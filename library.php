<?php
session_start();

require_once "vendor/autoloader.php";
require_once "includes/functions.php";

use Frontend\Directory;
use Frontend\FileRenderer;
use Frontend\Header;
use Frontend\ActionMenu\ActionMenu;
use Models\AuthUser;

// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$requiredSessionVariables = ['user_id', 'username', 'auth_token', 'user_info'];

// Check if any required session variables are missing or empty
foreach ($requiredSessionVariables as $variable) {
    if (!isset($_SESSION[$variable]) || empty($_SESSION[$variable])) {
        // Redirect to logout page if any required session variable is missing or empty
        header("Location: index.php?page=logout");
        exit();
    }
}

function includeTopNav()
{
    include "template/nav.php";
}



$loggedInUser = new AuthUser(
    $_SESSION['user_info'],
    $_SESSION['user_id']
);
$mediaManager = $loggedInUser->getMediaManagerObject();
$fileRenderer=new FileRenderer($mediaManager->getAllFiles());
$_SESSION['home_dir'] = str_pad($_SESSION['user_id'], 5, '0', STR_PAD_LEFT) . "_" . strtoupper($_SESSION['username']);
$_SESSION['home_path'] = "includes/MEDIA/{$_SESSION['home_dir']}";


include_once "template/header.php";
?>
<style>
    .container.grid.grid-2r {
        display: grid;
        grid-template-columns: minmax(200px, auto) 1fr;
        grid-gap: 10px;
        padding: 0;
        margin: 0;
    }

    main#library-main{
        padding: 0;
        height: 100vh;
        overflow: hidden;
    }
    main#library-main .sidebar{
        grid-area: 1 / 1 / 2 / 2; /* Start at row 1, column 1 and end at row 2, column 2 */
    }

    .content-wrapper{
        position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            margin: 30px auto;
            width: 100%;
        height: 100%;
        overflow: scroll;
            padding: 30px;

    }

    .header-section {
        display: flex;
        justify-content: center;
        align-items: center;
        grid-column-start: 2;
    }
    aside{
        grid-row-start: 0;
    }

    .file-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%; /* Adjust as needed */
    }
</style>
<body>


<main id="library-main">

<div class="container grid grid-2r">

    <?php
    include_once "template/sidebar.php";

    $page = $_GET['page'] ?? '';
    if ($page==''){
            $_GET['page'] = 'home';
    }


    include_once "template/sidebar.php"
    ?>

    <div class="content-wrapper">

        <?php

//        include_once "template/nav.php";


        if(isset($_GET['action'])){
            $action=$_GET['action'];
                switch ($action){
                    case 'upload':
                        include_once "upload.php";
                        break;

                }
        }else{
            $browse= $_GET['page'] ;
            switch ($browse) {
                case 'dashboard':
                    include_once "pages/app/dashboard.php";
                    break;

                case 'images':
//                    includeTopNav();
                    displayHeader('Images');
                    displayMedia($mediaManager->getPhotoArray());
                    break;

                case 'videos':
//                    includeTopNav();
                    displayHeader('Videos');
                    displayMedia($mediaManager->getVideoArray());
                    break;

                case 'audios':
//                    includeTopNav();
                    displayHeader('Audios');
                    displayMedia($mediaManager->getAudioArray());
                    break;

                case 'recents':
//                    includeTopNav();
                    displayHeader('Recents');
                    displayMedia($mediaManager->getRecentFileArray());
                    break;

                case 'trash':
                    displayHeader('Trash');
                    displayMedia($mediaManager->getTrashArray());
                    break;

                case 'home':
                    include_once "pages/app/oobe.php";
                    break;

                case 'uploads':
                    displayHeader('Uploads');
                    displayMedia($mediaManager->getUploadsArray());
                    break;

                case 'library':
                    displayHeader('Libraries');
                    $directories_array = $loggedInUser->getDirectoryArray();
                    $_SESSION['directories'] = $directories_array;
                    $uiDirectory = new Directory($directories_array);
                    echo $uiDirectory->render();
                    break;

                case 'oobe':
                    if (isset($_SESSION['access_code'])) {
                        include_once "pages/app/oobe.php";
                    } else {
                        header("Location: logout.php");
                        exit();
                    }
                    break;

                default:
                    include_once "pages/404.php";
                    break;
            }


        }

include_once "template/menu.php";
        // Example usage:

//        print_r($mediaManager->getAllFiles());
        ?>
    </div>
</div>
</main>

</body>

