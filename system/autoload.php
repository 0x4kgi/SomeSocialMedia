<?php

require "auth.php";
require "db.php";

spl_autoload_register(function ($className) {
    // if class is in a namespace, exit
    if (strpos($className, '/') !== false) return;

    // check if class has some suffix to them
    if (strpos($className, 'DAO') !== false) {
        if (file_exists(__DIR__ . "/dao/$className.php")) {
            require_once __DIR__ . "/dao/$className.php";
        }
    } elseif (strpos($class_name, 'Handler') !== false) {
        if (file_exists(__DIR__ . "/handler/$className.php")) {
            require_once __DIR__ . "/handler/$className.php";
        }
    } elseif (
        strpos($class_name, 'Object') !== false
    ) {
        if (file_exists(__DIR__ . "/object/$className.php")) {
            require_once __DIR__ . "/object/$className.php";
        }
    }
});
