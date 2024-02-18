<?php

use Models\Database;
use Frontend\Directory;
use Frontend\FileRenderer;
use Frontend\Sidebar\Sidebar;
use Frontend\Sidebar\SidebarItem;
use Frontend\Header;
use Controller\LibraryController;


use Models\User;
use Models\AuthUser;
use Models\Sanitizer;
function generateRandomString($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function hashString($inputString) {
    return password_hash($inputString, PASSWORD_BCRYPT);
}

function verifyPassword($inputPassword, $hashedPassword) {
    return password_verify($inputPassword, $hashedPassword);
}

function sanitizeInput($input){
    return htmlspecialchars(trim($input));
}
function updateSessionTokenStatus($userId, $token) {
    // Create an instance of the Database class
    $databaseConfig = new Database();

    // Get a database connection
    $conn = $databaseConfig->getDbConnection();

    // Check if the connection is successful
    if ($conn === false) {
        // Handle the connection failure (log, display an error message, etc.)
        echo "Failed to connect to the database.";
        return;
    }

    // SQL query to update the session token status
    $sql = "UPDATE vdetorre_project.de_torres_vincent_session_tokens 
            SET status = 'expired' 
            WHERE user_id = ? AND session_token = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Handle error, for example:
        die("Error: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("is", $userId, $token);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        // Handle error, for example:
        die("Error: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}



/*
 *
 * HOMEPAGE
 */
function displayHeader($title) {
    $lastAccess = date('F j, Y H:i:s');
    $breadcrumb = '<a class="caption-text" href="#">Home</a> / <a class="caption-text" href="#">' . $title . '</a>';
    $header = new Header($title, $lastAccess, $breadcrumb);
    echo $header->render();
}

function displayMedia($mediaArray) {
    $fileRenderer = new FileRenderer($mediaArray);
    echo $fileRenderer->render();
}
