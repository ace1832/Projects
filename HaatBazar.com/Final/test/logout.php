<?php
	session_start();
	session_destroy();
	header("location: ../test/index.php"); 
	exit;
?>