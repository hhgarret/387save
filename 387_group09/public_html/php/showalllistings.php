<?php
    require_once('/home/group9/init.php');
    if(!isset($_GET)){
        $order = "";
    }else{
        $sortby = $_GET['sortby'];
        $ordering = $_GET['ordering'];
        $order = " ORDER BY ".$sortby." ".$ordering;
        $position = $_GET['position'];
        if($position == "Internship"){
            $pos = " and PositionID = 1";
        }else if($position == "Job"){
            $pos = " and PositionID = 2";
        }else if($position == "Research"){
            $pos = " and PositionID = 3";
        }else{
            $pos = "";
        }
    }


    $sql = "Select ListingID, Name, PosterID, PositionID, PostDate as `Post Date`, StartDate as `Start Date`,  EndDate as `End Date`, Location, Salary, url as URL, Description,
    recurring
    from Listings where archived != 1".$pos.$order;
    $result = $conn->query($sql);
    $num_fields = mysqli_num_fields($result);
    while($row = $result->fetch_row()){
        echo("<div class='allthalistings'>");
        echo("<br />");
        echo("<br />");
        for($i = 0; $i < $num_fields; $i++){
        $field = $result->fetch_field_direct($i);
            if($field->flags == 49667 || $field->flags == 53257){
                if($i == 0) {
                    echo("<div><a href='listingInfo.php?listingid=".$row[0]."'>".$row[1]."</a><span class ='material-symbols-outlined'><a href='php/reportListing.php?listingid=".$row[0]."'>Flag</a></span></div><br />");
                    
                }
                $i++;
                continue; //Should be pk or fk flag
            }
            echo($field->name.": ".$row[$i]."<br />");
        }
       
        echo("</div>");
    }

    ?>