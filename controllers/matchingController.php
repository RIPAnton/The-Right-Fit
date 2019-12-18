<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/config/db.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/config/dyn_db.php';
	
	//vars
	$studentList = array();
	$groupList = array();
	
	//get the current date
	$currentDate = date("Y-m-d");
	
	//return list of surveys that have deadline of today or yesterday from survey_deadline
	$deadlineQuery = "SELECT * FROM survey_deadlines WHERE deadline<=?";
	$statement = $connection->prepare($deadlineQuery);
	$statement->bind_param('s', $currentDate);
	$statement->execute();
	$result = $statement->get_result();
	
	if($result){
		//foreach result, go into that survey on the survey_tables db and add their rows into the structure seen below
		while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			$surveyName = $row[1];
			echo $surveyName;
			$surveyGrabQuery = "SELECT * FROM `$surveyName`";
			$statement_1 = $connection_2->prepare($surveyGrabQuery);
			$statement_1->execute();
			$result_1 = $statement_1->get_result();
			while($row_1 = mysqli_fetch_array($result_1, MYSQLI_NUM)){
				//remove id cell
				array_splice($row_1, 0, 1);
				
				//merge first and second elements into one variable
				$fullName = $row_1[0] . " " . $row_1[1];
				
				//set fullName to $row_1[0] and delete the $row_1[1] element 
				$row_1[0] = $fullName;
				array_splice($row_1, 1, 1);
				
				//remove email
				//array_splice($row_1, 1, 1);
				
				//make the 5th element of the array an array of elements $row_1[4] - $row_1[10] and delete those elements
				$daysAv = array();
				array_push($daysAv, $row_1[4], $row_1[5], $row_1[6], $row_1[7], $row_1[8], $row_1[9], $row_1[10]);
				$row_1[5] = $daysAv;
				array_splice($row_1, 6, 5);
				
				//remove the last element
				array_splice($row_1, 8, 1);
				
				//make the fourth element the 6th one and delete the 6th element
				$row_1[4] = $row_1[6];
				array_splice($row_1, 6, 1);
				
				//add the row to studentList
				array_push($studentList, $row_1);
				
				//print_r($row_1);
			}
	
			//reset dicts
			$Dict = array();
			$emailDict = array();
	
			//run the algorithm for studentList
			groupalgo($studentList);
			dictCreate($groupList);
			
			//reset lists
			$studentList = array();
			$groupList = array();
			
			//get the instructor and push to $emailDict
			$adminEmail = substr($surveyName, strpos($surveyName, "-") + 1);
			$adminEmail = substr($adminEmail, 0, strpos($adminEmail, "-"));
			array_push($emailDict, $adminEmail);
			
			//print_r($groupList);
			print_r($Dict);
			print_r($emailDict);
			
			//update the survey table(at groupNum) with the output list of groups
			foreach($Dict as $key => $value){
				if(gettype($key) == "integer"){
					$emailOI = $emailDict[$key];
					$groupNumOI = $Dict[$value];
					
					//update sql
					$surveyUpdateQuery = "UPDATE `$surveyName` SET groupNum = ? WHERE email = ?";
					$statement_2 = $connection_2->prepare($surveyUpdateQuery);
					$statement_2->bind_param('is', $groupNumOI, $emailOI);
					$statement_2->execute();
				}		
			}	
			
			//remove the survey from survey_deadlines 
			$surveyRemoveQuery = "DELETE FROM survey_deadlines WHERE surveyName=?";
			$statement_3 = $connection->prepare($surveyRemoveQuery);
			$statement_3->bind_param('s', $surveyName);
			$statement_3->execute();
			
			//remove the survey from pending surveys
			$surveyRemoveQuery = "DELETE FROM pending_surveys WHERE surveyName=?";
			$statement_3 = $connection->prepare($surveyRemoveQuery);
			$statement_3->bind_param('s', $surveyName);
			$statement_3->execute();
			
			//add survey to finished_surveys
			foreach($emailDict as $i => $email){
				$surveyRemoveQuery = "INSERT INTO finished_surveys (surveyName, email) VALUES (?, ?)";
				$statement_3 = $connection->prepare($surveyRemoveQuery);
				$statement_3->bind_param('ss', $surveyName, $email);
				$statement_3->execute();
			}//*/
		}
	}	
	
	//function that contains algo for grouping students
	function groupalgo($studentList){
		global $groupList;
		///Length provides us with how many students are in the list
		$length = sizeof($studentList);
		///groupCount will give us the total amount of groups
		$groupCount = ceil($length/3);
		///studentCounter will increment as we progress through each individual student'''
		$studentCounter = 0;
		///elementCounter will increment as we progress through each individual element and then start back at 0 when a new student is reached '''
		$elementCounter = 0;
		///score is the compatibility score for student groups'''
		$score = 0;
		//echo($groupCount);
		while ($studentCounter < $length -1){
			$studentCounter+=1;
			$elementCounter = 1;
			$score = 0;
			
			///Checks to see if students have same IT Function/Skill''' 
			if ($studentList[0][$elementCounter] == $studentList[$studentCounter][$elementCounter]){
				//echo("Same Skill");
			}
			else{
				$score+=2;
			}
			$elementCounter+=1;
			
			
			///Checks to see if students have same project Preference
			if ($studentList[0][$elementCounter] == $studentList[$studentCounter][$elementCounter]){
				$score+=2;
			}
			else{
				//echo("Not matching project");
			}
			$elementCounter+=1;
			
			///Checks to see if students have similar distance from campus
			///revise this section for distance and project type
			if ($studentList[0][$elementCounter] == $studentList[$studentCounter][$elementCounter]){
				$score+=1;
			}
			else if ($studentList[0][$elementCounter] == "<5" or $studentList[0][$elementCounter] == "15" or $studentList[0][$elementCounter] == "30" and $studentList[$studentCounter][$elementCounter] == "<5" or $studentList[$studentCounter][$elementCounter] == "15" or $studentList[$studentCounter][$elementCounter] == "30"){
				$score+=1;
			}
			else if ($studentList[0][$elementCounter] == "30" or $studentList[0][$elementCounter] == "45" or $studentList[0][$elementCounter] == "60" and $studentList[$studentCounter][$elementCounter] == "30" or $studentList[$studentCounter][$elementCounter] == "45" or $studentList[$studentCounter][$elementCounter] == "60"){
				$score+=1;
			}
			else{
				//echo("too much of a time difference");
			}
			$elementCounter+=1;
			
			
			///Checks to see if students have same collaboration Preference     
			if ($studentList[0][$elementCounter] == $studentList[$studentCounter][$elementCounter]){
				$score+=1;
			}
			else{    
				//echo("different collab methods");
			}
			$elementCounter+=1;
			
			
			///Checks to see if students have compatible days to work together
			$availabilityCounter = 0;
			$availabilityScore = 0;
			while ($availabilityCounter < 7){
				if ($studentList[0][$elementCounter][$availabilityCounter] == $studentList[$studentCounter][$elementCounter][$availabilityCounter]){
					$availabilityScore+=1;
				}
				$availabilityCounter+=1;
			}
			if ($availabilityScore >= 3){
				$score+=1;
			}
			
		
			$studentList[$studentCounter][6] = $score;
		}
		//echo "made it to pop part";
		//print_r($studentList);
		
		
		///sequence that will break off students into grouplist
		//$groupLength = sizeof($groupList);
		while ($length > 2){
			$scoreDecrementCounter = 7;
			$popCounter = 1;
			while ($scoreDecrementCounter > 0){
				$studentCounter = 1;
				while ($studentCounter < $length){
					//echo("here we go again");
					//echo strval($studentList[$studentCounter][6]);
					if ($studentList[$studentCounter][6] == $scoreDecrementCounter){
						array_push($groupList, $studentList[$studentCounter]);
						$studentList[$studentCounter][6] = strval($studentList[$studentCounter][6]);
						array_splice($studentList,$studentCounter,1);
						//echo("im poppin off");
						$length = sizeof($studentList);
						$popCounter+=1;
					}
					if ($popCounter > 2){
						array_push($groupList, $studentList[0]);
						array_splice($studentList,0,1);
						//echo("im poppin off ^^^^^^");
						$length = sizeof($studentList);
						break;
					}
					$studentCounter+=1;
				}
				if ($popCounter > 2){
					break;
				}
				else{
					$scoreDecrementCounter-=1;
				}
			}        
		} 
		$length = sizeof($studentList);
		//echo($length); 
		if ($length == 2){
			array_push($groupList, $studentList[0]);
			array_splice($studentList,0,1);
			array_push($groupList, $studentList[0]);
			array_splice($studentList,0,1);
		}    
		if ($length == 1){
			array_push($groupList, $studentList[0]);
			array_splice($studentList,0,1);
		}
		$groupLength = sizeof($groupList);
		//print_r ($studentList);
		//print_r ($groupList);
		//echo ($groupCount);
		//echo ($groupLength);
	}
	
	//function that creates dictionary from grouplist
	function dictCreate($groupList){
		global $Dict;
		global $emailDict;
		$groupLengthDict = sizeof($groupList);
		$loopCounter = 0;
		$groupCounter = 1;
		$groupIncCounter = 0;
		if ($groupLengthDict % 3 != 0){
			if ($groupLengthDict % 3 == 1){
				while ($loopCounter < $groupLengthDict){
					if ($groupList[$loopCounter][0] == $groupList[0][0] or $groupList[$loopCounter][0] == $groupList[1][0] or $groupList[$loopCounter][0] == $groupList[2][0] or $groupList[$loopCounter][0] == $groupList[3][0]){
						array_push($Dict, $groupList[$loopCounter][0]);
						$Dict[$groupList[$loopCounter][0]] = 1;
						$groupIncCounter += 1;
						if ($groupIncCounter == 4){
							$groupIncCounter = 0;
							$groupCounter += 1;
						}
					}
					else{
						array_push($Dict, $groupList[$loopCounter][0]);
						//print_r($Dict[$groupCounter]);
						$Dict[$groupList[$loopCounter][0]] = $groupCounter;
						$groupIncCounter += 1;
						if ($groupIncCounter == 3){
							$groupCounter += 1;
							$groupIncCounter = 0;
						}
					}
					$loopCounter += 1;
				}
			}
			if ($groupLengthDict % 3 == 2){
				while ($loopCounter < $groupLengthDict){
					if ($groupList[$loopCounter][0] == $groupList[0][0] or $groupList[$loopCounter][0] == $groupList[1][0] or $groupList[$loopCounter][0] == $groupList[2][0] or $groupList[$loopCounter][0] == $groupList[3][0]){
						array_push($Dict, $groupList[$loopCounter][0]);
						$Dict[$groupList[$loopCounter][0]] = 1;
						$groupIncCounter += 1;
						if ($groupIncCounter == 4){
							$groupIncCounter = 0;
							$groupCounter += 1;
						}
					}
					else if ($loopCounter == $groupLengthDict - 4 or $loopCounter == $groupLengthDict - 3 or $loopCounter == $groupLengthDict - 2 or $loopCounter == $groupLengthDict - 1){
						array_push($Dict, $groupList[$loopCounter][0]);
						$Dict[$groupList[$loopCounter][0]] = $groupCounter;
						$groupIncCounter += 1;
						if ($groupIncCounter == 4){
							$groupIncCounter = 0; 
							$groupCounter += 1;
						}
					}
					else{
						array_push($Dict, $groupList[$loopCounter][0]);
						$Dict[$groupList[$loopCounter][0]] = $groupCounter;
						$groupIncCounter += 1;
						if ($groupIncCounter == 3){
							$groupCounter += 1;
							$groupIncCounter = 0;
						}
					}
					$loopCounter += 1;
				}
			}
		}
		else{
			while ($loopCounter < $groupLengthDict){
				array_push($Dict, $groupList[$loopCounter][0]);
				$Dict[$groupList[$loopCounter][0]] = $groupCounter;
				array_push($emailDict, $groupList[$loopCounter][7]);
				$groupIncCounter += 1;
				if ($groupIncCounter == 3){
					$groupCounter += 1;
					$groupIncCounter = 0;
				}
				$loopCounter += 1; 
			}
		}
		$GLOBALS['Dict'] = $Dict;
		$GLOBALS['emailDict'] = $emailDict;
	}

	/* ALGORITHM BELOW WITH EXAMPLE LIST
	//Required elements: Name, Strongest IT Function, Project Preference, Distance From Campus,
	//Asynchonous vs Synchronus Collaboration, Hours of Availability(Yes/No), Score

	
	$studentList = array(array("Jon Snow","Databases","1", "<5","Asynchronous",array("No","Yes","Yes","No","No","Yes","Yes"),0, "mjdknights14@gmail.com"),
	array("Eren Yeager","Programming","2", "15","Synchronous",array("Yes","Yes","No","Yes","No","No","Yes"),0 , "mjdknights14@gmail.com"),
	array("OP Man","CyberSec","0", "45","Asynchronous",array("Yes","Yes","Yes","No","No","Yes","No"),0 , "mjdknights14@gmail.com"),
	array("Kibutsuji Muzan","Programming","3", "<5","Asynchronous",array("No","Yes","No","Yes","No","Yes","Yes"),0 , "mjdknights14@gmail.com"),
	array("Manny DeJesus","Databases","3", "15","Synchronous",array("No","Yes","No","Yes","No","Yes","Yes"),0 , "mjdknights14@gmail.com"),
	array("Ariel Morillo","Programming","3", "<5","Asynchronous",array("No","Yes","No","Yes","No","Yes","Yes"),0 , "mjdknights14@gmail.com"));


	//echo(sizeof($studentList) % 3);
	$groupList = array();
	$Dict = array();

	///function that contains algo for grouping students
	function groupalgo($studentList){
		global $groupList;
		///Length provides us with how many students are in the list
		$length = sizeof($studentList);
		///groupCount will give us the total amount of groups
		$groupCount = ceil($length/3);
		///studentCounter will increment as we progress through each individual student'''
		$studentCounter = 0;
		///elementCounter will increment as we progress through each individual element and then start back at 0 when a new student is reached '''
		$elementCounter = 0;
		///score is the compatibility score for student groups'''
		$score = 0;
		//echo($groupCount);
		while ($studentCounter < $length -1){
			$studentCounter+=1;
			$elementCounter = 1;
			$score = 0;
			
			///Checks to see if students have same IT Function/Skill''' 
			if ($studentList[0][$elementCounter] == $studentList[$studentCounter][$elementCounter]){
				//echo("Same Skill");
			}
			else{
				$score+=2;
			}
			$elementCounter+=1;
			
			
			///Checks to see if students have same project Preference
			if ($studentList[0][$elementCounter] == $studentList[$studentCounter][$elementCounter]){
				$score+=2;
			}
			else{
				//echo("Not matching project");
			}
			$elementCounter+=1;
			
			///Checks to see if students have similar distance from campus
			///revise this section for distance and project type
			if ($studentList[0][$elementCounter] == $studentList[$studentCounter][$elementCounter]){
				$score+=1;
			}
			else if ($studentList[0][$elementCounter] == "<5" or $studentList[0][$elementCounter] == "15" or $studentList[0][$elementCounter] == "30" and $studentList[$studentCounter][$elementCounter] == "<5" or $studentList[$studentCounter][$elementCounter] == "15" or $studentList[$studentCounter][$elementCounter] == "30"){
				$score+=1;
			}
			else if ($studentList[0][$elementCounter] == "30" or $studentList[0][$elementCounter] == "45" or $studentList[0][$elementCounter] == "60" and $studentList[$studentCounter][$elementCounter] == "30" or $studentList[$studentCounter][$elementCounter] == "45" or $studentList[$studentCounter][$elementCounter] == "60"){
				$score+=1;
			}
			else{
				//echo("too much of a time difference");
			}
			$elementCounter+=1;
			
			
			///Checks to see if students have same collaboration Preference     
			if ($studentList[0][$elementCounter] == $studentList[$studentCounter][$elementCounter]){
				$score+=1;
			}
			else{    
				//echo("different collab methods");
			}
			$elementCounter+=1;
			
			
			///Checks to see if students have compatible days to work together
			$availabilityCounter = 0;
			$availabilityScore = 0;
			while ($availabilityCounter < 7){
				if ($studentList[0][$elementCounter][$availabilityCounter] == $studentList[$studentCounter][$elementCounter][$availabilityCounter]){
					$availabilityScore+=1;
				}
				$availabilityCounter+=1;
			}
			if ($availabilityScore >= 3){
				$score+=1;
			}
			
		
			$studentList[$studentCounter][6] = $score;
		}
		//echo "made it to pop part";
		//print_r($studentList);
		
		
		///sequence that will break off students into grouplist
		//$groupLength = sizeof($groupList);
		while ($length > 2){
			$scoreDecrementCounter = 7;
			$popCounter = 1;
			while ($scoreDecrementCounter > 0){
				$studentCounter = 1;
				while ($studentCounter < $length){
					//echo("here we go again");
					//echo strval($studentList[$studentCounter][6]);
					if ($studentList[$studentCounter][6] == $scoreDecrementCounter){
						array_push($groupList, $studentList[$studentCounter]);
						$studentList[$studentCounter][6] = strval($studentList[$studentCounter][6]);
						array_splice($studentList,$studentCounter,1);
						//echo("im poppin off");
						$length = sizeof($studentList);
						$popCounter+=1;
					}
					if ($popCounter > 2){
						array_push($groupList, $studentList[0]);
						array_splice($studentList,0,1);
						//echo("im poppin off ^^^^^^");
						$length = sizeof($studentList);
						break;
					}
					$studentCounter+=1;
				}
				if ($popCounter > 2){
					break;
				}
				else{
					$scoreDecrementCounter-=1;
				}
			}        
		} 
		$length = sizeof($studentList);
		//echo($length); 
		if ($length == 2){
			array_push($groupList, $studentList[0]);
			array_splice($studentList,0,1);
			array_push($groupList, $studentList[0]);
			array_splice($studentList,0,1);
		}    
		if ($length == 1){
			array_push($groupList, $studentList[0]);
			array_splice($studentList,0,1);
		}
		$groupLength = sizeof($groupList);
		//print_r ($studentList);
		//print_r ($groupList);
		//echo ($groupCount);
		//echo ($groupLength);
	}
	///function that creates dictionary from grouplist
	function dictCreate($groupList){
		global $Dict;
		$groupLengthDict = sizeof($groupList);
		$loopCounter = 0;
		$groupCounter = 1;
		$groupIncCounter = 0;
		if ($groupLengthDict % 3 != 0){
			if ($groupLengthDict % 3 == 1){
				while ($loopCounter < $groupLengthDict){
					if ($groupList[$loopCounter][0] == $groupList[0][0] or $groupList[$loopCounter][0] == $groupList[1][0] or $groupList[$loopCounter][0] == $groupList[2][0] or $groupList[$loopCounter][0] == $groupList[3][0]){
						array_push($Dict, $groupList[$loopCounter][0]);
						$Dict[$groupList[$loopCounter][0]] = 1;
						$groupIncCounter += 1;
						if ($groupIncCounter == 4){
							$groupIncCounter = 0;
							$groupCounter += 1;
						}
					}
					else{
						array_push($Dict, $groupList[$loopCounter][0]);
						//print_r($Dict[$groupCounter]);
						$Dict[$groupList[$loopCounter][0]] = $groupCounter;
						$groupIncCounter += 1;
						if ($groupIncCounter == 3){
							$groupCounter += 1;
							$groupIncCounter = 0;
						}
					}
					$loopCounter += 1;
				}
			}
			if ($groupLengthDict % 3 == 2){
				while ($loopCounter < $groupLengthDict){
					if ($groupList[$loopCounter][0] == $groupList[0][0] or $groupList[$loopCounter][0] == $groupList[1][0] or $groupList[$loopCounter][0] == $groupList[2][0] or $groupList[$loopCounter][0] == $groupList[3][0]){
						array_push($Dict, $groupList[$loopCounter][0]);
						$Dict[$groupList[$loopCounter][0]] = 1;
						$groupIncCounter += 1;
						if ($groupIncCounter == 4){
							$groupIncCounter = 0;
							$groupCounter += 1;
						}
					}
					else if ($loopCounter == $groupLengthDict - 4 or $loopCounter == $groupLengthDict - 3 or $loopCounter == $groupLengthDict - 2 or $loopCounter == $groupLengthDict - 1){
						array_push($Dict, $groupList[$loopCounter][0]);
						$Dict[$groupList[$loopCounter][0]] = $groupCounter;
						$groupIncCounter += 1;
						if ($groupIncCounter == 4){
							$groupIncCounter = 0; 
							$groupCounter += 1;
						}
					}
					else{
						array_push($Dict, $groupList[$loopCounter][0]);
						$Dict[$groupList[$loopCounter][0]] = $groupCounter;
						$groupIncCounter += 1;
						if ($groupIncCounter == 3){
							$groupCounter += 1;
							$groupIncCounter = 0;
						}
					}
					$loopCounter += 1;
				}
			}
		}
		else{
			while ($loopCounter < $groupLengthDict){
				array_push($Dict, $groupList[$loopCounter][0]);
				$Dict[$groupList[$loopCounter][0]] = $groupCounter;
				$groupIncCounter += 1;
				if ($groupIncCounter == 3){
					$groupCounter += 1;
					$groupIncCounter = 0;
				}
				$loopCounter += 1; 
			}
		}
	}    
	groupalgo($studentList);
	dictCreate($groupList);
	//print_r($groupList);
	print_r($Dict);
	*/
?>