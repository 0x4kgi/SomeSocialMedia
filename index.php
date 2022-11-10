<?php
require("system/db.php");
require("system/auth.php");
require("system/object/Comment.php");
require("system/object/Posts.php");
require("system/object/Post.php");
require("system/object/User.php");
require("lib/TimeAgo.php");

$user = new User($con, $_SESSION['username']);

$posts = new Posts($con);
$posts->setOrder(true);
$postsList = $posts->getPosts();

$status = "";
if (isset($_POST['new']) && $_POST['new'] == 'status') {
    $post = stripslashes($_REQUEST['post']); // removes backslashes
    $post = mysqli_real_escape_string($con, $post);
    $post = str_replace("\n", "<br>", $post);
    $post = str_replace("<", "&lt;", $post);
    $post = str_replace(">", "&gt;", $post);
    $trn_date = date("Y-m-d H:i:s");
    $rating = 0;
    $submittedby = $_SESSION["username"];
    $ins_query = "insert into posts (`post_date`,`post`,`submittedby`,`rating`) " .
        "values ('$trn_date','$post','$submittedby','$rating')";
    mysqli_query($con, $ins_query) or die(mysql_error());
    $status = "New Post Uploaded Successfully.</br>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Feed</title>
    <link rel="stylesheet" href="css/w3.css" />
    <link rel="stylesheet" href="css/w3-1.css" />
</head>

<body class="w3-light-grey">
    <?php include("layout/topbar.php"); ?>
    <br><br><br>
    <!-- the entire page layout -->
    <div class="w3-row">
        <!-- space buffer -->
        <div class="w3-col" style="width: 5px"><br></div>

        <!-- profile box -->
        <div class="w3-col m3 w3-card w3-center w3-white w3-leftbar w3-border-green" style="position: fixed;">
            <a href="profile.php?user=<?php echo $user->username ?>">
                <img src="<?php echo $user->profile_picture ?>" class="w3-circle" height="128" width="128" alt="Avatar"></a><br>
            <b><?php echo $user->display_name; ?><br></b>
            <i><?php echo $user->username; ?></i><br>
            <span class="w3-tiny"><a href="edit.php" class="w3-hover-text-green">Edit Profile</a></span>
            <hr>

        </div>
        <div class="w3-col m3">
            <br>
        </div>
        <!-- profile box end -->

        <!-- space buffer -->
        <div class="w3-col" style="width: 5px;"><br></div>

        <!-- post grid -->
        <div class="w3-rest">
            <!-- post box -->
            <div class="w3-card w3-white">
                <form name="form" method="post" action="">
                    <input type="hidden" name="new" value="status" />
                    <p align="center">
                        <textarea name="post" placeholder="Write your post here." class="w3-input"></textarea>
                        <button name="submit" type="submit" class="w3-btn w3-green w3-right">Post</button><br>
                    </p>
                </form>
                <p style="color:#FF0000;"><?php echo $status; ?></p>
            </div>
            <br>
            <!-- post box end -->
            <?php
            foreach ($postsList as $post) {
                $postId = $post->id;
                include __DIR__ . '/layout/post.php';
            }
            ?>

        </div> <!-- w3-rest for posts end here -->
        <div id="bottom"></div>
        <!-- space buffer -->
        <div class="w3-col w3-right" style="width: 5px"><br></div>

    </div> <!-- div w3-row end -->
</body>

</html>