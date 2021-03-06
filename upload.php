<?php
include "dbconnect.php";
//Loop through each file
	for($i=0; $i<count($_FILES['image']['name']); $i++) {
	  if(isset($_FILES["image"])) {
		@list(, , $imtype, ) = getimagesize($_FILES['image']['tmp_name'][$i]);
		// Get image type.
		// We use @ to omit errors
		if ($imtype == 3){ // cheking image type
		  $ext="png";
		}
		elseif ($imtype == 2){
		  $ext="jpeg";
		}
		elseif ($imtype == 1){
		  $ext="gif";
		}
		else{
		  $msg = 'Error: unknown file format';
		   echo $msg;
		  exit;
		}
		if(getimagesize($_FILES['image']['tmp_name'][$i]) == FALSE){
		  echo "Please select an image.";
		}
		else{
		  $image= addslashes($_FILES['image']['tmp_name'][$i]);
		  $name= addslashes($_FILES['image']['name'][$i]);
		  $image= file_get_contents($image);
		  $image= base64_encode($image);
		  saveimage($name,$image);
		}
	  }
	}
function saveimage($name,$image){
  global $link;
  $check="SELECT * FROM images WHERE name = '$name'";
  $rs = mysqli_query($link, $check);
  $data = mysqli_fetch_array($rs);
  if($data[0] > 1) {
    echo ($name . " " . "Image already exists.\n");
  }
  else{
    $qry="insert into images (name,image) values ('$name','$image')";
    $result=mysqli_query($link, $qry);
    if($result){
      echo ($name . " " . "Image uploaded.\n");
    }
    else{
      echo ($name . " " . "Image not uploaded.\n");
    }
  }
}
mysqli_close($link);
?>