<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "./config/db.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM projets WHERE id = 1";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $title = $row["title"];
                $type = $row["type"];
                $content = $row["content"];
                $role = $row["developer"];
                $date= $row["date"];
                $client = $row["client"];
                $website = $row["website"];
               
                $image="images/".$image;
            } 
            
            } 
          
        } else{
            echo "Oops! une erreur survenue.";
        }

    // Close statement
      mysqli_stmt_close($stmt);
      
      // Close connection
      mysqli_close($link);
    } 
    ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration des Projets</title>
  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
   
 
    <!-- Style Sheet -->
    <?php include('includes/css.php');?> 
     <!-- Style Sheet -->

<!------ Include the above in your HEAD tag ---------->

 
  

</head>

<body>
    
    
<body class="fix-header fix-sidebar">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
        <!-- Main wrapper  -->
      <div id="main-wrapper">

        <!-- Menu -->  
        
         <?php include('includes/menu.php');?> 
        <!-- End Menu -->
          
                      
               <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->

            <div id="wrapper">
	
		
            <div class="row page-titles">
              
                <div class="col-md-7 align-self-center">
                    
                        
               <h2>Les projets</h2>      
                    
                </div>
            </div>
                <!-- Start Page Content -->
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
                    $sql = "SELECT * FROM projets";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo 
                            "<table class='table table-bordered table-striped table-hover '>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Id</th>";
                                        echo "<th>Titre</th>";
                                        echo "<th>Type</th>";
                                        echo "<th>Contenu</th>";
                                        echo "<th>Image</th>";
                                        echo "<th>Role</th>";
                                        echo "<th> La Date</th>";
                                        echo "<th> Client</th>";
                                        echo "<th> Website</th>"; 
                                        echo "</tr>";
                                        echo "</thead>";
                               
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['type'] . "</td>";
                                       
                                        echo "<td>" . $row['content'] . "</td>";
                                        echo "<td>" . $row['image'] . "</td>";
                                   
                                        echo "<td>" . $row['developer'] . "</td>";
                                        echo "<td>" . date("d/m/Y", strtotime($row['date'])) . "</td>";
                                        echo "<td>" . $row['client'] . "</td>";
                                        echo "<td>" . $row['website'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'> <span class='fas fa-eye'style='color:#2ECC71  ;' ></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span  class='fas fa-edit'  style='color:#F39C12 ;'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='fas fa-trash-alt'  style='color: #E74C3C ;'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
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
           
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> Copyrights &copy; <?php echo date("Y"); ?> <a href="http://wa-digital.fr" target="_blank">wa-digital</a>. All Rights Reserved.</footer>
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