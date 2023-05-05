<?php
require_once('/home/group9/init.php');
$listingid = $_POST['ListingID'];
if(isset($listingid) && $listingid != 0){
	$sql = "Select archived, PosterID from Listings where ListingID = ?";
	$result = $conn -> execute_query($sql, [$listingid]);
	$row = $result->fetch_row();
	$bool = $row[0];
	$userid = $row[1];
	$sql2 = "Select UserID from Users where Username= ?";
	$result2 = $conn -> execute_query($sql2, [$_SESSION['user']]);
	$row2 = $result2 -> fetch_row();
	$apparentuserid = $row2[0];
	if($apparentuserid != $userid){
		$_SESSION['message'] = "Must be the creator of the listing to archive";
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
	}

	if($bool == 0){
	$sql = "Update Listings set archived = 1 where ListingID = ?";
	$result = $conn->execute_query($sql, [$listingid]);
	}else{
	$sql = "Update Listings set archived = 0 where ListingID = ?";
	$result = $conn->execute_query($sql, [$listingid]);
	}
	if(!$result){
		$_SESSION['message'] = "Failed to toggle archived";
	}
}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>