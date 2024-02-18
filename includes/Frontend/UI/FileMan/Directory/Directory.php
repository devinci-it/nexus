<?php

namespace Classes\UI\FileMan;

class Directory
{
    private $directories;
    private $files;

    public function __construct($directories, $files)
    {
        $this->directories = $directories;
        $this->files = $files;
    }

    public function getRaw()
    {
        return array_merge($this->directories, $this->files);
    }

    public function render()
    {
        $html = '<div class="directory-grid">';

        // Track directories by their IDs
        $trackedDirectories = [];
        foreach ($this->directories as $directory) {
            $parentId = $directory['parent_directory_id'];
            if (!isset($trackedDirectories[$parentId])) {
                $trackedDirectories[$parentId] = [];
            }
            $trackedDirectories[$parentId][] = $directory;
        }

        // Render each directory with its files
        foreach ($trackedDirectories as $parentId => $directories) {
            foreach ($directories as $directory) {
                $html .= $this->renderDirectory($directory);
                // Render files for this directory
                foreach ($this->files as $file) {
                    if ($file['directory_id'] == $directory['id']) {
                        $html .= $this->renderFile($file);
                    }
                }
            }
        }

        $html .= '</div>';

        return $html;
    }
    private function renderDirectory($directory)
    {
        // Extract directory name and path from the associative array
        $directoryName = $directory['directory_name']; // Use 'directory_name' instead of 'name'
        $directoryPath = isset($directory['directory_path']) ? $directory['directory_path'] : ''; // Use 'directory_path' instead of 'path'

        // Generate icon filename and path
        $iconFileName = strtolower($directoryName) . '.svg';
        $iconPath = file_exists('public/assets/icons/dash/' . $iconFileName) ?
            'public/assets/icons/dash/' . $iconFileName :
            'public/assets/icons/dash/directory.svg';

        // Generate HTML for each directory item with optional path attribute
        $html = '<div class="directory-item">';
        $html .= '<a href="?path=' . $directoryPath . '&id=' . $directory['id'] . '">';
        $html .= '<img class="directory-icon" src="' . $iconPath . '" alt="' . $directoryName . '">';
        $html .= '<span class="directory-name caption-text">' . $directoryName . '</span>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    private function renderFile($file)
    {
        // Extract file details
        $fileName = $file['file_id']; // Use 'file_id' instead of 'name'
        $fileClass = $file['file_classification'];
        switch ($fileClass) {
            case 'photo':
            case 'video':
            case 'audio':
            case 'other':
                $iconPath = 'public/assets/icons/' . $fileClass.'.svg';
                break;
            default:
                // Set default icon path for unknown file types
                $iconPath = 'public/assets/icons/dash/default-icon.svg';
        }

        // Customize this logic based on your file rendering requirements
        // ...
        $html = '<div class="file-item">';
        $html .= '<img class="directory-icon" src="' . $iconPath . '" alt="' . $fileName . '">';
        // Example: Display file name
        $html .= '<span class="file-name">' . $fileName . '</span>';
        $html .= '</div>';

        return $html;
    }

}
