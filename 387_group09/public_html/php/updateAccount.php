<?php
	require_once('/home/group9/init.php');
	
	$sql = "Select UserID, Password from Users where Username = ?";
	$result = $conn -> execute_query($sql, [$_SESSION['user']]);
	if($result->num_rows == 1){
		$row = $result->fetch_row();
		$id = $row[0];
		//echo("Userid is ".$id);
	}else{
		echo("Could not find user");
	}

	if(isset($_POST['email'])){
		echo("Emails of: ".$_POST['emailChange'].", ".$_POST['emailConfirmNew']);
		if($_POST['emailChange'] != $_POST['emailConfirmNew']){
			echo("Emails dont match!");;
		}else if($_POST['emailChange'] == ""){
			echo("Email is empty!");
		}else{
			$sql = "Select * FROM Users where Email = ?";
			echo("sql: $sql, email: $emailChange");
			$result = $conn -> execute_query($sql, [$_POST['emailChange']]);
			if($result -> num_rows > 0){
				$_SESSION['message'] = "There is already a user with that username or email address";
				header("Location: " . $_SERVER['HTTP_REFERER']);
			}else if(!$result){
				$_SESSION['message'] = "There is already a user with that username or email address";
		header("Location: " . $_SERVER['HTTP_REFERER']);
			}else{


			$sql = "Update Users set Email = ? where UserID = ?";
			$result = $conn -> execute_query($sql, [$_POST['emailChange'], $id]);
			if(!$result){
					echo("Failed to update!");
				}
				}
		}
	}else if(isset($_POST['username'])){
		echo("Usernames of: ".$_POST['usernameChange'].", ".$_POST['usernameConfirmNew']);
		if($_POST['usernameChange'] != $_POST['usernameConfirmNew']){
			echo("Usernames dont match!");
		}else if($_POST['usernameChange'] == ""){
			echo("Username is empty!");
		}else{

			$sql = "Select * FROM Users where Username = ?";
	
			$result = $conn -> execute_query($sql, [$_POST['usernameChange']]);
			if($result -> num_rows > 0){
				$_SESSION['message'] = "There is already a user with that username or email address";
		header("Location: " . $_SERVER['HTTP_REFERER']);
			}else if(!$result){
				$_SESSION['message'] = "There is already a user with that username or email address";
		header("Location: " . $_SERVER['HTTP_REFERER']);
			}else{

			$sql = "Update Users set Username = ? where UserID = ?";
			$result = $conn -> execute_query($sql, [$_POST['usernameChange'], $id]);
			if(!$result){
					echo("Failed to update!");
				}
			$_SESSION['user'] = $_POST['usernameChange'];
			}
		}
	}else if(isset($_POST['password'])){
		echo("Passwords of: ".$_POST['passwordOld'].", ".$_POST['passwordNew'].", ".$_POST['passwordConfirmNew']);
		if($_POST['passwordNew'] != $_POST['passwordConfirmNew']){
			echo("Passwords dont match!");
		}else if($_POST['passwordNew'] == ""){
			echo("Password is empty!");
		}else{
			$hashpass = password_hash($_POST['passwordNew'], PASSWORD_BCRYPT);
			$currentpass = $row[1];
			if(password_verify($_POST['passwordOld'], $currentpass)){
				$sql = "Update Users set Password = ? where UserID = ?";
				$result = $conn -> execute_query($sql, [$hashpass, $id]);
				if(!$result){
					echo("Failed to update!");
				}
			}
		}
	}else if(isset($_POST['passwordbypass']) ){
		echo("Passwords of: ".$_POST['passwordNew'].", ".$_POST['passwordConfirmNew']);
		if($_POST['passwordNew'] != $_POST['passwordConfirmNew']){
			echo("Passwords dont match!");
		}else if($_POST['passwordNew'] == ""){
			echo("Password is empty!");
		}else{
			$hashpass = password_hash($_POST['passwordNew'], PASSWORD_BCRYPT);
			$sql = "Update Users set Password = ? where Email = ?";
			$result = $conn -> execute_query($sql, [$hashpass, $_POST['email2']]);
			if(!$result){
				echo("Failed to update!");
			}
		}
	}
	echo("<br />end");
	header("Location: " . $_SERVER['HTTP_REFERER']);
?>