
## FileManager Class

Handles file management operations, including uploading, sanitizing, and database interactions.

### Summary
- **File:** [includes/Models/FileManager.php](includes/Models/FileManager.php)
- **Description:** Manages file-related operations such as uploading, sanitizing, and interacting with the database.

### Attributes

| Attribute              | Description                                         |
|------------------------|-----------------------------------------------------|
| $db                    | Database connection object.                         |
| $home                  | Home directory for file storage.                    |

### Methods

| Method                              | Description                                                                                   |
|-------------------------------------|-----------------------------------------------------------------------------------------------|
| __construct(Database $db)           | Constructor to initialize FileManager with a database connection.                           |
| sanitizeFileName(string $fileName)  | Sanitizes a given file name.                                                                |
| getDynamicPathByExtension(string $extension) | Determines dynamic path based on file extension.                                     |
| getDestinationDirectory(User $user, string $fileType, string $subdirectory) | Gets the destination directory for a file based on user, file type, and subdirectory.  |
| moveFile(array $file, string $destinationPath) | Moves a file to the specified destination path.                                       |
| uploadFile(User $user, string $fileType, array $files, ?string $directory = null) | Uploads files to the specified directory for a user.                             |
| insertFileMetadata(int $userId, int $fileId, string $fileType, array $file, int $directoryId, string $homeDirectory, string $username) | Inserts file metadata into the database.                                           |
