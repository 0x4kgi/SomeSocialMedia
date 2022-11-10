<?php
require("system/db.php");
require("system/auth.php");

include("lib/TimeAgo.php");

$id = $_REQUEST['id'];

// $postViewQuery = "SELECT * FROM posts where post_id = '$id'";
// $pvqC = mysqli_query($con, $postViewQuery);
// $pvqR = mysqli_fetch_assoc($pvqC);

// $user = $pvqR['submittedby'];
// $dp = "";
// $userQuery = "SELECT * from users where username='" . $user . "'";
// $userResult = mysqli_query($con, $userQuery) or die(mysqli_error());
// $userRows = mysqli_fetch_assoc($userResult);
// if ($userRows['prof_pic'] == null) $dp = "assets/noimg.jpg";
// else $dp = $userRows['prof_pic'];

// $profile_picture = "";
// $dpQ = "SELECT prof_pic FROM users WHERE username='" . $_SESSION['username'] . "'";
// $dpR = mysqli_query($con, $dpQ);
// $dpRR = mysqli_fetch_assoc($dpR);
// if ($dpRR['prof_pic'] == null)
//     $profile_picture = "assets/noimg.jpg";
// else $profile_picture = $dpRR['prof_pic'];

// $disp = "Select display_name from users WHERE username='" . $_SESSION['username'] . "'";
// $dispR = mysqli_query($con, $disp);
// $DRDR = mysqli_fetch_assoc($dispR);
// $naymu = $DRDR['display_name'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $pvqR['submittedby']; ?>'s post</title>
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
            Posted by:<br>
            <a href="profile.php?user=<?php echo $userRows['username'] ?>">
                <img src="<?php echo $dp ?>" class="w3-circle" height="128" width="128" alt="Avatar"></a><br>
            <b><?php echo $userRows['display_name'] ?><br></b>
            <i><?php echo $userRows['username']; ?></i><br>
            <hr>
            <div>
                <?php
                $userCTRQ = "SELECT COUNT(DISTINCT submittedby) AS ctr FROM comments WHERE post_id='$id'";
                $uCC = mysqli_query($con, $userCTRQ);
                $uCR = mysqli_fetch_assoc($uCC);

                $userLIST = "SELECT DISTINCT submittedby FROM comments WHERE post_id='$id' ORDER BY submittedby ASC";
                $uLC = mysqli_query($con, $userLIST);

                ?>
                <p><b>Thread participants: (<?php echo $uCR['ctr']; ?>)</b></p>
                <table>
                    <?php while ($ulR = mysqli_fetch_assoc($uLC)) {
                        $p = "";
                        $q = "SELECT display_name, prof_pic FROM users WHERE username='" . $ulR['submittedby'] . "'";
                        $qC = mysqli_query($con, $q);
                        $qR = mysqli_fetch_assoc($qC);
                        if ($qR['prof_pic'] == null) $p = "assets/noimg.jpg";
                        else $p = $qR['prof_pic'];
                    ?>
                        <tr class="w3-left">

                            <td width="32" height="32"><img src="<?php echo $p; ?>" width="32" height="32" class="w3-circle"></td>
                            <td><a href="profile.php?user=<?php echo $ulR['submittedby']; ?>"><?php echo $qR['display_name']; ?> </a></td>
                            </a>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="w3-col m3">
            <br>
        </div>
        <!-- profile box end -->

        <!-- space buffer -->
        <div class="w3-col" style="width: 5px"><br></div>

        <div class="w3-rest">

            <!-- posts start -->
            <?php
            $count = 1;
            $sel_query = "Select * from posts where post_id='$id' ORDER BY post_date desc;";
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
                                    <span class="w3-right"><a href="delete.php?id=<?php echo $row['post_id'] ?>">Delete</a> <a href="#">Edit</a></span>
                                <?php } else {
                                } ?>
                            </p>
                        </div>
                    </div>
                    <footer class="w3-container w3-white w3-small">

                        <p>
                        <form action="system/comment.php">
                            <input type="hidden" name="page" value="post_view">
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

                            $selComment = "SELECT * FROM comments WHERE post_id=$pid";
                            $commentR = mysqli_query($con, $selComment);
                            while ($commentN = mysqli_fetch_assoc($commentR)) {
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
                                <td width=26><img src="<?php echo $cdp; ?>" width=25 height=25 class="w3-circle"></th>
                                <td class="w3-rightbar w3-border-lightgreen">
                                    <b><?php echo $cdpn['display_name'] . "</b>-<i>" . $commentN['submittedby'] . "</i>"; ?>
                                        <br><?php echo TimeAgo($commentN['comment_date'], date("Y-m-d H:i:s")); ?>
                                        <?php if ($_SESSION['username'] == $commentN['submittedby']) { ?>
                                            <span class="w3-right w3-tiny"><a href="system/cdel.php?id=<?php echo $commentN['comment_id'] ?>&page=post_view&pid=<?php echo $pid; ?>">Delete</a></span>
                                        <?php } else {
                                        } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td class="w3-leftbar w3-rightbar w3-bottombar">
                                    <?php echo $commentN['comment']; ?>
                                </td>
                            </tr>
                        </table>
                    <?php
                            }
                    ?>
                    </p> <!-- comments display end -->
                    <?php
                    $cCTR = "SELECT COUNT(comment_id) as cCTR FROM comments WHERE post_id=$pid";
                    $cCTRC = mysqli_query($con, $cCTR);
                    $cCTRQ = mysqli_fetch_assoc($cCTRC);
                    if ($cCTRQ['cCTR'] > 7) {

                    ?>
                        <p>
                        <form action="system/comment.php">
                            <input type="hidden" name="page" value="post_view">
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
                    <?php } else {
                    } ?>
                    </footer>
                </div> <!-- profile post display ends here -->
                <br>
            <?php $count++;
            } ?>
            <!-- posts end -->
        </div> <!-- div w3-rest end -->
    </div> <!-- div row end -->
    <div id="bottom"></div>
</body>

</html>