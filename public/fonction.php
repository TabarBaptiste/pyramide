<?php

require_once 'connexion_bd.php';

function affichUsers(){
    global $pdo;
    $query = 'SELECT * FROM users';
    $prep = $pdo->prepare($query);
    $prep->execute();
    return $prep->fetchAll();
}

function getAuthentification($email, $password){
    global $pdo;
    $query = "SELECT * FROM users where email = :email";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':email', $email);
    $prep->execute();
    // On vérifie que la requête ne retourne qu'une seule ligne
    if($prep->rowCount() == 1){
        $result = $prep->fetch();
        // On vérifie que le mot de passe entré correspond à celui stocké
        if(password_verify($password, $result->password)){
            return $result;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function getUpdateUsers($params){
    global $pdo;
    $query = "UPDATE users set email=:email, password=:password, role=:role WHERE id=:id";
    $prep = $pdo->prepare($query);

    $id = filter_var($params['id'], FILTER_VALIDATE_INT);
    $email = filter_var($params['email'], FILTER_VALIDATE_EMAIL);
    $password = password_hash($params['password'], PASSWORD_DEFAULT);
    $role = filter_var($params['role'], FILTER_SANITIZE_STRING);

    // Vérifie que le rôle est bien une valeur valide de l'ENUM
    $allowed_roles = ['ROLE_ADMIN', 'ROLE_USER'];
    if (!in_array($role, $allowed_roles)) {
        throw new Exception("Le rôle n'est pas valide.");
    }

    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    $prep->bindValue(':email', $email, PDO::PARAM_STR);
    $prep->bindValue(':password', $password, PDO::PARAM_STR);
    $prep->bindValue(':role', $role, PDO::PARAM_STR);
    $prep->execute();
}

function ajoutUser($param){
    global $pdo;
    
    if ($param['password'] != $param['password_confirm']) {
        header('Location: register.php');
        return "Les mots de passe ne correspondent pas.";
    }

    $emailExisteDeja = emailExisteDeja($param['email']);
    if ($emailExisteDeja) {
        echo json_encode(array("status" => "error", "message" => "L'email est déjà utilisé."));
        exit;
    }

    $password = password_hash($param['password'], PASSWORD_DEFAULT);

    $requete = "INSERT INTO users (nom, prenom, email, password, role) VALUES (:nom, :prenom, :email, :password, :role)";
    $prep = $pdo->prepare($requete);
    $prep->bindValue(':nom', $param['nom']);
    $prep->bindValue(':prenom', $param['prenom']);
    $prep->bindValue(':password', $password);
    $prep->bindValue(':email', $param['email']);
    $prep->bindValue(':role', $param['role']);
    $prep->execute();

    $user = array(
        'id' => $pdo->lastInsertId(),
        'email' => $param['email'],
        'password' => $password,
        'prenom' => $param['prenom'],
        'role' => $param['role']
    );

    connecterUtilisateur($user);

    return "L'utilisateur a été ajouté avec succès.";
}
function emailExisteDeja($email) {
    global $pdo;

    $requete = "SELECT email FROM users WHERE email = :email";
    $prep = $pdo->prepare($requete);
    $prep->bindValue(':email', $email);
    $prep->execute();

    return $prep->fetch() !== false;
}

function connecterUtilisateur($user){
    // Démarrage de la session
    session_start();
    // Enregistrement des informations de l'utilisateur en session
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['password'] = $user['password'];
    $_SESSION['prenom'] = $user['prenom'];
    $_SESSION['role'] = $user['role'];
    // Durée de vie de la session
    ini_set('session.cookie_lifetime', 60 * 60 * 24);
    // Redirection vers la page d'accueil
    header('Location: index.php');
}


function inscrireUtilisateur($user_id, $event_id) {
    global $pdo;
    try {
        // Vérifier si l'utilisateur est déjà inscrit à l'événement
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM events_users WHERE user_id = :user_id AND event_id = :event_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            return "Vous êtes déjà inscrit à cet événement.";
        }

        // Insérer l'ID de l'utilisateur et l'ID de l'événement dans la table events_users
        $stmt = $pdo->prepare("INSERT INTO events_users (user_id, event_id) VALUES (:user_id, :event_id)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();

        // Incrémenter le nombre d'inscrits pour l'événement
        $stmt = $pdo->prepare("UPDATE events SET nb_inscrit = nb_inscrit + 1 WHERE id = :event_id");
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();

        // Incrémenter le nombre d'événements pour l'utilisateur
        $stmt = $pdo->prepare("UPDATE users SET nb_events = nb_events + 1 WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

function utilisateurDejaInscrit($user_id, $event_id) {
    global $pdo;
    try {
      $stmt = $pdo->prepare("SELECT * FROM events_users WHERE user_id = :user_id AND event_id = :event_id");
      $stmt->bindParam(':user_id', $user_id);
      $stmt->bindParam(':event_id', $event_id);
      $stmt->execute();
      return $stmt->fetch() !== false;
    } catch (PDOException $e) {
      echo "Erreur: " . $e->getMessage();
    }
}

function supprimerCompte($userId) {
    global $pdo;
    try {

        // Commencer une transaction
        $pdo->beginTransaction();

        // Vérifier si l'utilisateur est inscrit à un événement
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM events_users WHERE user_id = ?");
        $stmt->execute([$userId]);
        $count = $stmt->fetchColumn();
        if ($count == 0) {
            echo "Cet utilisateur n'est inscrit à aucun événement.";
        } else {
            // Récupérer les id des événements auxquels l'utilisateur est inscrit
            $stmt = $pdo->prepare("SELECT event_id FROM events_users WHERE user_id = ?");
            $stmt->execute([$userId]);
            $eventIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Supprimer les inscriptions de l'utilisateur
            $stmt = $pdo->prepare("DELETE FROM events_users WHERE user_id = ?");
            $stmt->execute([$userId]);

            // Mettre à jour le nombre d'inscrits pour chaque événement
            foreach ($eventIds as $eventId) {
                $stmt = $pdo->prepare("UPDATE events SET nb_inscrit = nb_inscrit - 1 WHERE id = ?");
                $stmt->execute([$eventId]);
            }
        }
        // Supprimer l'utilisateur
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        echo "L'utilisateur a été supprimé avec succès.";
        // Valider la transaction
        $pdo->commit();
        session_destroy();
        header('Location: index.php');

    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $pdo->rollBack();
        echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
    }
}

function afficherProfil(){
    global $pdo;
    // Vérifie si l'utilisateur est connecté
    if(!empty($_SESSION['id'])){
        $user_id = $_SESSION['id'];
        try {
            // Récupère les informations de l'utilisateur connecté
            $stmt = $pdo->prepare("SELECT id, nom, prenom, email, nb_events FROM users WHERE id = :id");
            $stmt->bindParam(':id', $user_id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}

function getEventsByUser($userId) {
    global $pdo;
    $requete = "SELECT e.id, e.nom, e.type, e.date FROM events e
                JOIN events_users ue ON e.id = ue.event_id
                WHERE ue.user_id = :userId";
    $prep = $pdo->prepare($requete);
    $prep->bindValue(':userId', $userId);
    $prep->execute();
    return $prep->fetchAll();
    
}

function unsubscribeEvent($userId, $eventId) {
    global $pdo;

    // Débuter une transaction
    $pdo->beginTransaction();

    try {
        // Vérifier si l'utilisateur est bien inscrit à l'événement
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM events_users WHERE user_id = :user_id AND event_id = :event_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':event_id', $eventId);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        if ($count == 0) {
            echo "Vous n'êtes pas inscrit à cet événement.";
            return;
        }

        // Supprimer l'inscription de l'utilisateur
        $stmt = $pdo->prepare("DELETE FROM events_users WHERE user_id = :user_id AND event_id = :event_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':event_id', $eventId);
        $stmt->execute();

        // Mettre à jour le nombre d'inscrits de l'événement
        $stmt = $pdo->prepare("UPDATE events SET nb_inscrit = nb_inscrit - 1 WHERE id = :event_id");
        $stmt->bindParam(':event_id', $eventId);
        $stmt->execute();

        // Mettre à jour le nombre d'événements inscrits de l'utilisateur
        $stmt = $pdo->prepare("UPDATE users SET nb_events = nb_events - 1 WHERE id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        // Valider la transaction
        $pdo->commit();
        echo "Vous vous êtes désinscrit de l'événement.";
    } catch (PDOException $e) {
        // Annuler la transaction en cas d'erreur
        $pdo->rollBack();
        echo "Erreur : " . $e->getMessage();
    }
}

function updateUser($param){
    global $pdo;
    try {
        if(!isset($param['id'])) {
            echo "L'ID n'est pas défini.";
            return;
        }        
        $stmt = $pdo->prepare("UPDATE users SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id");
        $stmt->bindValue(':id', $param['id']);
        $stmt->bindValue(':nom', $param['nom']);
        $stmt->bindValue(':prenom', $param['prenom']);
        $stmt->bindValue(':email', $param['email']);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

function idUser($id){
    global $pdo;
    $query = 'SELECT * FROM users WHERE id=:id';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id);
    $prep->execute();
    return $prep->fetch();
}