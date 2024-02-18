<?php
namespace Models\MediaManager;
use Models\Database;

class MediaManager
{
    private array $directories;
    private array $home_directory;
    private string $directory_absolute_path;
    private array $fileArray;
    private array $recentFileArray;
    private array $photoArray;
    private array $videoArray;
    private array $uploadsArray;
    private array $audioArray;
    private array $trashArray;

    public function __construct(array $directories, array $files)
    {
        $this->directories = $directories;
        $this->populateFileArrays($files);
        $this->fileArray=$files;
    }

    public function instantiateMediaDirectories()
    {
        $mediaDirectories = [];

        foreach ($this->directories as $directoryInfo) {
            $mediaDirectory = new MediaDirectory(
                $directoryInfo['id'],
                $directoryInfo['user_id'],
                $directoryInfo['directory_id'],
                $directoryInfo['directory_name'],
                $directoryInfo['date_added'],
                $directoryInfo['last_modified'],
                $directoryInfo['last_accessed'],
                $directoryInfo['directory_path'],
                $directoryInfo['username']
            );

            $mediaDirectories[] = $mediaDirectory;
        }

        return $mediaDirectories;
    }

    private function populateFileArrays(array $files)
    {
        // Sort files by date_added in descending order
        usort($files, function($a, $b) {
            return strtotime($b['date_added']) - strtotime($a['date_added']);
        });

        // Populate recentFileArray with the first 50 files
        $this->recentFileArray = array_slice($files, 0, 50);

        foreach ($files as $file) {
            // Check file type and add to respective arrays
            switch ($file['media_type']) {
                case 'image':
                    $this->photoArray[] = $file;
                    break;
                case 'video':
                    $this->videoArray[] = $file;
                    break;
                case 'audio':
                    $this->audioArray[] = $file;
                    break;
                default:
                    // Assume uploads or other types
                    $this->uploadsArray[] = $file;
                    break;
            }

            // Check if the file belongs to the "Trash" directory
//            if ($file['directory_name'] === 'Trash') {
//                // Add file to trashArray
//                $this->trashArray[] = $file;
//            }
        }
    }

    // Getter methods for accessing file arrays
    public function getRecentFileArray(): array
    {
        return $this->recentFileArray;
    }

    public function getPhotoArray(): array
    {
        return $this->photoArray;
    }

    public function getVideoArray(): array
    {
        return $this->videoArray;
    }

    public function getUploadsArray(): array
    {
        return $this->uploadsArray;
    }

    public function getAudioArray(): array
    {
        return $this->audioArray;
    }

    public function getTrashArray(): array
    {
        return $this->trashArray;
    }

    public function getAllFiles():array
    {
        return $this->fileArray;

    }
}

