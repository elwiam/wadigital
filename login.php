<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["username"]) && $_SESSION["password"] === true){
   
    header("location:/admin/dashboard.php");

  exit;

}

// Include config file
require_once "../config/db.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Entrer Votre Nom";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Entrer Votre Mot de Passe";
    } else{

        $pswd = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($pswd, $password)){

                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: dashboard.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Votre mot de passe est incorrect";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "le nom de l'utilisateur n'existe pas ";
                }
            } else{
                echo "Oops! Réssayer une autre fois ";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Se connecter</title>
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
		    <h2 class="text-center">Se connecter</h2>
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label for="exampleInputEmail1" >Nom d'utilisateur</label>
            
                <input type="text" name="username"pattern="^[A-Za-z '-]+$"  maxlength="20" class="form-control" required value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                 <label for="exampleInputPassword1">Mot de passe</label>
                <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{,}" required name="password"  class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>

            <div class="form-check">
   
                <button type="submit" class="btn btn-login float-right" value="Login">Se connecter</button>
          <br>
         
          <p><a href="mdp_forget.php" name="oublie">Mot de passe oublié</a><span class="fontawesome-arrow-right"></span></p>
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