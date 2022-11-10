<?php
require("system/db.php");
require("system/auth.php");
require("system/object/Comment.php");
require("system/object/Posts.php");
require("system/object/Post.php");
require("system/object/User.php");
require("lib/TimeAgo.php");


$posts = new Posts($con);

$list = $posts->getPosts();

foreach ($list as $post) {
    $comments = $post->getComments();
    $participants = $post->getPostParticipants();

    var_dump($post);
}
