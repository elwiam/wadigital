<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
?>
<?php
    // Define variables and initialize with empty values
    $title = $type = $content = $image=$developer =$date =$client=$website ="";
    $title_err = $type_err = $content_err = $image_err =$developer_err =$date_err =$client_err =$website_err ="";
    // Include config file
    require_once "../config/db.php";

    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        
        $id = $_GET['id'];
        $get_projet = mysqli_query($link,"SELECT * FROM `projets` WHERE id='$id'");
        
        if(mysqli_num_rows($get_projet) === 1){
            /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
            
            $row = mysqli_fetch_assoc($get_projet);
            // Retrieve individual field value
            $title = $row["title"];
            $type = $row["type"];
            $content = $row["content"];
            $image = $row["image"];
            $developer = $row["developer"];
            $date = $row["date"];
            $client = $row["client"];
            $website = $row["website"];
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
                        <li class="breadcrumb-item"><a href="/Admin/projets.php">Projets</a></li>
                        <li class="breadcrumb-item active">Editer Le Projet</li>
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
                    <form action="update.php?id=<?php echo $id ;?>" method="post"enctype="multipart/form-data">                        
                    <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                    <label class="col-md-12">Titre</label>
                    <div class="col-md-12">
                            <input type="text" name="title"  class="form-control" value="<?php echo $title; ?>">
                            <span class="help-block"><?php echo $title_err;?></span>
                        </div>
                              </div>
                        <div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
                        <label class="col-md-12">Type</label>
                    <div class="col-md-12">
                            <input type="text" name="type"  class="form-control" value="<?php echo $type; ?>">
                            <span class="help-block"><?php echo $type_err;?></span>
                        </div>
                                  </div>
                        <div class="form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
                        <label class="col-md-12">Contenu</label>
                    <div class="col-md-12">
                            <textarea rows = '10' cols = '80'  type="text" name="content" ><?php echo $content; ?></textarea>
                            <span class="help-block"><?php echo $content_err;?></span>
                        </div>
                                </div>
                                <div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
                        <label class="col-md-12">Développeur</label>
                    <div class="col-md-12">
                            <input type="text" name="developer"  class="form-control" value="<?php echo $developer; ?>">
                            <span class="help-block"><?php echo $developer_err;?></span>
                        </div>
                                  </div>
                                  <div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
                        <label class="col-md-12">Date</label>
                    <div class="col-md-12">
                            <input type="date" name="date"  class="form-control" value="<?php echo $date; ?>">
                            <span class="help-block"><?php echo $date_err;?></span>
                        </div>
                                  </div>
                                 <div class="form-group <?php echo (!empty($client_err)) ? 'has-error' : ''; ?>">
                        <label class="col-md-12">Client</label>
                    <div class="col-md-12">
                            <input type="text" name="client"  class="form-control" value="<?php echo $client; ?>">
                            <span class="help-block"><?php echo $client_err;?></span>
                        </div>
                                  </div>
                                  <div class="form-group <?php echo (!empty($website_err)) ? 'has-error' : ''; ?>">
                        <label class="col-md-12">Website</label>
                    <div class="col-md-12">
                            <input type="text" name="website"  class="form-control" value="<?php echo $website; ?>">
                            <span class="help-block"><?php echo $website_err;?></span>
                        </div>
                                  </div>
                        <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                     <label class="col-md-12">Image</label>
                    <div class="col-md-12">                            
                         <img src="images/<?php  echo $image ?>" width='400' height='400'/>
                            <span class="help-block"><?php echo $image_err;?></span>
                        </div>
                            </div>
                          <div class="form-group">
                          <label class="col-md-12"> Télécharger image</label>
                          <div class="col-md-12">                           
                        <input type="file" class="form-control" name="image" id="image"value="<?php echo $image; ?>" >                       
                        <span class="help-block"><?php echo $image_err;?></span>
                                </div>
                                     </div>                       
                        <div class="form-group">
                        <div class="col-sm-12">
                  </br>
                  <button type="submit" name="submit" value="Submit"  class="btn btn-outline-success">Valider</button>

                  <button type="button"class="btn btn-outline-secondary"type="submit"onclick="window.location.href = 'projets.php';">Annuler</button>
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
if(!empty($_POST))
{
    $image_r = $_FILES['image']['name'];
    $image_r_tmp = $_FILES['image']['tmp_name'];
    if (   $_POST['title']     <> $title
        || $_POST['type']      <> $type
        || $_POST['content']   <> $content
        || $_POST['date']      <> $date
        || $_POST['developer'] <> $developer
        || $_POST['client']    <> $client
        || $_POST['website']   <> $website
        || (!empty($image_r) && !empty($image_r_tmp))
        )
    {
        // check submit

        if(isset($_POST['submit'])) 
        { 
        // Escape special characters.
        
            $title = mysqli_real_escape_string($link, htmlspecialchars($_POST['title']));
            $type = mysqli_real_escape_string($link, htmlspecialchars($_POST['type']));
            $content = mysqli_real_escape_string($link, htmlspecialchars($_POST['content']));
            $developer = mysqli_real_escape_string($link, htmlspecialchars($_POST['developer']));
            $client = mysqli_real_escape_string($link, htmlspecialchars($_POST['client']));
            $website = mysqli_real_escape_string($link, htmlspecialchars($_POST['website']));
            $date = mysqli_real_escape_string($link, htmlspecialchars($_POST['date']));            
            if (!empty($image_r) && !empty($image_r_tmp)) 
            { 
                //  verifie if the file sending 
                if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
                {
                    // verifie if the file is  too big 
                    if ($_FILES['image']['size'] <= 1000000)
                    {
                        // verifie if the extension is validate 
                       
                        $infosfichier = pathinfo($_FILES['image']['name']); 
                        $extension_upload = $infosfichier['extension'];
                        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                        if (in_array($extension_upload, $extensions_autorisees))
                        {
                            // validate the file and store it in final destination  
                            move_uploaded_file($image_tmp,"images/$image_r");                           
        
                            $sql = "UPDATE projets SET
                                        title     = '$title',
                                        content   = '$content',
                                        type      = '$type',
                                        developer = '$developer',
                                        image     = '$image_r',
                                        date      = '$date',
                                        client    = '$client',
                                        website   = '$website'
                                        WHERE id  = '$id'";                 
                            // UPDATE PROJECT DATA               
                            $update_query = mysqli_query($link,$sql);
                                        
                            //CHECK DATA UPDATED OR NOT
                            if($update_query){
                                echo "<script>
                                alert('Projet mis à jour');
                                window.location.href = 'projets.php';
                                </script>";
                                exit;
                            }else{
                                echo "<h3>Opps erreur survenue !</h3>";
                            }                                                    
                        }
                    }
                }
            } else {
                // BEGIN ADD AELY
                $sql = "UPDATE projets SET
                            title     = '$title',
                            content   = '$content',
                            type      = '$type',
                            developer = '$developer',
                            image     = '$image',
                            date      = '$date',
                            client    = '$client',
                            website   = '$website'
                            WHERE id  = '$id'";                 
                // UPDATE PROJECT DATA               
                $update_query = mysqli_query($link,$sql);
                        
                //CHECK DATA UPDATED OR NOT
                if($update_query){
                    echo "<script>
                    alert('Projet mis à jour');
                    window.location.href = 'projets.php';
                    </script>";
                    exit;
                }else{
                    echo "<h3>Opps erreur survenue !</h3>";
                }
            }
            
        }
    }
}

// END OF UPDATING DATA

?>
                     </div>                           
                </div>
            </div>
        </div>  
  </div>   
         <!-- End PAge Content -->             
         <!-- Java Scripts -->
               <?php include('includes/js.php');?> 
         <!-- End Java Scripts -->
    
    </body>   
    </html>