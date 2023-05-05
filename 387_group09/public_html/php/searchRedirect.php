<?php
	require_once('/home/group9/init.php');
	if(isset($_POST['search'])){
		$sql = "Select ListingID from Listings where Name like ?";
		$result = $conn -> execute_query($sql, ['%'.$_POST['search'].'%']);
		if(!$result){
			$_SESSION['message'] = "Failed to Find Listing";
			header("Location: ../listings.php");
		
		}else if($result -> num_rows == 0){
			$_SESSION['message'] = "Failed to Find Listing";
			header("Location: ../listings.php");
		}else{
			$row = $result -> fetch_row();
			$id = $row[0];
			header("Location: ../listingInfo.php?listingid=".$id);
		}
	}
?>