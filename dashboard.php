<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
  
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
                    <ol class="breadcrumb">
            <span><li class="breadcrumb-item ">Tableau de bord</li></span> 
                    </ol>
                </div>
            </div>
                 
     
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                 <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->

                <div class="row">
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><a href="/Admin/projets.php"><i class="fa fa-sticky-note f-s-40 color-primary"></i></a></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>
                                       
                                    </h2>
                                    <p class="m-b-0"> Projets</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><a href="/Admin/services.php"><i class="fa fa-list-ul f-s-40 color-success"></i></a></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>
                                    </h2>
                                    <p class="m-b-0">Services</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><a href="/Admin/users.php"><i class="fa fa-users f-s-40 color-warning"></i></a></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2></h2>
                                    <p class="m-b-0">Profils</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><a href="http://wa-digital.fr"><i class="fa fa-eye f-s-40 color-danger"></i></a></span>
                                </div>
                                <div class="media-body media-text-right">

                                    <h2></h2>
                              
                                    <p class="m-b-0">Site Web</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>

              
                </div>
             
                </div>
         </div>


                <!-- End PAge Content -->
         
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> Copyrights &copy; <?php echo date("Y"); ?> <a href="http://wa-digital.fr" target="_blank">Wa-digital.fr</a>. All Rights Reserved.</footer>
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