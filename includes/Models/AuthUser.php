<?php

namespace Models;

use Exception;
use Models\MediaManager\MediaManager;

class AuthUser extends User {

    private Database $authDb;
    private bool $is_authenticated;
    protected  $user_id;
    private array $userDirectories;
    private string $first_name;
    private string $last_name;
    private string $user_name;
    private string $email_address;
    private string $password;
    private string $contact_number;
    private string $address;
    private string $access_level;
    private string $status;
    private string $access_code;
    private string $created_at;

    private array $fileArray;

    private string $updated_at;
    private string $session_token;

    private SessionToken $sessionToken;
    private MediaManager $mediaManager;

    public function __construct($userData, $user_id) {

        $this->authDb = new Database();
        parent::__construct($this->authDb);
        $this->is_authenticated = true;
        $this->populateUserProperties($userData);
        $this->fileArray = $this->getAllUserFiles($user_id);

        // Initialize SessionToken object
        $this->sessionToken = new SessionToken($user_id);
        $this->session_token = $this->sessionToken->getSessionToken();

        $this->userDirectories = $this->getUserDirectories($this->user_id);
        $this->mediaManager=new MediaManager($this->userDirectories,$this->fileArray);

    }


    private function getAllUserFiles($userId)
    {
        $query = "SELECT * FROM vdetorre_project.de_torres_vincent_user_files WHERE user_id = ? ORDER BY date_added DESC";
        $dbConnection = $this->authDb->getDbConnection();

        if (!$dbConnection) {
            throw new Exception("Failed to establish a database connection.");
        }

        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $files = [];
        while ($row = $result->fetch_assoc()) {
            $files[] = $row;
        }

        return $files;
    }

    public function getFileArray()
    {
        return $this->fileArray;
    }

    public function getToken()
    {
        return $this->session_token;
    }

    private function populateUserProperties($userData)
    {
        $this->user_id = $userData['id'];
        $this->first_name = $userData['firstname'] ?? '';
        $this->last_name = $userData['lastname'] ?? '';
        $this->user_name = $userData['username'] ?? '';
        $this->email_address = $userData['email'] ?? '';
        $this->password = $userData['password'] ?? '';
        $this->contact_number = $userData['contact_number'] ?? ''; // Provide a default value if null
        $this->address = $userData['address'] ?? '';
        $this->access_level = $userData['access_level'] ?? '';
        $this->status = $userData['status'] ?? '';
        $this->access_code = $userData['access_code'] ?? '';
        $this->created_at = $userData['created_at'] ?? '';
        $this->updated_at = $userData['updated_at'] ?? '';
    }

    private function populateFileArrays()
    {
        $db=$this->authDb->getDbConnection();

        $query = "SELECT * FROM vdetorre_project.de_torres_vincent_user_files WHERE user_id = ? ORDER BY date_added DESC LIMIT 50";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $this->user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Initialize arrays
        $this->fileArray = [];

        // Fetch files and populate arrays
        while ($row = $result->fetch_assoc()) {
            // Add file to fileArray
            $this->fileArray[] = $row;

            // Check if the file belongs to the "Recents" directory
            if ($row['directory_name'] === 'Recents') {
                // Add file to recentFileArray
                $this->recentFileArray[] = $row;
            }
        }
    }


    public function getDirectoryArray()
    {
        return $this->userDirectories;
    }

    private function getUserDirectories($userId) {
        $query = "SELECT * FROM vdetorre_project.de_torres_vincent_user_directories WHERE user_id = ?";
        $dbConnection = $this->authDb->getDbConnection();
        if (!$dbConnection) {
            throw new Exception("Failed to establish a database connection.");
        }
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $directories = [];
        while ($row = $result->fetch_assoc()) {
            $directories[] = $row;
        }
        return $directories;
    }

    public function getMediaManagerObject()
    {
        return $this->mediaManager;
    }
    private function updateLastActive()
    {
        $query = "UPDATE vdetorre_project.de_torres_vincent_users SET updated_at = CURRENT_TIMESTAMP() WHERE id = ?";
        $stmt = $this->authDb->prepare($query);
        $stmt->bind_param("i", $this->user_id);
        $stmt->execute();
    }

    public function getAuthToken($id)
    {
        return $this->session_token;
    }

    private function verifyAuthToken($authToken, $db) {
        if (empty($authToken) || !$db) {
            return false;
        }
        $query = "SELECT id FROM vdetorre_project.de_torres_vincent_session_tokens WHERE session_token = :token AND expiration > NOW() AND status = 'active'";
        $statement = $db->prepare($query);
        $statement->bindParam(':token', $authToken, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        }
        return false;
    }
}

