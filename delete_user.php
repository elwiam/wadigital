<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "../config/db.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM users WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            echo "<script>
            alert('Utilisateur suprimé');
            window.location.href = 'users.php';
            </script>";
            exit();
        } else{
            echo "Oops! Erreur survenue";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
 
  
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
                        <li class="breadcrumb-item active">Suprimer utilisateur</li>
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
                
                            <div class="col-md-12">

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="alert alert-danger fade in">
                      

                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>

                            <p>Voulez vous suprimer l'utilisateur?</p><br>
                            <p>
                                <input type="submit" class="btn btn-outline-danger" value="Oui">
                                <button type="button"class="btn btn-outline-secondary"type="submit"onclick="window.location.href = 'users.php';">Non</button>
                            </p>
                        </div>
                    </form>
                    </div>
                          </div>
                        </div>
                    </div>
    
              <!-- End PAge Content -->
                </div>
                <!-- End Container fluid  -->
                <!-- footer -->
              
            <!-- End Page wrapper  -->
        </div>
        <!-- End Wrapper -->
        
         <!-- Java Scripts -->
               <?php include('includes/js.php');?> 
         <!-- End Java Scripts -->
    
    </body>
    
    </html>