<?php
require_once('/home/group9/init.php');
if(isset($_GET['listingid'])){
$id = $_GET['listingid'];
$sql = "Update Listings Set reports = COALESCE(reports, 0) + 1 where ListingID = ?";
$result = $conn -> execute_query($sql, [$id]);
if(!$result){
	$_SESSION['message'] = "Failed to report";
}
}else{
	$_SESSION['message'] = "Listing ID does not exist";
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>
