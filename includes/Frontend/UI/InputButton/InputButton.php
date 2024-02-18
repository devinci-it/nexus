<?php

namespace Classes\UI;

use Exception;
const ICONS=
class InputButton
{
    /**
     * Generate HTML code for a specialized input container.
     * Note: CSS (forms.css) should be imported for the UI to be rendered properly.
     * If using the template header, CSS will be automatically imported.
     *
     * @param string $placeholder The placeholder text for the input field.
     * @param string $type The type of the input field (e.g., 'search').
     * @param string|null $svgFilename The filename of the SVG icon (optional).
     *
     * @return string The HTML code for the specialized input container.
     */
    public static function generate($placeholder, $type, $svgFilename = null)
    {
        try {
            $container = '<div class="specialized-input-container">';
            $input = '<input type="text" placeholder="' . htmlspecialchars($placeholder) . '" class="specialized-input input form-input">';
            $button = '<button type="submit" class="specialized-input-button btn form-btn">';

            if ($svgFilename !== null) {
                if (!defined('ICONS')) {
                    throw new Exception('ICONS constant is not defined. Make sure to define ICONS before using SVG filenames.');
                }

                $iconPath = ICONS . '/' . $svgFilename;
                $svg = '<img src="' . htmlspecialchars($iconPath) . '" alt="' . htmlspecialchars($type) . ' icon" width="16" height="16">';
                $button .= $svg;
            } else {
                $defaultSvgPath = ($type === 'search') ?
                    'M10.68 11.74a6 6 0 0 1-7.922-8.982 6 6 0 0 1 8.982 7.922l3.04 3.04a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215ZM11.5 7a4.499 4.499 0 1 0-8.997 0A4.499 4.499 0 0 0 11.5 7Z' :
                    'M10.68 11.74a6 6 0 0 1-7.922-8.982 6 6 0 0 1 8.982 7.922l3.04 3.04a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215ZM11.5 7a4.499 4.499 0 1 0-8.997 0A4.499 4.499 0 0 0 11.5 7Z';
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="' . htmlspecialchars($defaultSvgPath) . '"></path></svg>';
                $button .= $svg;
            }

            $button .= '</button>';
            $container .= $input . $button . '</div>';

            return $container;
        } catch (Exception $e) {
            // Handle the exception (e.g., log the error, display a message)
            return 'Error: ' . $e->getMessage();
        }
    }
}

// Example usage:
$placeholder = "Search";
$type = "search";
$svgFilename = "search-icon.svg";
echo InputButton::generate($placeholder, $type, $svgFilename);
