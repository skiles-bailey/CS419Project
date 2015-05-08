<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Main</title>
    <link rel="stylesheet" href="smbStyle.css">
  </head>
  
  <body>
    <div class="banner">
      Vote with your Wallet!
    </div>
    <div class="loginBar">
      <?php
      if (isset($_SESSION['username'])) {
          echo 'Hi ' . "$_SESSION[username]" . '!';
          echo '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;';
          echo '<a href="logout.php">logout</a>';
      }
      else {
          echo '<a href="login.php">Login / Create Account</a>';
      }
      ?>
    
    <div id="loginPadding"></div>
    
    <form method="post" action="createAcct.php">
      <div id="loginCenter">
        <fieldset id="createAcct">
          <legend>Create Account</legend>
          <div>
            <label>Username:</label>
            <input type="text" name="newUsername">
          </div>
          <div>
            <label>Password:</label>
            <input type="password" name="newPassword1">
          </div>
          <div>
            <label>Retype password:</label>
            <input type="password" name="newPassword2">
          </div>
          <div>
            <input type="submit" name="CreateAcct" value="Create Account">
          </div>
          <div id="errorMsg2"><br></div>
        </fieldset>
      </form>
       
      <form method="post" action="authenticate.php">
        <fieldset id="login">
          <legend>Login</legend>
          <div>
            <label>Username:</label>
            <input type="text" name="username">
          </div>
          <div>
            <label>Password:</label>
            <input type="password" name="password">
          </div>
          <div>
            <input type="submit" name="Login" value="Login">
          </div>
          <div id="errorMsg1"><br></div>
        </fieldset>
      </form>
    </div>
          
  </body>
</html>