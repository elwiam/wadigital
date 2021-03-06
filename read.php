<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "../config/db.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM projets WHERE id = ?";
    
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
                $developer= $row["developer"];
                $date = $row["date"]; 
                $client = $row["client"];
                $website = $row["website"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! une erreur survenue.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
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
    <title> Utilisateurs~ Wa-digital</title>
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
                        <li class="breadcrumb-item"><a href="/Admin/projets.php">Projets</a></li>
                        <li class="breadcrumb-item active">Lire Le Projet</li>
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
                    <form>                       
                    <div class="form-group">
                        <div class="col-md-12">
                        <span style="color:black; background-color: #D6DCE2 ;">    <label class="col-md-12">Titre</label></span>                        
                        <p class="form-control-static"><?php echo $row["title"]; ?></p>
                    </div>
                        </div>
                    <div class="form-group">                    
                        <div class="col-md-12">
                        <span style="color:black; background-color: #D6DCE2 ;"> <label class="col-md-12">Type</label></span>                       
                        <p class="form-control-static"><?php echo $row["type"]; ?></p>
                            </div>
                             </div>
                    <div class="form-group" >                      
                    <div class="col-md-12">
                    <span style="color:black; background-color: #D6DCE2 ;"> <label class="col-md-12">Contenu</label></span>                       
                        <p class="form-control-static" rows = '10' cols = '80'  type="text" name="content" ><?php echo $row["content"]; ?></p>
                    </div>
                            </div>
                            <div class="form-group">                    
                    <div class="col-md-12">
                    <span style="color:black; background-color: #D6DCE2 ;"> <label class="col-md-12">Développeur</label></span>                   
                    <p class="form-control-static"><?php echo $row["developer"]; ?></p>
                        </div>
                         </div>
                         <div class="form-group">                    
                    <div class="col-md-12">
                    <span style="color:black; background-color: #D6DCE2 ;"> <label class="col-md-12">Date de projet</label></span>            
                    <p class="form-control-static"><?php echo date("d/m/Y", strtotime($row['date'])); ?></p>                   
                         </div>
                         <div class="form-group">                    
                    <div class="col-md-12">
                    <span style="color:black; background-color: #D6DCE2 ;"> <label class="col-md-12">Client</label></span>                  
                    <p class="form-control-static"><?php echo $row["client"]; ?></p>
                        </div>
                         </div>
                         <div class="form-group">                    
                    <div class="col-md-12">
                    <span style="color:black; background-color: #D6DCE2 ;"> <label class="col-md-12">Website</label></span>                   
                    <p class="form-control-static"><?php echo $row["website"]; ?></p>
                        </div>
                         </div>
                    <div class="form-group">
                    <div class="col-md-12">                    
                        <span style="color:black; background-color: #D6DCE2 ;"> <label class="col-md-12">Image</label></span>                      
                        <p class="form-control-static">
                        <img src="images/<?php  echo $row["image"] ?>" width="400" height="400"/>'</p>                   
                               </div>
                              </div>                      
                    <div class="form-group align-self-center">
                     <div class="col-sm-12">
                                        </br>
                                        <a href="projets.php" type="submit" name='submit' value='Submit'class="btn btn-success">Back</a>                                      
                                    </div>
                                </div>
                                </table>
                                 </div>                            
                            </div>
                        </div>
                    </div>
                   </div>   
                    <!-- End PAge Content -->
                </div>       
         <!-- Java Scripts -->
               <?php include('includes/js.php');?> 
         <!-- End Java Scripts -->
    
    </body>
    
    </html>