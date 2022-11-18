<?php

require 'system/db.php';

// copypasted from autoload.php, for no auth conflict
spl_autoload_register(function ($className) {
    var_dump($className);
    // if class is in a namespace, exit
    if (strpos($className, '/') !== false) return;

    // check if class has some suffix to them
    if (strpos($className, 'DAO') !== false) {
        if (file_exists(__DIR__ . "/system/dao/$className.php")) {
            require_once __DIR__ . "/system/dao/$className.php";
        }
    } elseif (strpos($className, 'Handler') !== false) {
        if (file_exists(__DIR__ . "/system/handler/$className.php")) {
            require_once __DIR__ . "/system/handler/$className.php";
        }
    } else {
        if (file_exists(__DIR__ . "/system/object/$className.php")) {
            require_once __DIR__ . "/system/object/$className.php";
        }
    }
});

DB::changeDatabase('testsocialmedia');

var_dump(DB::getInstance());

$userHandler = new UserHandler();

$user = new User();

$user
    ->setEmail('test')
    ->setPassword('testpass')
    ->setUsername('testusernasme')
    ->setDisplayName('testdisplayname')
    ->setBio('testbio');

var_dump($user);

$userHandler->add($user);
$lastUserId = $userHandler->lastInsertId();
$user = $userHandler->getUser($lastUserId);
var_dump($user);
$userHandler->delete($user);
$user = $userHandler->getUser($lastUserId);
var_dump($user);
