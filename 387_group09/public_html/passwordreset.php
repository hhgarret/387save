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
    <?php
    
    if(!isset($_POST['submit']) && !isset($_POST['submit2'])){
       echo("
        <form action='passwordreset.php' method='post'>

        <!-- Email -->
          <label for='email'>Email:</label>
          <input type='email' name='email' title='Email' required>

        
          
       

          
          <input type = 'submit' name = 'submit' value = 'Request password change' />
          
        
        </form>
        ");
        }
        else if(!isset($_POST['submit2'])){
            $sql = "Select * FROM Users where Email = ?";
            $result = $conn -> execute_query($sql, [$_POST['email']]);
            if($result -> num_rows == 0){
                # no account with that email.
            }else{
                $code = uniqid();
                $_SESSION['code'] = $code;
                $to      = $_POST['email'];
	            $subject = 'A password reset has been requested';
	            $message = 'Somebody has requested a password change. Please us the code: '.$code.'. If this was not you, please contact admins at group9@turing.cs.olemiss.edu!';
	            $headers = 'From: group9@turing.cs.olemiss.edu' . "\r\n" .
	                   'Reply-To: group9@turing.cs.olemiss.edu' . "\r\n" .
	                   'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $message, $headers);
            }
            
            echo("
                If there is an account with that email, an email has been sent. Please enter the code in that email below.");
            echo("
                <form action='passwordreset.php' method='post'>
                <!-- Email -->
                  <label for='code'>Enter emailed code:</label>
                  <input type='hidden' name = 'email' value='".$_POST['email']."'>
                  <input name='code' title='Code' required>
                  <input type = 'submit' name = 'submit2' value = 'Submit code' />
                </form>
                ");
        }else{
            if($_POST['code'] == $_SESSION['code']){
                echo("Please change your password below!");
                echo("
                <form action='php/updateAccount.php' method='POST'>
           
          <!-- Password -->
          <b>Password: </b> <!-- This will display the user's current password starred out -->
            <!-- Change Password Button -->
            <button type='button'>Change Password</button>
                <input type = 'hidden' name = 'email2' value = '".$_POST['email']."'>
                <label for='password'>New Password:</label>
                  <input type='password' name='passwordNew' 
                    pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
                    title='Password must not match previous password and must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters'
                  >

                <label for='password'>Confirm New Password:</label>
                  <input type='password' name='passwordConfirmNew'  
                    pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
                    title='Password must not match previous password and must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters'
                  >

                <input class='change_password' type='submit' value = 'Change Password' name='passwordbypass'>
              </form>
                
                ");
            }else{
                echo("You have either entered the wrong email, entered the wrong code, or no such account with said email exists.");
            }
        }
        ?>
    <?php
      include 'footer.php';
    ?>
  </body>
</html>
