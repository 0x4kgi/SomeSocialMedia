<?php
include("system/auth.php");
include("lib/TimeAgo.php");
require('system/db.php');


$disp = "Select display_name from users WHERE username='" . $_SESSION['username'] . "'";
$dispR = mysqli_query($con, $disp);
$DRDR = mysqli_fetch_assoc($dispR);
$naymu = $DRDR['display_name'];

$profile_picture = "";
$dpQ = "SELECT prof_pic FROM users WHERE username='" . $_SESSION['username'] . "'";
$dpR = mysqli_query($con, $dpQ);
$dpRR = mysqli_fetch_assoc($dpR);
if ($dpRR['prof_pic'] == null)
    $profile_picture = "assets/noimg.jpg";
else $profile_picture = $dpRR['prof_pic'];


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
    <?php include("layout/topNavBar.php"); ?>
    <br><br><br>
    <!-- the entire page layout -->
    <div class="w3-row">
        <!-- space buffer -->
        <div class="w3-col" style="width: 5px"><br></div>

        <!-- profile box -->
        <div class="w3-col m3 w3-card w3-center w3-white w3-leftbar w3-border-green" style="position: fixed;">
            <a href="profile.php?user=<?php echo $_SESSION['username'] ?>">
                <img src="<?php echo $profile_picture ?>" class="w3-circle" height="128" width="128" alt="Avatar"></a><br>
            <b><?php echo $naymu; ?><br></b>
            <i><?php echo $_SESSION['username']; ?></i><br>
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
            <!-- PHP loop for displaying posts.... -->
            <?php
            $count = 1;
            $sel_query = "Select * from posts ORDER BY post_date desc;";
            $result = mysqli_query($con, $sel_query);
            while ($row = mysqli_fetch_assoc($result)) {
                $pid = $row['post_id'];
                $p = "";
                $a = $row['submittedby'];
                $q = "SELECT display_name,prof_pic FROM users WHERE username='$a';";
                $r = mysqli_query($con, $q);
                $n = mysqli_fetch_assoc($r);
                if ($n['prof_pic'] == null)
                    $p = "assets/noimg.jpg";
                else $p = $n['prof_pic'];
            ?>
                <div class="w3-card w3-white" id="<?php echo $pid; ?>">
                    <!-- profile post display start -->
                    <header class="w3-container w3-green w3-large">
                        <table border="1">
                            <tr>
                                <td rowspan="2" width="70" height="65"><a href=profile.php?user=<?php echo $row['submittedby'] ?>><img src="<?php echo $p ?>" class="w3-circle" height="60" width="60" alt="Avatar"></a></td>
                                <td><?php echo "<b>" . $n['display_name'] . "</b>"; ?></td>

                            </tr>
                            <tr>
                                <td><?php echo "<a href=profile.php?user=" . $row['submittedby'] . ">" . $row['submittedby'] . "</a>"; ?></td>
                            </tr>
                        </table>
                    </header>
                    <div class="w3-container w3-bottombar w3-rightbar w3-leftbar w3-border-green">
                        <p><?php echo $row['post']; ?></p>
                        <hr>
                        <div class="w3-tiny">
                            <p class="w3-tooltip">
                                <?php echo TimeAgo($row['post_date'], date("Y-m-d H:i:s")); ?>
                                <i><span class="w3-text">(<?php echo $row['post_date'] ?>)</span></i>
                                <?php if ($row['submittedby'] == $_SESSION['username']) { ?>
                                    <span class="w3-right"><a href="system/delete.php?id=<?php echo $row['post_id'] ?>">Delete</a> <a>Edit</a></span>
                                <?php } else {
                                } ?>
                            </p>
                        </div>
                    </div>
                    <footer class="w3-container w3-white w3-small">
                        <p>
                        <form action="system/comment.php">
                            <input type="hidden" name="page" value="index">
                            <input type="hidden" name="to" value="<?php echo $pid; ?>">
                            <input type="hidden" name="submitter" value="<?php echo $_SESSION['username']; ?>">
                            <table>
                                <tr>
                                    <td width=33><img src="<?php echo $profile_picture ?>" class="w3-circle" height="32" width="32" alt="Avatar"></td>
                                    <td><input type="text" name="commentContent" class="w3-round w3-input" rows="1" height="12px" placeholder="Write a comment..."></td>
                                </tr>
                            </table>
                        </form>
                        </p>
                        <p>
                            <!-- comments display here xD -->

                            <?php
                            $count = 0;
                            $selComment = "SELECT * FROM comments WHERE post_id=$pid";
                            $commentR = mysqli_query($con, $selComment);
                            while (($count < 3) && $commentN = mysqli_fetch_assoc($commentR)) {
                                $cpN = $commentN['submittedby'];
                                $cdp = "";
                                $cdpq = "SELECT display_name, prof_pic FROM users WHERE username='$cpN'";
                                $cdpr = mysqli_query($con, $cdpq);
                                $cdpn = mysqli_fetch_assoc($cdpr);
                                if ($cdpn['prof_pic'] == null) $cdp = "assets/noimg.jpg";
                                else $cdp = $cdpn['prof_pic'];
                            ?>
                        <table class="w3-table">
                            <tr class="w3-light-green" height=25>
                                <td width=26 class="w3-center"><img src="<?php echo $cdp; ?>" width=25 height=25 class="w3-circle"></th>
                                <td class="w3-rightbar w3-border-lightgreen">
                                    <b><?php echo $cdpn['display_name'] . "</b>-<i>" . $commentN['submittedby'] . "</i>"; ?>
                                        <br><?php echo TimeAgo($commentN['comment_date'], date("Y-m-d H:i:s")); ?>
                                        <?php if ($_SESSION['username'] == $commentN['submittedby']) { ?>
                                            <span class="w3-right w3-tiny"><a href="system/cdel.php?id=<?php echo $commentN['comment_id'] ?>&page=index">Delete</a></span>
                                        <?php } else {
                                        } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td class="w3-leftbar w3-rightbar w3-bottombar"><?php echo $commentN['comment']; ?></td>
                            </tr>
                        </table>
                    <?php $count++;
                            }
                            $cCTR = "SELECT COUNT(comment_id) as cCTR FROM comments WHERE post_id=$pid";
                            $cCTRC = mysqli_query($con, $cCTR);
                            $cCTRQ = mysqli_fetch_assoc($cCTRC);
                            if ($cCTRQ['cCTR'] > 0)
                                echo "<a href='post_view.php?id=" . $row['post_id'] . "'>View all " . $cCTRQ['cCTR'] . " comments</a>";
                    ?>
                    </p> <!-- comments display end -->

                    </footer>
                </div> <!-- profile post display ends here -->
                <br>
            <?php $count++;
            } ?>
            <!-- PHP Post loop ends here -->

        </div> <!-- w3-rest for posts end here -->
        <div id="bottom"></div>
        <!-- space buffer -->
        <div class="w3-col w3-right" style="width: 5px"><br></div>

    </div> <!-- div w3-row end -->
</body>

</html>