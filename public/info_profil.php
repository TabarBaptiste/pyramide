<?php
session_start();
require_once('fonction.php');

// Vérifie si l'utilisateur est connecté
if(!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $user = afficherProfil();

}else{
    echo "Vous devez être connecté pour accéder à votre profil";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="card">
        <h1>Profil</h1>
        <ul>
            <li>Nom : <?php echo $user['nom']; ?></li>
            <li>Prénom : <?php echo $user['prenom']; ?></li>
            <li>Email : <?php echo $user['email']; ?></li>
            <li>Nombre d'événements inscrits : <?php echo $user['nb_events']; ?></li>
            <?php 
                if (($user)['nb_events'] > 0 ) {
                    echo '<li>Liste d\'événements inscrits : <a href="events.php">Voir</a> </li>';
                }
            ?>
        </ul>
        <a href="delete_profil.php?delete=<?php echo $user['id']?>"
        onClick="return(confirm('Êtes-vous sûr de vouloir supprimer votre compte ?'));"><button class="supp-button" type="button">Supprimer mon compte</button></a>
        </form>

        <?php
        if(isset($_SESSION['flash_message'])){
            echo "<div class='flash_message'>" . $_SESSION['flash_message'] . "</div>";
            unset($_SESSION['flash_message']);
        }
        ?>
        <a href="index.php" class="card-button">Retour</a>
    </div>
</body>
</html>


<style>
body {
  background-image: url('assets/images/img/DJI_0013.JPG');
  background-size: cover;
  background-repeat: no-repeat;
  font-family: Arial, sans-serif;
}


.card {
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    padding: 30px;
    margin: 30px auto;
    max-width: 600px;
    box-shadow: 0px 0px 20px black;
    margin-top: 5%;
}

h1 {
    text-align: center;
    font-size: 2.5em;
    margin-bottom: 20px;
}

ul {
    list-style: none;
    font-size: 1.2em;
    margin-bottom: 20px;
}

li {
    margin-bottom: 10px;
}

form {
    text-align: center;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-size: 1.2em;
    margin-top: 10px;
}

input[type="submit"]:hover {
    background-color: #3e8e41;
}
.card-button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;
}

.card-button:hover {
    background-color: #3e8e41;
}

.supp-button{
    background-color: red; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;
}
.supp-button:hover {
    background-color: #DC143C;
}
</style>