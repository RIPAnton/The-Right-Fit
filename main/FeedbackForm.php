<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/The Right Fit/controllers/feedbackController.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Feedback</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/feedbackform_stylesheet.css">
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
			<h1>The Right Fit</h1>
			<h2>Feedback Page</h2>
			<?php 
				if(!empty($errors_feedback)){
					foreach($errors_feedback as $error){
						echo "<strong style='color:red;'>" . $error . "*</strong><br>";
						unset($error);
					}
				}
				else if(isset($submissionSuccess)){
					echo "<strong style='color:pink;'>" . $submissionSuccess . "</strong><br>";
					unset($submissionSuccess);
				}
			?>	
		</div>	
		<div class="feedback">
			<div class="justify-content-md-center container">
              <form action="FeedbackForm.php" method="post">
                  <label for="rate">Rate your experience:</label><br>
                  <input type="radio" name="rate" value="1"> 1 (Terrible)
                  <input type="radio" name="rate" value="2"> 2 (Bad)
                  <input type="radio" name="rate" value="3"> 3 (Okay)
                  <input type="radio" name="rate" value="4"> 4 (Good)
                  <input type="radio" name="rate" value="5"> 5 (Great)<br>
                  <br><label for="feedback">Feedback <em>(Max characters: 400)</em></label><br>
                  <textarea maxlength="400" id="feedback" name="subject"><?php echo $subject; ?></textarea><br>
                  <input type="submit" value="Submit" name="feedback_submit">
             </form>
		   </div>
		</div>
		<footer>Copyright © 2019 soyScripters</footer>
	</body>
</html>