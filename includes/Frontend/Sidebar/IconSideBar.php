<?php

namespace Frontend\Sidebar;

include_once "SidebarItem.php";
include_once "Sidebar.php";

class IconSideBar extends Sidebar {


    public function generateSidePanel($menuArray) {
        $returnSidePanel = '';

        foreach ($menuArray as $label => $menuItemData) {
            list($menuItem, $iconPath, $hashLink) = $menuItemData;

            $returnSidePanel .= generateSidebarIcon($label, $hashLink, $iconPath, strtolower($this->activeTab) == strtolower($label) ? 'active' : '');
        }
        return $returnSidePanel;
    }

    public function render($active) {
        parent::__construct(); // Call the parent constructor if needed

        $this->activeTab = strtolower($active);
        $menuArrays = [
            'Main' => $this->navItemsMain,
            'Libraries' => $this->navItemsMedia,
//            'Action' => $this->navItemsAction
        ];

        foreach ($menuArrays as $menuName => $menuArray) {
            echo '<div class="icon-sidebar panel-group body-medium-text">';
            echo '<ul class="sidebar-list">'; // Start the list
            echo $this->generateSidePanel($menuArray);
            echo '</ul>'; // End the list
            echo '</div>';
        }
    }
}

//// Usage

