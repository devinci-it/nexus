<?php
/**
 * Logout Page
 *
 * This PHP script handles the logout functionality by clearing all session variables
 * and destroying the session. After logout, the user is redirected to the login page.
 *
 */

// Start session
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header("Location: index.php?page=login");
exit();

