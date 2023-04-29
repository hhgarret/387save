<?php
require_once('/home/group9/init.php');
$input = $_REQUEST['input'];
if(isset($input) && $input != ""){
echo("The new table is ".$input."<br />");


$sql = "Show columns from ".$input;
echo($sql);
$finfos = array();
if(isset($conn)){
$result = $conn -> execute_query($sql, []);
$numfields = mysqli_num_fields($result);
echo("<table><tr>");
for($i = 0; $i < $numfields; $i++){
	$finfo = $result -> fetch_field_direct($i);
	$finfos[] = $finfo;
	echo("<th>".$finfos[$i]->name."</th>");
}
echo("<th>Test</th>");
echo("</tr>");
while($row = $result -> fetch_row()){
	echo("<tr>");
	for($i = 0; $i < $numfields; $i++){
		echo("<td>".$row[$i]."</td>");
	}
	echo("<td></td>");
	echo("</tr>");
}
echo("</table>");
}
else{
	echo("No conn!");
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




echo("<br/>Here is a table for Update: ");

$sql = "Select * from ".$input;
if(isset($conn)){
$result = $conn -> execute_query($sql, []);
$numfields = mysqli_num_fields($result);

echo("<div class = 'table'><div>");
for($i = 0; $i < $numfields; $i++){
	echo("<div>".$finfos[$i]->name."</div>");
}
echo("<div>Submit</div>");
echo("</div>");
while($row = $result -> fetch_row()){
	echo("<form action = 'php/crud.php?input=$input' method = 'POST'>");
	for($i = 0; $i < $numfields; $i++){
		echo("<div>");
		echo("<input type = ");
		if($finfos[$i] -> type == 252 || $finfos[$i] -> type == 253){ #252 is blobs/texts, 253 is varchar
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
		if(($finfos[$i] -> flags) % 2 == 1){ #flag bit of 1 is NOT_NULL_FLAG
			echo(" required");
		}
		if((($finfos[$i] -> flags) >> 1) % 2 == 1){ #flag bit of 2 is PRI_KEY_FLAG
			echo(" readonly");
		}else if((($finfos[$i] -> flags) >> 2) % 2 == 1){ #flag bit of 4 is UNIQUE_KEY_FLAG
			echo(" readonly");
		}else if((($finfos[$i] -> flags) >> 3) % 2 == 1){ #flag bit of 8 is MULTIPLE_KEY_FLAG
			echo(" readonly");
		}
		echo(" value = '".$row[$i]."' name = ".($finfos[$i]->name)); 

		echo("></div>");
	}
	echo("<div><input type = 'submit' name = 'submit' value = 'Update'></div></form>");
}
echo("</div>");
}
else{
	echo("No conn!");
}


echo("<br/>Here is a table for Create: ");


if(isset($conn)){
$numfields = mysqli_num_fields($result);
echo("<div class = 'table'><div>");
for($i = 0; $i < $numfields; $i++){
	echo("<div>".$finfos[$i]->name."</div>");
}
echo("<div>Submit</div></div>");
	echo("<form action = 'php/crud.php?input=$input' method = 'POST'>");
	for($i = 0; $i < $numfields; $i++){
		echo("<div>");
		echo("<input type = ");
		if($finfos[$i] -> type == 252 || $finfos[$i] -> type == 253){ #252 is blobs/texts, 253 is varchar
			echo("'text'");
		}else if($finfos[$i] -> type == 3){ # int
			echo("'number' step = '1'");
		}else if($finfos[$i] -> type == 4){ # double
			echo("'number' step = '.1'");
		}else if($finfos[$i] -> type == 10){ # date
			echo("'date'");
		}
		if(($finfos[$i] -> flags) % 2 == 1){ #flag bit of 1 is NOT_NULL_FLAG
			echo(" required");
		}
		echo(" value = '' name = ".($finfos[$i]->name)); 

		echo("></div>");
	}
	echo("<div><input type = 'submit' name = 'submit' value = 'Create'></div></form>");
echo("</div>");
}
else{
	echo("No conn!");
}


echo("<br/>Here is a table for Delete: ");


$sql = "Select * from ".$input;
if(isset($conn)){
$result = $conn -> execute_query($sql, []);
$numfields = mysqli_num_fields($result);

echo("<div class = 'table'><div>");
for($i = 0; $i < $numfields; $i++){
	echo("<div>".$finfos[$i]->name."</div>");
}
echo("<div>Submit</div>");
echo("</div>");
while($row = $result -> fetch_row()){
	echo("<form action = 'php/crud.php?input=$input' method = 'POST'>");
	for($i = 0; $i < $numfields; $i++){
		echo("<div>");
		echo("<input type = ");
		if($finfos[$i] -> type == 252 || $finfos[$i] -> type == 253){ #252 is blobs/texts, 253 is varchar
			echo("'text'");
		}else if($finfos[$i] -> type == 3){ # int
			echo("'number' step = '1'");
		}else if($finfos[$i] -> type == 4){ # double
			echo("'number' step = '.1'");
		}else if($finfos[$i] -> type == 10){ # date
			echo("'date'");
		}
		echo(" readonly");
		echo(" value = '".$row[$i]."' name = ".($finfos[$i]->name)); 

		echo("></div>");
	}
	echo("<div><input type = 'submit' name = 'submit' value = 'Delete'></div></form>");
}
echo("</div>");
}
else{
	echo("No conn!");
}


}
?>