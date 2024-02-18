<?php

namespace Frontend;

use DateTime;

class FileRenderer
{
    private $files;
    private $currentPage;
    private $itemsPerPage;

    public function __construct($files, $currentPage = 1, $itemsPerPage = 50)
    {
        $this->files = $files;
        $this->currentPage = $currentPage;
        $this->itemsPerPage = $itemsPerPage;
    }

    public function render()
    {
        $startIndex = ($this->currentPage - 1) * $this->itemsPerPage;
        $endIndex = $startIndex + $this->itemsPerPage;
        $filesToRender = array_slice($this->files, $startIndex, $this->itemsPerPage);

        $html = '<div class="file-grid">';

        foreach ($filesToRender as $file) {
            $html .= $this->renderFile($file);
        }

        $html .= '</div>';

        return $html;
    }

    public function renderPaginationControls($totalPages)
    {
        $html = '<div class="pagination">';
        $html .= '<span class="page-info">Page ' . $this->currentPage . ' of ' . $totalPages . '</span>';

        // Render previous page button
        if ($this->currentPage > 1) {
            $html .= '<a href="?page=' . ($this->currentPage - 1) . '" class="page-link">Previous</a>';
        }

        // Render next page button
        if ($this->currentPage < $totalPages) {
            $html .= '<a href="?page=' . ($this->currentPage + 1) . '" class="page-link">Next</a>';
        }

        $html .= '</div>';

        return $html;
    }

    private function formatDate($dateTimeString)
    {
        // Convert date and time string to DateTime object
        $dateTime = new DateTime($dateTimeString);

        // Format date and time separately
        $date = $dateTime->format('Y-m-d');
        $time = $dateTime->format('H:i:s');

        // Return formatted date and time
        return '<span class="date">' . $date . '</span> <span class="time">' . $time . '</span>';
    }

    private function renderFile($file)
    {
        $fileName = $file['original_filename'];
        $filePath = $file['file_path'];
        $lastModified = $file['last_modified'];
        $fileId = $file['file_id'];
        $fileClassification = $file['file_classification'];

        // Determine the icon based on file type
        switch ($fileClassification) {
            case 'audio':
                $iconPath = 'public/assets/icons/audio.svg';
                break;
            case 'video':
                $iconPath = 'public/assets/icons/video.svg';
                break;
            case 'photo':
                $iconPath = 'public/assets/icons/photo.svg';
                break;
            default:
                $iconPath = 'public/assets/icons/file.svg';
                break;
        }

        $html = '<a class="caption-text" href="?path=' . $filePath . '&id=' . $fileId . '">';
        $html .= '<div class="file-item">';
        $html .= '<img class="file-icon" src="' . $iconPath . '" alt="' . $fileName . '">';
        $html .= '<span class="file-name body-medium-text">' . $fileName . '</span>';
        $html .= '<span class="last-modified">' . $this->formatDate($lastModified) . '</span>';
        $html .= '</div>';
        $html .= '</a>';

        return $html;
    }
}
