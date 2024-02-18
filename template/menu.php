<?php

use Frontend\ActionMenu\ActionMenu;

const ICON_DIR = "public/assets/icons/menu/";


$actions = [
    ['name' => 'View', 'path' => 'view.php', 'icon' => ICON_DIR . 'view.svg'],
    ['name' => 'Delete', 'path' => 'delete.php', 'icon' => ICON_DIR . 'delete.svg'],
    ['name' => 'Rename', 'path' => 'rename.php', 'icon' => ICON_DIR . 'rename.svg'],
    ['name' => 'Info', 'path' => 'info.php', 'icon' => ICON_DIR . 'info.svg'],
    ['name' => 'Select All', 'path' => 'select-all.php', 'icon' => ICON_DIR . 'select-all.svg'],
    ['name' => 'Unselect', 'path' => 'unselect.php', 'icon' => ICON_DIR . 'unselect.svg']
];

$actionMenu = new ActionMenu($actions);

    $actionMenu->render();



