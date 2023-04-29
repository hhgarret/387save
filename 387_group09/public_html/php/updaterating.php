<?php
require_once('/home/group9/init.php');
$listingid = $_GET['listing'];
$userid = $_GET['userid'];
$rating = $_GET['rating'];
$sql = "Replace into Ratings VALUES (?, ?, ?, ' ')";
$result = $conn -> execute_query($sql, [$listingid, $userid, $rating]);
if($result != false){
	echo("Successfully inserted values ".$listingid.", ".$userid.", ".$rating);
}else{
	echo("Failed to insert values");
}
?>