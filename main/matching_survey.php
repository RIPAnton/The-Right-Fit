<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/dashController.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/surveyController.php';

	$wholeSurveyTableName = $_GET['survey_name'];
?>

<html>
	<head>
		<title>Matching Survey</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/matchingSurveyStyle.css">
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
		<?php $survey_name_alone = substr($_GET['survey_name'], 0, strpos($_GET['survey_name'], "-")); ?>
		<div class="greeting">
			<h1>Fill this survey out to match with compatible students for the "<?php echo $survey_name_alone; ?> project"</h1>
			<br>
			<h2>Deadline: <?php echo $pendingSurveys_student_deadlines[$wholeSurveyTableName]; ?></h2>
			<?php 
				if(!empty($errors)){
					foreach($errors as $error){
						echo "<strong style='color:red;'>" . $error . "*</strong><br>";
						unset($error);
					}	
				}	
			?>
		</div>
		<form action="matching_survey.php?survey_name=<?php echo $_GET['survey_name']; ?>" method="POST">
			<div class="oddContainer">
				<label for="it_function"><h3>What is your strongest IT function?</h3></label><br>
				<select name="it_function">
					<option value="no_select">Please Select</option>
					<option value="Programming">Programming/Coding</option>
					<option value="CyberSec">CyberSecurity</option>
					<option value="WebDesign">Web Development</option>
					<option value="Networks">Networking</option>
				</select>
			</div>
			<div class="evenContainer">
				<label for="preferred_project"><h3>Preferred Project</h3></label><br>
				<select name="preferred_project">
					<option value="no_select">Please Select</option>
					<option value="1">Project 1</option>
					<option value="2">Project 2</option>
					<option value="3">Project 3</option>
					<option value="4">Project 4</option>
					<option value="5">Project 5</option>
					<option value="6">Project 6</option>
					<option value="7">Project 7</option>
					<option value="8">Project 8</option>
					<option value="9">Project 9</option>
					<option value="10">Project 10</option>
					<option value="0">Other</option>
				</select>
			</div>
			<div class="oddContainer">
				<label for="campus_distance"><h3>Distance from Campus</h3></label><br>
				<select name="campus_distance">
					<option value="no_select">Please Select</option>
					<option value="<5"> &lt;5 minutes </option>
					<option value="15">15 minutes</option>
					<option value="30">30 minutes</option>
					<option value="45">45 minutes</option>
					<option value="60">60&gt;</option>
				</select>
			</div>
			<div class="evenContainer">
				<h3>Availability (<em>Please select those days you are available for at least 3 hours</em>)</h3>
				<label for="monday_av">Monday</label><br>
				<input type="radio" name="monday_av" value="Yes">Available
				<input type="radio" name="monday_av" value="No" checked>Not Available<br><br>
				<label for="tuesday_av">Tuesday</label><br>
				<input type="radio" name="tuesday_av" value="Yes">Available
				<input type="radio" name="tuesday_av" value="No" checked>Not Available<br><br>
				<label for="wednesday_av">Wednesday</label><br>
				<input type="radio" name="wednesday_av" value="Yes">Available
				<input type="radio" name="wednesday_av" value="No" checked>Not Available<br><br>
				<label for="thursday_av">Thursday</label><br>
				<input type="radio" name="thursday_av" value="Yes">Available
				<input type="radio" name="thursday_av" value="No" checked>Not Available<br><br>
				<label for="friday_av">Friday</label><br>
				<input type="radio" name="friday_av" value="Yes">Available
				<input type="radio" name="friday_av" value="No" checked>Not Available<br><br>
				<label for="saturday_av">Saturday</label><br>
				<input type="radio" name="saturday_av" value="Yes">Available
				<input type="radio" name="saturday_av" value="No" checked>Not Available<br><br>
				<label for="sunday_av">Sunday</label><br>
				<input type="radio" name="sunday_av" value="Yes">Available
				<input type="radio" name="sunday_av" value="No" checked>Not Available<br>
			</div>
			<div class="oddContainer" id="lastInputs">
				<label for="collab_type"><h3>Choose your preferred collaboration method</h3></label><br>
				<input type="radio" name="collab_type" value="Synchronous" checked>Synchronous
				<input type="radio" name="collab_type" value="Asynchronous">Asynchronous<br><br><br>
				<button class="btn btn-primary" type="reset" name="reset_survey_stu">Reset Survey</button>
				<button class="btn btn-primary" type="submit" name="survey_stu_submit">Submit Survey</button>
			</div>	
		</form>
		<footer>Copyright © 2019 soyScripters</footer>
	</body>
</html>