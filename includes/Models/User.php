<?php

/**
 * User class represents a user in the application with various attributes and methods for user-related operations.
 *
 * Attributes:
 * - $db: Database connection object.
 * - $first_name: User's first name.
 * - $libraryDirectories: User's library directories.
 * - $last_name: User's last name.
 * - $user_name: User's username.
 * - $user_id: User's unique identifier.
 * - $email_address: User's email address.
 * - $display_photo: User's display photo.
 * - $password: Hashed user password.
 * - $reset_code: Hashed reset code.
 * - $home_directory: User's home directory.
 * - $abs_path: Absolute path in the server.
 * - $is_authenticated: Flag indicating whether the user is authenticated.
 * - $auth_token: Authentication token.
 * - $is_registered: Flag indicating whether the user is registered.
 * - $registration_date: Date of user registration.
 * - $last_active: Timestamp of the user's last activity.
 * - $userFiles: User's files metadata.
 * - $last_password_reset: Timestamp of the last password reset.
 * - $account_status: User account status (Active, Suspended, Inactive).
 *
 * Methods:
 * - __construct($db = null): Constructor that initializes the database connection.
 * - isLoggedIn(): Checks if the user is logged in.
 * - register($first_name, $last_name, $user_name, $email_address, $password): Registers a new user.
 * - isDuplicateAccount(): Checks for duplicate user accounts.
 * - insertUser(): Inserts a new user into the database.
 * - runOnboardingScript(): Executes the onboarding script after successful registration.
 * - createHomeDirectory(): Creates the user's home directory.
 * - createLibraryDirectories(): Creates default library directories for the user.
 * - addDefaultLibraryDirectories(): Adds default library directories to the database.
 * - copyDefaultDisplayPhoto(): Copies the default display photo to the user's root directory.
 * - login($username, $password): Logs in the user with the provided credentials.
 * - populateUserProperties($user): Populates user properties after successful login.
 * - generateSessionToken(): Generates a session token for the user.
 * - updateLastActive(): Updates the last active timestamp in the database.
 * - retrieveLibraryDirectories(): Retrieves user library directories from the database.
 * - getLibraryDirectories(): Gets the associative array of user's library directories.
 * - changeProfilePicture($newImagePath): Changes the user's profile picture.
 * - getId(): Gets the user's ID.
 * - getAllFiles(): Retrieves all files associated with the user.
 * - getFilesByFilter($filterType): Retrieves files based on a preset filter type.
 * - filterFilesByMediaType($mediaType): Filters files by media type.
 * - filterFilesByRecent(): Filters files by recent modifications.
 * - uploadFile($directory_id, $fileId, $mediaType, $fileClassification, $file): Uploads a file to the user's directory.
 * - insertFileMetadata($directory_id, $fileId, $mediaType, $fileClassification, $filePath): Inserts file metadata into the database.
 * - deleteFile($fileId): Deletes a file, moving it to the Trash directory.
 * - updateFileMetadata($fileId, $filePath, $fileClassification): Updates file metadata in the database.
 */

namespace Models;

include_once "constants.php";
include_once "Database.php";
include_once "FileManager.php";
include_once ASSET_PATH."/../vendor/autoloader.php";


class User
{
    private $db;
    private $first_name;
    private $libraryDirectories = [];
    private $last_name;
    private $user_name;
    protected $user_id;
    private $email_address;
    private $display_photo;

    private $password;
    private $reset_code;

    private $home_directory;
    private $abs_path;

    private $is_authenticated;
    private $auth_token;
    private $is_registered;
    private $sessionToken;

    private $registration_date;
    private $last_active;
    private $userFiles;
    private $last_password_reset;
    private $account_status; //Active, Suspended, Inactive
    private $defaultPhotoPath;

    // constructor
    public function __construct( $db = null)
    {
        if ($db === null) {
            $databaseConfig = new Database();
            $this->db = $databaseConfig->getDbConnection();
        } else {
            $this->db = $db;
        }
        $this->defaultPhotoPath = ASSET_PATH . "user_icon.svg";
        $this->setHomeDirectory();




    }

    private function setHomeDirectory()
    {
        // Check if user_name is not null before setting home_directory
        if ($this->user_name !== null) {
            $this->home_directory = sprintf("%05d_%s", $this->user_id, strtoupper($this->user_name));
        } else {
            // Handle the case when $this->user_name is null
            // You might want to provide a default value or log a message.
        }
    }


    public function isLoggedIn(){
        return true;
//        return $this->sessionToken->isValidSessionToken($this->user_id);
    }
    public function logout()
    {
        $this->sessionToken->revokeSessionToken($this->user_id);

    }


    /**
     * Registers a new user.
     *
     * @param string $first_name The first name of the user.
     * @param string $last_name The last name of the user.
     * @param string $user_name The username of the user.
     * @param string $email_address The email address of the user.
     * @param string $password The password of the user.
     * @param string $access_code The access code of the user.
     *
     * @return bool True if the user is successfully registered, false otherwise.
     */
    public function register($first_name, $last_name, $user_name, $email_address, $password, $access_code)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->user_name = $user_name;
        $this->email_address = $email_address;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $hashed_access_code = password_hash($access_code, PASSWORD_DEFAULT); // Hash the access code

        if ($this->isDuplicateAccount()) {
            return false;
        }
        $this->insertUser($hashed_access_code); // Pass the hashed access code to insertUser
        $result = $this->login($user_name, $password);
        $this->user_id = $result['id'];
        $this->runOnboardingScript();

        return true;
    }

    private function isDuplicateAccount()
    {
        // Query to check for duplicate username or email
        $query = "SELECT id FROM vdetorre_project.de_torres_vincent_users WHERE username = ? OR email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $this->user_name, $this->email_address);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0; // Return true if a duplicate account is found
    }

    /**
     * Inserts a new user into the database.
     *
     * @param string $access_code The access code for the user.
     * @throws mysqli_sql_exception When encountering database errors.
     */
    private function insertUser($access_code)
    {
        try {
            // SQL query to insert a new user with access code
            $query = "INSERT INTO vdetorre_project.de_torres_vincent_users (firstname, lastname, username, email, password, access_code) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);

            // Bind parameters to the prepared statement
            $stmt->bind_param("ssssss", $this->first_name, $this->last_name, $this->user_name, $this->email_address, $this->password, $access_code);

            // Execute the statement
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === '1062') {
                echo "Error: Duplicate email address. Please choose a different email.";
            } else {
                throw $e;
            }
        }
    }

    private function runOnboardingScript()
    {
        $this->createHomeDirectory(__DIR__);
        $this->createLibraryDirectories();
        $this->copyDefaultDisplayPhoto();
        $this->addDefaultLibraryDirectories();
    }

    private function createHomeDirectory($base)
    {
        // Directory nomenclature: {user_id[left-padded(0)]}_{user_name[strtoupper]}
        $this->home_directory = sprintf("%05d_%s", $this->user_id, strtoupper($this->user_name));
        $media_path = $base."/../MEDIA/";
        mkdir($media_path . $this->home_directory);
    }

    private function createLibraryDirectories()
    {
        $library_directories = ["Photos", "Videos", "Audios", "Recents", "Trash", "Uploads"];
        $currentDir = dirname(__FILE__);
        // Construct the absolute path to the home directory
        $home_path = $currentDir . "/../MEDIA/" . $this->home_directory . "/";
        foreach ($library_directories as $directory) {
            mkdir($home_path . $directory);
        }
    }

    private function addDefaultLibraryDirectories()
    {
        // Assuming $this->user_id is set

        $library_directories = ["Photos", "Videos", "Audios", "Recents", "Trash", "Favorites","Uploads"];
        $home=$this->home_directory;
        $home_dir_id = md5(uniqid($home, true));
        $home_path = "/includes/MEDIA/" . $home ;
        $nullValue = null;



        foreach ($library_directories as $directory) {
            // Generate a unique directory ID
            $directory_id = md5(uniqid($directory, true));

            // Specify the path to the directory (inside the home directory)
            $directory_path = "../MEDIA/" . $this->home_directory . "/" . $directory;

            // Insert the directory information into the user_directories table
            $query = "INSERT INTO vdetorre_project.de_torres_vincent_user_directories (user_id, directory_id, directory_name, date_added, last_modified, directory_path,parent_directory_id) 
                      VALUES (?, ?, ?, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), ?,?)";
            $stmt = $this->db->prepare($query);

            $stmt->bind_param("issss", $this->user_id, $directory_id, $directory, $directory_path,$home_dir_id);
            $stmt->execute();
        }
        $query = "INSERT INTO vdetorre_project.de_torres_vincent_user_directories (user_id, directory_id, directory_name, date_added, last_modified, directory_path,parent_directory_id) 
                      VALUES (?, ?, ?, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), ?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("issss", $this->user_id, $home_dir_id, $home, $home_path,$nullValue);
        $stmt->execute();


    }

    private function copyDefaultDisplayPhoto()
    {
        $default_photo_path = ASSET_PATH."/user_icon.svg";
        $user_root_path = STORE_MASTER ."/". $this->home_directory . "/";
        copy($default_photo_path, $user_root_path . "user_icon.svg");
    }

    /**
     * Method to verify the user's password and fetch user data upon successful login.
     *
     * @param string $username The username to verify.
     * @param string $password The password to verify.
     * @return array|bool Returns the user data array if login is successful, false otherwise.
     */
    public function login($username, $password)
    {
        // Prepare the SQL query to fetch user data based on username
        $query = "SELECT * FROM vdetorre_project.de_torres_vincent_users WHERE username = ?";

        // Prepare and execute the query
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Get the result of the query
        $result = $stmt->get_result();

        // Fetch the row from the query result
        $row = $result->fetch_assoc();

        // Check if a single row is returned and verify password
        if ($result->num_rows === 1 && password_verify($password, $row['password'])) {
            // Return the user data array if login is successful
            return $row;
        }

        // Return false if login fails
        return false;
    }



//    private function populateUserProperties($user)
//    {
//        $this->user_id = $user['id'];
//        $this->first_name = $user['firstname'];
//        $this->last_name = $user['lastname'];
//        $this->user_name = $user['username'];
//        $this->email_address = $user['email'];
//        $this->is_authenticated = true;
//        $this->libraryDirectories = $this->getLibraryDirectories();
//
//    }

    private function generateSessionToken()
    {
        $sessionToken = new SessionToken($this->db);
        return $sessionToken->getSessionToken();
    }

//    private function updateLastActive()
//    {
//        // Update the last active timestamp in the database
//        $query = "UPDATE vdetorre_project.de_torres_vincent_users SET updated_at = CURRENT_TIMESTAMP() WHERE id = ?";
//        $stmt = $this->db->prepare($query);
//        $stmt->bind_param("i", $this->user_id);
//        $stmt->execute();
//    }

    private function retrieveLibraryDirectories()
    {
        if (!$this->isLoggedIn()) {
            // User not logged in, handle accordingly
            return false;
        }

        $query = "SELECT directory_id, directory_name FROM vdetorre_project.de_torres_vincent_user_directories WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $this->user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            // Store directory_id and directory_name as key-value pairs in the associative array
            $this->libraryDirectories[$row['directory_id']] = $row['directory_name'];
        }

        return true;
    }

    // Get the associative array of user's library directories
    public function getLibraryDirectories()
    {
        return $this->libraryDirectories;
    }

    public function changeProfilePicture($newImagePath)
    {
        // Assuming the user has logged in and $this->user_id is set

        // Specify the path where the new profile picture will be saved
        $user_root_path = "../MEDIA/" . $this->home_directory . "/";
        $newImageName = "new_profile_picture.jpg";

        // Save the new profile picture to the user's root directory
        if (copy($newImagePath, $user_root_path . $newImageName)) {
            // Update the display_photo property in the database
            $this->display_photo = $newImageName;
            // You might want to update the database here to store the new image name
            // Example query: "UPDATE vdetorre_project.de_torres_vincent_users SET display_photo = ? WHERE id = ?"
        }
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAllFiles()
    {
        if (!$this->isLoggedIn()) {
            // User not logged in, handle accordingly
            return [];
        }

        // Retrieve all files associated with the user
        $query = "SELECT * FROM vdetorre_project.de_torres_vincent_user_files WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $this->user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $this->userFiles = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getFilesByFilter($filterType)
    {
        if (!$this->isLoggedIn()) {
            // User not logged in, handle accordingly
            return [];
        }

        // Define filter types (you can customize these based on your application's needs)
        $validFilterTypes = ["Photos", "Audios", "Videos", "Recent"];

        // Validate the provided filter type
        if (!in_array($filterType, $validFilterTypes)) {
            // Invalid filter type, handle accordingly
            return [];
        }

        // Retrieve files based on the specified filter type
        switch ($filterType) {
            case "Photos":
                return $this->filterFilesByMediaType("photo");
            case "Audios":
                return $this->filterFilesByMediaType("audio");
            case "Videos":
                return $this->filterFilesByMediaType("video");
            case "Recent":
                return $this->filterFilesByRecent();
            default:
                return [];
        }
    }

    private function filterFilesByMediaType($mediaType)
    {
        return array_filter($this->userFiles, function ($file) use ($mediaType) {
            return $file['file_classification'] === $mediaType;
        });
    }

    private function filterFilesByRecent()
    {
        // Sort files by last modified timestamp in descending order
        usort($this->userFiles, function ($file1, $file2) {
            return strtotime($file2['last_modified']) - strtotime($file1['last_modified']);
        });

        return $this->userFiles;
    }


    public function setAuthToken($id,$token){
        $instanceId = $this->user_id;

        if ($id==$instanceId){
            $this->auth_token = $token;

        }else{
            return false;
        }

        return true;
    }

    public  function getAuthToken($id){
        $instanceId = $this->user_id;
        if ($id==$instanceId){
            return $instanceId;
        }else{
            return false;
        }
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }


    // Setter and getter for $libraryDirectories
    public function setLibraryDirectories($libraryDirectories)
    {
        $this->libraryDirectories = $libraryDirectories;
    }


    // Setter and getter for $last_name
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    // Setter and getter for $user_name
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    public function getUserName()
    {
      return   $this->user_name;
    }

    // Setter and getter for $user_id
    protected function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    // Setter and getter for $email_address
    public function setEmailAddress($email_address)
    {
        $this->email_address = $email_address;
    }

    public function getEmailAddress()
    {
        return $this->email_address;
    }

    // Setter and getter for $display_photo
    public function setDisplayPhoto($display_photo)
    {
        $this->display_photo = $display_photo;
    }

    public function getDisplayPhoto()
    {
        return $this->display_photo;
    }


    public function getHomeDirectory()
    {
        if (!$this->home_directory) {

        }

        return $this->home_directory;
    }





}
