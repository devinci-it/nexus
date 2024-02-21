<?php

namespace Frontend\InputButton;

class InputButton
{
    protected $name;
    protected $attributes;
    protected $svgFilename;
    protected $label;
    protected $isLabeled;

    const ICONS_DIR = __DIR__ . '/assets/icons'; // Replace with the actual path to your icons directory

    /**
     * Set the name attribute for the input field.
     *
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Set additional optional attributes for the input tag.
     *
     * @param array $attributes
     */
    public function setAttributes($attributes): void
    {
        // Sanitize attribute values
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    }

    /**
     * Set the filename of the SVG icon.
     *
     * @param string|null $svgFilename
     */
    public function setSvgFilename($svgFilename = null): void
    {
        $this->svgFilename = htmlspecialchars($svgFilename, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Set the label text for the input field.
     *
     * @param string|null $label
     */
    public function setLabel($label = null): void
    {
        $this->label = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Set whether to show label elements.
     *
     * @param bool $isLabeled
     */
    public function setIsLabeled($isLabeled): void
    {
        $this->isLabeled = (bool)$isLabeled;
    }

    /**
     * Generate HTML code for a specialized input container.
     *
     * @return string The HTML code for the specialized input container.
     * @throws \Exception If ICONS directory is not defined or if the name attribute is not provided.
     */
    public function generate(): string
    {
        try {
            // Validate required parameters
            if (empty($this->name)) {
                throw new \Exception('The "name" attribute is required.');
            }

            $container = '<div class="specialized-input-container" style="min-width:100%">';
            $inputAttributes = 'name="' . $this->name . '"';

            // Handle optional attributes
            foreach ($this->attributes as $attr => $value) {
                if ($value !== null) {
                    if ($value === '') {
                        $inputAttributes .= ' ' . $attr;
                    } else {
                        $inputAttributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }
            }

            // Use label text as the default placeholder if isLabeled is set to false
            $placeholder = ($this->isLabeled && $this->label !== null) ? $this->label : '';

            $input = '<input type="text" ' . (($placeholder !== '') ? 'placeholder="' . $placeholder . '" ' : '') . 'class="specialized-input input form-input"' . $inputAttributes . '>';
            $button = '<button type="submit" class="specialized-input-button btn form-btn">';

            if ($this->svgFilename !== null) {
                $iconPath = self::ICONS_DIR . '/' . $this->svgFilename;

                // Read SVG file contents
                $svgContent = file_get_contents($iconPath);

                // Extract path data using a regular expression
                preg_match('/<path d="(.*?)"/', $svgContent, $matches);

                // Check if the match was successful
                if (isset($matches[1])) {
                    $pathData = htmlspecialchars($matches[1]);
                    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="' . $pathData . '"></path></svg>';
                } else {
                    // Handle the case when the path data is not found
                    $svg = ''; // or provide a default SVG or throw an exception
                }
            } else {
                // Updated default SVG path
                $defaultSvgPath = 'M13.22 19.03a.75.75 0 0 1 0-1.06L18.19 13H3.75a.75.75 0 0 1 0-1.5h14.44l-4.97-4.97a.749.749 0 0 1 .326-1.275.749.749 0 0 1 .734.215l6.25 6.25a.75.75 0 0 1 0 1.06l-6.25 6.25a.75.75 0 0 1-1.06 0Z';
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="' . htmlspecialchars($defaultSvgPath) . '"></path></svg>';
            }

            $button .= $svg . '</button>';

            if ($this->isLabeled && $this->label !== null) {
                // Show label elements
                $container .= '<label class="caption-text">' . $this->label . '</label>';
            }

            $container .= $input . $button . '</div>';

            return $container;
        } catch (\Exception $e) {
            throw $e; // Rethrow the exception for higher-level handling
        }
    }
}
