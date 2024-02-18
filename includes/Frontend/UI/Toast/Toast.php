<?php

namespace Classes\UI;

class Toast
{
    private $errorSVG;
    private $alertSVG;
    private $infoSVG;
    private $successSVG;

    public function __construct()
    {
        define("ICONS_PATH", "public/assets/icons/");
        if (!defined('ICONS_PATH')) {
            $this->iconMissing = true;
        } else {
            $this->errorSVG = ICONS_PATH . 'fill-error.svg';
            $this->alertSVG = ICONS_PATH . 'fill-alert.svg';
            $this->infoSVG = ICONS_PATH . 'fill-info.svg';
            $this->successSVG = ICONS_PATH . 'fill-success.svg';
        }
    }

    public function displayAlert($message, $svgPath)
    {
        $toReturn = "<div class='toast-wrapper'>";
        $toReturn .= "<div class='toast alert'>$message";
        $toReturn .= "<img class='svg-icon' src='" . htmlspecialchars($svgPath, ENT_QUOTES, 'UTF-8') . "' alt='SVG Icon'></div></div>";
        return $toReturn;
    }

    public function displayError($message)
    {
        return $this->displayAlert($message, $this->errorSVG);
    }

    public function displayInfo($message)
    {
        $toReturn = "<div class='toast-wrapper'>";
        $toReturn .= "<div class='toast info'>$message";
        $toReturn .= "<img class='svg-icon' src='" . htmlspecialchars($this->infoSVG, ENT_QUOTES, 'UTF-8') . "' alt='SVG Icon'></div></div>";
        return $toReturn;
    }

    public function displaySuccess($message)
    {
        $toReturn = "<div class='toast-wrapper'>";
        $toReturn .= "<div class='toast success'>$message";
        $toReturn .= "<img class='svg-icon' src='" . htmlspecialchars($this->successSVG, ENT_QUOTES, 'UTF-8') . "' alt='SVG Icon'></div></div>";
        return $toReturn;
    }

    public function showMessage($type, $message)
    {
        switch ($type) {
            case 'error':
                echo $this->displayError($message);
                break;
            case 'info':
                echo $this->displayInfo($message);
                break;
            case 'success':
                echo $this->displaySuccess($message);
                break;
            default:
                // Default to alert for unknown types
                echo $this->displayAlert($message, $this->alertSVG);
                break;
        }
    }
}

