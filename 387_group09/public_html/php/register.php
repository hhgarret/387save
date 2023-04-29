<?php
$error = false;
if(strcmp(strtolower($_POST['email']), strtolower($_POST['emailConfirm'])) != 0){
	echo("Email mismatch!<br></br>");
	echo('email1: '.$_POST["email"].', email2: '.$_POST["emailConfirm"].'<br></br>');
	$error = true;
}else if(!str_contains($_POST['email'], '@')){
	echo("Invalid email, must contain an @<br></br>");
	$error = true;
	#TODO: Expand valid email requirements
}else{
	$email = $_POST['email'];
}
if(strcmp(strtolower($_POST['username']), strtolower($_POST['usernameConfirm'])) != 0){
	echo("Username mismatch!<br></br>");
	$error = true;
}else{
	$username = $_POST['username'];
}
if(strcmp(strtolower($_POST['password']), strtolower($_POST['passwordConfirm'])) != 0){
	echo("Password mismatch!<br></br>");
	$error = true;
}else{
	$pass = $_POST['password'];
}
echo("<br>Everything matches</br>");


if(!$error){
	$sql = "Select * FROM Users where Username = ? OR Email = ?";
	
	$result = $conn -> execute_query($sql, [$username, $email]);
	if($result -> num_rows > 0){
		echo("There is already a user with that username or email address");
		$_SESSION['message'] = "There is already a user with that username or email address";
		header("Location: " . $_SERVER['HTTP_REFERER']);
		return 0;
	}
	$hashpass = password_hash($pass, PASSWORD_BCRYPT);

	echo($sql);
	echo("Vals of: ".$username." ".$hashpass." ".$email);
	$sql = "INSERT INTO Users (Username, Role, Password, Email) VALUES (?, 'poster', ?, ?)";
	$result = $conn -> execute_query($sql, [$username, $hashpass, $email]);
	echo($sql);
	$_SESSION['user'] = $username;
	
	echo("<br /> To: $email");
	$subject = 'Welcome to Group 9s Project!';
	$message = 'An account has been created under this email. If this was not you, please contact admins at group9@turing.cs.olemiss.edu!';
	$message = wordwrap($message, 70);
	$headers = 'From: group9@turing.cs.olemiss.edu' . "\r\n" .
	    'Reply-To: group9@turing.cs.olemiss.edu' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	$status = mail($email, $subject, $message, $headers);
	if($status){
		echo("<br /> Successfully sent!");
	}else{
		echo("<br /> Failed to send! Error: ".error_get_last()['message']);
	}

}


echo("<br></br>");
?>