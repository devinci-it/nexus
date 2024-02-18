<?php

namespace Classes\UI\FileMan\File;
class File
{
    protected $id;
    protected $userId;
    protected $nameWithExtension;
    protected $lastAccessed;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->userId = $data['user_id'];
        $this->nameWithExtension = $data['file_id']; // Assuming 'file_id' includes the extension
        $this->lastAccessed = $data['last_accessed'];
// Add more properties as needed
    }

// Getter methods for properties

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getNameWithExtension()
    {
        return $this->nameWithExtension;
    }

    public function getLastAccessed()
    {
        return $this->lastAccessed;
    }
}

class FileRenderer
{
    protected $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function render()
    {
        $iconHtml = '<div class="user-icon">';
        $iconHtml .= '<input type="checkbox" id="file_' . $this->file->getId() . '" name="file_' . $this->file->getId() . '">';
        $iconHtml .= '<label for="file_' . $this->file->getId() . '">';
        $iconHtml .= $this->getIcon();
        $iconHtml .= $this->file->getNameWithExtension() . '<br>';
        $iconHtml .= '<span class="caption-text">' . $this->file->getLastAccessed() . '</span>';
        $iconHtml .= '</label>';
        $iconHtml .= '</div>';

        return $iconHtml;
    }

    public function displaySummary()
    {
        $summary = 'File Summary:';
        $summary .= '<br>ID: ' . $this->file->getId();
        $summary .= '<br>User ID: ' . $this->file->getUserId();
// Add more attributes as needed for the summary

        return $summary;
    }

    protected function getIcon()
    {
// Default icon logic
        return '<img src="default_icon.png" alt="Default Icon">';
    }
}

class AudioFileRenderer extends FileRenderer
{
    protected function getIcon()
    {
        return '<img src="audio_icon.png" alt="Audio Icon">';
    }

    public function displaySummary()
    {
        $summary = parent::displaySummary();
        $summary .= '<br>MediaManager Type: Audio';
// Add more audio-specific details if needed

        return $summary;
    }
}

class VideoFileRenderer extends FileRenderer
{
    protected function getIcon()
    {
        return '<img src="video_icon.png" alt="Video Icon">';
    }

    public function displaySummary()
    {
        $summary = parent::displaySummary();
        $summary .= '<br>MediaManager Type: Video';
// Add more video-specific details if needed

        return $summary;
    }
}

class OtherFileRenderer extends FileRenderer
{
    protected function getIcon()
    {
        return '<img src="other_icon.png" alt="Other Icon">';
    }

    public function displaySummary()
    {
        $summary = parent::displaySummary();
        $summary .= '<br>MediaManager Type: Other';
// Add more other-specific details if needed

        return $summary;
    }
}
