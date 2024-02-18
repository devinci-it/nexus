<?php

namespace Models;
/**
 * Sanitizer class provides static methods for sanitizing different types of input.
 */
class Sanitizer
{
        /**
         * Sanitizes user input by converting special characters to HTML entities and trimming whitespace.
         *
         * @param string $input The input to be sanitized.
         *
         * @return string The sanitized input.
         */
        public static function sanitizeInput($input)
        {
            return htmlspecialchars(trim($input));
        }

    /**
     * Validates the strength of a password based on certain criteria.
     *
     * @param string $password The password to be validated.
     * @param int $minLength The minimum length required for the password.
     * @param bool $requireUppercase Whether the password must contain at least one uppercase letter.
     * @param bool $requireLowercase Whether the password must contain at least one lowercase letter.
     * @param bool $requireNumber Whether the password must contain at least one numeric digit.
     * @param bool $requireSpecialChar Whether the password must contain at least one special character.
     *
     * @return bool True if the password meets the criteria, false otherwise.
     */
    public static function validatePasswordStrength(
        $password,
        $minLength = 8,
        $requireUppercase = true,
        $requireLowercase = true,
        $requireNumber = true,
        $requireSpecialChar = true
    ) {
        // Check minimum length
        if (strlen($password) < $minLength) {
            return false;
        }

        // Check uppercase requirement
        if ($requireUppercase && !preg_match('/[A-Z]/', $password)) {
            return false;
        }

        // Check lowercase requirement
        if ($requireLowercase && !preg_match('/[a-z]/', $password)) {
            return false;
        }

        // Check numeric digit requirement
        if ($requireNumber && !preg_match('/\d/', $password)) {
            return false;
        }

        // Check special character requirement
        if ($requireSpecialChar && !preg_match('/[^A-Za-z0-9]/', $password)) {
            return false;
        }

        // All criteria passed, password is valid
        return true;
    }


    /**
     * Sanitizes a filename by removing illegal characters and trimming whitespace.
     *
     * @param string $fileName The original filename to be sanitized.
     *
     * @return string The sanitized filename.
     */
    public static function sanitizeFileName($fileName)
    {
        $fileName = preg_replace("/[^a-zA-Z0-9_.]/", '_', $fileName);
        $fileName = preg_replace("/_+/", '_', $fileName);
        $fileName = trim($fileName, '_');
        if (empty($fileName)) {
            $fileName = 'default_filename';
        }
        $maxFileNameLength = 255;
        $fileName = substr($fileName, 0, $maxFileNameLength);
        return $fileName;
    }

    /**
     * Strips HTML tags from a given string.
     *
     * @param string $html The HTML string to be stripped.
     *
     * @return string The string without HTML tags.
     */
    public static function stripHtml($html)
    {
        return strip_tags($html);
    }



}
