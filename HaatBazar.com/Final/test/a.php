<?php
	if(isset($_GET['id'])&& isset($_GET['name']) && isset($_GET['username'])&& isset($_GET['marketid']) && isset($_GET['pinnumber']) && isset($_GET['phoneno']) && isset($_GET['password']) &&
	!empty($_GET['id'])&& !empty($_GET['name']) && !empty($_GET['username'])&& !empty($_GET['marketid']) && !empty($_GET['pinnumber']) && !empty($_GET['phoneno']) && !empty($_GET['password'])){
		echo 'success';
		$name = $_GET['name'];
		$username = $_GET['username'];
		$marketid = $_GET['marketid'];
		$id = $_GET['id'];
		$pin = $_GET['pinnumber']; 
		$phone = $_GET['phoneno'];
		$password = $_GET['password'];
		
		include "scripts/connect_to_sqlsrv.php"; 
		
		$sql = "SELECT * FROM dbo.PinNumber WHERE MarketID='$marketid' and RetailerID='$id' and PinNumber='$pin'";
		$query = sqlsrv_query($conn, $sql);		
		if ($query === false){  
			exit("<pre>".print_r(sqlsrv_errors(), true));
		}	
		$itemCount = sqlsrv_has_rows($query); // count the output amount
		if ($itemCount > 0) {
			//echo 'pin number exists';
			$sql = "INSERT INTO Retailer (RetailerID,MarketID,RetailerName,RUserName,RPassword,RPhoneNo) 
							  VALUES ('$id','$marketid','$name','$username','$password','$phone')";
		
			$query = sqlsrv_query($conn, $sql);				
			if($query){
				echo $msg = "User Created Successfully.";
			}else{
				echo $msg = "Unsuccessfull - Required All";
			}	 
		}
	}
?>

<!doctype html>
<html>
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
		<form action="a.php" method="GET">
				<div class="row">
					<div class="large-6 columns">
						<label>Retailer ID
							<input type="text" name = "id" placeholder="Enter ID" /><br>
						</label>
						
						<label>Retailer Name
							<input type="text" name = "name" placeholder="Enter Name" /><br>
						</label>
						
						<label>Retailer UserName
							<input type="text" name = "username" placeholder="Enter Name" /><br>
						</label>
						
						<label>Market ID
							<input type="text" name = "marketid" placeholder="Market ID" /><br>
						</label>
						<label>Pin ID
							<input type="text" name = "pinnumber" placeholder="Pin ID" /><br>
						</label>
						<label>Phone Number
							<input type="text" name = "phoneno" placeholder="Enter Phn No." /><br>
						</label>
						
						<label>Password
							<input type="password" name = "password" placeholder="Enter Password" /><br>
						</label>
						
						
						<input type="submit" value="Submit">
					</div>
				</div>
  
			</form>
		</body>	
		
		
	<script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
	<script src="js/foundation/foundation.abide.js"></script>
    <script>
      $(document).foundation();
	  
    </script>
</html>			