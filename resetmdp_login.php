<?php

// Include config file
require_once "../config/db.php";

?>
<?php
$error=""; $error1=""; $error2="";
if(isset($_GET['id']) ){
	$id = mysqli_real_escape_string($link,$_GET['id']);

	$query = "SELECT * FROM users WHERE id='$id' AND email='$email'";
    $run = mysqli_query($link,$query);

}else{
	//header("Location:login.php");
}
if (isset($_POST['reset'])) {
	
	$password = mysqli_real_escape_string($link,$_POST['password']);
	$cpassword = mysqli_real_escape_string($link,$_POST['cpassword']);
    if (empty($password) || empty($cpassword)) {
		$error = "<div class='alert alert-danger' style='color:red;'>All The Fields are required !!</div>";
	}elseif(strlen($password) <5 ) {
		$error=  "<div class='alert alert-danger' style='color:red;'>Your password must be atleast 6 characters !!</div>";
		$error1 =  "<span style='color:red; float:right;'>Your password must be atleast 6 characters !!</span>";
	}elseif($password != $cpassword) {
		
		$error2 = "<span style='color:red; float:right;'>mot de passe n'est pas bon  !!</span>";
	}else{
		$pass = password_hash($password, PASSWORD_DEFAULT);
		$query = "UPDATE users SET password='$pass' WHERE id='$id'";
		mysqli_query($link,$query);     
        // UPDATE USERS DATA               
        $update_query = mysqli_query($link,$query);
        if( $update_query){
            echo "<script>
            alert('Initialisation réussite');
            window.location.href = 'login.php';
            </script>";
            exit;
        }
    }
    
}

?>
  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Initialiser le mot de passe</title>
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
		    <h2 class="text-center">Initialiser mot de passe</h2>
    
      
      
        <form action="" method="POST">
         
         <div class="form-group">
         <label for="exampleInputPassword1" >Nouveau Mot de passe</label>
          <input type="password" class="form-control"required name="password" id="password" placeholder="Entrer votre mot de passe">
          <?php echo  $error1; ?>
         </div>
         <div class="form-group">
         <label for="exampleInputPassword1" >Confirmer le mot de passe</label>
          <input type="password" class="form-control" required name="cpassword" id="cpassword" placeholder="Confirmer votre mot de passe">
          <?php echo  $error2; ?>
         </div>

         <div class="form-check">
         
        <button type="submit" class="btn btn-login float-right" name="reset">Valider</button>
        
       
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
</section>
</body>
</html>