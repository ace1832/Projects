<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>


<?php
if (isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["username"]) && 
	isset($_GET["marketid"]) && isset($_GET["pinnumber"]) && isset($_GET["phoneno"]) && isset($_GET["password"]) ) {
	echo 'success';
}
?>