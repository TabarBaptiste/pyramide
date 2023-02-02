<?php
require_once 'fonction.php';

session_start();
$userId = $_SESSION['id'];
$eventId = $_GET['event_id'];

if(!empty($userId) && !empty($eventId)) {
    unsubscribeEvent($userId, $eventId);
    header('Location: info_profil.php');
} else {
    print_r($userId);
    //header('Location: events.php');
}
?>

