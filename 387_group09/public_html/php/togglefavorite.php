<?php
require_once('/home/group9/init.php');
$listingid = $_GET['listing'];
$userid = $_GET['userid'];
$value = $_GET['value'];
if(isset($userid) && $userid != 0){
if($value == "true"){
	$sql = "Insert Into Favorites VALUES (?, ?)";
	$result = $conn->execute_query($sql, [$userid, $listingid]);
}else if($value == "false"){
	$sql = "Delete From Favorites Where UserID = ? and ListingID = ?";
	$result = $conn->execute_query($sql, [$userid, $listingid]);
}}else{
	echo("You must sign in to favorite!");
}
?>