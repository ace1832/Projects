<?php 
session_start();
if (isset($_SESSION["RETAILER"])) {
    header("location: retailerhome.php"); 
    exit();
}
?>
<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["RUserName"]) && isset($_POST["RPassword"])) {

	$username = $_POST["RUserName"]; // filter everything but numbers and letters
    $password = $_POST["RPassword"]; // filter everything but numbers and letters
	
    // Connect to the SQLSVR database  
	include "scripts/connect_to_sqlsrv.php"; 
	
    $sql = "SELECT * FROM dbo.Retailer WHERE RUserName = '$username' AND RPassword = '$password'";
	$query = sqlsrv_query($conn, $sql);
	
	if ($query === false){  
	exit("<pre>".print_r(sqlsrv_errors(), true));
	}
	// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = sqlsrv_has_rows($query); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = sqlsrv_fetch_array($query)){ 
			 
			 $_SESSION["RETAILER"] = $row["RUserName"];
		 	 //$_SESSION["STUDENT"] = $row["UserName"];
		 	 $_SESSION["RETAILERPASS"] = $row["RPassword"];
			 $_SESSION["RETAILERID"] = $row["RetailerID"];
			 $_SESSION["MARKETID"] = $row["MarketID"];
		 }
		 
		 header("location: retailerhome.php");
		 
         exit();
    } else {
		die(header("location: retailerlogin.php?LoginFailed=true&reason=password"));
	}
}
?>


<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HaatBazar.com</title>
	
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
    
	
	
	<nav class="top-bar docs-bar hide-for-small" data-topbar="">
  <ul class="title-area">
    <li class="name">
     <h1><a href="index.php"  class="links">HaatBazar.com</a></h1>
    </li>
  </ul>

  
</nav>
  
  <div class="row" align="center">
		
		<div class="large-12 columns">
		<div class="panel">
		<h1> Welcome to HaatBazar.com
		</h1>
		<p>We give daily price updates of market products</br>We also show the inventory list of retailers in every market!!</p>
		
		</div>
		</div>
	
	</div>
	

  
  <div class="row">
		
	
		<div class="large-4 columns">
		
		</div>
		
		<div class="large-8 columns">
			
			<h3>Retailer Panel</h3>
			<ul class="large-block-grid-6">
			

			<li>
			<a href="#" data-reveal-id="myModal2" class="button [radius round]">Login</a>
			

			<div id="myModal2" class="reveal-modal" data-reveal>
			<h2>Login</h2>
			<form action="retailerlogin.php" method="post">
				<div class="row">
					<div class="large-6 columns">
						<label>Retailer UserName
							<input type="text" name = "RUserName" placeholder="Enter Name" />
						</label>
						<label>Password
							<input type="password" name = "RPassword" placeholder="Enter Password" />
						</label>
						<input type="submit" value="Submit" name="Login">
					</div>
					
				</div>
  
			</form>
			
			
			
			
			
			<a class="close-reveal-modal">&#215;</a>
			</div>
			</li>
			
			<li>
			
			<a href="a.php" class="button">Register</a>
			

			
			</li>
			
		
			</ul>
			
			
		</div>
	
	</div>




	
	<script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
	<script src="js/foundation/foundation.abide.js"></script>
    <script>
      $(document).foundation();
	  
    </script>
  </body>
</html>
