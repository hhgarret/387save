<?php
require_once('/home/group9/init.php');
$input = $_GET['input'];
$action = $_POST['submit'];
echo("Input: $input, Action: $action");

foreach($_POST as $param_name => $param_val){
	echo("<br />Param: $param_name; Value: ".$_POST["$param_name"]);
}

$sql = "Select ".$input.".* From (Select 1) as ignore_me left join $input on 1 = 1 Limit 1";

$finfos = array();
if(isset($conn)){
	$result = $conn -> execute_query($sql, []);
	$numfields = mysqli_num_fields($result);
	for($i = 0; $i < $numfields; $i++){
	$finfo = $result -> fetch_field_direct($i);
	$finfos[] = $finfo;
}
}


if($action == "Update"){
	echo("<br />");
	$sql = "Update $input Set";
	$args = array();
	for($i = 0; $i < sizeof($finfos); $i++){
		if( (($finfos[$i]->flags & 8)  + ($finfos[$i]->flags & 4) + ($finfos[$i]->flags & 2)) == 0){ #Where the 4th bit isnt 1, i.e., not primary
		$sql = $sql." ".$finfos[$i]->name." = ?";
		$args[] = $_POST[$finfos[$i]->name];
		if($i < (sizeof($finfos) - 1)){
			$sql = $sql.", ";
		}
		}
	}
	$sql = $sql." where";
	for($i = 0; $i < sizeof($finfos); $i++){
		if( (($finfos[$i]->flags & 8) + ($finfos[$i]->flags & 4) + ($finfos[$i]->flags & 2)) > 0){ #Where the 4th bit is 1, i.e., primary
		$sql = $sql." ".$finfos[$i]->name." = ? AND";
		$args[] = $_POST[$finfos[$i]->name];
		}
	}
	$sql = substr($sql, 0, -4); #remove the last " AND"
	echo($sql);
	echo("<br />");
	print_r($args);
	echo("<br />");
	$result = $conn -> execute_query($sql, $args);
	if($result == False){
		
		$_SESSION['message'] = "Failed to execute delete";
	}else{
		$_SESSION['message'] = implode($args);
	}
}else if($action == "Create"){
	echo("<br />");
	$sql = "Replace Into $input VALUES (";
	for($i = 0; $i < sizeof($finfos); $i++){
		if($i != sizeof($finfos)-1){
		$sql = $sql."?,";
		}else{
			$sql = $sql."?";
		}
	}
	$sql = $sql.")";
	echo("<br />");
	echo("sql: $sql<br />");
	echo("Values of: ");
	$args = array();
	foreach($finfos as $finfo){
	echo($finfo->name."--".$_POST[$finfo->name]." ");
	$args[] = $_POST[$finfo->name];
	}
	$result = $conn -> execute_query($sql, $args);
	if($result == False){
		$_SESSION['message'] = "Failed to execute delete";
	}
}else if($action == "Delete"){
	echo("<br />");
	$sql = "Delete from $input where";
	for($i = 0; $i < sizeof($finfos); $i++){
		if( (($finfos[$i]->flags & 8)  + ($finfos[$i]->flags & 4) + ($finfos[$i]->flags & 2)) != 0){
		$sql = $sql." ".$finfos[$i]->name."= ? AND";
		}
	}
	$sql = substr($sql, 0, -4);
	$args = array();
	foreach($finfos as $finfo){
		if( (($finfo->flags & 8)  + ($finfo->flags & 4) + ($finfo->flags & 2)) != 0){
		$args[] = $_POST[$finfo->name];
		}
	}
	echo($sql);
	echo("<br />");
	echo("Values of: ");
	foreach($finfos as $finfo){
	echo($finfo->name."--".$_POST[$finfo->name]." ");
	}
	echo("args: ");
	print_r($args);
	$result = $conn -> execute_query($sql, $args);
	print_r($result);
	if($result == False){
		echo("Failed to execute");
		$_SESSION['message'] = "Failed to execute delete";
	}
}
echo("Make it to the end!");
echo("<br />HTTP REFERER: ".$_SERVER['HTTP_REFERER']);
header("Location: " . $_SERVER['HTTP_REFERER']);
//header("Location: ../ajax.php?table=$input");
?>