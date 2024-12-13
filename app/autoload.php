<?php

spl_autoload_register(function ($class) {
    if ($class === 'PDO') {
        return;
    }

    // Convert the namespace to a directory structure
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // Split the class path into its parts (for namespaced classes)
    $classParts = explode(DIRECTORY_SEPARATOR, $classPath);

    // Check if the class is in the models namespace
    if ($classParts[0] === 'models') {
        // For models, make sure we're looking in the app/models directory
        $fullPath = __DIR__ . '/../app/models/' . basename($classPath) . '.php';
    }
    // Check if the class is in the config namespace
    elseif ($classParts[0] === 'config') {
        // For config, make sure we're looking in the app/config directory
        $fullPath = __DIR__ . '/../app/config/' . basename($classPath) . '.php';
    } else {
        // For all other classes, we are looking in app/controllers
        $fullPath = __DIR__ . '/../app/controllers/' . basename($classPath) . '.php';
    }

    // Check if the file exists and require it
    if (file_exists($fullPath)) {
        require_once $fullPath;
        return;
    } else {
        die("Class '$class' not found at path: $fullPath");
    }
});

