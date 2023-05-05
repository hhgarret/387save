<?php
    require_once('/home/group9/init.php');
    $sql = "Select DISTINCT Listings.ListingID, Name, Location,  Salary, AVG(Rating) as Rating, COUNT(Rating) as numRating
    from Listings left outer join Ratings on Listings.ListingID = Ratings.ListingID where PositionID = ? and archived != 1 group by ListingID";
    $result = $conn -> execute_query($sql, [$positionid]);
      while($row = $result -> fetch_row()){
        $numfields = mysqli_num_fields($result);
        echo("<div style='position: relative; height: auto;'><br />");
            echo("<b><a href='listingInfo.php?listingid=".$row[0]."'>".$row[1]."</a></b><span class ='material-symbols-outlined'><a href='php/reportListing.php?listingid=".$row[0]."'>Flag</a></span><br />");
            echo("Located in ".$row[2]."<br />");
            echo("Salary: $".$row[3]." per hour");
            echo("<br />");
            echo("<fieldset class='rate' id = 'rate'>");
            for($i = 10; $i > 0; $i--){
                if($i == round($row[4] * 2)){
                    $checked = "id = 'checked'";
                }else{
                    $checked = '';
                }
                if($i%2==1){
                    $half = "class = 'half'";
                }else{
                    $half = '';
                }
                echo("<label for='rating$i' $checked $half></label>");
            }
        echo("</fieldset>from $row[5] ratings<br /></div>");
      }

    ?>