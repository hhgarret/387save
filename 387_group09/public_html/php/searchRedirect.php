<?php
	require_once('/home/group9/init.php');
	if(isset($_POST['search'])){
		$sql = "Select ListingID from Listings where Name like ?";
		$result = $conn -> execute_query($sql, ['%'.$_POST['search'].'%']);
		if(!$result){
			echo("Failed to search!");
			return -1;
		}
		$row = $result -> fetch_row();
		$id = $row[0];
		header("Location: ../listingInfo.php?listingid=".$id);

	}
?>