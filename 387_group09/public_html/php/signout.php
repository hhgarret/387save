<?php
session_start();
unset($_SESSION);
session_destroy();
header("LOCATION: ../index.php");
exit;

?>