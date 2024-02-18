<?php
/**
 * This script handles user registration.
 *
 * It starts a session, sanitizes user input, and attempts to register a new user.
 * Upon successful registration, it generates a dynamically generated access code,
 * sets it to the session, and redirects the user to the out-of-box experience page (oobe.php).
 * If registration fails or if the request method is not POST, it redirects the user to the
 * index page with an error parameter.
 **/

include_once "../vendor/autoloader.php";
include_once "functions.php";

use Models\Sanitizer;
use Models\User;

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Instantiate the Sanitizer class
    $sanitizer = new Sanitizer();

    $first_name = $sanitizer->sanitizeInput($_POST['firstname']);
    $last_name = $sanitizer->sanitizeInput($_POST['lastname']);
    $user_name = $sanitizer->sanitizeInput($_POST['username']);
    $email_address = $sanitizer->sanitizeInput($_POST['email']);
    $password = password_hash($sanitizer->sanitizeInput($_POST['password']), PASSWORD_BCRYPT);

    // Create a User object
    $user = new User();

    $access_code = generateRandomString(8);


    if ($user->register($first_name, $last_name, $user_name, $email_address, $password,$access_code)) {

        // Set the access code to the session
        $_SESSION['access_code'] = $access_code;

        // Redirect to oobe.php after successful registration
        header("Location: ../.home.php?page=oobe");
        exit();
    }
} else {
    if (isset($conn)) {
        mysqli_close($conn);
    }
    header("Location: ../index.php?error=access_invalid");
    exit();
}