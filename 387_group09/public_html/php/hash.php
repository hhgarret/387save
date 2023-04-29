<?php
$pass = $_GET['pass'];
$hashpass = password_hash($pass, PASSWORD_BCRYPT);
echo($hashpass);
?>