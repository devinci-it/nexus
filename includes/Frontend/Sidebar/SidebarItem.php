<?php
namespace Frontend\Sidebar;


function generateSidebarItem($label, $href, $icon, $class = null)
{
    $iconPath = "public/assets/icons/nav/" . $icon;
    $classAttribute = $class ?? ''; // Check if class is not null
    return '<li class="side-menu-item ' . $classAttribute . '">
<a href="' . $href . '">
<img src="' . $iconPath . '" alt="' . $label . ' Icon">' . $label . '</a></li>';
}
function generateSidebarIcon($label, $href, $icon, $class = null)
{
    $iconPath = "public/assets/icons/nav/" . $icon;
    $classAttribute = $class ?? ''; // Check if class is not null
    return '<li class="side-menu-item ' . $classAttribute . '">
<a href="' . $href . '">
<img src="' . $iconPath . '" alt="' . $label . ' Icon">' . $label . '</a></li>';
}
