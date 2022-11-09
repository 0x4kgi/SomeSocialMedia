<?php
require("system/db.php");
include("system/auth.php");

$disp = "Select display_name from users WHERE username='" . $_SESSION['username'] . "'";
$dispR = mysqli_query($con, $disp);
$DRDR = mysqli_fetch_assoc($dispR);
$naymu = $DRDR['display_name'];

$user = $_REQUEST['user'];

$dp = "";
$userQuery = "SELECT * from users where username='" . $user . "'";
$userResult = mysqli_query($con, $userQuery) or die(mysqli_error());
$userRows = mysqli_fetch_assoc($userResult);
if ($userRows['prof_pic'] == null) $dp = "uploads/avatars/noimg.jpg";
else $dp = $userRows['prof_pic'];

$postCountQuery = "SELECT COUNT(post_id) AS postCTR FROM posts WHERE submittedby='" . $user . "'";
$pcqResult = mysqli_query($con, $postCountQuery) or die(mysqli_error());
$pcqRows = mysqli_fetch_assoc($pcqResult);

$commentCountQuery = "SELECT COUNT(comment_id) AS commentCTR FROM comments WHERE submittedby='$user'";
$ccqResult = mysqli_query($con, $commentCountQuery) or die(mysqli_error());
$ccqRows = mysqli_fetch_assoc($ccqResult);

$profile_picture = "";
$dpQ = "SELECT prof_pic FROM users WHERE username='" . $_SESSION['username'] . "'";
$dpR = mysqli_query($con, $dpQ);
$dpRR = mysqli_fetch_assoc($dpR);
if ($dpRR['prof_pic'] == null)
    $profile_picture = "uploads/avatars/noimg.jpg";
else $profile_picture = $dpRR['prof_pic'];

function TimeAgo($oldTime, $newTime)
{
    $timeCalc = strtotime($newTime) - strtotime($oldTime);
    if ($timeCalc < 0) {
        $timeCalc = "FROM THE DISTANT FUTURE";
    } else if ($timeCalc >= (60 * 60 * 24 * 30 * 12 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30 / 12) . " years ago";
    } else if ($timeCalc >= (60 * 60 * 24 * 30 * 12)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30 / 12) . " year ago";
    } else if ($timeCalc >= (60 * 60 * 24 * 30 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30) . " months ago";
    } else if ($timeCalc >= (60 * 60 * 24 * 30)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30) . " month ago";
    } else if ($timeCalc >= (60 * 60 * 24 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24) . " days ago";
    } else if ($timeCalc >= (60 * 60 * 24)) {
        $timeCalc = " Yesterday";
    } else if ($timeCalc >= (60 * 60 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60) . " hours ago";
    } else if ($timeCalc >= (60 * 60)) {
        $timeCalc = intval($timeCalc / 60 / 60) . " hour ago";
    } else if ($timeCalc >= 60 * 2) {
        $timeCalc = intval($timeCalc / 60) . " minutes ago";
    } else if ($timeCalc >= 60) {
        $timeCalc = intval($timeCalc / 60) . " minute ago";
    } else if ($timeCalc > 0) {
        $timeCalc .= " seconds ago";
    } else if ($timeCalc == 0) {
        $timeCalc = "Just now";
    } else $timeCalc = "Unknown date";
    return $timeCalc;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $user; ?>'s userpage!</title>
    <link rel="stylesheet" href="css/w3.css" />
    <link rel="stylesheet" href="css/w3-1.css" />
</head>

<body class="w3-light-grey">
    <!-- top nav bar -->
    <div class="w3-top w3-card">
        <ul class="w3-navbar w3-black">
            <li class="w3-right"><a href="logout.php">Logout</a></li>
            <li class="w3-right"><a href="edit.php">Edit Profile</a></li>
            <li class="w3-right"><a href="profile.php?user=<?php echo $_SESSION['username']; ?>"><?php echo $_SESSION['username']; ?></a></li>
            <li class="w3-right"><a href="index.php">Home</a></li>
        </ul>
    </div>
    <!-- top nav bar end -->
    <br><br><br>
    <?php
    if ($userRows == false) {
        echo "<h1>User <i>" . $user . "</i> is not found!</h1><br>";
        echo "Maybe you had a typo while typing the user's URL!<br>";
        echo "Check the name after \"<i>profile.php?user=</i>\"<br>";
        echo "Click <a href=index.php>here</a> to go back to home!<br><br><br>";
        echo "ill make a search function for this, if im not lazy.";
    } else {

    ?>
        <!-- the entire page layout -->
        <div class="w3-row">
            <!-- space buffer -->
            <div class="w3-col" style="width: 5px"><br></div>
            <!-- profile box -->
            <div class="w3-col m3 w3-card w3-center w3-white w3-leftbar w3-border-green" style="position: fixed;">
                <img src="<?php echo $dp ?>" class="w3-circle" height="128" width="128" alt="Avatar"><br>
                <b><?php echo $userRows['display_name'] ?><br></b>
                <i><?php echo $userRows['username']; ?></i><br>
                <?php if ($userRows['username'] == $_SESSION['username']) { ?>
                    <span class="w3-tiny"><a href="edit.php" class="w3-hover-text-green">Edit Profile</a></span>
                <?php } else {
                } ?>
                <hr>
                Account created <?php echo TimeAgo($userRows['join_date'], date("Y-m-d H:i:s")) ?><br>
                <?php if (($pcqRows['postCTR'] > 0)) { ?>
                    This user has made <?php echo $pcqRows['postCTR']; ?> posts<br>
                <?php } else { ?>
                    This user hasn't posted yet. :(<br>
                <?php } ?>
                <?php if (($ccqRows['commentCTR'] > 0)) { ?>
                    This user commented <?php echo $ccqRows['commentCTR']; ?> times<br>
                <?php } else {
                } ?>
                <hr>
            </div>
            <div class="w3-col m3">
                <br>
            </div>
            <!-- profile box end -->

            <!-- space buffer -->
            <div class="w3-col" style="width: 5px"><br></div>

            <div class="w3-rest">
                <!-- bio box (lol) -->
                <header class="w3-container w3-green w3-card">
                    <h1><?php echo $userRows['display_name'] ?>'s User page</h1>
                    <p class="w3-tiny">this will be customizable in the future :)</p>
                </header>
                <?php if ($userRows['prof_bio'] != null) { ?>
                    <div class="w3-container w3-leftbar w3-sand w3-card">
                        <p class="w3-tiny">Bio</p>
                        <p class="w3-xxlarge w3-serif"><i><?php echo $userRows['prof_bio'] ?></i></p>
                    </div>
                <?php } else { ?>
                    <div class="w3-container w3-pale-red w3-leftbar w3-rightbar w3-border-red">
                        <p class="w3-tiny">User has no bio available. Maybe this person is just lazy.</p>
                    </div>
                <?php } ?>
                <br>
                <!-- bio end -->
                <!-- posts start -->
                <?php
                $count = 1;
                $sel_query = "Select * from posts where submittedby='$user' ORDER BY post_date desc;";
                $result = mysqli_query($con, $sel_query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $pid = $row['post_id'];
                    $p = "";
                    $a = $row['submittedby'];
                    $q = "SELECT display_name,prof_pic FROM users WHERE username='$a';";
                    $r = mysqli_query($con, $q);
                    $n = mysqli_fetch_assoc($r);
                    if ($n['prof_pic'] == null)
                        $p = "uploads/avatars/noimg.jpg";
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
                                        <span class="w3-right"><a href="system/delete.php?id=<?php echo $row['post_id'] ?>">Delete</a> <a href="#">Edit</a></span>
                                    <?php } else {
                                    } ?>
                                </p>
                            </div>
                        </div>
                        <footer class="w3-container w3-white w3-small">

                            <p>
                            <form action="system/comment.php">
                                <input type="hidden" name="page" value="profile">
                                <input type="hidden" name="profile" value="<?php echo $a; ?>">
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
                                    if ($cdpn['prof_pic'] == null) $cdp = "uploads/avatars/noimg.jpg";
                                    else $cdp = $cdpn['prof_pic'];
                                ?>
                            <table class="w3-table">
                                <tr class="w3-light-green" height=25>
                                    <td width=26><img src="<?php echo $cdp; ?>" width=25 height=25 class="w3-circle"></th>
                                    <td class="w3-rightbar w3-border-lightgreen">
                                        <b><?php echo $cdpn['display_name'] . "</b>-<i>" . $commentN['submittedby'] . "</i>"; ?>
                                            <br><?php echo TimeAgo($commentN['comment_date'], date("Y-m-d H:i:s")); ?>
                                            <?php if ($_SESSION['username'] == $commentN['submittedby']) { ?>
                                                <span class="w3-right w3-tiny"><a href="system/cdel.php?id=<?php echo $commentN['comment_id'] ?>&page=profile&profile=<?php echo $user; ?>">Delete</a></span>
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
                <!-- posts end -->
            </div> <!-- div w3-rest end -->
        </div> <!-- div row end -->
    <?php } //end of if(userRows)  DO NOT REMOVE 
    ?>
</body>

</html>