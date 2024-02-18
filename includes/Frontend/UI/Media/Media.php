<?php

namespace Classes\UI\Media;

abstract class FileObject {
    protected $files;

    public function __construct($files) {
        $this->files = $files;
    }

    abstract protected function getIconPath($fileName);

    public function render() {
        $html = '<div class="file-grid">';

        foreach ($this->files as $file) {
            $fileName = $file['name'];
            $filePath = isset($file['path']) ? $file['path'] : '';

            $iconPath = $this->getIconPath($fileName);

            $html .= '<div class="file-item">';
            $html .= '<a href="?path=' . $filePath . '&id=' . $file['id'] . '">';
            $html .= '<img class="file-icon" src="' . $iconPath . '" alt="' . $fileName . '">';
            $html .= '<span class="file-name caption-text">' . $fileName . '</span>';
            $html .= '</a>';
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }
}

class Directory extends FileObject {
    protected function getIconPath($fileName) {
        $iconFileName = strtolower($fileName) . '.svg';
        return file_exists('public/assets/icons/dash/' . $iconFileName) ?
            'public/assets/icons/dash/' . $iconFileName :
            'public/assets/icons/dash/directory.svg';
    }
}

class ImageFile extends FileObject {
    protected function getIconPath($fileName) {
        return 'public/assets/icons/image.svg';
    }
}

class VideoFile extends FileObject {
    protected function getIconPath($fileName) {
        return 'public/assets/icons/video.svg';
    }
}

class AudioFile extends FileObject {
    protected function getIconPath($fileName) {
        return 'public/assets/icons/audio.svg';
    }
}

class PhotoFile extends FileObject {
    protected function getIconPath($fileName) {
        return 'public/assets/icons/photo.svg';
    }
}

