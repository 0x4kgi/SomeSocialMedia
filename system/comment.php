<?php
	require("db.php");
	include("auth.php");
	
	$fromPage = $_REQUEST['page'];
	$whatProfile = $_REQUEST['profile'];
	
	$commentTO = $_REQUEST['to'];
	$postContent = stripslashes($_REQUEST['commentContent']);
    $postContent = mysqli_real_escape_string($con,$postContent);
	$postContent = str_replace("<", "&lt;", $postContent);
	$postContent = str_replace(">", "&gt;", $postContent);
	
	$commenter = $_REQUEST['submitter'];
	$postDate = date("Y-m-d H:i:s");
	$commentQuery = "INSERT INTO `comments` (`post_id`, `submittedby`, `comment`, `comment_date`) 
										VALUES ('$commentTO', '$commenter', '$postContent', '$postDate')";
	$result = mysqli_query($con,$commentQuery);
	
	if($fromPage == "index") header("Location: ../index.php#$commentTO"); 
	else if($fromPage == "profile") header("Location: ../profile.php?user=$whatProfile#$commentTO");
	else if($fromPage == "post_view") header("Location: ../post_view.php?id=$commentTO#bottom");
?>