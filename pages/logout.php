<?php
/**
 * Logout Script
 *
 * This script handles the logout functionality by revoking the session token,
 * clearing session variables, destroying the session, and redirecting the user
 * to the login pages with a logout success message.
 */

use Models\SessionToken;

$sessionManager = new SessionToken();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["auth_token"]) && isset($_SESSION["user_id"])) {
    $sessionManager->revokeSessionToken($_SESSION["user_id"]);
}

$_SESSION = array();

session_destroy();

header("Location: ..\index.php?logout=success&page=login");
exit();
