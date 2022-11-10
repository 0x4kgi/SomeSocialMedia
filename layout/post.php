<?php
$postObject = new Post($con, $postId);

$postUserName = $postObject->submitter->username;
$postUserProfilePicture = $postObject->submitter->profile_picture;
$postDisplayName = $postObject->submitter->display_name;
$postContent = $postObject->content;
$postDateRelative = TimeAgo($postObject->postDate, date("Y-m-d H:i:s"));
$postDate = $postObject->postDate;

/**
 * @var Comment[]
 */
$postComments = $postObject->getComments();
?>

<div class="w3-card w3-white" id="4">
    <!-- profile post display start -->
    <header class="w3-container w3-green w3-large">
        <table border="1">
            <tr>
                <td rowspan="2" width="70" height="65"><a href="profile.php?user=<?= $postUserName ?>"><img src="<?= $postUserProfilePicture ?>" class="w3-circle" height="60" width="60" alt="Avatar"></a></td>
                <td><b><?= $postDisplayName ?></b></td>

            </tr>
            <tr>
                <td><a href="profile.php?user=<?= $postUserName ?>"><?= $postUserName ?></a></td>
            </tr>
        </table>
    </header>
    <div class="w3-container w3-bottombar w3-rightbar w3-leftbar w3-border-green">
        <p><?= $postContent ?></p>
        <hr>
        <div class="w3-tiny">
            <p class="w3-tooltip">
                <?= $postDateRelative ?> <i><span class="w3-text">(<?= $postDate ?>)</span></i>
                <?php if ($_SESSION['username'] === $postUserName) { ?>
                    <span class="w3-right"><a href="system/delete.php?id=<?= $postId ?>">Delete</a> <a>Edit</a></span>
                <?php } ?>
            </p>
        </div>
    </div>
    <footer class="w3-container w3-white w3-small">
        <p>
        <form action="system/comment.php">
            <input type="hidden" name="page" value="index">
            <input type="hidden" name="to" value="<?= $postId ?>">
            <input type="hidden" name="submitter" value="<?= $_SESSION['username'] ?>">
            <table>
                <tr>
                    <td width=33><img src="<?= $postUserProfilePicture ?>" class="w3-circle" height="32" width="32" alt="Avatar"></td>
                    <td><input type="text" name="commentContent" class="w3-round w3-input" rows="1" height="12px" placeholder="Write a comment..."></td>
                </tr>
            </table>
        </form>
        </p>
        <p>
            <!-- comments display here xD -->
            <?php
            foreach ($postComments as $comment) {
                $commentId = $comment->id;
                $commentUserAvatar = $comment->submitter->profile_picture;
                $commentUsername = $comment->submitter->username;
                $commentUserDisplayName = $comment->submitter->display_name;
                $commentContent = $comment->comment;
                $commentDateRelative = TimeAgo($comment->date, date("Y-m-d H:i:s"));
                include __DIR__ . '/comment.php';
            }
            ?>
        </p> <!-- comments display end -->

    </footer>
</div> <!-- profile post display ends here -->