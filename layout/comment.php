<table class="w3-table">
    <tbody>
        <tr class="w3-light-green" height="25">
            <td class="w3-center" width="26"><img src="<?= $commentUserAvatar ?>" class="w3-circle" width="25" height="25">
            </td>
            <td class="w3-rightbar w3-border-lightgreen">
                <b><?= $commentUserDisplayName ?></b> @<i><?= $commentUsername ?></i> <br><?= $commentDateRelative ?>
                <?php if ($_SESSION['username'] === $commentUsername) { ?>
                    <span class="w3-right w3-tiny"><a href="system/cdel.php?id=<?= $commentId ?>#page=index">Delete</a></span>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><br></td>
            <td class="w3-leftbar w3-rightbar w3-bottombar"><?= $commentContent ?></td>
        </tr>
    </tbody>
</table>