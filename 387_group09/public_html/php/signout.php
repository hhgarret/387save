<?php
session_start();
unset($_SESSION);
session_destroy();
header("LOCATION: http://turing.cs.olemiss.edu/~group9");
?>