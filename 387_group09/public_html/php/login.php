<?php


if(isset($_POST['password'])){
	echo("Password: ".$_POST['password']."      ");
}
if(isset($_POST['email'])){
	$email = $_POST['email'];
}
echo("<br></br>");

$set = false;
echo("Vals email, ".$email.", password, ".$_POST['password'].", hashpass, ".$hashpass);
if(isset($email)){
	$sql = 'select Username, Password from Users where Email = ?';
	$result = $conn -> execute_query($sql, [$email]);
	$set = true;
}
else{
	$sql = "";
}

echo($sql);
echo("<br></br>");

if($set){
	if($result -> num_rows == 1){
		$row = $result->fetch_assoc();
		$hashpass = $row['Password'];
		if(password_verify($_POST['password'], $hashpass)){
			echo("There is one matching user... logging in.");
			$_SESSION['user'] = $row['Username'];
		}
		else{
			echo("Failed to log in.");
		}
		
		echo("<br></br>");
	}
	else{
		echo("Failed to log in.<br />");
		unset($_SESSION['user']);
	}
}
?>