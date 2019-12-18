<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/authController.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/config/dyn_db.php';
	
	$searchKeyword = "";
	$names = array();
	$projName = "";
	$date = "";
	$time = "";
	$finalStudents = array();
	$errors_1 = array();
	$errors_2 = array();
	
	if(isset($_POST['searchNames'])){
		if(!empty($_POST['studentNameSearch'])){
			$searchKeyword = $_POST['studentNameSearch'];
			$type = 0;
			$searchKeyword .= "%";
			$lastNameQuery = "SELECT * FROM users WHERE lastName LIKE ? AND type=?";
			$statement = $connection->prepare($lastNameQuery);
			$statement->bind_param('si', $searchKeyword, $type);
			$statement->execute();
			$result = $statement->get_result();
			while($row = mysqli_fetch_array($result, MYSQLI_NUM))
			{
				$names += [$row[1] . " " . $row[2] => $row[3]];
			}
			if(count($names) == 0){
				$errors_1['none_found'] = "No results found.";
			}	
		}		
		else{
			$errors_1['no_search_key'] = "No search key was entered.";
		}
	}		
	
	if(isset($_POST['submitSurvey'])){
		//validation
		if(isset($_POST['proj_name'])){
			$projName = $_POST['proj_name'];
			if(empty($projName)){
				$errors_2['empty_projName'] = 'The project needs a name...';
			}
			if(strpos($projName, "-") !== false){
				$errors_2['has_dash'] = 'Please remove the dash from the project name.';
			}				
		}

		if(isset($_POST['date'])){
			$date = $_POST['date'];
			if(empty($date)){
				$errors_2['empty_date'] = 'The project needs a deadline...';
			}
			else if($date < date("Y-m-d")){
				$errors_2['future_date'] = "Please select a future date for the deadline.";
			}
		}
		
		if(file_exists('text files/' . $_SESSION['token'] . '_current_students.txt') === false){
			$errors_2['no_students'] = 'No students were added to the project...';
		}
		else{
			$file_content = file_get_contents('text files/' . $_SESSION['token'] . '_current_students.txt');
			$finalStudentsTemp = explode("\n", $file_content);
			foreach($finalStudentsTemp as $student){
				if($student != ""){
					$finalStudents += [substr($student, 0, strpos($student, ".")) => substr($student, strpos($student, ".") + 1)];
				}	
			}
			if(count($finalStudents) < 6){
				$errors_2['not_enough'] = "To administer a survey, please add at least six students.";
			}	
		}	
		
		//insert table into the survey_tables db
		if(count($errors_2) === 0){
			$backend_projName = $projName . "-" . $_SESSION['email'] . "-" . $_SESSION['surveys_created'];

			//create table in survey_tables 
			$sql_4 = "CREATE TABLE `$backend_projName`(
			id INT(11) NOT NULL AUTO_INCREMENT,
			PRIMARY KEY(id),
			firstName VARCHAR(50) NOT NULL, 
			lastName VARCHAR(75) NOT NULL, 
			itFunction VARCHAR(100) NOT NULL, 
			preferredProj INT(2) NOT NULL, 
			camp_distance VARCHAR(50) NOT NULL, 
			monAv VARCHAR(3) NOT NULL, 
			tueAv VARCHAR(3) NOT NULL, 
			wedAv VARCHAR(3) NOT NULL, 
			thuAv VARCHAR(3) NOT NULL, 
			friAv VARCHAR(3) NOT NULL, 
			satAv VARCHAR(3) NOT NULL, 
			sunAv VARCHAR(3) NOT NULL, 
			collabMethod VARCHAR(50) NOT NULL,
			score INT(3) NOT NULL,
			groupNum INT(2) NOT NULL,
			email VARCHAR(200))";
			mysqli_query($connection_2, $sql_4);
			
			//default variables in array for initial insert query
			$defaults = array("Programming", 0, "<5", "No", "Synchronous");
			
			//insert students into newly created table
			foreach($finalStudents as $name => $email){
				//print_r($finalStudents);
				$first_name = substr($name, 0, strpos($name, " "));
				$last_name = substr($name, strpos($name, " ") + 1);
				$sql_5 = "INSERT INTO `$backend_projName` (firstName, lastName, itFunction, preferredProj, camp_distance, monAv, tueAv, wedAv, thuAv, friAv, satAv, sunAv, collabMethod, score, groupNum, email) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$statement_insert_new = $connection_2->prepare($sql_5);
				$statement_insert_new->bind_param('sssisssssssssiis', $first_name, $last_name,  $defaults[0], $defaults[1], $defaults[2], $defaults[3], $defaults[3], $defaults[3], $defaults[3], $defaults[3], $defaults[3], $defaults[3], $defaults[4], $defaults[1], $defaults[1], $email);
				$statement_insert_new->execute();
			}

			//increment login's survey_created column by 1
			$_SESSION['surveys_created'] = $_SESSION['surveys_created'] + 1;
			$sql_1 = "UPDATE users SET surveysCreated=? WHERE token=? LIMIT 1";
			$statement = $connection->prepare($sql_1);
			$statement->bind_param('is', $_SESSION['surveys_created'], $_SESSION['token']);
			$statement->execute();
			
			//insert deadline and survey side project name into survey_deadlines tables
			$sql_2 = "INSERT INTO survey_deadlines (surveyName, deadline) VALUES (?, ?)";
			$statement = $connection->prepare($sql_2);
			$statement->bind_param('ss', $backend_projName, $date);
			$statement->execute();
			
			//insert into pending_surveys the backend_projName and emails
			$sql_3 = "INSERT INTO pending_surveys (surveyName, email) VALUES (?, ?)";
			$statement = $connection->prepare($sql_3);
			$statement->bind_param('ss', $backend_projName, $_SESSION['email']);
			$statement->execute();
			foreach($finalStudents as $name => $email){
				$statement = $connection->prepare($sql_3);
				$statement->bind_param('ss', $backend_projName, $email);
				$statement->execute();
			}	
			
			//set necessary session variables
			$_SESSION['projName'] = $projName;	
			
			//last thing
			unlink('text files/' . $_SESSION['token'] . '_current_students.txt');
			header("location: survey_submitted_message.php?survey_name=$projName");
			exit();
		}
	}

	if(isset($_POST['survey_stu_submit'])){
		$itFunction = "";
		$prefProject = "";
		$campusDistance = "";
		$monAv = $_POST['monday_av'];
		$tueAv = $_POST['tuesday_av'];
		$wedAv = $_POST['wednesday_av'];
		$thuAv = $_POST['thursday_av'];
		$friAv = $_POST['friday_av'];
		$satAv = $_POST['saturday_av'];
		$sunAv = $_POST['sunday_av'];
		$collabMethod = $_POST['collab_type'];
		
		//validation
		if($_POST['it_function'] != "no_select"){
			$itFunction = $_POST['it_function'];
		}
		else{
			$errors['no_function'] = "Please select an IT Function";
		}
		if($_POST['preferred_project'] != "no_select"){
			$prefProject = $_POST['preferred_project'];
		}
		else{
			$errors['no_project'] = "Please select your preferred project";
		}
		if($_POST['campus_distance'] != "no_select"){
			$campusDistance = $_POST['campus_distance'];
		}
		else{
			$errors['no_distance'] = "Please select your distance in minutes from campus";
		}
		
		if(count($errors) === 0){
			$survey_name = $_GET['survey_name'];
			$survey_name_alone = substr($survey_name, 0, strpos($survey_name, "-"));
			//move the data into necessary row of the login's email in that particular survey_table
			$updateQuery = "UPDATE `$survey_name` SET itFunction=?, preferredProj=?, camp_distance=?, monAv=?, tueAv=?, wedAv=?, thuAv=?, friAv=?, satAv=?, sunAv=?, collabMethod=? WHERE email=?";
			$statement = $connection_2->prepare($updateQuery);
			$statement->bind_param('ssssssssssss', $itFunction, $prefProject, $campusDistance, $monAv, $tueAv, $wedAv, $thuAv, $friAv, $satAv, $sunAv, $collabMethod, $_SESSION['email']);
			if($statement->execute()){
				header("location: survey_submitted_message.php?survey_name=$survey_name_alone");
				exit();
			}
			else{
				echo "There was an error submitting your answers.";
			}
		}	
	}	
?>