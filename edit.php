<?php
require('system/db.php');
include("system/auth.php");
$profile = $_SESSION['username'];
$query = "SELECT * from users where username='" . $profile . "'";
$result = mysqli_query($con, $query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);
$id = $row['user_id'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Edit account</title>
    <link rel="stylesheet" href="css/w3.css" />
    <link rel="stylesheet" href="css/w3-1.css" />
</head>

<body>
    <div class="w3-top w3-card">
        <ul class="w3-navbar w3-black">
            <li class="w3-right"><a href="logout.php">Logout</a></li>
            <li class="w3-right"><a href="edit.php">Edit Profile</a></li>
            <li class="w3-right"><a href="profile.php?user=<?php echo $_SESSION['username']; ?>"><?php echo $_SESSION['username']; ?></a></li>
            <li class="w3-right"><a href="index.php">Home</a></li>
        </ul>
    </div>
    <div class="form">
        <p align="right"><?php echo "<b>EDITING: </b>" . $_SESSION['username']; ?> | <a href="index.php">Home</a> | <b><a>Edit Profile</a></b> | <a href="logout.php">Logout</a></p>

        <?php
        $detstat = $passstat = $dpstat = $emailstat = "";
        if (isset($_POST['new']) && $_POST['new'] == 'details') {
            $disp_name = stripslashes($_REQUEST['name']);
            $disp_name = mysqli_real_escape_string($con, $disp_name);
            $disp_name = str_replace("<", "&lt;", $disp_name);
            $disp_name = str_replace(">", "&gt;", $disp_name);
            $bio = stripslashes($_REQUEST['bio']);
            $bio = mysqli_real_escape_string($con, $bio);
            $bio = str_replace("<", "&lt;", $bio);
            $bio = str_replace(">", "&gt;", $bio);
            $update = "UPDATE users SET display_name = '" . $disp_name . "', prof_bio = '" . $bio . "' WHERE users.user_id = '" . $id . "'";
            mysqli_query($con, $update) or die(mysqli_error());
            $detstat = "Profile Updated Successfully. <br>";
        } else if (isset($_POST['new']) && $_POST['new'] == 'access') {
            $email = $_REQUEST['email'];
            $update = "UPDATE users SET email = '" . $email . " WHERE users.user_id = '" . $id . "'";
            mysqli_query($con, $update) or die(mysqli_error());
            $emailstat = "Email Updated Successfully.<br>";
        } else if (isset($_POST['new']) && $_POST['new'] == 'security') {
        } else if (isset($_POST['new']) && $_POST['new'] == 'picture') {
            $target_dir = "uploads/avatars/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $dpstat = "File is an image - " . $check["mime"] . ".<br>";
                $uploadOk = 1;
            } else {
                $dpstat .= "File is not an image. <br>";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 128000000) {
                $dpstat .= "Sorry, your file is too large. File size must be less than 128gb! <br>";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $dpstat .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed. <br>";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $dpstat .= "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $dpstat .= "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded. <br>";
                    $updatePIC = "UPDATE users SET prof_pic = 'uploads/avatars/" . basename($_FILES["fileToUpload"]["name"]) . "' WHERE users.user_id = '" . $id . "'";
                    mysqli_query($con, $updatePIC);
                } else {
                    $dpstat .= "Sorry, there was an error uploading your file. <br>";
                }
            }
        }
        ?>
        <div class="w3-container">
            <div class="w3-card">
                <h1>Edit Profile</h1>
                <form name="form" method="post" action="">
                    <input type="hidden" name="new" value="details" />
                    <input name="user" type="hidden" value="<?php echo $profile; ?>" />
                    <p>Profile Name: <input type="text" name="name" placeholder="Display Name" value="<?php echo $row['display_name']; ?>" /></p>
                    <p>Your Bio: <input type="text" name="bio" placeholder="Bio" value="<?php echo $row['prof_bio']; ?>" /></p>
                    <p><button name="submit" type="submit">Update details</button></p>
                    <p><?php echo $detstat; ?></p>
                </form>
            </div><br>
            <div class="w3-card">
                <h1>Profile picture</h1>
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="new" value="picture" />
                    Select image to upload:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <p><button type="submit" value="Upload Image">Upload Image</button></p>
                    <p><?php echo $dpstat; ?></p>
                </form>
            </div><br>
            <div class="w3-card">
                <h1>Account Access</h1>
                <form name="form" method="post" action="">
                    <input type="hidden" name="new" value="access" />
                    <input name="id" type="hidden" value="<?php echo $profile; ?>" />
                    <p>Email: <input type="text" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" /></p>
                    <p><button name="submit" type="submit">Change Email</button></p>
                    <p><?php echo $emailstat; ?></p>
                </form>
            </div><br>
            <div class="w3-card">
                <h1>Account Password</h1>
                <form name="form" method="post" action="">
                    <input type="hidden" name="new" value="security" />
                    <p>Password: <input type="text" name="pass1" placeholder="New Password" /></p>
                    <p>Confirm Password: <input type="text" name="pass2" placeholder="Confilrm Password" /></p>
                    <p><button name="submit" type="submit">Update password</button></p>
                    <p><?php echo $passstat; ?></p>
                </form>
            </div> <br>
        </div><!-- w3-container -->
    </div>
</body>

</html>