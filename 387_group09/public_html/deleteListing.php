<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delete Listing</title>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
        <style>
        table {
    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    text-indent: initial;
    white-space: normal;
    line-height: normal;
    font-weight: normal;
    font-size: medium;
    font-style: normal;
    color: -internal-quirk-inherit;
    text-align: start;
    border-spacing: 2px;
    border-color: gray;
    font-variant: normal;
    width: 100%;
    table-layout: auto;
    border: 1px solid;
}
th{
    text-align: left;
}
td{
    height: 50px;
    vertical-align: bottom;
}
th, td{
    border-bottom: 1px;
    border: 1px solid;
}
tr:nth-child(even){
    background-color: $f2f2f2;
}
.table{
    display: table;
}
.table>* {
    display: table-row;
    }
.table>*>*{
    display:table-cell;
}
        </style>

  </head>
  <body>
    <?php
    include 'header.php';
  ?>
<?php

require_once('/home/group9/init.php');
$input = "Listings";
if(isset($input) && $input != ""){
echo("The new table is ".$input."<br />");


$sql = "Show columns from ".$input;
echo($sql);
$finfos = array();
if(isset($conn)){
$result = $conn -> execute_query($sql, []);
$numfields = mysqli_num_fields($result);

for($i = 0; $i < $numfields; $i++){
	$finfo = $result -> fetch_field_direct($i);
	$finfos[] = $finfo;
}
}
else{
	echo("No conn!");
}

$sql = "Select Name, PostDate, StartDate, EndDate, Location, Salary, url, Description, recurring, ListingID, PosterID, PositionID From (Select 1) as ignore_me left join $input on 1 = 1 Limit 1";

$finfos = array();
if(isset($conn)){
	$result = $conn -> execute_query($sql, []);
	$numfields = mysqli_num_fields($result);
	for($i = 0; $i < $numfields; $i++){
	$finfo = $result -> fetch_field_direct($i);
	$finfos[] = $finfo;
}
}



echo("<br/>Here is a table for Delete: ");

$sql = "Select UserID from Users where Username = ?";
$result = $conn -> execute_query($sql,[$_SESSION["user"]]);
$row = $result->fetch_row();
$userid = $row[0];

$sql = "Select Name, PostDate, StartDate, EndDate, Location, Salary, url, Description, recurring, ListingID, PosterID, PositionID from ".$input ." where PosterID = ?";
if(isset($conn)){
$result = $conn -> execute_query($sql, [$userid]);
$numfields = mysqli_num_fields($result);

echo("<div class = 'table'><div>");
for($i = 0; $i < $numfields-3; $i++){
	echo("<div>".$finfos[$i]->name."</div>");
}
echo("<div>Submit</div>");
echo("</div>");
while($row = $result -> fetch_row()){
	echo("<form action = 'php/crud.php?input=$input' method = 'POST'>");
	for($i = 0; $i < $numfields; $i++){
		echo("<div>");
		echo("<input type = ");
		if((($finfos[$i] -> flags) >> 1) % 2 == 1){ #flag bit of 2 is PRI_KEY_FLAG
			echo("'hidden'");
		}else if((($finfos[$i] -> flags) >> 2) % 2 == 1){ #flag bit of 4 is UNIQUE_KEY_FLAG
			echo("'hidden'");
		}else if((($finfos[$i] -> flags) >> 3) % 2 == 1){ #flag bit of 8 is MULTIPLE_KEY_FLAG
			echo("'hidden'");
		}else if($finfos[$i] -> type == 252 || $finfos[$i] -> type == 253){ #252 is blobs/texts, 253 is varchar
			echo("'text'");
		}else if($finfos[$i] -> type == 3){ # int
			echo("'number' step = '1'");
		}else if($finfos[$i] -> type == 4 || $finfos[$i] -> type == 5){ # float/double
			echo("'number' step = '.1'");
		}else if($finfos[$i] -> type == 10){ # date
			echo("'date'");
		}else if($finfos[$i] -> type == 1){ # tinyin
			echo("'number' min = '0' max = '1' step = '1'");
		}
		echo(" readonly");
		echo(" value = '".$row[$i]."' name = ".($finfos[$i]->name)); 

		echo("></div>");
	}
	echo("<div><input type = 'submit' name = 'submit' value = 'Delete'></div></form>");
}
echo("</div>");
}
}
?>

	
        <?php
      include 'footer.php';
    ?>
  </body>
</html>
