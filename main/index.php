<?php
 
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/authController.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/dashController.php';
	
	if(isset($_GET['token'])){
		$token = $_GET['token'];
		verifyUser($token);
	}		
	
	if(isset($_GET['password-token'])){
		$passwordToken = $_GET['password-token'];
		resetPassword($passwordToken);
	}
	
	if(!isset($_SESSION['id'])){
		header('location: login.php');
	}	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Home</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/dash_style.css">
	</head>
	<body>
		<?php 
		
				if(isset($_SESSION['message'])){
					echo "<div><strong style='margin-left: 15px;'>". $_SESSION['message'] ."</strong></div>"; 
					unset($_SESSION['message']);
				}	
		?>
		<nav class="navbar navbar-expand-md bg-dark navbar-dark" id="nav">
			<a class="navbar-brand" href="index.php">TRF <img src="styles/usflogo.png" type="usflogo" alt="" width="48" height="40"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
					<?php if($_SESSION['verified'] == 0): ?>
					<?php else: ?>
					<li class="nav-item"><a class="nav-link" href="FeedbackForm.php">Feedback</a></li>
					<?php endif; ?>
					<li class="nav-item"><a class="nav-link" href="index.php?logout=1" id="logout">Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- <a style="margin-left: 15px;" href="index.php?logout=1">Logout</a>-->
		
		<?php if(!$_SESSION['verified']):?>
		<div style="text-align: center; padding:70px;">You need to verify your account. Sign in to your email account and click on the verification link we emailed you at <strong><?php echo $_SESSION['email']; ?></strong></div>
		<?php endif; ?>
		
		<?php if($_SESSION['verified']):
				//for the admin login
				if($_SESSION['type'] == 1):?>
				<div class="greeting">
					<h1>The Right Fit</h1>
					<h3>Welcome, <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] . " (Admin)"; ?></h3>
				</div>	
				<div class="dash">	
					<div class="pendSur">
						<h2>Pending Surveys</h2><br>
						<?php if(!empty($pendingSurveys_admin_display)):?>
						<?php foreach($pendingSurveys_admin_display as $survey_name): ?>
						<?php $survey_name_alone = substr($survey_name, 0, strpos($survey_name, "-")); ?>
						<p><u><a href="survey_pending.php?survey_name=<?php echo $survey_name; ?>"><?php echo $survey_name_alone; ?></u></a><p>
						<?php endforeach; ?>
						<?php else: ?>
						<p><em>No pending surveys</em></p>
						<?php endif; ?>
					</div>
					<div class="resultSur">
						<h2>Survey Results</h2><br>
						<?php if(!empty($finishedSurveys_admin)):?>
						<?php //print_r($finishedSurveys_admin) ?>
						<?php foreach($finishedSurveys_admin as $survey_name => $student_rows): ?>
						<?php $survey_name_alone = substr($survey_name, 0, strpos($survey_name, "-")); ?>
						<p><u><a href="survey_results.php?survey_name=<?php echo $survey_name; ?>"><?php echo $survey_name_alone; ?></u></a><p>
						<?php endforeach; ?>
						<?php else: ?>
						<p><em>No completed surveys</em></p>
						<?php endif; ?>
					</div>
					<div class="createSur">
						<h2>Create a Survey</h2><br>
						<button class="btn btn-primary" id="createButtonLink" onclick="location.href='create-survey.php';">Create a Survey</button>
						<br><br>
					</div>
				</div>
				<?php
				//for the student login
				else: ?>
				<div class="greeting">
					<h1>The Right Fit</h1>
					<h3>Welcome, <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h3>
				</div>	
				<div class="dash">
					<div class="pendSur">
						<h2>Surveys to Submit</h2><br>
						<?php if(!empty($pendingSurveys_student_display)):?>
						<?php foreach($pendingSurveys_student_display as $survey_name): ?>
						<?php $survey_name_alone = substr($survey_name, 0, strpos($survey_name, "-")); ?>
						<p><u><a href="matching_survey.php?survey_name=<?php echo $survey_name; ?>"><?php echo $survey_name_alone; ?></u></a><p>
						<?php endforeach; ?>
						<?php else: ?>
						<p><em>No surveys to submit</em></p>
						<?php endif; ?>
					</div>
					<div class="resultSur">
						<h2>Assigned Teams</h2><br>
						<?php if(!empty($finishedSurveys_student)):?>
						<?php foreach($finishedSurveys_student as $survey_name => $students): ?>
						<?php $survey_name_alone = substr($survey_name, 0, strpos($survey_name, "-")); ?>
						<p><u><a href="survey_results.php?survey_name=<?php echo $survey_name; ?>"><?php echo $survey_name_alone; ?></u></a><p>
						<?php endforeach; ?>
						<?php else: ?>
						<p><em>No assigned teams</em></p>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>	
		<?php endif; ?>
		<footer>Copyright © 2019 soyScripters</footer>
	</body>
</html>