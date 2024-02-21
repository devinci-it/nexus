<?php

require_once 'InputButton.php';
require_once 'InputButtonBuilder.php';
use Frontend\InputButton\InputButton;
use Frontend\InputButton\InputButtonBuilder;

const ICONS_DIR = __DIR__.'/assets/icons'; // Replace with the actual path to your icons directory
include_once 'style.php';
// Now you can use InputButton and InputButtonBuilder classes
$name = "searchInput";
$label = "Search";
$svgFilename = "search.svg";
$attributes = ['class' => 'custom-class', 'data-custom' => 'value'];
$isLabeled = true;
?>
<section class="input-button-demo">
  <?php  echo InputButtonBuilder::build($label, $name, $svgFilename, $attributes, $isLabeled);?>
</section>
