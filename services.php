<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}?>
<!DOCTYPE html>
<html lang="fr">
    <head>
   
<?php include('includes/css.php');?> 
     
</head>
    <body>

   
<div class="bgimg">
  <div class="topleft">
  <p><a href="/Admin/dashboard.php"><img src="/images/logosite7.png" alt="logo"  class="dark-logo" /></a></p>
 
</div>
  
 
</div>
</body>
</html>

