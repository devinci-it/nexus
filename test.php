<?php
include_once 'vendor/autoloader.php';
use Frontend\InputButton\InputButton;
use Frontend\InputButton\InputButtonBuilder;

include_once 'template/header.php';
const ICONS_DIR = __DIR__.'/assets/icons'; // Replace with the actual path to your icons directory

// Now you can use InputButton and InputButtonBuilder classes
$name = "searchInput";
$label = "Search";
$svgFilename = "audio.svg";
$attributes = ['class' => 'custom-class', 'data-custom' => 'value'];
$isLabeled = true;
?>

<form style="min-width: 700px;padding: 20px;">
<?php
echo InputButtonBuilder::build($label, $name, $svgFilename=null, $attributes, $isLabeled);
?>