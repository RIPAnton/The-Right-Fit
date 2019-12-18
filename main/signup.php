<!doctype html>

<!--
HTML for singup page
Created by: Chance Belloise
signup.html - v0.1, October 2019
Copyright © 2019 soyScripters
-->

<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/authController.php';
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>The Right Fit - Signup</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/signup_stylesheet.css">
	</head>
<body>
	<div class="sidebar">
			<img src="styles/sidebar.png" type="sidebar" alt="" align="top">
			<img src="styles/usflogo.png" type="usflogo" alt="" align="top">
	</div>
	<h1>The Right Fit</h1><br>
	<h2>Academic Group Matcher</h2>
		<?php 
		if(count($errors) > 0){
			foreach($errors as $error){
				echo "<li style='list-style-type:none; margin-left: 15px;'><strong style='color: red;'>" . $error . "*</strong></li><br>";
			}	
		}	
	?>
	<div class="signup">
		<form action="signup.php" method="POST">
			<input id="student-radio" type="radio" name="signup-type" value="Student">
			<label for="student-radio">Student</label>
			<input id="admin-radio" type="radio" name="signup-type" value="Admin">
			<label for="admin-radio">Admin</label><br>
			<input type="email" name="email" placeholder="email" value="<?php echo $email; unset($email);?>"><br>
			<input type="text" name="first_name" placeholder="first name" class="name" value="<?php echo $firstName; unset($firstName); ?>">
			<input type="text" name="last_name" placeholder="last name" class="name" value="<?php echo $lastName; unset($lastName);?>"><br>
			<input type="password" name="password" placeholder="password"><br>
			<input type="password" name="password_2" placeholder="confirm password"><br>
			<input type="submit" name="create_acct_btn" value="Create Account">
			<a href="login.php"><u>Already registered?</u></a>
		</form>
	</div>
</body>
<footer>
	<p align="center">Copyright © 2019 soyScripters<br>
	Chance Belloise, Manuel Dejesus, Ariel Morillo<br>
	All rights reserved.</p> 
</footer>
</html>
