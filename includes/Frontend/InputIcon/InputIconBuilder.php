<?php
namespace Frontend\InputIcon;
use Frontend\InputIcon\InputIcon;

class InputIconBuilder
{
    private $inputIcon;

    public function __construct()
    {
        $this->inputIcon = new InputIcon();
    }

    public function setName($name): self
    {
        $this->inputIcon->setName($name);
        return $this;
    }

    public function setSvgFilename($svgFilename): self
    {
        $this->inputIcon->setSvgFilename($svgFilename);
        return $this;
    }

    public function setIsLabeled($isLabeled): self
    {
        $this->inputIcon->setIsLabeled($isLabeled);
        return $this;
    }

    public function setTypeName($typeName): self
    {
        $this->inputIcon->setTypeName($typeName);
        return $this;
    }

    public function setIsError($isError): self
    {
        $this->inputIcon->setIsError($isError);
        return $this;
    }

    public function setStickyValue($stickyValue): self
    {
        $this->inputIcon->setStickyValue($stickyValue);
        return $this;
    }

    public function setPlaceholder($placeholder): self
    {
        $this->inputIcon->setPlaceholder($placeholder);
        return $this;
    }

    public function build(): InputIcon
    {
        return $this->inputIcon;
    }

}