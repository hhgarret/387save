<?php  

// 
//Listing values:
//ListingID (PK) (autoincrement)
//Name  (companyName?)
//PosterID (FK) (userID from $_SESSION['user'])
//PositionID (FK) (reference Positions)
//Date (theres opStateDate and opEndDate, but I thought we'd use locally created time... check in with team)
//Salary (from salary)
//url (optional) (not included rn)
//Description (from opDesc, although theres also a comDesc for the company? check from user? Also an opQual... append to desc? )
//recurring (bool) (not included)


if(!isset($_SESSION['user'])){
	echo("You must be logged in to create a listing!<br />");
	echo("<a href = 'signin.php'>Click me to sign in!</a><br />");
	return 0;
}
$sql = "Select UserID from Users where Username = ?";

$result = $conn->execute_query($sql, [$_SESSION['user']]);
if($result == false){
	echo("Couldnt retrieve UserID<br />");
	return 0;
}
$row = $result->fetch_row();
$UserID = $row[0];
$Name = $_POST['companyName'];
$position = $_POST['position'];
$sql = "Select PositionID from Positions where PositionName = ?";
$result = $conn->execute_query($sql, [$position]);
$row = $result->fetch_row();
$PositionID = $row[0];
echo("Made it to point 3<br />");
$Date = date("Y-m-d");
$StartDate = $_POST['opStartDate'];
$EndDate = $_POST['opEndDate'];
$Location = $_POST['location'];
$Salary = $_POST['salary'];
$url = "blank";
$Desc = $_POST['opQual'];
if($_POST['reccuring'] == "Yes"){
	$recurring = 1;
}else{
	$recurring = 0;
}
$sql = "Insert into Listings (Name, PosterID, PositionID, PostDate, StartDate, EndDate, Location, Salary, url, Description, recurring) values (?,?,?,?,?,?,?,?,?,?,?)";
echo("Sql statement looks like: ".$sql."<br />");
echo("With values: [$Name, $UserID, $PositionID, $Date, $StartDate, $EndDate, $Location, $Salary, $url, $Desc, $recurring]<br />");
$result = $conn->execute_query($sql, [$Name, $UserID, $PositionID, $Date, $StartDate, $EndDate, $Location, $Salary, $url, $Desc, $recurring]);
echo("Result: ".$result);
echo("Made it to the end!");
?>