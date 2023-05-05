<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    require_once("/home/group9/init.php");
    $listingid = $_GET['listingid'];
    $sql = "Select DISTINCT Listings.ListingID, Name, PostDate, StartDate, EndDate, Salary, url, Listings.Description, recurring, AVG(Rating) as Rating, COUNT(Rating) as numRating
    from Listings left outer join Ratings on Listings.ListingID = Ratings.ListingID where Listings.ListingID = ? group by ListingID";
      $result = $conn -> execute_query($sql, [$listingid]);
      $row = $result -> fetch_row();
        $title = $row[1];
    ?>
    <title><?php echo $title; ?></title>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <script src="https://kit.fontawesome.com/1622b82e7e.js" crossorigin="anonymous"></script>
    <style>
      .displayCentered {
          text-align: center;
      }

.listingDisplay {
            display: block;
  background-color: #E8E8E8;
  /* margin-bottom: 10px; */
  padding: 10px;
  padding-left: 30px;
  padding-right:30px;
  
  border: 1px solid #ccc;
  border-radius: 17px 17px 0 0;
  /* justify-content: center; */
  text-align: left;
  /* margin-left: 0 auto; */
  /* margin: 0 auto;
  contain: center; */
  margin-left: 20px;
  margin-right: 20px;
  margin-top: 20px;
}

.rateFav {
    display: block;
  background-color: #E8E8E8;
  /* margin-bottom: 10px; */
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 0 0 17px 17px;
  /* justify-content: center; */
  text-align: center;
  /* margin-left: 0 auto; */
  /* margin: 0 auto;
  contain: center; */
  margin-left: 20px;
  margin-right: 20px;
  /* margin-top: 20px; */
}

#flex { display: flex; flex-direction: column; }
    #a { order: 1; }
    #b { order: 2; }

        @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
        /* Star Rating */
            .rate {
                display: inline-block;
                border: 0;
            }
            .rate > input {
                display: none;
            }
            .rate > label {
                float: right;
            }
            .rate > label:before {
                display: inline-block;
                font-size: 2rem;
                padding: .3rem .2rem;
                margin: 0;
                cursor: pointer;
                font-family: FontAwesome;
                content: "\f005 "; 
            }
            .rate .half:before {
                content: "\f089 "; 
                position: absolute;
                padding-right: 0;
            }
            input:checked ~ label, 
            label:hover, label:hover ~ label { color: #FFC700;  } 
            input:checked + label:hover, input:checked ~ label:hover, 
            input:checked ~ label:hover ~ label, 
            label:hover ~ input:checked ~ label  { color: #FFC700;  } 
        }

        
    </style>
  </head>
  <body>
    <?php
        include("header.php");
    ?>
    
       <div class="allDisplay" id="flex">
        <div class="rateFav" id="b">
       <fieldset class="rate" id = "rate">
            <input type="radio" id="rating10" name="rating" value="10" /><label for="rating10" title="5 stars"></label>
            <input type="radio" id="rating9" name="rating" value="9" /><label class="half" for="rating9" title="4 1/2 stars"></label>
            <input type="radio" id="rating8" name="rating" value="8" /><label for="rating8" title="4 stars"></label>
            <input type="radio" id="rating7" name="rating" value="7" /><label class="half" for="rating7" title="3 1/2 stars"></label>
            <input type="radio" id="rating6" name="rating" value="6" /><label for="rating6" title="3 stars"></label>
            <input type="radio" id="rating5" name="rating" value="5" /><label class="half" for="rating5" title="2 1/2 stars"></label>
            <input type="radio" id="rating4" name="rating" value="4" /><label for="rating4" title="2 stars"></label>
            <input type="radio" id="rating3" name="rating" value="3" /><label class="half" for="rating3" title="1 1/2 stars"></label>
            <input type="radio" id="rating2" name="rating" value="2" /><label for="rating2" title="1 star"></label>
            <input type="radio" id="rating1" name="rating" value="1" /><label class="half" for="rating1" title="1/2 star"></label>
        </fieldset>
        <p id = "ratestatement"></p>
        <br>
        
        

        <label for="favorite">Favorite</label>
    <input type ="checkbox" id="favorite" name="favorite" value="Favorite">
    <?php
      
      $listingid = $_GET['listingid'];
      if(!isset($_SESSION['user']) || $_SESSION['user'] == ""){
            $userid = "na";
      }else{
      $sql = "Select UserID from Users where Username = ?";
      $result = $conn ->execute_query($sql, [$_SESSION['user']]);
      if($result -> num_rows == 1){
      $row = $result -> fetch_row();
      $userid = $row[0];
      }else{
        $userid = 0;
      }
      }
      $sql = "Select Rating from Ratings where ListingID = ? AND UserID = ?";
      if($userid != "na"){
            $result = $conn -> execute_query($sql, [$listingid, $userid]);
            if($result != false){ #There is a result, so we can set the initial rating to what the result is
            $row = $result -> fetch_row();
            $rating = $row[0];
            }
            else{ #If there is no result here, then they have not rated it yet, so set initial rating to zero.
                $rating = 0;
            }

      }else{
            $rating = 0;
      }
      
      $sql = "Select * From Favorites where UserID = ? AND ListingID = ?";
      if($userid != "na"){
            $result = $conn -> execute_query($sql, [$userid, $listingid]);
            if($result != false && $result->num_rows != 0){
                $checked = true;
            }else{
                $checked = false;
            }
      }else{
            $checked = false;
      }
      echo("
      <script>
      let buttonsinit = document.getElementsByName('rating')
      let favorite = document.getElementById('favorite')
      for(i = 0; i < buttonsinit.length; i++){
            if(buttonsinit[i].value/2 == $rating)
                buttonsinit[i].checked = true
      }
      if($checked){
            favorite.checked = true;
      }
      </script>
      ");
      ?>
      </div>
      <div class="displayCentered">
      <div class="listingDisplay" id="a">
        <br>
      <?php
     
      echo("<span id = 'metadata' title = '$listingid&$userid'></span>");
      $sql = "Select DISTINCT Listings.ListingID, Name, PostDate, StartDate, EndDate, Salary, url, Listings.Description, recurring, AVG(Rating) as Rating, COUNT(Rating) as numRating, PositionName, Location
    from Listings left outer join Ratings on Listings.ListingID = Ratings.ListingID left outer join Positions on Positions.PositionID = Listings.PositionID where Listings.ListingID = ? group by ListingID";
      $result = $conn -> execute_query($sql, [$listingid]);
      while($row = $result -> fetch_row()){
        $numfields = mysqli_num_fields($result);
        echo("");
            echo("<b><u>$row[1]</u><span class ='material-symbols-outlined'><a href='php/reportListing.php?listingid=".$row[0]."'>Flag</a></span></b>");
            echo("<br>");
            echo("<br />Date Posted: <b>$row[2]</b>");
            echo("<br />Opportunity Type: <b>$row[11]</b>");
            echo("<br />Starts on <b>$row[3]</b> <br>Ends on <b>$row[4]</b>");
            if($row[8] == 1){
                echo("<br />Opportunity Recurring");
            }
            else{
                echo("<br />Opportunity Not Recurring");
            }
            echo("<br />Location: <b>$row[12]</b>");
           
            echo("<br />Salary is <b>$$row[5] per hour</b>");
            if($row[6] != "blank"){
              echo("<br />Link to apply: <a href='$row[6]'>$row[6] </a>");
          }
          
          
          echo("<br />Average Rating: <b>$row[9] (from $row[10] ratings)</b>");

            echo("<br /><br /><u>Opportunity Description:</u><br/> $row[7]");
           
            echo("<br/>");
            
            //for($i = 0; $i < $numfields; $i++){
                //if($i == 0){
                    //continue;
                //}
                //echo($result->fetch_field_direct($i)->name.": ".$row[$i]."<br />");
            //}
      }
      
    ?>
    <!-- </div>
    <div class="rateFav"> -->
    <!-- Star Rating -->
    <!-- <center> -->
        
      <!-- </center> -->
      </div>
    </div>
    </div>
    
    <!-- </center> -->
    <br />
    <script>
    let rate = document.getElementById('rate')
    let buttons = document.getElementsByName('rating')
    let text = document.getElementById("ratestatement");
    let metadata = document.getElementById("metadata").title;
    let metadataarr = metadata.split("&")
    let listingid = metadataarr[0]
    let userid = metadataarr[1]
    rate.addEventListener("click", function(){
    for(i = 0; i < buttons.length; i++){
        if(buttons[i].checked){
            let rating = (buttons[i].value)/2
            if(userid == "na"){
                text.innerHTML = "Must be signed in to rate listing!"
            }else if(buttons[i].value != null){
             var xmlhttp = new XMLHttpRequest();
             xmlhttp.onreadystatechange = function(){
                  if(this.readyState == 4 && this.status == 200){
                    text.innerHTML = this.responseText;
                    //  text.innerHTML = "listingid: "+listingid+", userID of "+userid+", rating of "+rating+", response: " + this.responseText;
                  }
             };
             xmlhttp.open("GET", "php/updaterating.php?listing="+listingid+"&userid="+userid+"&rating="+rating, true);
             xmlhttp.send();
             }
    }
       }
    });
    favorite.addEventListener("click", function(){
    if(userid == "na"){
        text.innerHTML = "Must be signed in to favorite a listing!"
    }else{
        if(favorite.checked){ //it was just clicked onto true, so add to favorites
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                  if(this.readyState == 4 && this.status == 200){
                     text.innerHTML = "Favorited!";
                  }
             };
            xmlhttp.open("GET", "php/togglefavorite.php?listing="+listingid+"&userid="+userid+"&value=true", true);
            xmlhttp.send();
        }else{
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                  if(this.readyState == 4 && this.status == 200){
                     text.innerHTML = "Unfavorited!";
                  }
             };
            xmlhttp.open("GET", "php/togglefavorite.php?listing="+listingid+"&userid="+userid+"&value=false", true);
            xmlhttp.send();
        }
    }});
    
    </script>
    
    <?php
      include('footer.php');
    ?>
  </body>
</html>
