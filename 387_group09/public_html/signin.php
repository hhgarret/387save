<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    
    <style>
      .password-container{
        position: relative;
      }.password-container input[type="password"],
      .password-container input[type="text"]{
        width: 100%;
        padding: 12px 36px 12px 12px;
        box-sizing: border-box;
      }.fa-eye{
        position: absolute;
        top: 28%;
      right: 4%;
      cursor: pointer;
      color: lightgray;
      }
    </style>
  </head>
  <body>
    <!-- Banner -->
<?php
      include 'header.php';
    ?>

    

    <!-- Login -->
    <div class="login__tab">
      <div class="login_title">
        <strong>Sign In</strong>
       
      </div>
      <div class="username">
        <form action="temp.php" method="post">

        <!-- Email -->
          <label for="email">Email:</label>
          <input type="email" name="email" title="Email" required>

        <!-- Password -->
        <div class="password-container">
          <label for="password">Password:</label>
          <input type="password" id="pwd" name="password" 
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
          title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
          required>
          <input type="checkbox" onclick="myFunction()"> Show Password
        </div>
          
        <!-- JS for show password -->
        <script>
          function myFunction() {
          var x = document.getElementById("pwd");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
          } 
        </script>

        <!-- Forgot password -->
          <a href="passwordreset.php">Forgot login?</a>
          
          <input type = "submit" value = "Sign in" />
          
          <hr>
          <p>New User? <a href="createaccount.php">Create Account</a><p>
        
        </form>
      </div>
    </div>
    <?php
      include 'footer.php';
    ?>
  </body>
</html>

