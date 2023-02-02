<?php
//include("index.php");
require_once('fonction.php');
session_start();
if (isset($_GET['delete']) ){
    $userId = $_GET['delete'];
    supprimerCompte($userId);
    echo "Utilisateur supprimé";
  } else {
  echo " \n Non supprimé";
  }
?>