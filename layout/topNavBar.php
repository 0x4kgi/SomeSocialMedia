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