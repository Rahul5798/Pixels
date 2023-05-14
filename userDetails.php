<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Profile card</title>
    <link rel="stylesheet" href="./src/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="profile">
        <img src="https://cdn.pixabay.com/photo/2018/11/13/21/43/instagram-3814049__480.png" alt="" class="photo">
        <span class="name"><?php echo $_SESSION['username'];?></span>
        <div class="buttons">
        <a href="logout.php"><button class="button logout" type="submit" name="login">Logout</button></a>           
        </div>

  </body>
</html>
