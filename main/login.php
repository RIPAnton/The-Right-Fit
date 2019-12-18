<!doctype html>

<!--
HTML for login/index page
Created by: Chance Belloise
login.html - v0.1, October 2019
Copyright © 2019 soyScripters
-->

<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/authController.php';
	
	if(isset($_GET['token'])){
		$token = $_GET['token'];
		verifyUser($token);
	}	
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>The Right Fit</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/login_stylesheet.css">
	</head>
<body>
	<div class="sidebar">
			<img src="styles/sidebar.png" type="sidebar" alt="" align="top">
			<img src="styles/usflogo.png" type="usflogo" alt="" align="top">
	</div>
	<h1>The Right Fit</h1><br>
	<h2>Academic Group Matcher</h2>
	<div><?php 
			if(isset($_SESSION['pass_re_message'])){
				echo "<strong style='margin-left: 15px; color: rgb(161, 161, 93);'>".$_SESSION['pass_re_message']."</strong>"; 
				unset($_SESSION['pass_re_message']);
			}
			else if(isset($_SESSION['message'])){
				echo "<strong style='margin-left: 15px; color: rgb(161, 161, 93);'>".$_SESSION['message']."</strong>"; 
				unset($_SESSION['message']);
			}
	?></div>
	<?php 
		if(count($errors) > 0){
			foreach($errors as $error){
				echo "<li style='list-style-type:none; margin-left: 15px;'><strong style='color: red;'>" . $error . "*</strong></li><br>";
			}	
		}	
	?>
	<div class="login">
		<form action="login.php" method="post">
			<input type="text" name="email" placeholder="email" value="<?php echo $email; unset($email);?>"><br>
			<input type="password" name="password" placeholder="password">
			<input type="submit" name="login-btn" value="Login">
			<a href="signup.php"><u>New? Sign up»</u></a>
			<a href="forgot_password.php"><u>Forgot your password?</u></a>
		</form>
	</div>
</body>
<footer>
	<p align="center">Copyright © 2019 soyScripters<br>
	Chance Belloise, Manuel Dejesus, Ariel Morillo<br>
	All rights reserved.</p> 
</footer>
</html>
