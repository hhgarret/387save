<?php

//if(!isset($_SESSION)){
session_start();
//}


$servername = "localhost";
$username = "group9";
$password = '$ICgnirut';
$dbname = "group9";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn -> connect_error){
    echo("Error in connecting to DB");
}else{
    //echo("Created connection to DB<br></br>");
}
?>