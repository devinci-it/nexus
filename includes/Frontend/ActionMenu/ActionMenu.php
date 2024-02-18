<?php
namespace Frontend\ActionMenu;
class ActionMenu {
    private $actions;

    public function __construct($actions) {
        $this->actions = $actions;
    }

    public function render()
    {
        echo '<div class="action-menu">';
        foreach ($this->actions as $action) {
            $link = $action['path'] . '?action=' . urlencode($action['name']);
            echo '<a href="' . $link . '" class="btn action-btn">';
            echo '<img src="' . $action['icon'] . '" alt="' . $action['name'] . '" class="menu-icon">';
            echo $action['name'];
            echo '</a>';
        }
        echo '</div>';


    }
}


