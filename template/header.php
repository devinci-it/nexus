<?php
// Start output buffering
ob_start();

// Define base paths for CSS and icons
$cssBasePath = "static/css/";
$iconsBasePath = "static/assets/";

// Check if page_title and custom_css are set in the GET parameters
if (isset($_GET["page_title"], $_GET["custom_css"])) {
    $title = htmlspecialchars($_GET["page_title"]);
    $custom_css = htmlspecialchars($_GET["custom_css"]);
} else {
    $title = "NEXUS";
    $custom_css = "";
}

// Define an array of base CSS files
$baseCssFiles = ['reset', 'typography', 'forms', 'buttons', 'toast', 'user_management','styles','ui'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="<?php echo $iconsBasePath . "favicon.svg"; ?>">
    <!-- Set the page title -->
    <title><?php echo $title; ?></title>
    <!-- Include the base CSS files -->
    <?php foreach ($baseCssFiles as $cssFile) : ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $cssBasePath . $cssFile . '.css'; ?>">
    <?php endforeach; ?>
    <!-- If custom_css is set, include it -->
    <?php if (!empty($custom_css)) : ?>
        <link rel="stylesheet" href="<?php echo $cssBasePath . "custom/" . $custom_css; ?>">
    <?php endif; ?>
</head>