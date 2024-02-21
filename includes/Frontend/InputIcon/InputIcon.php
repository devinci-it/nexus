<?php
namespace Frontend\InputIcon;

class InputIcon
{
    protected mixed $attributes;
    protected $name;
    protected $svgFilename;
    protected $isLabeled;
    protected $typeName;
    protected $isError;
    protected $stickyValue;
    protected $placeholder;

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setSvgFilename($svgFilename): self
    {
        $this->svgFilename = $svgFilename;
        return $this;
    }

    public function setIsLabeled($isLabeled): self
    {
        $this->isLabeled = $isLabeled;
        return $this;
    }

    public function setTypeName($typeName): self
    {
        $this->typeName = $typeName;
        return $this;
    }

    public function setIsError($isError): self
    {
        $this->isError = $isError;
        return $this;
    }

    public function setStickyValue($stickyValue): self
    {
        $this->stickyValue = $stickyValue;
        return $this;
    }

    public function setPlaceholder($placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function generate(): string
    {
        $lowercasePlaceholder = $this->generatePlaceholder();
        $attributesString = $this->buildAttributesString();

        $html = '<div class="svg-input-container">';
        if ($this->isLabeled) {
            $html .= '<label for="svg-input">' . $this->typeName . '</label>';
        }

        $html .= '<div class="input-wrapper">';
        $html .= '<input value="' . htmlspecialchars($this->stickyValue) . '" class="input form-input svg-input" name="' . $lowercasePlaceholder . '" id="svg-input" type="' . $this->typeName . '" placeholder="' . $this->placeholder . '" required ' . $attributesString . '>';

        $svgPath = $this->getSvgPath();
        $svgContent = file_get_contents($svgPath);

        $html .= $svgContent;
        $html .= '</div></div>';

        return $html;
    }

    private function generatePlaceholder()
    {
        if ($this->placeholder !== null) {
            return strtolower(str_replace(' ', '_', $this->placeholder));
        }

        return strtolower(str_replace(' ', '_', $this->name));
    }

    private function buildAttributesString()
    {
        $attributesString = '';
        foreach ($this->attributes as $key => $value) {
            $attributesString .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
        }

        return $attributesString;
    }

    private function getSvgPath()
    {
        return __DIR__."/assets/icons/" . $this->svgFilename;
    }
}
