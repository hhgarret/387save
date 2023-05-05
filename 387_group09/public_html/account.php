<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Account</title>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
   <style>
    #createButton,
            #updateButton,
            #deleteButton,
            #archiveButton {
              display: inline-flex;
              flex-direction: row;
              background-color: #E8E8E8;
              padding: 10px;
              /* margin-left: 20px; */
              margin-top: 10px;
              border: 1px solid #ccc;
              border-radius: 17px;
              
            }

            .showButtons {
              display: inline;
            }
    /* CSS for collapsible */
      .collapsible {
        font-family: "Helvetica Neue", Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
        color: #333;
        background-color: white;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        border-radius: 17px;
      }

      .active, .collapsible:hover {
        background-color: #D3D3D3;
      }

      .content {
        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;
        border-radius: 17px;
      }
    </style>
  </head>
  <body>
    <?php
      include 'header.php';
    ?>
    <div class="accountTab">
        <div class="accountTitle">
          <strong>My Account</strong>
        </div>
        <div class="Account">
          <form action="php/updateAccount.php" method="post" autocomplete="off">
           
          <!-- Email -->
          <b>Email: </b><!-- This will display the user's current email -->
            <!-- Change Email Button -->
            <button type="button" class="collapsible">Change Email</button>
              <div class="content">
                  <label for="email">New Email:</label>
                    <input autocomplete="new-password" type="email" name="emailChange" title="Email" >
                  
                    <label for="email">Confirm New Email:</label>
                    <input autocomplete="new-password" type="email" name="emailConfirmNew" title="Email" >
                  
                  <input class="change_email" type="submit" value = "Change Email" name='email'>
              </div> 
            
          <!-- Username -->
          <b>Username: </b><!-- This will display the user's current username -->
          
            <!-- Change Username Button -->
            <button type="button" class="collapsible">Change Username</button>
              <div class="content">
              <label for="usernameChange">Change Username:</label>
                <input autocomplete="new-password" type="string" name="usernameChange"
                  pattern="[A-Za-z0-9_]{1,15}"
                  title="Username must only contain uppercase and lowercase letters, numbers, underscores, and no more than 15 characters" 
                >   

              <label for="usernameConfirmNew">Confirm New Username:</label>
                <input autocomplete="new-password" type="string" name="usernameConfirmNew"
                  pattern="[A-Za-z0-9_]{1,15}"
                  title="Username must only contain uppercase and lowercase letters, numbers, underscores, and no more than 15 characters" 
                >
            
                <input class="change_username" type="submit" value = "Change Username" name='username'>
              </div> 
            
          <!-- Password -->
          <b>Password: </b> <!-- This will display the user's current password starred out -->
            <!-- Change Password Button -->
            <button type="button" class="collapsible">Change Password</button>
              <div class="content">
                <label for="password">Old Password:</label>
                  <input autocomplete="new-password" type="password" name="passwordOld" 
                  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                  title="Password must match previous password"
                >

                <label for="password">New Password:</label>
                  <input autocomplete="new-password" type="password" name="passwordNew" 
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Password must not match previous password and must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                  >

                <label for="password">Confirm New Password:</label>
                  <input type="password" name="passwordConfirmNew"  
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Password must not match previous password and must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                  >

                <input class="change_password" type="submit" value = "Change Password" name='password'>
              </div> 
              </form>
              <br />
            <!-- JS for collapsible -->
            <script>
              var coll = document.getElementsByClassName("collapsible");
              var i;

              for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                  content.style.display = "none";
                } else {
                  content.style.display = "block";
                }
                });
              } 
            </script>
            
            <hr>
            <!-- Favorited Listings -->
           <b> My Favorite Listings: </b>
           <br>
            <?php
            $username = $_SESSION['user'];
            $sql = "Select DISTINCT Listings.ListingID, Name, PostDate, StartDate, EndDate, Salary, url, Listings.Description
            from Users natural join Favorites left outer join Listings
            on Listings.ListingID = Favorites.ListingID where Users.Username = ?";
    
            $result = $conn -> execute_query($sql, [$username]);
            while($row = $result -> fetch_row()){
                $numfields = mysqli_num_fields($result);
                echo("<br />");
                for($i = 0; $i < $numfields; $i++){
                    if($i == 0){
                      
                        echo("<a href='listingInfo.php?listingid=".$row[0]."'>".$row[1]."</a>, ");
                        
                        $i++;
                        
                        continue;
                    }
                    
                    $field = $result ->fetch_field_direct($i);
                    echo($field->name.": ".$row[$i]);
                    if($i != $numfields-1){
                        echo(", ");
                    }
            }
            echo("<br/>");
      }

            ?>
            <br>
            <br>
            <hr>
            
            <!-- My Listings -->
           <b> My Listings: </b>
           <br>
           <div class="showButtons">
           <button class="create_listing" id="createButton" type="button">
              <a href="createListing.php"> Create Listing </a> 
           </button>

          <button class="update_listing" id="updateButton" type="button">
              <a href="updateListing.php"> Update Listing </a> 
          </button>

          <button class="delete_listing" id="deleteButton" type="button">
              <a href="deleteListing.php"> Delete Listing </a>
          </button>

          <button class="archiveListings" id="archiveButton" type="button">
          <a href="archive.php"> View Archive </a> 
      </button>
    </div>
          <br>

            <?php
            $username = $_SESSION['user'];
            $sql = "Select DISTINCT Listings.ListingID, Name, PostDate, StartDate, EndDate, Salary, url, Listings.Description
            from Listings left outer join Users on Listings.PosterID = Users.UserID where Users.Username = ?";
    
            $result = $conn -> execute_query($sql, [$username]);
            while($row = $result -> fetch_row()){
                $numfields = mysqli_num_fields($result);
                echo("<br />");
                for($i = 0; $i < $numfields; $i++){
                    if($i == 0){
                        echo("<a href='listingInfo.php?listingid=".$row[0]."'>".$row[1]."</a>, ");
                        $i++;
                        continue;
                    }
                    $field = $result ->fetch_field_direct($i);
                    echo($field->name.": ".$row[$i]);
                    if($i != $numfields-1){
                        echo(", ");
                    }
            }
            echo("<br/>");
      }

            ?>



            <?php
            include 'footer.php';
            ?>
  </body>
</html>
