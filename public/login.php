<?php
require_once('fonction.php');

// Vérification des données du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    if (!empty($_POST['email'])&& !empty($_POST['password'])) {
        // Validation de l'email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            header('Location: authentification.php');
            exit;
        }
        else {
            // Appel de la fonction getAuthentification pour vérifier les informations d'authentification
            $result = getAuthentification($_POST['email'], $_POST['password']);

            if ($result) {
                // Démarrage de la session
                session_start();
                // Enregistrement des informations de l'utilisateur en session
                $_SESSION['id'] = $result->id;
                $_SESSION['email'] = $result->email;
                $_SESSION['password'] = $result->password;
                $_SESSION['prenom'] = $result->prenom;
                $_SESSION['role'] = $result->role;
                // Durée de vie de la session
                ini_set('session.cookie_lifetime', 60 * 60 * 24);
                // Redirection vers la page d'accueil
                header('Location: index.php');
                exit;
            } else {
                // Redirection vers la page d'authentification en cas d'erreur
                //header('Location: authentification.php');
                print_r($_POST);
                echo "  Information incorrect";
                exit;
            }
        }
    }
    else {
        // Redirection vers la page d'authentification en cas d'erreur
        header('Location: authentification.php');
        exit;
    }
}
else {
    // Redirection vers la page d'authentification en cas d'erreur
    header('Location: authentification.php');
    exit;
}
?>
