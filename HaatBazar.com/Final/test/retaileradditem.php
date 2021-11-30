<?php 
session_start();
?>
<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php

//$itemid = $_GET['productid'];


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
		
			<div class="panel">
		
				<h6>Add Item for MarketID <?php echo $_SESSION["MARKETID"] ?> </h6>
				<h6>Add Item for RetailerID <?php echo $_SESSION["RETAILERID"] ?> </h6>
								
				 
				
				 
			</div>
			
		</div>
			
		
		
	</div>
	
	
	<form action="add.php" method="post">
				<div class="row">
				
					<div class="large-6 columns">
						
						<label>Item ID
							<input type="text" name = "itemid" placeholder="Enter Item ID"/>
						</label>
						
						<label>Quantity
							<input type="text" name = "quantity" placeholder="Enter Quantity"/>
						</label>
						
						<label>Unit
							<input type="text" name = "unit" placeholder="Enter Unit"/>
						</label>
						
						<input type="submit" value="Submit">
					</div>
				</div>
			</form>
	

	
	<script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
	  
    </script>
  </body>
</html>
