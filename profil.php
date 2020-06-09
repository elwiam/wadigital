
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

//include config
require_once('../config/db.php');

?>
 <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
     <!-- Style Sheet -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
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
                        <li class="breadcrumb-item active">Utilisateurs</li>
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
                                <div class="table-responsive">
                                
                <div class="wrapper">
               <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                
                <table class="table">




    <?php
                    // Include config file
                    require  "../config/db.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM users";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo 
                            "<table class='table table-bordered table-striped table-hover '>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Id</th>";
                                        echo "<th>Nom d'utilisateur</th>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Prénom</th>";
                                        echo "<th>Téléphone</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Mot de passe</th>";
                                        
                                    echo "</tr>";
                                echo "</thead>";
                               
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['firstname'] . "</td>";
                                        echo "<td>" . $row['lastname'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['password'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='read_user.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'> <span class='fas fa-eye'style='color:#2ECC71  ;' ></span></a>";
                                        echo "<a href='edit_user.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span  class='fas fa-edit'  style='color:#F39C12 ;'></span></a>";
                                        echo "<a href='delete_user.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='fas fa-trash-alt'  style='color: #E74C3C ;'></span></a>";
                                    echo "</td>";
                                       
                                   
                                }
                                echo "</tbody>";                            
                           
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);

                    ?>
                   
                  
                   
                  
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
           
    
    <!-- Java Scripts -->
           <?php include('includes/js.php');?> 
     <!-- End Java Scripts -->
    
</body>

</html>







                          
    
    
