<?php
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/dashController.php';
	
?>

<html>
	<head>
		<title>Survey Results</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/surveyResultsStyle.css">
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
					<li class="nav-item"><a class="nav-link"href="FeedbackForm.php">Feedback</a></li>
					<li class="nav-item"><a class="nav-link" href="index.php?logout=1" id="logout">Logout</a></li>
				</ul>
			</div>
		</nav>
		<?php $survey_name_alone = substr($_GET['survey_name'], 0, strpos($_GET['survey_name'], "-")); ?>
		<h1>The survey for "<?php echo $survey_name_alone; ?>" is complete.</h1>
		<?php if(!empty($finishedSurveys_student[$_GET['survey_name']])): ?>
		<h2>You were assigned to Group <?php echo $finishedSurveys_student[$_GET['survey_name']][0]; ?></h2>
		<div class="container">
			<table class="table table-dark table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($finishedSurveys_student[$_GET['survey_name']] as $index => $student):?>
					<?php if($index != 0 && !strpos($student, $_SESSION['email'])): ?>
					<?php $name = substr($student, 0, strpos($student, ".")); $email = substr($student, strpos($student, ".") + 1); ?>
					<tr><td><?php echo $name; ?></td><td><?php echo $email; ?></td></tr>
					<?php endif;?>
					<?php endforeach; ?>
					<tr><td><em>yourself</em></td><td><?php echo $_SESSION['email']; ?></td></tr>
				</tbody>
			</table>
		</div>	
		<?php elseif(!empty($finishedSurveys_admin[$_GET['survey_name']])): ?>
		<?php
			//print_r($finishedSurveys_admin[$_GET['survey_name']]);
			$parsedFinishedSurveys = array();
			$currentGroupNum = substr($finishedSurveys_admin[$_GET['survey_name']][0], strpos($finishedSurveys_admin[$_GET['survey_name']][0], "-") + 1);
			$parsedFinishedSurveys[$currentGroupNum] = array();
			foreach($finishedSurveys_admin[$_GET['survey_name']] as $index => $student){
				if($currentGroupNum == substr($student, strpos($student, "-") + 1)){
					array_push($parsedFinishedSurveys[$currentGroupNum], substr($student, 0, strpos($student, "-")));
				}
				else{
					$currentGroupNum = substr($student, strpos($student, "-") + 1);
					$parsedFinishedSurveys[$currentGroupNum] = array();
					array_push($parsedFinishedSurveys[$currentGroupNum], substr($student, 0, strpos($student, "-")));
				}	
			}
			//print_r($parsedFinishedSurveys);			
		?>
		<?php foreach($parsedFinishedSurveys as $groupNum => $student): ?>
		<h2>Group <?php echo $groupNum; ?></h2>
		<div class="container">
			<table class="table table-dark table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($parsedFinishedSurveys[$groupNum] as $index => $student): ?>
					<?php $name = substr($student, 0, strpos($student, "."));?>
					<?php $email = substr($student, strpos($student, ".") + 1);?>
					<tr><td><?php echo $name; ?></td><td><?php echo $email; ?></td></tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<br>
		</div>		
		<?php endforeach; ?>	
		<?php endif;?>
		<footer>Copyright © 2019 soyScripters</footer>
	</body>
</html>