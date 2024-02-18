<?php


namespace Controller;
include_once __DIR__ . "/../../vendor/autoloader.php";
include_once __DIR__."/../functions.php";

use Frontend\Directory;
use Frontend\FileRenderer;
use Frontend\Header;
use Frontend\Sidebar\Sidebar;
use Frontend\Sidebar\SidebarItem;


use Models\Database;
use Models\User;
use Models\AuthUser;
use Models\Sanitizer;

class LibraryController
{
    public static function includeDashboard()
    {
        // Include dashboard content here
    }

    public static function includeImages($mediaManager)
    {
        self::displayHeader('Images');
        self::displayMedia($mediaManager->getPhotoArray());
    }

    public static function includeVideos($mediaManager)
    {
        self::displayHeader('Videos');
        self::displayMedia($mediaManager->getVideoArray());
    }

    public static function includeAudios($mediaManager)
    {
        self::displayHeader('Audios');
        self::displayMedia($mediaManager->getAudioArray());
    }

    public static function includeRecents($mediaManager)
    {
        self::displayHeader('Recents');
        self::displayMedia($mediaManager->getRecentFileArray());
    }

    public static function includeTrash($mediaManager)
    {
        self::displayHeader('Trash');
        self::displayMedia($mediaManager->getTrashArray());
    }

    public static function includeHome()
    {
        // Include home content here
    }

    public static function includeUploads($mediaManager)
    {
        self::displayHeader('Uploads');
        self::displayMedia($mediaManager->getUploadsArray());
    }

    public static function includeLibrary($loggedInUser)
    {
        self::displayHeader('Libraries');
        $directories_array = $loggedInUser->getDirectoryArray();
        $_SESSION['directories'] = $directories_array;
        $uiDirectory = new Directory($directories_array);
        echo $uiDirectory->render();
    }

    public static function includeOobe()
    {
        if (isset($_SESSION['access_code'])) {
            include_once "pages/app/oobe.php";
        } else {
            header("Location: logout.php");
            exit;
        }
    }

    // Helper functions

    private static function displayHeader($title)
    {
        $lastAccess = date('F j, Y H:i:s');
        $breadcrumb = '<a class="caption-text" href="#">Home</a> / <a class="caption-text" href="#">' . $title . '</a>';
        $header = new Header($title, $lastAccess, $breadcrumb);
        echo $header->render();
    }

    private static function displayMedia($mediaArray)
    {
        $fileRenderer = new FileRenderer($mediaArray);
        echo $fileRenderer->render();
    }
}
