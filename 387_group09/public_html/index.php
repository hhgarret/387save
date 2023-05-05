<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Homepage</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/1622b82e7e.js" crossorigin="anonymous"></script>
    <style>
      html,
      body {
        margin: 0;
      }

button:hover {
  transform: scale(1.1);
}
      .banner {
        background: #14213d;
      }
      .banner__text,
      .banner__close > span {
        color: #ffffff;
      }
      @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
        /* Star Rating */
            
            .rate {
                display: inline-block;
                border: 0;
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
            #checked ~ label, #checked { color: #FFC700;  } 

            #showButton,
            #createButton,
            #updateButton,
            #deleteButton,
            #archiveButton {
              display: inline-flex;
              flex-direction: row;
              background-color: #E8E8E8;
              padding: 15px;
              margin-left: 20px;
              margin-top: 20px;
              border: 1px solid #ccc;
              border-radius: 17px;
              
            }

            .showButtons {
              display: inline;
            }

    </style>

  </head>
  <body>
    <!-- Banner -->
<?php
      include 'header.php';
    ?>
    <center>
    <div class="showButtons">
    <button class="showListings" id="showButton" type="button">
        <a href="listings.php"> Show All Listings </a> 
    </button>
    
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
          </center>
    <!-- Listings Buttons -->
    <!-- <div class="listings">
      <div class="listings__content">
        <div class="listings__text">
          <strong>Research Listings</strong>
          <strong>Job Listings</strong>
          <strong>Internship Listings</strong>
        </div>
        <button class="banner__login" type="button">
          <span class="material-icons"> <a href="listings.php"> science </a> </span>
        </button>
        <button>
          <span class="material-icons"> <a href="listings.php"> work </a> </span>
        </button>
        <button>
          <span class="material-icons"> <a href="listings.php">badge</a> </span>
        </button>
      </div> -->
      <div class = "test_show_listings">
      <style > 
.test_show_listings {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 60px;
    height: 100%;
    margin-top: -40px;
  }
  .box {
    width: 1500px;
    height:500px;
    max-width: 100%;
    margin: 0 10px;
    padding: 20px;
    text-align: justify;
    background: transparent;
    border: 2px solid #14213d;
  }
.job-title {
  font-size: 35px;
  text-align: center;
  display: flex;
  justify-content: center;
  border-bottom: 1px solid #14213d;
  padding-bottom: 10px;
  margin-bottom: 20px;
}
.title-underline {
        width: 70%;
        height: 2px;
        margin: 0 auto;
        background-color: #14213d; /* Add a background color to the line */
      }
.listing {
  background-color: #E8E8E8;
  margin-bottom: 10px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 17px;
}
     </style>
      <?php
      echo("<br />");
      $positionid = 1;
      echo("<div id = 'position1' class = 'box' style = 'overflow-y: scroll;'>");
      echo("<span class='job-title'><b>All Internships: </b></span></br>");
      echo("<div class='listing'>");
      include('php/showtypelisting.php');
      echo("</div>");
      echo("</div>");
      $positionid = 2;
      echo("<div id = 'position2' class = 'box' style = 'overflow-y: scroll;'>");
      echo("<span class='job-title'><b>All jobs: </b></span></br>");
      echo("<div class='listing'>");
      include('php/showtypelisting.php');
      echo("</div>");
      echo("</div>");
      $positionid = 3;
      echo("<div id = 'position3' class = 'box' style = 'overflow-y: scroll;'>");
      echo("<span class='job-title'><b>All Research Positions: </b></span></br>");
      echo("<div class='listing'>");
      include('php/showtypelisting.php');
      echo("</div>");
      echo("</div>");
      ?>
      </div>
    </div>
    <?php
      include 'footer.php';
    ?>
  </body>
</html>

