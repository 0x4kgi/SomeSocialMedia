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

/**
 * USER TESTING!!!!!!!!!!!!!!!!!!!!!!!
 */
echo "<details><summary>User testing!</summary>";
$userHandler = new UserHandler();
$user = new User();
$time = time();
$email = "{$time}@testing.com";

$user
    ->setEmail($email)
    ->setPassword('testpass')
    ->setUsername($time)
    ->setDisplayName("testdisplayname$time")
    ->setBio("testbio$time")
    ->setAvatar("$time.png");
var_dump($user);

echo "===============new user<br>";
$userHandler->add($user);
$lastUserId = $userHandler->lastInsertId();
$useradded = $userHandler->getUser($lastUserId);
var_dump($useradded);

echo "==============update<br>";
$useradded->setAvatar('modified')->setUsername('modified')->setEmail('modified')->setDisplayName('modified')->setPassword('modified')->setBio('modified');
var_dump($useradded);
$u = $userHandler->update($useradded);
if (!$u) {
    var_dump($userHandler->getExecutionFeedback());
}

echo "===============delete<br>";
$d = $userHandler->delete($useradded);
if (!$d) {
    var_dump($userHandler->getExecutionFeedback());
}

$userdeleted = $userHandler->getUser($email, 'email');
var_dump($userdeleted);
var_dump($userHandler->getUser($lastUserId));

echo "===============purge<br>";
$p = $userHandler->purge($userHandler->getUser($lastUserId));
if (!$p) {
    var_dump($userHandler->getExecutionFeedback());
}
var_dump($userHandler->getUser($lastUserId));
echo "</details>";

/**
 * POST TESTING!!!!!!!!!!!!!!!!!!!!!!!
 */
echo "<details><summary>Post testing!</summary>";
$postHandler = new PostHandler();
$post = new Post();

$post->setContent("post $time")->setUserId($time)->setRating($time);
var_dump($post);

echo "===============new post<br>";
$np = $postHandler->add($post);
if (!$np) {
    echo ($postHandler->getExecutionFeedback());
}
$lastId = $postHandler->lastInsertId();
$lastPost = $postHandler->getPost($lastId);
var_dump($lastPost);

echo "===============update<br>";
$lastPost->setContent('modified')->setRating(0);
$up = $postHandler->update($lastPost);
if (!$up) {
    echo ($postHandler->getExecutionFeedback());
}
$lastPost = $postHandler->getPost($lastId);
var_dump($lastPost);

echo "===============delete<br>";
$dp = $postHandler->delete($lastPost);
if (!$dp) {
    echo ($postHandler->getExecutionFeedback());
}
$lastPost = $postHandler->getPost($lastId);
var_dump($lastPost);

echo "===============purge<br>";
$pp = $postHandler->purge($lastPost);
if (!$pp) {
    var_dump($postHandler->getExecutionFeedback());
}
$lastPost = $postHandler->getPost($lastId);
var_dump($lastPost);
echo "</details>";

echo "</details>";

/**
 * Comment TESTING!!!!!!!!!!!!!!!!!!!!!!!
 */
echo "<details><summary>Comment testing!</summary>";

echo "</details>";
