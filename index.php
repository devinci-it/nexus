<?php
session_start();
/**
 * Application Entry Point
 *
 * PHP version 8.1
 *
 * This PHP script serves as the entry point of the application developed as part of the CS85 PHP course during the Intersession 2024.
 * The script is designed to facilitate the initiation of sessions, inclusion of essential files like the autoloader and fe.templates,
 *  and proper routing of requests to their respective pages.
 *
 * The CS85 PHP course, undertaken during the Intersession 2024, focuses on equipping students with Introductory skills in PHP programming.
 * @package  Nexus
 *
 * @author   VINCENT DE TORRES <DE_TORRES_VINCENT_01@students.smc.edu>
 * @link    github.com/devinci-it
 */

require_once "vendor/autoloader.php";

use Frontend\Directory;
use Frontend\InputButton\InputButton;
use Frontend\InputButton\InputButtonBuilder;
use Frontend\InputIcon\InputIcon;
use Frontend\InputIcon\InputIconBuilder;

use Models\Database;
use Models\User;
use Models\AuthUser;
use Models\Sanitizer;
use Controller\LibraryController;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "template/header.php";
include_once "template/nav.php";

$page = $_GET['page'] ?? '';

switch ($page) {
    case 'login':
        include_once "pages/login.php";
        break;

    case 'signup':
        include_once "pages/register.php";
        break;

    case 'logout':
        session_destroy();
        header("Location: logout.php");
        exit(); // Terminate script execution after redirection
        break;

    case 'upload':
        header("Location: upload.php");
        break;

    case 'dashboard':

        if (isset($_SESSION['auth_token'])) {
            header("Location: library.php");
            exit();
        } else {
            include_once "pages/404.php";
        }
        break;

    default:
        session_destroy();
        include_once "pages/login.php";
        break;
}

include_once "template/footer.php";

