<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>


<?php 
$dynamicList = "";

// Connect to the SQLSRV database  
include "scripts/connect_to_sqlsrv.php"; 
$market = "";
$catagoryid = "";
$searchHeader = "";
if(isset($_POST['submit'])){ 
	if(isset($_GET['go'])){ 
		if(preg_match("/^[  a-zA-Z]+/", $_POST['sInput'])){ 
			$searchInput=$_POST['sInput']; 
			echo $marketname=$_POST['sInput1'];
			// Connect to the MySQL database  
			 
			$sql = "SELECT * FROM Item WHERE ItemID IN(
									SELECT I.ItemID
									FROM Retailer R
									INNER JOIN Market M
									ON M.MarketID = R.MarketID
									INNER JOIN RetailerStock RC
									ON R.RetailerID = RC.RetailerID
									INNER JOIN Item I
									ON RC.ItemID = I.ItemID
									WHERE M.MarketName='$marketname' and I.ItemName = '$searchInput'
									GROUP BY I.ItemID
                                  )";
			$query = sqlsrv_query($conn, $sql);		
			if ($query === false){  
				exit("<pre>".print_r(sqlsrv_errors(), true));
			}	
			$itemCount = sqlsrv_has_rows($query); // count the output amount
			if ($itemCount > 0) {
			while($row = sqlsrv_fetch_array($query)){ 
             $id = $row["ItemID"];
			 $item_name = $row["ItemName"];
			 $item_prevprice = $row["PrevPrice"];
			 $item_presentprice = $row["PresentPrice"];
			 $dynamicList .= 
			'<table width="100%" border="0" cellspacing="0" cellpadding="10">
				<tr>
				  <td width="17%" valign="top"><a href="itemdetails.php?id=' . $id . '"><img style="border:#666 1px solid;" src="inventory_images/' . $id . '.jpg" alt="' . $item_name . '" width="77" height="102" border="1" /></a></td>
				  <td width="83%" valign="top">' . $item_name . '<br />' . $item_presentprice . '<br /><a href="itemdetails.php?id=' . $id . '&market=' .$market. '">View item Details</a></td>
				</tr>
			</table>';
    }
		}else {
				$dynamicList = "We have no products listed in our database yet";
			}
		}else{ 
			echo  "<p>Please enter a search query</p>"; 
		} 
	} 
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
        <a href="#" class="links">Search</a>
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
				 <table width="600px" border="0" cellspacing="0" cellpadding="10" align="center">
					<tr>
						<td width="100%" valign="top">
							<p><?php echo $dynamicList; ?><br/></p>
		
						</td>
					</tr>
				 <table>
				 
				 
			</div>
			
			
		</div>
		
		
		<div class="large-3 columns">
		
			<div>
			
				<div class="panel">
				<form  method="post" action="search.php?go"  id="searchform"> 
					<input  type="text" name="sInput">
					<input  type="text" name="sInput1">
					<input  type="submit" name="submit" value="Search"> 
				</form>
				 
				 
			</div>

		
				
			</div>
			
			
		</div>
		
	
	</div>
	
	<div class="row">
	
		<div class="large-9 columns">
		
			<div class="panel">
				

			<div id="myModal2" class="reveal-modal" data-reveal>
			
			
			
			
			
			
			
			<a class="close-reveal-modal">&#215;</a>
			</div>
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
