<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset="utf-8" />
    </head>
<body>
<?php 
    
    include('header.php');
      $referer = end(explode("/",$_SERVER['HTTP_REFERER'])); //Gets the file name of the last page sent from. Blank if nothing. Cool!
      echo($referer."<br />");       
      echo("Before includes <br></br>");
      if($referer == "signin.php"){
        include('php/login.php');
        //header("Refresh:0");
      }else if($referer == "createaccount.php"){
        include('php/register.php');
        //header("Refresh:0");
      }else if($referer == "createListing.php"){
        echo("About to include generatelisting <br />");
        include('php/generatelisting.php');
      }
	  #$sql = "select * from Users;";
	  #$result = $conn -> query($sql);
      #$fieldcount = mysqli_num_fields($result);
	  #if ($result-> num_rows > 0) {
    // output data of each row
       # while($row = $result->fetch_row()) {
        #    for($i = 1; $i < $fieldcount; $i++){
         #   $fieldinfo = $result ->fetch_field_direct($i);
          #  echo(" ".$fieldinfo->name . ": ".$row[$i]."<br></br>");
        #}
    #}
//} else {
//    echo("0 results");
//}
    echo($referer);       
    
	echo("<br></br>You are logged in as ".$_SESSION['user']);
    if($_SESSION['user'] == "" || !isset($_SESSION['user'])){
        header("Location: signin.php");
    }else{
	header("Location: index.php");
    }
?>
</body>
</html>