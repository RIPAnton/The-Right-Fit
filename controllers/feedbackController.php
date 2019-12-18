<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/authController.php';
	
	$errors_feedback = array();
	$subject = "";
	
	//if user clicks submit on feedback page
	if(isset($_POST['feedback_submit'])){
		//validate inputs
		if(isset($_POST['rate'])){
			$rate = $_POST['rate'];
		}
		else{
			$errors_feedback['no_rate'] = "Please rate your experience";
		}
		if(isset($_POST['subject']) && !empty($_POST['subject'])){
			$subject = $_POST['subject'];
		}
		else{
			$errors_feedback['no_subject'] = "Please fill out the feedback section";
		}
		//if no errors, put the feedback in the table
		if(count($errors_feedback) == 0){
			$name = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
			$email = $_SESSION['email'];
			
			$sql = "INSERT INTO feedback (name, email, experience, feedback) VALUES (?, ?, ?, ?)";
			$statement = $connection->prepare($sql);
			$statement->bind_param('ssis', $name, $email, $rate, $subject);
			$statement->execute();
			
			$submissionSuccess = "Thank you for your feedback submission! We'll potentially use that to improve our system.";
			$subject = "";
		}
	}
?>