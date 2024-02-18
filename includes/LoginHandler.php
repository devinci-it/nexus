<?php
session_start();

include_once "../vendor/autoloader.php";

use Models\Sanitizer;
use Models\User;
use Models\AuthUser;

// Function to set session variables
function setSessionVariables(AuthUser $user, $auth,$user_name) {
    $_SESSION['user_id'] = $user->getId();
    $_SESSION['username'] =$user_name;
    $_SESSION['auth_token'] = $auth;
}

// Function to destroy session
function destroySession() {
    session_unset();
    session_destroy();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    // Create User object
    $user = new User();

    // Sanitize input
    $sanitize = new Sanitizer();
    $username = $sanitize::sanitizeInput($_POST['username']);
    $password = $sanitize::sanitizeInput($_POST['password']);

    // Attempt login with hashed password
    $result = $user->login($username, $password);
    $_SESSION['user_info']=$result;


    // Debug: Output login attempt result
//    var_dump($result);

    // Check login result
    if ($result) {
        $user_id = $result['id'];
        // Debug: Output authenticated user object
        $authenticatedUser=new AuthUser($result,$user_id);
//        var_dump($authenticatedUser);
        $token= $authenticatedUser->getToken();


        // Set session variables for user_id, username, and auth_token
        setSessionVariables($authenticatedUser,$token,$username);

        // Redirect user to .home.php with login success parameter
        header('Location: ../library.php?login=success&page=home');
        exit(); // Terminate script execution after redirection
    } else {
        // Debug: Output login failure message
        echo "Login failed. Redirecting to logout page.";

        // Redirect if login fails
        header('Location: ../index.php?page=logout');
        exit();
    }
}
