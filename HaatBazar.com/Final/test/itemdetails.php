<?php

$itemid="";
$msg="";
if (isset($_GET['id'])) {
    $itemid=$_GET['id'];
	$market=$_GET['market'];
	// Connect to the MySQL database  
	include "scripts/connect_to_sqlsrv.php"; 	
	$itemid = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	$sql = "SELECT * FROM dbo.Item WHERE ItemID='$itemid'";
	$query = sqlsrv_query($conn, $sql);		
	if ($query === false){  
		exit("<pre>".print_r(sqlsrv_errors(), true));
	}	
	$itemCount = sqlsrv_has_rows($query); // count the output amount
    if ($itemCount > 0) {
		// get all the product details
		while($row = sqlsrv_fetch_array($query)){ 
             $id = $row["ItemID"];
			 $item_name = $row["ItemName"];
			 $item_prevprice = $row["PrevPrice"];
			 $item_presentprice = $row["PresentPrice"];
			 
         }
		 
	} else {
		echo "That item does not exist.";
	    exit();
	}

} else {
	echo "Data to render this page is missing.";
	exit();
}

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HaatBazar.com</title>
	<link rel="stylesheet" type="text/css" href="mystyle.css">

		
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
	<section class="top-bar-section">
    <ul class="right">
     
      <li>
        <a href="search.php" class="links">Search</a>
      </li>
     
      </ul>
  </section>
  
</nav>
  
  <div class="row" align="center">
		
		<div class="large-12 columns">
		<div class="panel">
		<h1> Welcome to HaatBazar.com
		</h1>
		<p>We give daily price update of market products</br>We also show the inventory list of retailers in every market!!</p>
		</div>
		</div>
	
	</div>

	<hr />
<li><a href="#" data-dropdown="drop1" data-options="align:right">Market List &raquo;</a>
					<ul id="drop1" class="f-dropdown"  data-dropdown-content>
						<?php
						$sql = "SELECT MarketName FROM dbo.Market";
						$query = sqlsrv_query($conn, $sql);

						if ($query === false){  
							exit("<pre>".print_r(sqlsrv_errors(), true));
						}

						$ItemCount = sqlsrv_has_rows($query); // count the output amount
						if ($ItemCount > 0) {
							while($row = sqlsrv_fetch_array($query)){?>
									<li><a href="userhome.php?market=<?php echo $row["MarketName"] ?>"><?php echo $row["MarketName"] ?></a></li>
					<?php	}

						}
						
					?>
					</ul></li>
					<li><a href="#" data-dropdown="drop2"  data-options="align:right">Food Catagory &raquo;</a>
					<ul id="drop2" class="f-dropdown"  data-dropdown-content>
						<?php
						$sql = "SELECT * FROM dbo.Catagory";
						$query = sqlsrv_query($conn, $sql);

						if ($query === false){  
							exit("<pre>".print_r(sqlsrv_errors(), true));
						}

						$ItemCount = sqlsrv_has_rows($query); // count the output amount
						if ($ItemCount > 0) {
							while($row = sqlsrv_fetch_array($query)){?>
									<li><a href="userhome.php?catagoryid=<?php echo $row["CatagoryID"] ?>&market=<?php echo $market?>"><?php echo $catagoryname=$row["CatagoryName"] ?></a></li>
					<?php	
							
							}

						}
						
					?>
					</ul></li>
	<div class="row">
	
		<div class="large-9 columns">
		
			<div class="panel">
				
				 <h4>Market Name::<?php echo $market; ?></h4> 
				 
				 <table width="600px" border="0" cellspacing="0" cellpadding="15" align = "center">
				<tr>
				<td width="19%" valign="top"><a href="inventory_images/<?php echo $id; ?>.jpg"><img src="inventory_images/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $item_name; ?>" /></a><br /></td>
				<td width="81%" valign="top"><h3><?php echo $item_name; ?></h3>
				
					<br/>
				
					<b>Present Price:</b><?php echo $item_presentprice; ?>
					<br/>		
					<b>item id:</b><?php echo $itemid; ?>
					<br/>
					</p>
				  </td>
				</tr>
		</table>
				 
				 
			</div>
			
			
		</div>
		
		
		
		
	
	</div>
	
	<div class="row">
	
		<div class="large-9 columns">
		
			<div class="panel">
				<h6>Available Retailers: </h6>
				<ul>
					<?php
						$sql = "select * from Retailer where RetailerID in(
								select RetailerID from RetailerStock where ItemID='$itemid' and MarketID in
								( select MarketID from Market where MarketName='$market'))";
						$query = sqlsrv_query($conn, $sql);

						if ($query === false){  
							exit("<pre>".print_r(sqlsrv_errors(), true));
						}

						$ItemCount = sqlsrv_has_rows($query); // count the output amount
						if ($ItemCount > 0) {
							while($row = sqlsrv_fetch_array($query)){?>
									<li><a href="itemquantity.php?id=<?php echo $itemid ?>&market=<?php echo $market?>&retailerid=<?php echo $row["RetailerID"]?>"> <?php echo $catagoryname=$row["RetailerName"] ?></a></li>
					<?php	
							
							}

						}
						
					?>
					
				</ul>
	
			

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
