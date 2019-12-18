<?php 

	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/authController.php';
	
	if(isset($_GET['password-token'])){
		$passwordToken = $_GET['password-token'];
		resetPassword($passwordToken);
	}
	
	/*
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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/resetPasswordStyle.css">
	</head>
	<body>
		<form action="reset_password.php" method="post">
			<h3>Reset Password</h3>
			<?php if(count($errors) >0):?>
			<div>
				<?php foreach($errors as $error): ?>
				<li style="color:red;"><?php echo $error ?></li>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
			
			<label for="password">New Password</label>
			<input type="password" name="password"></br>
			
			<label for="password_2">Confirm Password</label>
			<input type="password" name="passwordConf"></br>
			
			<button class="btn btn-warning" type="submit" name="reset-password">Reset password</button>
			
		</form>
		<footer>Copyright © 2019 soyScripters</footer>
	</body>
</html>