<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/authController.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/config/dyn_db.php';
	
	$pendingSurveys_admin_display = array();
	$pendingSurveys_admin_students = array();
	$pendingSurveys_admin_deadlines = array();
	
	$pendingSurveys_student_display = array();
	$pendingSurveys_student_deadlines = array();
	
	$finishedSurveys_admin = array();//needs to be key value with project name and an array of array of student's row
	$finishedSurveys_student = array();//needs to be an associative array with the project_name as the key and an array of students in login's group
		
	//check if login is an admin has any rows in pending_surveys or finished_surveys
	if($_SESSION['type'] == 1){
		$loginEmail = $_SESSION['email'];
		$pendingQuery = "SELECT * FROM pending_surveys WHERE email=?";
		$statement = $connection->prepare($pendingQuery);
		$statement->bind_param('s', $loginEmail);
		$statement->execute();
		$result = $statement->get_result();
		
		if($result){
			while($survey_row = mysqli_fetch_array($result, MYSQLI_NUM)){
				array_push($pendingSurveys_admin_display, $survey_row[1]);
			}	
		}
		
		//loop through each found pending survey and create new assoc array: surveyName => array(students involved)
		foreach($pendingSurveys_admin_display as $i => $surveyName){
			$pendingSurveys_admin_students[$surveyName] = array();
			$pendingStudentsQuery = "SELECT firstName, lastName FROM `$surveyName`";
			$statement_1 = $connection_2->prepare($pendingStudentsQuery);
			$statement_1->execute();
			$result_1 = $statement_1->get_result();
			if($result_1){
				while($names = mysqli_fetch_array($result_1, MYSQLI_NUM)){
					array_push($pendingSurveys_admin_students[$surveyName], $names[0] . " " . $names[1]);
				}	
			}
		}	
		
		//loop through found pending surveys and create new assoc array: surveyName => deadline
		foreach($pendingSurveys_admin_display as $i => $surveyName){
			//$pendingSurveys_admin_deadlines += [$row[1] . " " . $row[2] => $row[3]];
			$pendingDeadlinesQuery = "SELECT deadline FROM survey_deadlines WHERE surveyName=?";
			$statement_2 = $connection->prepare($pendingDeadlinesQuery);
			$statement_2->bind_param('s', $surveyName);
			$statement_2->execute();
			$result_2 = $statement_2->get_result();
			if($result_2){
				while($deadlines = mysqli_fetch_array($result_2, MYSQLI_NUM)){
					$pendingSurveys_admin_deadlines += [$surveyName => $deadlines[0]];
				}	
			}
		}
		
		//check for their finished surveys involvement
		$finishedQuery = "SELECT * FROM finished_surveys WHERE email=?";
		$statement = $connection->prepare($finishedQuery);
		$statement->bind_param('s', $loginEmail);
		$statement->execute();
		$result = $statement->get_result();
		
		//display all groups
		if($result){
			while($survey_row = mysqli_fetch_array($result, MYSQLI_NUM)){
				//array_push($finishedSurveys_admin, $survey_row[1]);
				$current_row_survey = $survey_row[1];
				$finishedSurveys_admin[$current_row_survey] = array();
				
				//get all users tied to that project
				$group_grab_sql = "SELECT firstName, lastName, email, groupNum FROM `$current_row_survey` ORDER BY groupNum ASC";
				$statement = $connection_2->prepare($group_grab_sql);
				$statement->execute();
				$result_groups = $statement->get_result();
				
				while($row = mysqli_fetch_array($result_groups, MYSQLI_NUM)){
					array_push($finishedSurveys_admin[$current_row_survey], $row[0] . " " . $row[1] . "." . $row[2] . "-" . $row[3]);
				}	
			}	
		}
	}
	
	//check if login is an admin has any rows in pending_surveys or finished_surveys
	else if($_SESSION['type'] == 0){
		$loginEmail = $_SESSION['email'];
		$pendingQuery = "SELECT * FROM pending_surveys WHERE email=?";
		$statement = $connection->prepare($pendingQuery);
		$statement->bind_param('s', $loginEmail);
		$statement->execute();
		$result = $statement->get_result();
		
		if($result){
			while($survey_row = mysqli_fetch_array($result, MYSQLI_NUM)){
				array_push($pendingSurveys_student_display, $survey_row[1]);
			}	
		}
		
		//loop through found pending surveys and create new assoc array: surveyName => deadline
		foreach($pendingSurveys_student_display as $i => $surveyName){
			//$pendingSurveys_admin_deadlines += [$row[1] . " " . $row[2] => $row[3]];
			$pendingDeadlinesQuery = "SELECT deadline FROM survey_deadlines WHERE surveyName=?";
			$statement_2 = $connection->prepare($pendingDeadlinesQuery);
			$statement_2->bind_param('s', $surveyName);
			$statement_2->execute();
			$result_2 = $statement_2->get_result();
			if($result_2){
				while($deadlines = mysqli_fetch_array($result_2, MYSQLI_NUM)){
					$pendingSurveys_student_deadlines += [$surveyName => $deadlines[0]];
				}	
			}
		}
		
		//check for their involvement in finished surveys
		$finishedQuery = "SELECT * FROM finished_surveys WHERE email=?";
		$statement = $connection->prepare($finishedQuery);
		$statement->bind_param('s', $loginEmail);
		$statement->execute();
		$result = $statement->get_result();
		
		//here display only the student's group - will require another search
		if($result){
			while($survey_row = mysqli_fetch_array($result, MYSQLI_NUM)){
				//array_push($finishedSurveys_student, $survey_row[1]);
				$current_row_survey = $survey_row[1];
				$finishedSurveys_student[$current_row_survey] = array();
				
				//select the user's groupNum
				$group_check_sql = "SELECT groupNum FROM `$current_row_survey` WHERE email=? LIMIT 1";
				$statement = $connection_2->prepare($group_check_sql);
				$statement->bind_param('s', $loginEmail);
				$statement->execute();
				$result_groupNum = $statement->get_result();
				$user = $result_groupNum->fetch_assoc();
				
				//get all users with that group num
				$group_num_oi = $user['groupNum'];
				$group_collect_sql = "SELECT * FROM `$current_row_survey` WHERE groupNum=?";
				$statement = $connection_2->prepare($group_collect_sql);
				$statement->bind_param('s', $group_num_oi);
				$statement->execute();
				$result_group = $statement->get_result();
				array_push($finishedSurveys_student[$current_row_survey], $group_num_oi);
				
				while($row = mysqli_fetch_array($result_group, MYSQLI_NUM)){
					array_push($finishedSurveys_student[$current_row_survey], $row[1] . " " . $row[2] . "." . $row[16]);
				}	
			}	
		}
	}	
	
?>