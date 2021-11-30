<?php
	$server = "rafi\SQLEXPRESS";
	$options = array(  "UID" => "sa",  "PWD" => "p@ssword13",  "Database" => "php_test");

	$conn = sqlsrv_connect($server, $options);

	if ($conn === false) 
	die("<pre>".print_r(sqlsrv_errors(), true));

	//echo "Successfully connected!";

	
?>