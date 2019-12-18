<?php
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/vendor/autoload.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/config/constants.php';

	// Create the Transport
	$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
	  ->setUsername(EMAIL)
	  ->setPassword(EMAIL_PASS)
	  ;

	// Create the Mailer using your created Transport
	$mailer = new Swift_Mailer($transport);

	function sendVerificationEmail($email, $token){
		global $mailer;
		$body = '<!DOCTYPE html>
				<html>
				<head>
					<meta charset="UTF-8">
					<title>Document</title>
				</head>
				<body>
					<div>
						<p>Thank you for signing up on our website. Please click on the link below to verify your email.</p>
						<a href="http://localhost/The Right Fit/main/login.php?token='. $token . '">Verify your address</a>
					</div>
					
				</body>
			</html>';
		
		$message = (new Swift_Message('Verify your email address'))
		  ->setFrom([EMAIL])
		  ->setTo([$email])
		  ->setBody($body, 'text/html')
		  ;

		// Send the message
		$result = $mailer->send($message);
	}

	function sendPasswordResetLink($email, $token){
		global $mailer;
		$body = '<!DOCTYPE html>
				<html>
				<head>
					<meta charset="UTF-8">
					<title>Document</title>
				</head>
				<body>
					<div>
						<p>
							Hello,
							
							Please click on the link below to reset your password.
						</p>
						<a href="http://localhost/The Right Fit/main/index.php?password-token='. $token . '">Reset your password</a>
					</div>
					
				</body>
			</html>';
		
		$message = (new Swift_Message('Reset your password'))
		  ->setFrom([EMAIL])
		  ->setTo([$email])
		  ->setBody($body, 'text/html')
		  ;

		// Send the message
		$result = $mailer->send($message);
	}	
?>