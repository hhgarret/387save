<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=], initial-scale=1.0" />
    <title>Create Account</title>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f2f2f2;
      }

      /* Banner */
      header {
        background-color: #333;
        color: white;
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 10vh;
      }

      /* Create Account Tab */
      .create__tab {
        margin-top: 50px;
        flex-direction: column;
        align-items: center;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 500px;
        margin: 0 auto;
      }

      .create_account_title {
        font-size: 2rem;
        margin-bottom: 0.1rem;
        text-align: center;
      }

      .create {
        display: flex;
        flex-direction: column;
        align-items: center;

      }

      form {
        display: flex;
        flex-direction: column;
        align-items: left;
        width: 100%;
      }

      label {
        font-size: 1.2rem;
        margin-top: 0.5rem;
        margin-bottom: 0;
        width: 100%;
      }

      input[type="email"],
      input[type="password"],
      input[type="text"] {
        width: 80%;
        height: 2.5rem;
        margin-top: 0.1rem;
        margin-bottom: 0.1rem;
        padding-left: 1rem;
        font-size: 1.2rem;
        border: none;
        border-radius: 5px;
        background-color: #f2f2f2;
      }

      input[type="submit"] {
        width: 80%;
        margin-top: 1rem;
        margin-bottom: 1rem;
        padding: 1rem;
        border: none;
        border-radius: 5px;
        background-color: #333;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
display: block;
margin: 0 auto;

      }

      input[type="submit"]:hover {
        background-color: #555;
      }


   </style>
  </head>
  <body>
    <!-- Banner -->
    <?php
      include 'header.php';
    ?>
    <!-- Create Account Tab -->
    <div class="create__tab">
      <div class="create_account_title">
        <strong>Create Account</strong>
      </div>
      <div class="create">
        <form action="temp.php" method="post">
       
        <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" name="email" title="Email" required>

            <label for="email">Confirm Email:</label>
            <input type="email" name="emailConfirm" title="Email" required>
<hr style="border-top: 1px solid grey; margin-top: 20px; margin-bottom: 20px;">
          <!-- Username -->
            <label for="username">Username:</label>
            <input type="string" name="username" 
            pattern="[A-Za-z0-9_]{1,15}"
            title="Username must only contain uppercase and lowercase letters, numbers, underscores, and no more than 15 characters" 
            required>

            <label for="username">Confirm Username:</label>
            <input type="string" name="usernameConfirm" 
            pattern="[A-Za-z0-9_]{1,15}"
            title="Username must only contain uppercase and lowercase letters, numbers, underscores, and no more than 15 characters" 
            required>
<hr style="border-top: 1px solid grey; margin-top: 20px; margin-bottom: 20px;">
          <!-- Password -->
            <label for="password">Password:</label>
            <input type="password" name="password" 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            title="Password must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
            required>

            <label for="password">Confirm Password:</label>
            <input type="password" name="passwordConfirm"  
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            title="Password must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
            required>

          <input class="create_account" type="submit" value = "Create Account">
            
        </form>
      </div>
    </div>
    <?php
      include 'footer.php';
    ?>
  </body>
</html>

