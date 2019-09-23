<?php

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/w3.css" />
<link rel="stylesheet" href="css/style.css" />
</head>
<body class="w3-container">
	<?php
        require('system/db.php');
        session_start();
		$status = "";
		//Login here
        if (isset($_POST['login']) && $_POST['login']=='details'){
            
            $usernameLogin = stripslashes($_REQUEST['usernameLogin']); // removes backslashes
            $usernameLogin = mysqli_real_escape_string($con,$usernameLogin); //escapes special characters in a string
            $passwordLogin = stripslashes($_REQUEST['passwordLogin']);
            $passwordLogin = mysqli_real_escape_string($con,$passwordLogin);
            
       		 //Checking is user existing in the database or not
            $queryLogin = "SELECT * FROM `users` WHERE (username='$usernameLogin' OR email='$usernameLogin') and password='".md5($passwordLogin)."'";
            $resultLogin = mysqli_query($con,$queryLogin) or die(mysqli_error());
            $rowsLogin = mysqli_num_rows($resultLogin);
            if($rowsLogin==1){
				$row = mysqli_fetch_assoc($resultLogin);
				$_SESSION["username"] = $row["username"];
				$_SESSION["display_name"] = $row["display_name"];
                header("Location: index.php"); // Redirect user to index.php
            }
			else{
                $status = "Username/password is incorrect.";
            }
        }
		//Registration here
		else if (isset($_POST['register']) && $_POST['register']=='details'){
			$status = "";
			$usernameRegister = stripslashes($_REQUEST['usernameRegister']);
            $usernameRegister = mysqli_real_escape_string($con,$usernameRegister);
            $emailRegister = stripslashes($_REQUEST['emailRegister']);
            $emailRegister = mysqli_real_escape_string($con,$emailRegister);
            $passwordRegister = stripslashes($_REQUEST['passwordRegister']);
            $passwordRegister = mysqli_real_escape_string($con,$passwordRegister);
			$display_nameRegister = stripslashes($_REQUEST['display_nameRegister']);
    		$display_nameRegister = mysqli_real_escape_string($con,$display_nameRegister);
            $trn_date = date("Y-m-d H:i:s");
            $queryR = "INSERT into `users` (username, password, email, display_name, join_date) ".
								  "VALUES ('$usernameRegister', '".md5($passwordRegister)."', '$emailRegister', '$display_nameRegister', '$trn_date')";
            $resultR = mysqli_query($con,$queryR);
            if($resultR){
				$status = "Account created! You can now <a href='login.php'> login.</a><br>";            
			}
		}
    ?>
	<!-- LOGIN HERE -->
    <div class="w3-container w3-center w3-animate-top">
        <div class="w3-quarter"><br></div>
		<div class="w3-half w3-center">			
			<form action="" method="post" name="login" class="w3-container w3-card-4">
				<p style="color:#FF0000;"><?php echo $status; ?></p>
				<h1>Log In</h1>
				<input type="hidden" name="login" value="details" />
				<input class="w3-input w3-hover-blue" type="text" name="usernameLogin" placeholder="Username or Email" required /><br>
				<input class="w3-input w3-hover-blue" type="password" name="passwordLogin" placeholder="Password" required /><br>
				<input class="w3-input w3-hover-green" name="submit" type="submit" value="Login" /><br>	
				No account? <a href="#" onclick="showOther('register')"> Register here.</a><br>				
			</form>			
		</div>	
		<div class="w3-quarter"><br></div><br><br>		
    </div>
	
	<hr>
	
	<!-- REGISTRATION  HERE -->
	<div class="w3-quarter"><br></div>
	<div id="register" class="w3-hide w3-half w3-animate-top w3-center">
			<form action="" method="post" name="registerForm" class="w3-container w3-card-4">
				<h1>Register</h1>
				<input type="hidden" name="register" value="details" />
				<input class="w3-input w3-hover-blue" type="text" name="usernameRegister" placeholder="Username" required /><br>
				<input class="w3-input w3-hover-blue" type="email" name="emailRegister" placeholder="Email" required /><br>
				<input class="w3-input w3-hover-blue" type="password" name="passwordRegister" placeholder="Password" required /><br>
				<input class="w3-input w3-hover-blue" type="text" name="display_nameRegister" placeholder="Display name" /><br>
				<input class="w3-input w3-hover-green" type="submit" name="submit" value="Register" /><br>
				<p style="color:#FF0000;"><?php echo $status; ?></p>
			</form>
	</div>
	<div class="w3-quarter"><br></div><br><br>
	<script>
		function showOther(id) {
			document.getElementById(id).classList.toggle("w3-show");
		}
	</script>
	

</body>
</html>
