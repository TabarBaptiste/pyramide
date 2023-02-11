<?php
require_once('fonction.php');
session_start();

//Vérifie si l'utilisateur est connecté
if (!empty($_SESSION['id'])) {
    if (isset($_POST['event_id'])) {
        $event_id = $_POST['event_id'];
        $id = $_SESSION['id'];
        $event_name = getEventName($event_id);
        $inscription = inscrireUtilisateur($id, $event_id);

        $_SESSION['flashMessage'] = ($inscription !== "Vous êtes déjà inscrit à cet événement.") ? "Vous vous êtes inscrit à l'événement " . $event_name : "Vous êtes déjà inscrit à cet événement.";
    }
} else {
    $_SESSION['flashMessage'] = 'Vous devez être connecté pour vous inscrire à un événement';
}
header('location: index.php');
?>