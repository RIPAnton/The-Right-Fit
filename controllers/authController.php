<?php
	session_start();
	
	require $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/config/db.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/emailController.php';

	$errors = array();
	$firstName = "";
	$lastName = "";
	$email = "";
	$symbolsAndNumbers = "!@#$%^&*()_+{}|:<>?~-=[];'\",./`0123456789 ";
	
	//if user clicks on the sign up student button
	if((isset($_POST['signup-type']) && $_POST['signup-type'] == "Student") && isset($_POST['create_acct_btn'])){
		$firstName = $_POST['first_name'];
		$lastName = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password_2 = $_POST['password_2'];
		
		//validation
		if(empty($firstName)){
			$errors['firstName'] = "First name required";
		}
		else{
			$firstNameChars = str_split($firstName);
			foreach($firstNameChars as $firstChar){
				if(strpos($symbolsAndNumbers, $firstChar) !== false){
					$errors['firstName'] = "Valid first name required";
				}
			}	
		}	
			
		if(empty($lastName)){
			$errors['lastName'] = "Last name required";
		}
		else{
			$lastNameChars = str_split($lastName);
			foreach($lastNameChars as $lastChar){
				if(strpos($symbolsAndNumbers, $lastChar) !== false){
					$errors['lastName'] = "Valid last name required";
				}
			}	
		}
		
		if(empty($email)){
			$errors['email'] = "E-mail required";
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = "Invalid E-mail";
		}
		
		if(empty($password)){
			$errors['password'] = "Password required";
		}
		else if(strlen($password) < 7 || preg_match("#\W+#", $password) != true || preg_match("#[0-9]+#", $password) != true){
			$errors['pass_specs'] = "Password needs to be at least 7 characters long, contain a special character and a number";
		}	
		else if($password != $password_2){
			$errors['password'] = "The two passwords do not match";
		}

		$emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
		$statement = $connection->prepare($emailQuery);
		$statement->bind_param('s', $email);
		$statement->execute();
		$result = $statement->get_result();
		$userCount = $result->num_rows;
		
		if($userCount > 0){
			$errors['email'] = "Email already exists";
		}

		//check errors
		if(count($errors) === 0){	
			$password = password_hash($password, PASSWORD_DEFAULT);
			$token = bin2hex(random_bytes(50));
			$verified = false;
			
			$sql = "INSERT INTO users (firstName, lastName, email, verified, token, password) VALUE (?, ?, ?, ?, ?, ?)";
			$statement = $connection->prepare($sql);
			
			$statement->bind_param('sssdss', $firstName, $lastName, $email, $verified, $token, $password);
			
			if($statement->execute()){
				/*register user
				$user_id = $connection->insert_id;
				$_SESSION['id'] = $user_id;
				$_SESSION['token'] = $token;
				$_SESSION['first_name'] = $firstName;
				$_SESSION['last_name'] = $lastName;
				$_SESSION['email'] = $email;
				$_SESSION['verified'] = $verified;
				$_SESSION['type'] = 0;*/
				
				sendVerificationEmail($email, $token);
				
				/*set flash messages*/
				$_SESSION['message'] = "A verification email was sent to " . $email . ". You can login, but content won't be visible until your account is verified.";
				header('location: login.php');
				exit();
			}
			else{
				$errors['db_error'] = "Database error: Failed to register";
			}	
		}
	}
	
	//if user clicks on the sign up admin button	
	else if((isset($_POST['signup-type']) && $_POST['signup-type'] == "Admin") && isset($_POST['create_acct_btn'])){
		$firstName = $_POST['first_name'];
		$lastName = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password_2 = $_POST['password_2'];
		
		//validation
		if(empty($firstName)){
			$errors['firstName'] = "First name required";
		}
		else{
			$firstNameChars = str_split($firstName);
			foreach($firstNameChars as $firstChar){
				if(strpos($symbolsAndNumbers, $firstChar) !== false){
					$errors['firstName'] = "Valid first name required";
				}
			}	
		}	
			
		if(empty($lastName)){
			$errors['lastName'] = "Last name required";
		}
		else{
			$lastNameChars = str_split($lastName);
			foreach($lastNameChars as $lastChar){
				if(strpos($symbolsAndNumbers, $lastChar) !== false){
					$errors['lastName'] = "Valid last name required";
				}
			}	
		}
		
		if(empty($email)){
			$errors['email'] = "E-mail required";
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = "Invalid E-mail";
		}
		else{
			$adminCheckPage = file_get_contents('https://www.usf.edu/engineering/cse/people/index.aspx');
			if(strpos($adminCheckPage, $email) === false){
				$errors['notAdmin'] = "Please enter a valid admin email address";
			}	
		}	
		
		if(empty($password)){
			$errors['password'] = "Password required";
		}
		else if(strlen($password) < 7 || preg_match("#\W+#", $password) != true || preg_match("#[0-9]+#", $password) != true){
			$errors['pass_specs'] = "Password needs to be at least 7 characters long, contain a special character and a number";
		}
		else if($password != $password_2){
			$errors['password'] = "The two passwords do not match";
		}

		$emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
		$statement = $connection->prepare($emailQuery);
		$statement->bind_param('s', $email);
		$statement->execute();
		$result = $statement->get_result();
		$userCount = $result->num_rows;
		
		if($userCount > 0){
			$errors['email'] = "Email already exists";
		}

		//check errors
		if(count($errors) === 0){	
			$password = password_hash($password, PASSWORD_DEFAULT);
			$token = bin2hex(random_bytes(50));
			$verified = true;
			$surveysMade = 0;
			
			$sql = "INSERT INTO users (firstName, lastName, email, verified, token, password, surveysCreated) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$statement = $connection->prepare($sql);
			
			$statement->bind_param('sssdsss', $firstName, $lastName, $email, $verified, $token, $password, $surveysMade);
			
			if($statement->execute()){
				/*register user
				$user_id = $connection->insert_id;
				$_SESSION['id'] = $user_id;
				$_SESSION['token'] = $token;
				$_SESSION['first_name'] = $firstName;
				$_SESSION['last_name'] = $lastName;
				$_SESSION['email'] = $email;
				$_SESSION['verified'] = $verified;
				//set flash messages*/
				$_SESSION['message'] = "A verification email was sent to " . $email . ". You can login, but content won't be visible until your account is verified.";
				header('location: login.php');
				exit();
			}
			else{
				$errors['db_error'] = "Database error: Failed to register";
			}	
		}
	}

	else if(isset($_POST['create_acct_btn']) && !isset($_POST['signup-type'])){
		$errors['noType'] = "Please select to create either a student account or an admin account";
		$firstName = $_POST['first_name'];
		$lastName = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password_2 = $_POST['password_2'];
	}	

	//if user clicks login button
	if(isset($_POST['login-btn'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		//validation
		if(empty($email)){
			$errors['email'] = "E-mail required";
		}
		
		if(empty($password)){
			$errors['password'] = "Password required";
		}
		
		if(count($errors) === 0){
			
			$sql = "SELECT * FROM users WHERE email=?";
			$statement = $connection->prepare($sql);
			
			$statement->bind_param('s', $email);
			$statement->execute();
			$result = $statement->get_result();
			$user = $result->fetch_assoc();
			
			if(password_verify($password, $user['password'])){
				//login success
				$_SESSION['id'] = $user['id'];
				$_SESSION['token'] = $user['token'];
				$_SESSION['first_name'] = $user['firstName'];
				$_SESSION['last_name'] = $user['lastName'];
				$_SESSION['email'] = $user['email'];
				$_SESSION['verified'] = $user['verified'];
				$_SESSION['type'] = $user['type'];
				if($_SESSION['type'] == 1){
					$_SESSION['surveys_created'] = $user['surveysCreated'];
				}	
				//set flash messages
				//$_SESSION['message'] = "You are now logged in!";
				header('location: index.php');
				exit();
			}	
			else{
				$errors['login_fail'] = "Incorrect email or password";
			}
		}
	}
	
	//logout user
	if(isset($_GET['logout'])){
		session_destroy();
		unset($SESSION['id']);
		unset($SESSION['first_name']);
		unset($SESSION['last_name']);
		unset($SESSION['verified']);
		unset($_SESSION['token']);
		unset($_SESSION['email']);
		unset($_SESSION['type']);
		header('location: login.php');
		exit();
	}

	//if user clicks on the forgot password button
	if(isset($_POST['forgot-password'])){
		$email = $_POST['email'];
		if(empty($email)){
			$errors['email'] = "E-mail required";
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = "Invalid E-mail";
		}
		
		if(count($errors) == 0){
			$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
			$result = mysqli_query($connection, $sql);
			$user = mysqli_fetch_assoc($result);
			$token = $user['token'];
			sendPasswordResetLink($email, $token);
			
			//$_SESSION['reset_email'] = $email;
			$_SESSION['pass_re_message'] = "An email has been sent to " . $email . " with a link to reset your password.";
			header('Location: login.php');
			exit();
		}	
	}
	
	//if user clicked on the reset password button
	if(isset($_POST['reset-password'])){
		$password = $_POST['password'];
		$passwordConf = $_POST['passwordConf'];
		
		if(empty($password)){
			$errors['password'] = "Password required";
		}
		else if(strlen($password) < 7 || preg_match("#\W+#", $password) != true || preg_match("#[0-9]+#", $password) != true){
			$errors['pass_specs'] = "Password needs to be at least 7 characters long, contain a special character and a number";
		}
		else if($password != $passwordConf){
			$errors['password'] = "The two passwords do not match";
		}
		
		$password = password_hash($password, PASSWORD_DEFAULT);
		$email = $_SESSION['email'];
		
		if(count($errors) == 0){
			$sql = "UPDATE users SET password='$password' WHERE email='$email'";
			$result = mysqli_query($connection, $sql);
			if($result){
				header("Location: password_reset_message.php");
				exit();
			}	
		}	
	}	
	
	function verifyUser($token){
		global $connection;
		$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
		$result = mysqli_query($connection, $sql);
		
		if(mysqli_num_rows($result) > 0){
			$update_query = "UPDATE users SET verified=true WHERE token='$token'";
			$update_query_result = mysqli_query($connection, $update_query);
			$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
			$result = mysqli_query($connection, $sql);
			$user = mysqli_fetch_assoc($result);
			if($update_query_result){
				$_SESSION['id'] = $user['id'];
				$_SESSION['first_name'] = $user['firstName'];
				$_SESSION['type'] = $user['type'];
				$_SESSION['verified'] = $user['verified'];
				//set flash messages
				$_SESSION['message'] = "Your email address was successfully verified!";
				header('location: login.php');
				exit();
			}	
		}
		else{
			echo 'User not found...';
		}	
	}

	function resetPassword($token){
		global $connection;
		$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
		$result = mysqli_query($connection, $sql);
		$user = mysqli_fetch_assoc($result);
		$_SESSION['email'] = $user['email'];
		header('Location: reset_password.php');
		exit();	
	}	
?>