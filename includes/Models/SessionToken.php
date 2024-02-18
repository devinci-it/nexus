<?php

namespace Models;
include_once __DIR__."/../../vendor/autoloader.php";


use Models\Database;

class SessionToken
{
    private $conn;
    private $sessionToken;

    public function __construct($userId, $databaseConnection = null)
    {
        if ($databaseConnection === null) {
            $databaseConfig = new Database();
            $this->conn = $databaseConfig->getDbConnection();
        } else {
            $this->conn = $databaseConnection;
        }

        $this->sessionToken = $this->generateToken();
        $this->addSessionToken($userId); // Automatically add the session token for the user_id
    }

    public function getSessionToken()
    {
        return $this->sessionToken;
    }

    private function generateToken($length = 32)
    {
        // Generate a random token of the specified length
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $token;
    }

    private function addSessionToken($userId)
    {
        // Revoke any existing active token for the user
        $this->revokeActiveTokens($userId);

        // Generate a new session token
        $sessionToken = $this->generateToken();

        // Set expiration time to 8 hours from the current time
        $expiration = date('Y-m-d H:i:s', strtotime('+8 hours'));

        $status = 'active';

        // Prepare and bind parameters to prevent SQL injection
        $stmt = $this->conn->prepare("INSERT INTO de_torres_vincent_session_tokens (user_id, session_token, expiration, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $userId, $sessionToken, $expiration, $status);

        // Execute the statement
        if ($stmt->execute()) {
            $this->sessionToken = $sessionToken;
            return true;
        } else {
            echo "Failed to add session token: " . $stmt->error;
            return false;
        }
    }

    private function revokeActiveTokens($userId)
    {
        // Set status of all active tokens for the user to 'expired'
        $status = 'expired';

        // Prepare and bind parameters to prevent SQL injection
        $stmt = $this->conn->prepare("UPDATE de_torres_vincent_session_tokens SET status = ? WHERE user_id = ? AND status = 'active'");
        $stmt->bind_param("ss", $status, $userId);

        // Execute the statement
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Failed to revoke active session tokens: " . $stmt->error;
            return false;
        }
    }

    public function isValidSessionToken($userId)
    {
        $sessionToken = $this->getSessionToken();

        $currentDateTime = date('Y-m-d H:i:s');

        // Prepare and bind parameters to prevent SQL injection
        $stmt = $this->conn->prepare("SELECT * FROM de_torres_vincent_session_tokens WHERE user_id = ? AND session_token = ? AND expiration > ? AND status = 'active'");
        $stmt->bind_param("sss", $userId, $sessionToken, $currentDateTime);

        // Execute the statement
        $stmt->execute();

        // Check if there are any results
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function revokeSessionToken($userId)
    {
        $sessionToken = $this->getSessionToken();

        // Prepare and bind parameters to prevent SQL injection
        $stmt = $this->conn->prepare("UPDATE de_torres_vincent_session_tokens SET status = 'expired' WHERE user_id = ? AND session_token = ?");
        $stmt->bind_param("ss", $userId, $sessionToken);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Session token revoked successfully!";
        } else {
            echo "Failed to revoke session token: " . $stmt->error;
        }
    }

    public function renewSessionToken($userId)
    {
        $sessionToken = $this->getSessionToken();

        // Set expiration time to 8 hours from the current time
        $expiration = date('Y-m-d H:i:s', strtotime('+8 hours'));

        // Prepare and bind parameters to prevent SQL injection
        $stmt = $this->conn->prepare("UPDATE de_torres_vincent_session_tokens SET expiration = ? WHERE user_id = ? AND session_token = ?");
        $stmt->bind_param("sss", $expiration, $userId, $sessionToken);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Session token renewed successfully!";
        } else {
            echo "Failed to renew session token: " . $stmt->error;
        }
    }
}



//// Specify the user ID for testing
//$userId = 37; // Example user ID
//
//// Create a new session token for the specified user ID
//$sessionToken = new SessionToken($userId);
//
//// Retrieve the generated session token
//$token = $sessionToken->getSessionToken();
//echo "Generated Session Token: $token\n";
//
//// Check if the generated session token is valid for the specified user ID
//$isTokenValid = $sessionToken->isValidSessionToken($userId);
//if ($isTokenValid) {
//    echo "Session token is valid for user ID $userId\n";
//} else {
//    echo "Session token is invalid for user ID $userId\n";
//}
//
//// Revoke the session token for the specified user ID
//$sessionToken->revokeSessionToken($userId);
//
//// Renew the session token for the specified user ID
//$sessionToken->renewSessionToken($userId);