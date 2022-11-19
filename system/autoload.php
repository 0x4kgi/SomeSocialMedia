<?php

require "auth.php";
require "db.php";

spl_autoload_register(function ($className) {
    // if class is in a namespace, exit
    if (str_contains($className, '/')) return;

    // check if class has some suffix to them
    if (str_contains($className, 'DAO')) {
        if (file_exists(__DIR__ . "/dao/$className.php")) {
            require_once __DIR__ . "/dao/$className.php";
        }
    } elseif (str_contains($class_name, 'Handler')) {
        if (file_exists(__DIR__ . "/handler/$className.php")) {
            require_once __DIR__ . "/handler/$className.php";
        }
    } elseif (str_contains($class_name, 'Object')) {
        if (file_exists(__DIR__ . "/object/$className.php")) {
            require_once __DIR__ . "/object/$className.php";
        }
    } else {
        if (file_exists(__DIR__ . "/$className.php")) {
            require_once __DIR__ . "/$className.php";
        }
    }
});
