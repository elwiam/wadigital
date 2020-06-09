<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

// Include config file
require_once "../config/db.php";


 
// Define variables and initialize with empty values
$title = $type = $content =$developer =$date =$client=$website=  $image="";
$title_err = $type_err = $content_err = $image_err =$developper_err=$date_err=$client_err=$website_err="";
 

if(!empty($_POST)){

    $title = $_POST['title'];
    $type = $_POST['type'];
    $content = $_POST['content'];
    $developer = $_POST['developer'];
    $client = $_POST['client'];
    $date= $_POST['date'];
    $website = $_POST['website'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_tmp,"images/$image");

    if(isset($_POST['create'])){

    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Attempt insert query execution
    $sql = "INSERT INTO projets (title,type,content,image,developer,date,client,website) VALUES ('$title','$type','$content','$image','$developer','$date','$client','$website');";

        if(mysqli_query($link, $sql)){

            echo "<script>
            alert('Projet ajouté');
            window.location.href = 'projets.php';
            </script>";
            exit;
        } else{

            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }

    // Close connection
    mysqli_close($link);

    }
}



?>
<?php
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
                        <li class="breadcrumb-item"><a href="/Admin/projets.php">Home</a></li>
                        <li class="breadcrumb-item active">Ajouter Un Projet</li>
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

                
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"enctype="multipart/form-data">
                    
                                               
                    <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                            <label class="col-md-12">Titre</label>
                            <div class="col-md-12">

                            <input type="text" name="title" pattern="^[A-Za-z '-]+$" class="form-control" required value="<?php echo $title; ?>">
                            <span class="help-block"><?php echo $title_err;?></span>
                        </div>
                         </div>

                        <div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
                            <label class="col-md-12">Type</label>
                            <div class="col-md-12">
                            <input type="text" name="type" class="form-control" pattern="^[A-Za-z '-]+$" required  value="<?php echo $type; ?>">
                            <span class="help-block"><?php echo $type_err;?></span>
                        </div>
                           </div>



                        <div class="form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
                            <label class="col-md-12">Contenu</label>
                            <div class="col-md-12">
                            <textarea name="content" class="form-control" required ><?php echo $content; ?></textarea>
                            <span class="help-block"><?php echo $content_err;?></span>
                        </div>
                              </div>


                              <div class="form-group <?php echo (!empty($role_err)) ? 'has-error' : ''; ?>">
                            <label class="col-md-12">Développeur</label>
                            <div class="col-md-12">
                            <input type="text" name="developer" class="form-control" pattern="^[A-Za-z '-]+$" required ><?php echo $developer; ?>
                            <span class="help-block"><?php echo $developer_err;?></span>
                        </div>
                              </div>
                              <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                            <label class="col-md-12">Date</label>
                            <div class="col-md-12">
                          
                            <input type="date" name="date" class="form-control" required  value="<?php echo $date; ?>">
                            <span class="help-block"><?php echo $date_err;?></span>
                        </div>
                              </div>

                              <div class="form-group <?php echo (!empty($client_err)) ? 'has-error' : ''; ?>">
                            <label class="col-md-12">Client</label>
                            <div class="col-md-12">
                            <input type="text" name="client" class="form-control" required pattern="^[A-Za-z '-]+$" value="<?php echo $client; ?>">
                            <span class="help-block"><?php echo $client_err;?></span>
                        </div>
                              </div>

                              <div class="form-group <?php echo (!empty($website_err)) ? 'has-error' : ''; ?>">
                            <label class="col-md-12">Website</label>
                            <div class="col-md-12">
                            <input type="text" name="website" class="form-control" required  value="<?php echo $website; ?>">
                            <span class="help-block"><?php echo $website_err;?></span>
                        </div>
                              </div>



                        <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">

                            <label class="col-md-12">Image</label>
                        
                            <div class="col-md-12">
                           
    <input type="file" name="image" class="form-control"required id="image" value="<?php echo $image; ?>">
                            <span class="help-block"><?php echo $image_err;?></span>
    

                        </div>
                            </div>
                        <div class="form-group">
                        <div class="col-sm-12">
                        <input type="submit" class="btn btn-outline-success" type="submit" value="Valider" name="create">
        
                        <button type="button"class="btn btn-outline-secondary"type="submit"onclick="window.location.href = 'projets.php';">Annuler</button>
                        
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
                <footer class="footer"> Copyrights &copy; <?php echo date("Y"); ?> <a href="http://wa-digital.fr" target="_blank">wa-digital.info</a>. All Rights Reserved.</footer>
                <!-- End footer -->
            </div>
            <!-- End Page wrapper  -->
        </div>
        <!-- End Wrapper -->
        
         <!-- Java Scripts -->
               <?php include('includes/js.php');?> 
               <script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
         <!-- End Java Scripts -->
    
    </body>
    
    </html>