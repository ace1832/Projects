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
	
	<div class="row" align="center">
		
		
		<div class="large-12 columns">
		
			<div class="panel" align="center">
				
				<h2>Welcome <?php echo $_SESSION["RETAILER"] ?></h2>
				<h6>Your RetailerID is:<?php echo $_SESSION["RETAILERID"] ?> </h4>
				<h6>Your MarketID is:<?php echo $_SESSION["MARKETID"] ?> </h4>
				<h6>You Can Manage Your Inventory From Here. </h4>
								
				 
			</div>
			
		</div>
			
		
		
	</div>
	
	
	

	
	<script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
	  
    </script>
  </body>
</html>
