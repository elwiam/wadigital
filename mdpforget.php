<?php
// Define variables and initialize with empty values

// Include config file
require_once "../config/db.php";

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    
    $id = $_GET['id'];
    $get_users = mysqli_query($link,"SELECT * FROM `users` WHERE id='$id'");
    
    if(mysqli_num_rows($get_users) === 1){
        /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
        
        $row = mysqli_fetch_assoc($get_users);
     // Retrieve individual field value
     $username = $row["username"];
     $password = $row["password"];
    

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Update User And Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Editer le compte User</h2>
                    </div>
                    



  

                    
                    <form action="mdpforget.php?id=<?php echo $id ;?>" method="post"enctype="multipart/form-data">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            
                        </div>
                        <div class="form-group">
                            <label>password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                            
                        </div>
                      
                    
                       
                       <div class="form-actions">
                    <input type="submit" class="btn btn-success" name="submit" value="submit">	
							
                       
                       
    </div>
                    </form>
                   

 
                    
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
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

if(isset($_POST['username']) && isset($_POST['password'])){
    
    // check title and content empty or not
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        
        // Escape special characters.
        $username = mysqli_real_escape_string($link, htmlspecialchars($_POST['username']));
        $password= mysqli_real_escape_string($link, htmlspecialchars($_POST['password']));
       

       

       








        $users_username= mysqli_real_escape_string($link, htmlspecialchars($_POST['content']));
        $users_password= mysqli_real_escape_string($link, htmlspecialchars($_POST['title']));
       
        
        //CHECK content IS VALID OR NOT
        if (filter_var($users_username)) {
            $id = $_GET['id'];
            // CHECK IF content IS ALREADY INSERTED OR NOT
            $check_username= mysqli_query($link, "SELECT `projets` FROM `wadig1286358` WHERE title = '$title' type = '$type'content = '$content''image= '$image' AND id != '$id'");
            
            if(mysqli_num_rows($check_username) > 0){    
                
                echo "<h3>This content content is already registered. Please Try another.</h3>";
            }else{
                
                
                // UPDATE PROJECT DATA               
                $update_query = mysqli_query($link,"UPDATE `users` SET username='$username',password='$password' WHERE id=$id");

                //CHECK DATA UPDATED OR NOT
                if($update_query){
                    echo "<script>
                    alert('Data Updated');
                    window.location.href = 'login.php';
                    </script>";
                    exit;
                }else{
                    echo "<h3>Opps something wrong!</h3>";
                }
            }
        }else{
            echo "Invalid content. Please enter a valid content content";
        }
        
    }else{
        echo "<h4>Please fill all fields</h4>";
    }   


// END OF UPDATING DATA
}
?>

