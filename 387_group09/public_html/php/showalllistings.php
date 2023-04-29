<?php
    require_once('/home/group9/init.php');
    if(!isset($_GET)){
        $order = "";
    }else{
        $sortby = $_GET['sortby'];
        $ordering = $_GET['ordering'];
        $order = " ORDER BY ".$sortby." ".$ordering;
    }


    $sql = "Select * from Listings".$order;
    $result = $conn->query($sql);
    $num_fields = mysqli_num_fields($result);
    while($row = $result->fetch_row()){
        echo("<br />");
        echo("<br />");
        for($i = 0; $i < $num_fields; $i++){
        $field = $result->fetch_field_direct($i);
            if($field->flags == 49667 || $field->flags == 53257){
                if($i == 0)
                    echo("<a href='listingInfo.php?listingid=".$row[0]."'>".$row[1]."</a><br />");
                $i++;
                continue; //Should be pk or fk flag
            }
            echo($field->name.": ".$row[$i]."<br />");
        }
        
    }

    ?>