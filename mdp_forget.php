<?php
session_start();
include ('../config/db.php');

if(isset($_SESSION["username"]) && $_SESSION["email"] === true){
header('Location: login.php');
 exit;
}
 
if(!empty($_POST)){
	extract($_POST);
	$valid = true;

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="/Admin/css/style1css.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  
</head>

  <body>

   <!-- Form -->
   <section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		   <h2 class="text-center">Mot de passe oublié</h2>
         
<form action="mdp_mailer.php" method="post" class="login100-form validate-form flex-sb flex-w"name="form1" id="form1"
             onsubmit="MM_validateForm('email','','RisEmail','','R','verif_box','','R','','R')
            ;return document.MM_returnValue">


        <div class="form-group">  
<label for="exampleInputEmail1"> Adresse email</label>

  <?php
if (isset($er_email)){
?>
<div><?= $er_email ?></div>
<?php
}
?>
 <input  name="email" type="email" class="form-control"required id="email"placeholder=" Votre Email*"value="<?php if(isset($email)){ echo $email; }?>"/>
 
            </div>
              
            
             
            <?php
              if (isset($_POST['email']))
  {
    $_POST['email'] = htmlspecialchars($_POST['email']);

 
      if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $_POST['email']))
        {
          $email = $_POST['email'];

        }
      else
        {
          $email = "Adresse email invalide!";
        }
  }
else
  {
    $email = "";
  }
  ?>
            
            <?php if (isset($error)) {
                      echo"<div class='alert alert-danger' role='alert'>
                      <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>".$error."</div>";
                 } ?>
            <?php if ($message<>"") {
                      echo"<div class='alert alert-danger' role='alert'>
                      <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>".$message."</div>";
                } ?>
            <?php if (isset($message_success)) {
                      echo"<div class='alert alert-success' role='alert'>
                      <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>".$message_success."</div>";
                  } ?>

<div class="form-group">
<label for="exampleInputCode">Code</label>
   
<img src="verrfimg_mail.php?<?php echo rand(0,9999);?>" alt="verification image, type it in the box" width="100" height="30" style="vertical-align:middle" /><br />
            
                </div>
            


                <div class="form-group">


<input name="verif_box" type="text" id="verif_box" required placeholder=" saisissez le code* "class= "input100" type="text" name="code"/>
           
                </div>  
          
             
             <!-- if the variable "wrong_code" is sent email previous page then display the error field -->
              
            <?php if(isset($_GET['wrong_code'])){?>
            <div style="border:1px solid #990000; background-color:#D70000; color:#FFFFFF; padding:4px; padding-left:6px;width:295px;">erreur dans verification code</div><br />
            <?php ;}?>
            
         
            <div class="form-check">
            <button type="submit" name="submit"class="btn btn-login float-right" value="Valider">Valider</button>
        <br>
        <p><a href="login.php">Se connecter</a><span class="fontawesome-arrow-right"></span></p>
      
            </div>
 
  <div class="copy-text">
    
    <p>
    
    wa-digital.fr Copyright &copy;<script>
    document.write(new Date().getFullYear());
    </script> All rights reserved </i>
    
    </p></div>
            </form>

            </div>


<div class="col-md-8 banner-sec">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    
<div class="carousel-inner" role="listbox">

<img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="image">

    
        </div>	   

 </div>
</div>
            </div>
</div>
</section>
</body>
</html>