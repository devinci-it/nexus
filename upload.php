<?php
session_start();

require_once "vendor/autoloader.php";
require_once "includes/functions.php";

use Frontend\Directory;
use Frontend\FileRenderer;
use Frontend\Header;
use Frontend\ActionMenu\ActionMenu;
use Frontend\Sidebar\IconSideBar;
use Frontend\Sidebar\Sidebar;

use Models\AuthUser;

$requiredSessionVariables = ['user_id', 'username', 'auth_token', 'user_info'];

// Check if any required session variables are missing or empty
foreach ($requiredSessionVariables as $variable) {
    if (!isset($_SESSION[$variable]) || empty($_SESSION[$variable])) {
        // Redirect to logout page if any required session variable is missing or empty
        header("Location: index.php?page=logout");
        exit();
    }
}
function formatFileSize($bytes) {
    if ($bytes === 0) return '0 B';
    $k = 1024;
    $sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
    $i = floor(log($bytes) / log($k));
    return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
}

include_once "template/header.php";
?>
<body id="upload">
<aside class="icon-sidebar">

<?php
include_once "template/sidebaricon.php";
?>
</aside>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <main>
        <?php

        displayHeader("Upload File");

        ?>
        <div class="container">


    <div>
        <input class="btn form-input" onclick="selectFiles()" value="Add Files" id="fileInput">

        <div id="dragAndDropArea" class="drag_and_drop_area">
            <h2 class="title-medium-text light-text">
                Drag and Drop Files Here
            </h2>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="46" height="46">
                <path fill="#c4c4c4" d="M2 1.75C2 .784 2.784 0 3.75 0h5.586c.464 0 .909.184 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v8.586A1.75 1.75 0 0 1 12.25 15h-7a.75.75 0 0 1 0-1.5h7a.25.25 0 0 0 .25-.25V6H9.75A1.75 1.75 0 0 1 8 4.25V1.5H3.75a.25.25 0 0 0-.25.25V4.5a.75.75 0 0 1-1.5 0Zm-.5 10.487v1.013a.75.75 0 0 1-1.5 0v-1.012a3.748 3.748 0 0 1 3.77-3.749L4 8.49V6.573a.25.25 0 0 1 .42-.183l2.883 2.678a.25.25 0 0 1 0 .366L4.42 12.111a.25.25 0 0 1-.42-.183V9.99l-.238-.003a2.25 2.25 0 0 0-2.262 2.25Zm8-10.675V4.25c0 .138.112.25.25.25h2.688l-.011-.013-2.914-2.914-.013-.011Z"></path>
            </svg>

        </div>

        <p class="subtitle-text" id="file_count"></p>
        <p class="subtitle-text" id="size"></p>
        <form id="fileUploadForm" action="includes/UploadHandler.php" class="upload-form nexus-form-control" enctype="multipart/form-data" method="POST">
            <input type="file" name="file[]" id="file" multiple class="input" hidden>
        </form>

        <input type="submit" value="Upload" class="btn" id="uploadButton">

    </div>
    <table id="fileStack" class="file_table">
        <thead>
        <tr>
            <th class="title-small-text">Name</th>
            <th class="title-small-text">Size</th>
            <th class="title-small-text">Type</th>
            <th class="title-small-text"></th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>

</div>

    </main>
</body>

<script>
    function selectFiles() {
        const fileInput = document.getElementById('file');
        fileInput.click();

    }

    $(document).ready(function() {
        $('#file').on('change', function() {
            const files = $(this)[0].files;
            renderTable(files);
        });



        function renderTable(files) {
            const tableBody = $('#fileStack tbody');
            tableBody.empty();
            $.each(files, function(index, file) {
                const fileSize = formatFileSize(file.size);
                const fileRow = `
                    <tr>
                        <td class="body-small-text">${file.name}</td>
                        <td class="body-small-text">${fileSize}</td>
                        <td class="body-small-text">${file.type}</td>
                    </tr>
                `;
                tableBody.append(fileRow);
            });

            $('#file_count').text(`Total Files: ${files.length}`);
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 B';
            const k = 1024;
            const sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    });
</script>
