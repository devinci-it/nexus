<?php
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Redirect to the logout page
    header("Location:.?page=logout");
    exit();
}