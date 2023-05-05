<!DOCTYPE html>
<html lang="en">
<?php 
    require_once("/home/group9/init.php");
  ?>
<head>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <!-- favicon -->
  <link rel="shortcut icon" href="otvfavicon.ico" type="image/x-icon">
  <link rel="icon" href="otvfavicon.ico" type="image/x-icon">
</head>
<style>
  html,
  body {
    margin: 0;
    margin-bottom: %;
  }

  .banner {
    background: #14213d;
    height: 85px;
    left: 0;
    right: 0;
  }

  .banner__text {
    /* text-align: center;
    color: #ffffff;
    display: flex;
    
    margin: auto;
    position: absolute;
    top: 30px;
    justify-content: center; */
    display: flex;
    justify-content: center;
    color: #ffffff;
    margin-top: -3%;
    /* vertical-align: fixed;
    resize: none; */
    
  }
  .banner__close > span {
    color: #ffffff;
    
  }

  .logo {
    /* display: block;
    vertical-align: bottom;
    float: left; */
    top: 11px;
  left: 20px;
  margin: auto;
  /* position: absolute; */
  /* pointer-events: all; */
  right: 0;
  /* min-width: 3%; */
  /* text-align: center; */
  /* top: -23px; */
  }

  .icons {
    display: flex;
    margin-top: -2%;
    background-color: #14213d;
    justify-content: right;
    vertical-align: fixed;

    /* position: relative;
    
    z-index:1; */
    
    /* position: absolute; */
   
    /* margin-right: 500px;
    display: inline-block; */
    /* align-items: center; */
  }
  button{
    margin:0;
    border: 0;
    background: 0;
  }
  
  .banner__account {
    margin-right: 10px;
  }

  .banner__account-signout{
      /* display: flex;
      
      align-content: right;
      margin-left: auto;
      margin-right: 500px; */
      
      
  }

  /* .icons a:link,
  a:visited {
    text-decoration: none;
    color: blue;
    background-color: transparent;
  } */

  

  .banner a:link {
    text-decoration: none;
    color: white;
  }

  .banner a:visited {
    text-decoration: none;
    color: white;
  }

  

</style>
<body>
  
  <div class="banner">
    
      <div class="logo">
        <a href="index.php"><img src="OfflineTV_2021_logo.svg.png" alt="Logo" width="3%" height="3%"></a>
      </div>
      
      <!-- <a href="index.php"><span class="material-icons"> work_outline OTV</span></a> -->
     
      <div class="banner__text">
        
        <?php 
          echo("           ");
          if(isset($_SESSION) && $_SESSION['user'] != ""){
            echo("<strong>You are signed in as ".$_SESSION['user']."</strong>");
          } else{
            echo("<strong>You are not signed in.</strong>");
          }
          $page = explode("/", $_SERVER['SCRIPT_NAME'])[2];
          if(!isset($_SESSION['user']) && ($page == 'createListing.php' || $page == 'account.php' || $page == 'updateListing.php' || $page == 'deleteListing.php' || $page == "archive.php")){
            echo("<script src='js/boottosignin.js'></script>");
          } else if($page == 'ajax.php' && $_SESSION['user'] != "admin"){
            echo("<script src='js/boottosignin.js'></script>");
          }
        ?>
        
      </div>
    <div class="icons">
        
      <?php
          if(!isset($_SESSION['user']) || $_SESSION['user'] == ""){
            echo('
            <button class="banner__login" type="button">
            <span class="material-icons"> <a href = "signin.php">login</a> </span>
            </button>');
          } else {
            echo('
          <div class="banner__account-signout">
            <button class="banner__signOut" type="button">
              <span class="material-symbols-outlined"> <a href = "account.php"> account_circle </a> </span>
               </button>
                <button class="banner__signOut" type="button">
              <span class="material-symbols-outlined" id="so"> <a href = "php/signout.php" onclick="return confirm(\'Are you sure you want to signout? \')">logout</a> </span>
                </button>');
                if($_SESSION['user'] == "admin") {
              echo("<button class='banner__signOut' type='button'>
              <span class='material-symbols-outlined'> <a href = 'ajax.php'>AJAX Interface</a> </span>
               </button>");
            }}

    
          echo('</div>');

      ?>
      
    </div>
  </div>
  <?php
  if(isset($_SESSION['message'])){
            echo($_SESSION['message']);
            unset($_SESSION['message']);
     }
  ?>
</body>
</html>
