<?php
require('db.php');
$id=$_REQUEST['id'];
$page=$_REQUEST['page'];
$postID=$_REQUEST['pid'];
$whatprofile=$_REQUEST['profile'];
$query = "DELETE FROM comments WHERE comment_id=$id"; 
$result = mysqli_query($con,$query);
if($page == "index") header("Location: ../index.php");
else if($page == "post_view") header("Location: ../post_view.php?id=$postID"); 
else if($page == "profile") header("Location: ../profile.php?user=$whatprofile"); 
?>