<?php

namespace Classes\UI\Button;

class ButtonGenerator {
    private $attributes;

    public function __construct($attributes = array()) {
        $this->attributes = $attributes;
    }

    public function generate($type, $size = '', $round = false, $selected = false) {
        $classes = ['btn','submit-btn', 'form-input'];

        // Add type class
        switch ($type) {
            case 'primary':
            case 'dark':
            case 'outline':
            case 'error':
            case 'alert':
            case 'info':
            case 'success':
                $classes[] = $type;
                break;
            default:
                $classes[] = 'primary';
        }

        // Add size class
        switch ($size) {
            case 'small':
            case 'large':
                $classes[] = $size;
                break;
            default:
                // Default size is medium, so no additional class needed
        }

        // Add round class
        if ($round) {
            $classes[] = 'round';
        }

        // Add selected class
        if ($selected) {
            $classes[] = 'selected';
        }

        // Join classes into a string
        $classString = implode(' ', $classes);

        // Generate HTML attributes
        $attributesString = '';
        foreach ($this->attributes as $key => $value) {
            $attributesString .= " $key=\"$value\"";
        }

        // Return button structure
        return "<input type=\"button\" class=\"$classString\"$attributesString>";
    }
}

// Example usage:
// Uncomment the following lines to see the sample usage

// $attributes = array(
//     'id' => 'customButton',
//     'name' => 'customButton'
// );

// $buttonGenerator = new \Classes\UI\Button\ButtonGenerator($attributes);
// echo $buttonGenerator->generate('primary', 'large', true, true);
