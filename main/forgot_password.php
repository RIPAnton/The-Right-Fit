<?php require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/authController.php';?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Forgot Password</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/forgotPasswordStyle.css">
	</head>
	<body>
		<form action="forgot_password.php" method="post">
			<h3>Send password reset link</h3>
			<p>Please enter your account email address and we will send you a password reset link.</p>
			<?php if(count($errors) >0):?>
			<div>
				<?php foreach($errors as $error): ?>
				<li><?php echo $error ?></li>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
			
			<input placeholder="Enter your email here..." type="text" name="email" value= "<?php echo $email; ?>">
			<button class="btn btn-warning" type="submit" name="forgot-password">Send reset link</button>
		</form>
		<footer>Copyright © 2019 soyScripters</footer>
	</body>
</html>