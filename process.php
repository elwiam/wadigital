<?php
//Vérifie que une image a bien été envoyée
    if ($_FILES["image"]["name"] != "")
    {
      $dir = "/images";
      $file = $dir . basename($_FILES["image"]["name"]);
      $upload = 1;
      $img_type = strtolower(pathinfo($file,PATHINFO_EXTENSION));
      // Vérifié la conformité de l'image
      if(isset($_POST["submit"]))
      {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false)
        {
          $uploadOk = 1;
        }
        else
        {
          $_SESSION['img_error'] = '<div class="alert alert-danger">Attention!<em> Veuillez soumettre une image conforme</em></div>';
          $uploadOk = 0;
        }
      }
      // Vérifie si le fichier existe déjà
      if (file_exists($file))
      {
        $uploadOk = 0;
      }
      // Vérifie la taille
      if ($_FILES["image"]["size"] > 2000000)
      {
        $_SESSION['img_error'] = '<div class="alert alert-danger">Attention!<em> Fichier trop volumineux</em></div>';
        $uploadOk = 0;
      }
      // Vérifie le format
      if($img_type != "jpg" && $img_type != "png" && $img_type != "jpeg")
      {
        $_SESSION['img_error'] = '<div class="alert alert-danger">Attention!<em> Veuillez soumettre une image au format png, jpg ou jpeg</em></div>';
        $uploadOk = 0;
      }
      else
      {
        // Si aucun problème, télécharge puis ajoute à la base de donnée
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $file))
        {
          $req_img = $link->prepare(
            'UPDATE projets SET image = :image WHERE id = :id');
          $req_img->execute([
            'image' => $_FILES['image']['name'],
            'id' => $id
          ]);
        }
        else
        {
          $_SESSION['img_error'] = '<div class="alert alert-danger">Erreur!<em> Problème lors du téléchargement du fichier</em></div>';
        }
      }
    }