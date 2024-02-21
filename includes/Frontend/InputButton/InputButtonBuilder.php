<?php

namespace Frontend\InputButton;

class InputButtonBuilder
{
    private $inputButton;

    const ENCODING_OPTIONS = ENT_QUOTES | ENT_HTML5;

    /**
     * InputButtonBuilder constructor.
     */
    public function __construct()
    {
        $this->inputButton = new InputButton();
    }

    /**
     * Set the label text for the input field.
     *
     * @param string|null $label
     * @return InputButtonBuilder
     */
    public function setLabel($label = null): self
    {
        $this->inputButton->setLabel($this->sanitize($label));
        return $this;
    }

    /**
     * Set the name attribute for the input field.
     *
     * @param string $name
     * @return InputButtonBuilder
     */
    public function setName($name): self
    {
        $this->inputButton->setName($this->sanitize($name));
        return $this;
    }

    /**
     * Set the filename of the SVG icon.
     *
     * @param string|null $svgFilename
     * @return InputButtonBuilder
     */
    public function setSvgFilename($svgFilename = null): self
    {
        $this->inputButton->setSvgFilename($this->sanitize($svgFilename));
        return $this;
    }

    /**
     * Set additional optional attributes for the input tag.
     *
     * @param array $attributes
     * @return InputButtonBuilder
     */
    public function setAttributes($attributes): self
    {
        $sanitizedAttributes = array_map([$this, 'sanitize'], $attributes);
        $this->inputButton->setAttributes($sanitizedAttributes);
        return $this;
    }

    /**
     * Set whether to show label elements.
     *
     * @param bool $isLabeled
     * @return InputButtonBuilder
     */
    public function setIsLabeled($isLabeled): self
    {
        $this->inputButton->setIsLabeled((bool)$isLabeled);
        return $this;
    }

    /**
     * Build and return the HTML code for the specialized input container.
     *
     * @return string
     */
    public function build(): string
    {
        return $this->inputButton->generate();
    }

    /**
     * Sanitize a string.
     *
     * @param string|null $value
     * @return string|null
     */
    private function sanitize($value = null): ?string
    {
        return ($value !== null) ? htmlspecialchars($value, self::ENCODING_OPTIONS, 'UTF-8') : null;
    }
}
