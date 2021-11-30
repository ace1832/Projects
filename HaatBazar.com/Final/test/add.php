<?php 
session_start();
?>
<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php
include "scripts/connect_to_sqlsrv.php";
$marketid=$_SESSION["MARKETID"];
$retailerid=$_SESSION["RETAILERID"];
//$itemid=$_GET['productid'];
if (isset($_POST["quantity"]) && isset($_POST["itemid"]) && isset($_POST["unit"]) && !empty($_POST["quantity"]) && !empty($_POST["itemid"]) && !empty($_POST["unit"]) ) {

	$quantity = $_POST["quantity"];
	$itemid = $_POST["itemid"];
	$unit = $_POST["unit"];	
	
	// Connect to the SQL Server database  
     
	
    $sql = "INSERT INTO RetailerStock (RetailerID,MarketID,ItemID,Quantity,Unit)
						VALUES ('$retailerid','$marketid','$itemid','$quantity','$unit')";
		
	$query = sqlsrv_query($conn, $sql);				
						
	if($query){
    echo 'success';      
	//header("location: retailerproducts.php"); 
    //exit();
		

    }else{
		
		echo $msg = "Unsuccessfull Try Again";
		
	}
	
}
?>