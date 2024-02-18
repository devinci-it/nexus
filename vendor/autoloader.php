<?php
/**
 * Autoloader
 *
 * This autoloader function is responsible for automatically loading classes based on their namespaces.
 *
 * It uses the PHP SPL (Standard PHP Library) autoloading mechanism to dynamically include class files
 * as they are referenced in the code.
 *
 * Usage:
 * Include this file in your project to enable autoloading of classes from the specified base directory.
 * Adjust the $baseDir variable to match the directory structure of your project.
 *
 * @param string $className The fully qualified class name (with namespace) to be autoloaded.
 */
const ICONS_PATH = 'static/';

spl_autoload_register(function ($className) {
    // Your base directory for classes
    $baseDir = __DIR__ . '/../includes/';

    // Replace namespace separators with directory separators, and append with .php
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    // Construct the full path to the class file
    $filePath = $baseDir . $className;

    // If the file exists, require it
    if (file_exists($filePath)) {
        require $filePath;
    }
});
