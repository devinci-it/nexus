<?php
namespace Models;

/**
 * FileManager class handles file management operations, including uploading, sanitizing, and database interactions.
 *
 * Attributes:
 * - $db: Database connection object.
 * - $home: Home directory for file storage.
 *
 * Methods:
 * - __construct(Database $db): Constructor to initialize FileManager with a database connection.
 * - sanitizeFileName(string $fileName): Sanitizes a given file name.
 * - getDynamicPathByExtension(string $extension): Determines dynamic path based on file extension.
 * - getDestinationDirectory(User $user, string $fileType, string $subdirectory): Gets the destination directory for a file based on user, file type, and subdirectory.
 * - moveFile(array $file, string $destinationPath): Moves a file to the specified destination path.
 * - uploadFile(User $user, string $fileType, array $files, ?string $directory = null): Uploads files to the specified directory for a user.
 * - insertFileMetadata(int $userId, int $fileId, string $fileType, array $file, int $directoryId, string $homeDirectory, string $username): Inserts file metadata into the database.
 */



class FileManager
{
    private const ALLOWED_SUBDIRECTORIES = ['Audios', 'Favorites', 'Photos', 'Recents', 'Trash', 'Uploads', 'Videos'];

    private const STORE_MASTER = __DIR__ . "/../MEDIA/";
    private $db;
    private $home;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    /**
     * Sanitizes a given file name.
     *
     * @param string $fileName The original file name to be sanitized.
     *
     * @return string The sanitized file name.
     */
    private function sanitizeFileName($fileName)
    {
        $fileName = preg_replace("/[^a-zA-Z0-9_.]/", '_', $fileName);
        $fileName = preg_replace("/_+/", '_', $fileName);
        $fileName = trim($fileName, '_');
        if (empty($fileName)) {
            $fileName = 'default_filename';
        }
        $maxFileNameLength = 255;
        $fileName = substr($fileName, 0, $maxFileNameLength);
        return $fileName;
    }

    private function getDynamicPathByExtension($extension)
    {
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff'])) {
            return 'Photos/';
        } elseif (in_array($extension, ['mp4', 'avi', 'mkv', 'mov', 'wmv', 'flv'])) {
            return 'Videos/';
        } elseif (in_array($extension, ['mp3', 'wav', 'ogg', 'aac', 'flac', 'm4a'])) {
            return 'Audios/';
        } else {
            return 'Other/';
        }
    }

    private function getDestinationDirectory(User $user, $fileType, $subdirectory)
    {
        $userId = $user->getUserId();
        $paddedUserId = sprintf("%06d", $userId);
        $userName = strtoupper($userId."_".$user->getUserName());
        $fileType=$this->getDynamicPathByExtension($fileType); //*
        $destinationDirectory = "/{$userName}/{$fileType}{$subdirectory}/";

        return $destinationDirectory;
    }

    private function moveFile($file, $destinationPath)
    {
        if (move_uploaded_file($file['tmp_name'], $destinationPath)) {
            echo "File moved successfully.\n";
        } else {
            echo "Error moving the file.\n";
        }
    }

    /**
     * Upload files to the specified directory for a user.
     *
     * @param User $user The user object.
     * @param string $fileType The type of files being uploaded.
     * @param array $files An array of files to be uploaded.
     * @param string|null $directory The subdirectory within the user's directory.
     *
     * @return void
     */
    public function uploadFile(User $user, string $fileType, array $files, ?string $directory = null)
    {
        $fileList = $this->destructureFilesArray($files);

        foreach ($fileList as $fileData) {
            $subdirectory = $fileData['subdirectory'] ?? 'Uploads';
            if (!$this->isValidSubdirectory($subdirectory)) {
                $subdirectory = 'Uploads';
            }
            $destinationDirectory = $this->getDestinationDirectory($user, $fileType, $subdirectory);
            if (!file_exists($destinationDirectory) && !is_dir($destinationDirectory)) {
                mkdir($destinationDirectory, 0777, true);
            }
            $fileName = $this->sanitizeFileName($fileData['name']);
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);

            if (!$this->isValidExtension($extension)) {
                echo "Invalid file extension for file: $fileName. Skipping.\n";
                continue; // Skip to the next file
            }
            $dynamicPath = $this->getDynamicPathByExtension($extension);
            $destinationPath = $destinationDirectory . $dynamicPath . $fileName;

            $this->moveFile($fileData, $destinationPath);


        }
    }


    private function insertFileMetadata($userId, $fileId, $fileType, $file, $directoryId, $homeDirectory, $username)
    {
        $filePath = $homeDirectory . '/' . $fileId . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
        $mediaType = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileClassification = 'others';

        $sql = "INSERT INTO vdetorre_project.de_torres_vincent_user_files 
            (user_id, directory_id, file_id, media_type, file_classification, file_path, file_type, original_filename, upload_date, username)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("issssssss", $userId, $directoryId, $fileId, $mediaType, $fileClassification, $filePath, $fileType, $file['name'], $username);
        $stmt->execute();
        $stmt->close();

        echo "File metadata inserted into the database." . PHP_EOL;
    }
}


