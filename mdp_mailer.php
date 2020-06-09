<?php

	include '../config/db.php';

	// load the variables form address bar

	$email = $_REQUEST["email"];
	$verif_box = $_REQUEST["verif_box"];

	// remove the backslashes that normally appears when entering " or '

	$email = stripslashes($email);

	// check to see if verificaton code was correct
	if(md5($verif_box).'a4xn' == $_COOKIE['tntcon']){

		// --- Verrification of the email---
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
		exit('Invalid email address'); //  error handling 
		}

		$flag = false;
		$sql = "SELECT id FROM users WHERE email = ?";

		if($stmt = mysqli_prepare($link, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_email);

			// Set parameters
			$param_email = $email;

			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				// Store result
				mysqli_stmt_store_result($stmt);

				// Check if username exists
				if(mysqli_stmt_num_rows($stmt) == 1){
					// Bind result variables
					mysqli_stmt_bind_result($stmt, $id_reset);
					if(mysqli_stmt_fetch($stmt)){ 
					}
				}
			}

			// begin add AELY
			if(!empty($_POST)){
				//$row= mysqli_fetch_row($stmt);
				mysqli_stmt_store_result($stmt);
				if (mysqli_stmt_num_rows($stmt) == '1') {
					$message = "email: ".$email."\n".$message;
					$message .= "Merci de cliquer sur ce lien afin de changer votre mot de passe: http://wa-digital.fr/Admin/resetmdp_login.php?id=" . $id_reset;

					mail("$email", 'Online Form: '.$subject, $_SERVER['REMOTE_ADDR']."\n\n".$message, "email: $email");
					// delete the cookie so it cannot sent again by refreshing this page
					setcookie('tntcon','');
					$flag = true;
				};
			};

		} else {
			// if verification code was incorrect then return to contact page and show error
			header("Location:".$_SERVER['HTTP_REFERER']."?&email=$email&message=$message&wrong_code=true");
			exit;
		}

		// Close statement
		mysqli_stmt_close($stmt);

		// Close connection
		mysqli_close($link);
	}

	if ($flag == true) {
		echo "<script>
		alert('Un email de réinitialisation vous a été envoyé à votre boite mail');
		window.location.href = 'login.php';
		</script>";
		exit;
	} else {
		echo "<script>
		alert('L`adresse mail saisie n`existe pas');
		window.location.href = 'login.php';
		</script>";
		exit;
	};

?>