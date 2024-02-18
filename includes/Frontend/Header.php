<?php
namespace Frontend;

class Header {
    private $title;
    private $lastModified;
    private $breadcrumb;

    public function __construct($title, $lastModified, $breadcrumb) {
        $this->title = $title;
        $this->lastModified = $lastModified;
        $this->breadcrumb = $breadcrumb;
    }

    public function render() {
        $html = '<div class="header">';

        // Title
        $html .= '<span><h1 class="title-medium-text">' . $this->title . '</h1>';

        // Timestamp last modified
        $html .= '<div class=" caption-text last-modified">Last Modified: ' . $this->lastModified . '</div></span>';

        // Breadcrumb
        $html .= '<nav class="breadcrumb">' . $this->breadcrumb . '</nav>';

        $html .= '</div>';

        return $html;
    }
}



