<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/authController.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/surveyController.php';
		
	$count = 0;
	
	if(!isset($_SESSION['id']) || $_SESSION['type'] != 1){
		header('location: login.php');
	}
	
	if(isset($_POST['student_id'])){
		$student_id = $_POST['student_id'];
		$file_path = 'text files/' . $_SESSION['token'] . "_current_students.txt";
		$current = file_get_contents($file_path);
		$current .= $student_id . "\n";
		file_put_contents($file_path, $current);
	
	}
	if(isset($_POST['student_id_remove'])){
		$file_path = 'text files/' . $_SESSION['token'] . "_current_students.txt";
		$file_content = file_get_contents($file_path);
		
		$student_id_remove = $_POST['student_id_remove'] . "\n";
		$file_content = str_replace($student_id_remove, '', $file_content);
		file_put_contents($file_path, $file_content);
		$file_content = file_get_contents($file_path);
		
		if(filesize($file_path) == 0 or $file_content == ""){
			unlink($file_path);
		}		
	}
	
	$token = $_SESSION['token'];
	
	//could get like a current count on page load and then have javascript handle it from there while page hasn't been refreshed
	if(file_exists('text files/' . $_SESSION['token'] . '_current_students.txt')){
		$file_content = file_get_contents('text files/' . $_SESSION['token'] . '_current_students.txt');
		$finalStudentsTemp = explode("\n", $file_content);
		foreach($finalStudentsTemp as $student){
			if($student != ""){
				$count += 1;
			}	
		}
	}	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Create a Project Survey</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Home</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/createSurveyStyle.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
		<script src="scripts/survey.js" type="text/javascript"></script>
		<script>getStudentCount(<?php echo $count; ?>);</script>
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
		<div class="greeting">
			<h1>Create a Project Survey</h1>
			<?php if(count($errors_2)>0): ?>
				<?php foreach($errors_2 as $error): ?>
				<strong style='color:red'><?php echo $error; ?></strong><br>
				<?php unset($error); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="container-fluid">
			<div class="row" id="searchRow">
				<div class="col-sm-6" id="searchDiv">
					<form action="create-survey.php" method="post" id="searchForm">
						<label for="studentNameSearch">Search Students: </label><br>
						<input type="text" name="studentNameSearch" placeholder="Search by last name..."><br>
						<button class="btn btn-primary" type="submit" name="searchNames">Search</button>
					</form><br>
					<?php if(count($names)>0): ?>		
							<!-- <em id="search_results">Search Results:</em><br> -->
								<?php foreach($names as $name => $email): ?>
								<label id="resultLabel" for="<?php echo 'stu_' . $name . '.' . $email; ?>" name="<?php echo 'label_' . $name . '.' . $email; ?>"><?php echo $name . " (" . $email . ")"; ?></label> <button class="btn btn-primary btn-sm" id="<?php echo 'stu_' . $name . '.' . $email; ?>" name="<?php echo 'stu_' . $name . '.' . $email; ?>" 
								<?php 
								if(file_exists('text files/' . $_SESSION['token'] . "_current_students.txt")){
									$currentNames = file_get_contents('text files/' . $_SESSION['token'] . "_current_students.txt");
									if(strpos($currentNames, $name . '.' . $email) !== false){
										echo "disabled";
									}
									else{
										echo 'onclick="add_student(this.id);"';
									}
								}
								else{
									echo 'onclick="add_student(this.id);"';
								}
								?> toy=<?php echo $token; ?>>Add</button><br>
								<?php endforeach; ?>	
							<?php elseif(count($errors_1)>0): ?>
									<?php foreach($errors_1 as $error): ?>
									<em style='color:red'><?php echo $error; ?></em>
									<?php unset($errors_1); ?>
									<?php endforeach; ?>
					<?php endif; ?>	
				</div>
				<div class="col-sm-6" id="studentsInvolvedDiv">
					<h4>Students Involved (<em>Minimum: 6</em>)</h4>
					<ol name="addedNames">
						<?php if(file_exists('text files/' . $_SESSION['token'] . '_current_students.txt')): ?>
						<?php $currentNames = explode("\n", file_get_contents('text files/' . $_SESSION['token'] . "_current_students.txt", FILE_SKIP_EMPTY_LINES));?>
						<?php foreach($currentNames as $name):?>
						<?php if($name == ""):?>
						<?php else: ?>
						<li id="list_<?php echo $name; ?>"><?php echo substr($name, 0, strpos($name, ".")) . " (" . substr($name, strpos($name, ".") + 1) . ")"; ?> <button class="btn btn-primary btn-sm" onclick="remove_student(this.id)" id="remove_<?php echo $name; ?>" toy="<?php echo $token; ?>">x</button></li>
						<?php endif; ?>
						<?php endforeach;?>
						<?php else: ?>
						<em id="list_filler_notice">Students will appear here as you search and add them.</em>
						<?php endif; ?>
						<span id="list_filler_span"></span>
					</ol>
				</div>
			</div>
			<div id="otherInputs" class="row">
				<div class="col-sm-12">
					<form action="create-survey.php" id="survey-create-form" method="post">
						<label for="proj_name">Project Name</label><br>
						<input type="text" name="proj_name" value="<?php echo $projName;?>"><br><br>
						<label for="date">Deadline</label><br>
						<input type="date" name="date" value="<?php echo $date; ?>"><br><em id="surveyNote">(Survey closes at 11:59pm of deadline date)</em><br><br>
						<button class="btn btn-primary" type="submit" name="submitSurvey">Submit Survey</button>
					</form>
				</div>
			</div>
		</div>	
		<footer>Copyright © 2019 soyScripters</footer>
	</body>
</html>