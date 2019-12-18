<?php
	require_once 'constants.php';
	$connection_2 = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DYN);
	
	if($connection_2->connect_error){
		die('Database error:' . $connection_2->connect_error);
	}	
?>