<?php 
session_start();
?>
<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
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
     <h1><a href="index.php"  class="links"></a></h1>
    </li>
  </ul>
  
  <section class="top-bar-section">
    <ul class="right">
     
      <li>
        <a href="logout.php" class="links">Logout</a>
      </li>
     
      </ul>
  </section>
  
  <section class="top-bar-section">
    <ul class="left">
     
      <li>
        <a href="retailerproducts.php" class="links">Products</a>
      </li>
	  <li>
        <a href="retaileradditem.php" class="links">Add Products</a>
      </li>
     
      </ul>
  </section>

  
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
	
	
	<hr />
	
	<div class="row">
		
		
		<div class="large-12 columns">
		
			<div class="panel" align="center" width="600px">
				<h2>Welcome <?php echo $_SESSION["RETAILER"] ?></h2>
				<h6>Your RetailerID is:<?php echo $_SESSION["RETAILERID"] ?> </h4>
				<h6>Your MarketID is:<?php echo $_SESSION["MARKETID"] ?> </h4>
				<h6>You Can Manage Your Inventory From Here. </h4>
								
				 
			</div>
			
		</div>
			
<hr/>		
		
	</div>
			<table width="600px" border="0" cellspacing="0" cellpadding="10" align="center">
			<tr>
				<td width="25%" valign="top">
					ItemID<br/>	
				</td>
				<td width="25%" valign="top">
					Quantity<br/>	
				</td>
				<td width="25%" valign="top">
					Unit<br/>	
				</td>
				
			</tr>


<?php 
$dynamicList = "";

// Connect to the SQLSRV database  
include "scripts/connect_to_sqlsrv.php"; 

	$retailerid = $_SESSION['RETAILERID'];
	$marketid = $_SESSION['MARKETID'];
	$sql = "SELECT * FROM dbo.RetailerStock WHERE RetailerID='$retailerid' and MarketID='$marketid'";
	$query = sqlsrv_query($conn, $sql);		
	if ($query === false){  
		exit("<pre>".print_r(sqlsrv_errors(), true));
	}	
	$itemCount = sqlsrv_has_rows($query); // count the output amount
	if ($itemCount > 0) {
	while($row = sqlsrv_fetch_array($query)){ ?>
            <tr>
				<td width="25%" valign="top">
					<?php echo $row["ItemID"] ?><br/>	
				</td>
				<td width="25%" valign="top">
					<?php echo $row["Quantity"] ?><br/>	
				</td>
				<td width="25%" valign="top">
					<?php echo $row["Unit"] ?><br/>	
				</td>
				<td width="25%" valign="top">
					<a href="retaileredit.php?productid=<?php echo $row["ItemID"] ?>">Edit</a><br/>	
				</td>
				
			</tr>
<?php
    }
}
?>		
			
			
					
				
			<table>
	
	
	

	
	<script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
	  
    </script>
  </body>
</html>
