<?php

namespace Frontend\Sidebar;

class Sidebar {
    protected $activeTab;

    protected $navItemsMain = [
        'Home' => ['Home', 'home.svg', '?page=home'],
        'Dashboard'=>['Dashboard','dash.svg','?page=dashboard'],
        'Library' => ['Library', 'folder.svg', '?page=library'],
    ];

    protected $navItemsMedia = [
        'Recent' => ['Recent', 'recent.svg', '?page=recents'],
        'Uploads'=> ['Uploads', 'upload.svg', '?page=uploads'],
        'Images' => ['Images', 'photo.svg', '?page=images'],
        'Videos' => ['Videos', 'video.svg', '?page=videos'],
        'Audios' => ['Audios','music.svg','?page=audios'],
    ];

    protected $navItemsAction = [
        'Trash' => ['Trash', 'Trash.svg', 'home.php?page=trash'],
        'Upload' => ['Upload', 'uploads.svg', 'upload.php'],
        'Settings' => ['Settings', 'gear.svg', 'settings.php'],
        'Logout' => ['Logout', 'logout.svg', 'logout.php'],
//        'Categories' => ['Categories', 'sort-cat.svg', '#Categories'],
    ];

    private $navItemsCustom = [];

    public function __construct() {
        include_once "SidebarItem.php";
    }

    public function generateSidePanel($menuArray) {
        $returnSidePanel = '';

        foreach ($menuArray as $label => $menuItemData) {
            list($menuItem, $iconPath, $hashLink) = $menuItemData;

            $returnSidePanel .= generateSidebarItem($label, $hashLink, $iconPath, strtolower($this->activeTab) == strtolower($label) ? 'active' : '');
        }
        return $returnSidePanel;
    }

    public function render($active) {
        $this->activeTab=strtolower($active);
        $menuArrays = [
            'Main' => $this->navItemsMain,
            'Libraries' => $this->navItemsMedia,
//            'Custom' => $this->navItemsCustom,
            'Action' => $this->navItemsAction
        ];

        foreach ($menuArrays as $menuName => $menuArray) {
            echo '<div class="panel-group body-medium-text">';
//            echo '<h3 class="sidebar-title">' . $menuName . '</h3>'; // Add title
            echo '<ul class="sidebar-list">'; // Start the list
            echo $this->generateSidePanel($menuArray);
            echo '</ul>'; // End the list
            echo '</div>';
        }
    }
}

//// Usage
//$sidebar = new Sidebar();
//$sidebar->render();
//
