<?php
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/dashController.php';
	
	$wholeSurveyTableName = $_GET['survey_name'];
	$surveyNameOnly = substr($_GET['survey_name'], 0, strpos($_GET['survey_name'], "-"));
?>

<html>
	<head>
		<title>Survey's Still Out!</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/surveyPendingStyle.css">
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
		<h1>The survey for "<?php echo $surveyNameOnly; ?>" is still out...</h1>
		<div class="container" id="surveyInfo">
			<div class="row">
				<div class="col-sm-6" id="deadlineInfo">
					<h2>Deadline:</h2>
					<p><?php echo $pendingSurveys_admin_deadlines[$wholeSurveyTableName]; ?></p>
				</div>
				<div class="col-sm-6" id="studentsInfo">
					<h2>Students Involved:</h2>
					<div id="studentsList">
						<?php foreach($pendingSurveys_admin_students[$wholeSurveyTableName] as $index => $name): ?>
						<p><?php echo $name; ?></p>
						<?php endforeach; ?>
					</div>	
				</div>	
			</div>	
		</div>	
		<footer>Copyright © 2019 soyScripters</footer>
	</body>
</html>