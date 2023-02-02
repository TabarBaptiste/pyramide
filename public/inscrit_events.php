<?php
//include("index.php");
//Vérifie si l'utilisateur est connecté
require_once('fonction.php');
session_start();

if(!empty($_SESSION['id'])) {
    if (isset($_POST['event_id'])){
        $event_id = $_POST['event_id'];
        $id = $_SESSION['id'];
        inscrireUtilisateur($id, $event_id);
        $_SESSION['flashMessage'] = 'Vous vous êtes inscrit à cet évènement';
        header('location: index.php#projects');
        //echo "Vous êtes inscrit à l'évenement";
    }
}else{
    echo "Vous devez être connecté pour vous inscrire à un événement";
}
?>