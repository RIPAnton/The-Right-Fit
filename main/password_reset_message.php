<?php require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/authController.php';

	/*
	This was commented out across the main files, where applicable, because it would require the user to stay in one browser.
	
	if(!isset($_SESSION['reset_email'])){
		header('location: login.php');
	}*/	

?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Reset Password</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/passwordResetMessageStyle.css">
		
	</head>
	<body>
		<form action="reset_password.php" method="post">
			<h3>Your password was successfully reset.</h3>
		</form>
		<footer>Copyright © 2019 soyScripters</footer>
	</body>
</html>