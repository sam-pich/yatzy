<?php

echo "Bootstrap Path: " . __FILE__ . "\n";

spl_autoload_register(function ($fullName) {
    $parts = explode("\\", $fullName);
    $len = count($parts);
    $className = $parts[$len - 1];
    if (file_exists(__DIR__ . "/../app/models/{$className}.php")) {
        require_once __DIR__ . "/../app/models/{$className}.php";
    }
});