<?php
namespace Classes\UI\FileMan;

class Generic
{
    private $directories;

    public function __construct($directories)
    {
        $this->directories = $directories;
    }

    public function render()
    {
        $html = '<div class="directory-grid">';

        foreach ($this->directories as $directory) {
            $iconFileName = 'directory.svg'; // Assuming icon filenames are lowercase
            $iconPath = 'public/assets/icons/dash/' . $iconFileName;

            // Generate HTML for each directory item
            $html .= '<div class="directory-item">';
            $html .= '<img class="directory-icon" src="' . $iconPath . '" alt="' . $directory . '">';
            $html .= '<span class="directory-name">' . $directory . '</span>';
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }
}