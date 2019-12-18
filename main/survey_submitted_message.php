<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/surveyController.php';
	if(!isset($_SESSION['id'])){
		header('location: login.php');
	}
	
	
?>

<html>
	<?php if($_SESSION['type'] == 1): ?>
	<head>
		<title>Survey Administered</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/surveySubmittedStyle.css">
	</head>
	<body>
		<nav class="navbar navbar-expand-md bg-dark navbar-dark" id="nav">
			<a class="navbar-brand" href="index.php">TRF <img src="styles/usflogo.png" type="usflogo" alt="" width="48" height="40"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="FeedbackForm.php">Feedback</a></li>
					<li class="nav-item"><a class="nav-link" href="index.php?logout=1" id="logout">Logout</a></li>
				</ul>
			</div>
		</nav>
		<div class="mainBody">
			<h1>Your survey for <?php echo "\"" . $_GET['survey_name'] . "\""; ?> was successfully administered.</h1>
		</div>	
		<footer>Copyright © 2019 soyScripters</footer>
	</body>
	<?php else: ?>
	<head>
		<title>Survey Submitted</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/surveySubmittedStyle.css">
	</head>
	<body>
		<nav class="navbar navbar-expand-md bg-dark navbar-dark" id="nav">
			<a class="navbar-brand" href="index.php">TRF <img src="styles/usflogo.png" type="usflogo" alt="" width="48" height="40"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="FeedbackForm.html">Feedback</a></li>
					<li class="nav-item"><a class="nav-link" href="index.php?logout=1" id="logout">Logout</a></li>
				</ul>
			</div>
		</nav>
		<div class="mainBody">
			<h1>You submitted your survey answers for <?php echo "\"" . $_GET['survey_name'] . "\""; ?> successfully.</h1>
			<h2>You can change your answers up until the survey deadline.</h2>
		</div>
		<footer>Copyright © 2019 soyScripters</footer>
	</body>
	<?php endif; ?>
</html>