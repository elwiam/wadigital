<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

// Include config file
require_once "../config/db.php";

?>
<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
 
    <!-- Style Sheet -->
           <?php include('includes/css.php');?> 
     <!-- Style Sheet -->
    
</head>

<body class="fix-header fix-sidebar">
    
        <!-- Main wrapper  -->
      <div id="main-wrapper">
          
        <!-- Menu -->
           <?php include('includes/menu.php');?> 
        <!-- End Menu -->
    
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->

            <div id="wrapper">
	
		
            <div class="row page-usernames">
               
                   
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/Admin/dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Ajouter nouveau profil</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->

                
                <div class="row">
				    <div class="col-lg-12">
                        <div class="card">

                            <?php

// Include config file
require_once "../config/db.php";
 
// Define variables and initialize with empty values
$password = $username =$lastname=$firstname=$phone=$email="";
$password_err = $username_err =$lastname_err=$firstname_err=$phone_err=$email_err="";
 

if(!empty($_POST)){

    $username = trim($_POST['username']);
    $lastname= trim($_POST['lastname']);
    $firstname = trim($_POST['firstname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
   
    // Hachage for password

$password = password_hash($_POST['password'],  PASSWORD_DEFAULT);


   
  //if form has been submitted process it
        if(isset($_POST['submit'])){

    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Attempt insert query execution
    $sql = "INSERT INTO users (username,password,firstname,lastname,phone,email) VALUES ('$username','$password','$firstname','$lastname','$phone','$email');";

        if(mysqli_query($link, $sql)){
            echo "<script>
            alert(' Utilisateur ajouté');
            window.location.href = 'users.php';
            </script>";
           

    

        } else{

            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }

    // Close connection
    mysqli_close($link);

    }
}



?>
     
                            <div class="card-body">
                            <form action="new_user.php" method="post"enctype="multipart/form-data">
                                            <div class="form-group">
                                          <span> <label class="col-md-12">Nom d'utlisateur</label></span>     
                                                <div class="col-md-12">
                                                    <input type="text" required name='username' value='<?php if(isset($error)){ echo $_POST['username'];}?>' placeholder="Entrer votre nom d'utilisateur" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                           <span> <label class="col-md-12">Nom</label></span>    
                                                <div class="col-md-12">
                                                    <input type="text" required name='lastname' value='<?php if(isset($error)){ echo $_POST['lastname'];}?>' placeholder="Entrer votre nom de famille" class="form-control form-control-line">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                         <span><label class="col-md-12">Prénom</label></span> 
                                                <div class="col-md-12">
                                                    <input type="text" required name='firstname' value='<?php if(isset($error)){ echo $_POST['firstname'];}?>' placeholder="Entrer votre prénom" class="form-control form-control-line">
                                                </div>
                                            </div>

                                     
                                            <div class="form-group">
                                         <span><label class="col-md-12">Téléphone</label></span>  
                                                <div class="col-md-12">
                                 <input type="tel"name="phone"pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" required value='<?php if(isset($error)){ echo $_POST['phone'];}?>' placeholder="Entrer votre numéro de téléphone" class="form-control form-control-line">
                                                </div>
                                            </div>
                                           
                                            <div class="form-group">
                                           <span><label class="col-md-12">Email</label></span>     
                                                <div class="col-md-12">
                                                    <input type="text" required name='email' value='<?php if(isset($error)){ echo $_POST['email'];}?>' placeholder="Entrer votre email" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                          <span> <label class="col-md-12">Mot de passe</label></span>      
                                                <div class="col-md-12">
                                                    <input type="password" required name='password' value='<?php if(isset($error)){ echo $_POST['password'];}?>' placeholder="Entrer votre mot de passe" class="form-control form-control-line">
                                                </div>
                                            </div>
                                           
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" name='submit' value='Ajouter_utilisateur' class="btn btn-outline-success">Valider</button>
                                                    
                                                    <button type="button"class="btn btn-outline-secondary"type="submit"onclick="window.location.href = 'users.php';">Annuler</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                            
                            
                        </div>
                    </div>
                </div>



                </div>


                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> Copyrights &copy; <?php echo date("Y"); ?> <a href="http://wa-digital.fr" target="_blank">Wa-digital</a>. All Rights Reserved.</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    
     <!-- Java Scripts -->
           <?php include('includes/js.php');?> 
     <!-- End Java Scripts -->

</body>

</html>