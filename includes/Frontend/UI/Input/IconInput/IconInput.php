<?php

namespace Classes\UI\Input\IconInput;

class IconInput {
    private $attributes;

    public function __construct($attributes = array()) {
        $this->attributes = $attributes;
    }

    public function generate($placeholder, $svgFilename,$typeName, $size = null, $isLabeled = false, $isError = false, $stickyValue = null) {
        // Set default values if not provided
        if (!$stickyValue) {
            $stickyValue = '';
        }

        // Path to the SVG icons directory
        $baseIconPath = "public/assets/icons/forms/";

        // Construct SVG path
        $svgPath = $baseIconPath . $svgFilename;

        // Set inline styles based on size parameter
        $containerStyle = '';
        $inputStyle = '';
        if ($size === 'block-centered') {
            $containerStyle = 'text-align: center;';
        } elseif ($size === 'px-width') {
            $inputStyle = 'width: 200px;'; // Adjust the width as needed
        }

        // Set input classes
        $inputClass = "input form-input svg-input";
        if ($isError === true) {
            $inputClass .= " error";
        }

        // Generate lowercase placeholder name
        $lowercasePlaceholder = strtolower(str_replace(' ', '_', $placeholder));

        // Generate HTML attributes
        $attributesString = '';
        foreach ($this->attributes as $key => $value) {
            $attributesString .= " $key=\"$value\"";
        }
        ?>

        <div class="svg-input-container" style="<?php echo $containerStyle; ?>">
            <?php if ($isLabeled): ?>
                <label for="svg-input" style="display: block; margin-bottom: 8px;"><?php echo $typeName; ?></label>
            <?php endif; ?>
            <div class="input-wrapper">
                <input value='<?php echo htmlspecialchars($stickyValue) ?>' class='<?php echo $inputClass ?>' name="<?php echo $lowercasePlaceholder; ?>" id="svg-input" type="<?php echo $typeName; ?>" placeholder="<?php echo $placeholder; ?>" style="<?php echo $inputStyle; ?>" required <?php echo $attributesString; ?>>
                <?php
                // Output the SVG icon
                $svgContent = file_get_contents($svgPath);
                echo '<img class="svg-icon" src="' . htmlspecialchars($svgPath, ENT_QUOTES, 'UTF-8') . '" alt="SVG Icon">';
                ?>
            </div>
        </div>

        <?php
    }
}

// Example usage:
// Uncomment the following lines to see the sample usage

// $attributes = array(
//     'name' => 'username',
//     'maxlength' => '20'
// );

// $placeholder = 'Enter your username';
// $svgFilename = 'user.svg';
// $size = 'px-width';
// $isLabeled = true;
// $typeName = 'text';
// $generator = new SvgInputGenerator($attributes);
// $generator->generate($placeholder, $svgFilename, $size, $isLabeled, $typeName);
