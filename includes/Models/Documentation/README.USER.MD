## User Class

Represents a user in the application with various attributes and methods for user-related operations.

### Attributes

| Attribute                | Description                                           |
|--------------------------|-------------------------------------------------------|
| $db                      | Database connection object.                           |
| $first_name              | User's first name.                                    |
| $libraryDirectories      | User's library directories.                           |
| $last_name               | User's last name.                                     |
| $user_name               | User's username.                                      |
| $user_id                 | User's unique identifier.                             |
| $email_address           | User's email address.                                 |
| $display_photo           | User's display photo.                                 |
| $password                | Hashed user password.                                 |
| $reset_code              | Hashed reset code.                                    |
| $home_directory          | User's home directory.                                |
| $abs_path                | Absolute path in the server.                           |
| $is_authenticated        | Flag indicating whether the user is authenticated.    |
| $auth_token              | Authentication token.                                 |
| $is_registered           | Flag indicating whether the user is registered.       |
| $registration_date       | Date of user registration.                            |
| $last_active             | Timestamp of the user's last activity.                |
| $userFiles               | User's files metadata.                               |
| $last_password_reset     | Timestamp of the last password reset.                 |
| $account_status          | User account status (Active, Suspended, Inactive).    |

### Methods

| Method                                      | Description                                               |
|---------------------------------------------|-----------------------------------------------------------|
| __construct($db = null)                     | Constructor that initializes the database connection.     |
| isLoggedIn()                                | Checks if the user is logged in.                          |
| register($first_name, $last_name, $user_name, $email_address, $password) | Registers a new user.                                    |
| isDuplicateAccount()                        | Checks for duplicate user accounts.                       |
| insertUser()                                | Inserts a new user into the database.                     |
| runOnboardingScript()                      | Executes the onboarding script after successful registration. |
| createHomeDirectory()                       | Creates the user's home directory.                        |
| createLibraryDirectories()                  | Creates default library directories for the user.        |
| addDefaultLibraryDirectories()              | Adds default library directories to the database.        |
| copyDefaultDisplayPhoto()                   | Copies the default display photo to the user's root directory. |
| login($username, $password)                 | Logs in the user with the provided credentials.           |
| populateUserProperties($user)               | Populates user properties after successful login.        |
| generateSessionToken()                      | Generates a session token for the user.                   |
| updateLastActive()                          | Updates the last active timestamp in the database.        |
| retrieveLibraryDirectories()                | Retrieves user library directories from the database.    |
| getLibraryDirectories()                     | Gets the associative array of user's library directories. |
| changeProfilePicture($newImagePath)         | Changes the user's profile picture.                       |
| getId()                                     | Gets the user's ID.                                      |
| getAllFiles()                               | Retrieves all files associated with the user.             |
| getFilesByFilter($filterType)               | Retrieves files based on a preset filter type.            |
| filterFilesByMediaType($mediaType)          | Filters files by media type.                              |
| filterFilesByRecent()                       | Filters files by recent modifications.                    |
| uploadFile($directory_id, $fileId, $mediaType, $fileClassification, $file) | Uploads a file to the user's directory.           |
| insertFileMetadata($directory_id, $fileId, $mediaType, $fileClassification, $filePath) | Inserts file metadata into the database.    |
| deleteFile($fileId)                         | Deletes a file, moving it to the Trash directory.         |
| updateFileMetadata($fileId, $filePath, $fileClassification) | Updates file metadata in the database.    |
