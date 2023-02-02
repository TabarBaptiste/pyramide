<?php
require_once('fonction.php');


  if (isset($_GET['id'])) {
    $id_user = $_GET['id'];
    $user = idUser($id_user);
  } else {
    echo 'pas de id GET';
  }
//$user = idUser($id_user);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
</head>
<form action="listeUser.php" method="post">
    <h3>Mettre à jour les informaions de <?php echo $user->prenom; ?></h3>
    <div class="form-group" value="<?php echo $user->id ; ?>">
        <input type="hidden" name="id" value="<?php echo $user->id; ?>">
        <label for="nom">Nom :</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $user->nom; ?>">
    </div>
    <div class="form-group" value="<?php echo $user->prenom ; ?>">
        <label for="prenom">Prénom :</label>
        <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $user->prenom; ?>">
    </div>
    <div class="form-group" value="<?php echo $user->email ; ?>">
        <label for="email">Email :</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->email; ?>">
    </div>
    <button type="reset" class="btn btn-secondary">Annuler</button>
    <button type="submit" name="update" class="btn btn-primary" onclick="window.location.href = 'listeUser.php';">Mettre à jour</button>
</form>
<style>
    form {
        width: 50%;
        margin: 0 auto;
        margin-top: 5%;
        padding: 30px;
        background-color: #f2f2f2;
        border-radius: 10px;
        box-shadow: 2px 2px 5px #bbb;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #bbb;
        padding: 10px;
        box-shadow: 1px 1px 2px #ccc;
        width: 100%;
    }

    button[type="submit"] {
        width: 30%;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        margin-top: 20px;
        border: none;
        cursor: pointer;
    }
    button[type="reset"] {
        width: 30%;
        border-radius: 5px;
        background-color: gray;
        color: white;
        padding: 10px;
        margin-top: 20px;
        border: none;
        cursor: pointer;
    }
    h3{
        margin-bottom: 5%
    }
</style>