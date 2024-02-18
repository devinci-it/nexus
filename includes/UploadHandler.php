<?php
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the home path from session and remove the 'includes/' prefix
    $homePath = str_replace('includes/', '', $_SESSION['home_path']);
    $path = str_replace('~/', '', $_POST['path']);

    // Construct the full destination directory path
    $destinationDirectory = "$homePath/$path/";
    echo $destinationDirectory;
    // Create the destination directory if it doesn't exist
    if (!file_exists($destinationDirectory)) {
        mkdir($destinationDirectory, 0777, true);
    }

    // Get all files data
    if (!empty($_FILES['file']['name'][0])) {
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            // Move the uploaded file to the destination directory
            $fileTmpName = $_FILES['file']['tmp_name'][$i];
            $fileName = $_FILES['file']['name'][$i];
            $destination = $destinationDirectory . $fileName;

            // Move the file to the destination
            if (move_uploaded_file($fileTmpName, $destination)) {
                // File uploaded successfully
                continue;
            } else {
                // Error moving file, redirect back to libraries.php
                $_SESSION['file_upload_error'] = "Failed to move file $fileName";
                header("Location: libraries.php?page=upload&upload=failed");
                exit();
            }
        }
    }

    // Display success message
    $_SESSION['file_upload_success'] = "Files uploaded successfully.";
    header("Location: libraries.php?page=upload&upload=success");
    exit();
} else {
    // Invalid request method
    $_SESSION['file_upload_error'] = "Invalid request method.";
    header("Location: libraries.php?page=upload&upload=failed");
    exit();
}
