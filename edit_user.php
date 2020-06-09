<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

// Define variables and initialize with empty values
$firstname = $username = $lastname = $email=$phone=$password="";
$firstname_err = $username_err = $lastname_err = $email_err =$phone_err=$password_err="";
// Include config file
require_once "../config/db.php";

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    
    $id = $_GET['id'];
    $get_projet = mysqli_query($link,"SELECT * FROM `users` WHERE id='$id'");
    
    if(mysqli_num_rows($get_projet) === 1){
        /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
        
     $row = mysqli_fetch_assoc($get_projet);
     // Retrieve individual field value
     $firstname = $row["firstname"];
     $username = $row["username"];
     $lastname = $row["lastname"];
     $email = $row["email"];
     $phone = $row["phone"];
     $password = $row["password"];

?>  
  
<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

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
                        <li class="breadcrumb-item"><a href="/Admin/users.php">Utilisateurs</a></li>
                        <li class="breadcrumb-item active">Editer utilisateur</li>
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
                        <div class="card-body">
                    
                    <form action="edit_user.php?id=<?php echo $id ;?>" method="post"enctype="multipart/form-data">
                        
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label class="col-md-12">Nom d'utilisteur</label>
                    <div class="col-md-12">
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err;?></span>
                        </div>
                          </div>

                        <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">

                        <label class="col-md-12">Nom</label>
                    <div class="col-md-12">
                            <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                            <span class="help-block"><?php echo $lastname_err;?></span>
                        </div>
                            </div>

                        <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">

                        <label class="col-md-12">Prénom</label>
                    <div class="col-md-12">
                            <input type="text" name="firstname" class="form-control"value="<?php echo $firstname; ?>">
                            <span class="help-block"><?php echo $firstname_err;?></span>
                        </div>
                               </div>

                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                     <label class="col-md-12">Email</label>
                     <div class="col-md-12">
                  
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
         
                        <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                    <label class="col-md-12">Télephone</label>
                    <div class="col-md-12">

                    <input type="tel"  name="phone" class="form-control" value="<?php echo $phone; ?>"required aria-required="true"pattern="0[1-68]([-. ]?[0-9]{2}){4}"title="Votre numéro de téléphone portable"spellcheck="false">
                        
                            <span class="help-block"><?php echo $phone_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label class="col-md-12">Mot de passe</label>
                    <div class="col-md-12">

                            <input type="text" name="password" class="form-control"value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $password_err;?></span>
                        </div>
                            </div>

                        
                        <div class="form-group">
                        <div class="col-sm-12">
                  </br>
                  <button type="submit" name='submit' value='Submit'  class="btn btn-outline-success">Valider</button>
                  <button type="button"class="btn btn-outline-secondary"type="submit"onclick="window.location.href = 'users.php';">Annuler</button>
					  
                              </div>
                        </div>
                    </form>        

<?php
}else{
        // set header response code
        http_response_code(404);
        echo "<h1>404 Page Not Found!</h1>";
    }
    
}else{
    // set header response code
    http_response_code(404);
    echo "<h1>404 Page Not Found!</h1>";
}


/* ---------------------------------------------------------------------------
------------------------------------------------------------------------------ */


// UPDATING DATA

if(isset($_POST['username']) && isset($_POST['email'])){
    
    // check title and content empty or not
    if(!empty($_POST['username']) && !empty($_POST['email'])){
        
        // Escape special characters.
        $username = mysqli_real_escape_string($link, htmlspecialchars($_POST['username']));
        $firstname = mysqli_real_escape_string($link, htmlspecialchars($_POST['firstname']));
        $email= mysqli_real_escape_string($link, htmlspecialchars($_POST['email']));
        $lastname = mysqli_real_escape_string($link, htmlspecialchars($_POST['lastname']));
        $phone= mysqli_real_escape_string($link, htmlspecialchars($_POST['phone']));
     
        //CHECK content IS VALID OR NOT
        if (filter_var($username)) {
            $id = $_GET['id'];
            // CHECK IF content IS ALREADY INSERTED OR NOT
            $check_user = mysqli_query($link, "SELECT `users` FROM `wadig1286358` WHERE firstname= '$firstname' username = '$username'phone = '$phone' lastname = '$lastname' email= '$email' AND id != '$id'");
          
            if(mysqli_num_rows($check_user) > 1){    
                
                echo "<h3>le utilisateur à étè mis à jour </h3>";
            }else{
                
                // UPDATE PROJECT DATA               
                $update_query = mysqli_query($link,"UPDATE `users` SET firstname='$firstname',lastname='$lastname',username='$username',email='$email',phone='$phone' WHERE id=$id");

                //CHECK DATA UPDATED OR NOT
                if($update_query){
                    echo "<script>
                    alert(' utilisateur mis à jour ');
                    window.location.href = 'users.php';
                    </script>";
                    exit;
                }else{
                    echo "<h3>erreur!</h3>";
                }
            }
        }else{
            echo "invalide titre et nom de l'utilisateur";
        }
        
    }

// END OF UPDATING DATA
}
?>
                                 </div>
                             </div>
                        </div>
                    </div>    
                </div>
    
    
 <!-- End Page Content -->
               
               
<!-- Java Scripts -->
     <?php include('includes/js.php');?> 
<!-- End Java Scripts -->
    
    </body>
    
    </html>

 