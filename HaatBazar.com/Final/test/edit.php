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
$itemid=$_GET['productid'];
if (isset($_POST["quantity"]) && !empty($_POST["quantity"])) {

	$quantity = $_POST["quantity"];
	
	// Connect to the SQL Server database  
     
	
    $sql = "UPDATE RetailerStock SET Quantity = '$quantity' WHERE ItemID = '$itemid' and RetailerID = '$retailerid' and MarketID = '$marketid'";
		
	$query = sqlsrv_query($conn, $sql);				
						
	if($query){
    echo 'success';      
	header("location: retailerproducts.php"); 
    exit();
		

    }else{
		
		$msg = "Unsuccessfull Try Again";
		
	}
	
}
?>