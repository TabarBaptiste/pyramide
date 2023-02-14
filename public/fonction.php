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
        $_SESSION['flash'] = "L'email est déjà utilisé.";
        header('Location: register.php');
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
            $_SESSION['flashMessage'] = "Vous êtes déjà inscrit à cet événement.";
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
function getEventName($event_id) {
    global $pdo;
    $query = "SELECT nom FROM events WHERE id = :event_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['event_id' => $event_id]);
    $event = $stmt->fetch();
    return get_object_vars($event)['nom'];
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

function affichEvents() {
    global $pdo;
    $query = 'SELECT * FROM events';
    $prep = $pdo->prepare($query);
    if ($prep->execute()) {
        return $prep->fetchAll();
    }
    return false;
}
function idEvents($id){
    global $pdo;
    $query = 'SELECT * FROM events WHERE id=:id';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id);
    $prep->execute();
    return $prep->fetch();
}
function updateEvents($param){
    global $pdo;
    try {
        if(!isset($param['id'])) {
            echo "L'ID n'est pas défini.";
            return;
        }        
        $stmt = $pdo->prepare("UPDATE events SET nom = :nom, type = :type, date = :date WHERE id = :id");
        $stmt->bindValue(':id', $param['id']);
        $stmt->bindValue(':nom', $param['nom']);
        $stmt->bindValue(':type', $param['type']);
        $stmt->bindValue(':date', $param['date']);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
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

function idUser($id = null){
    if ($id === null){
        return false;
    }
    global $pdo;
    $query = 'SELECT * FROM users WHERE id=:id';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id);
    $prep->execute();
    $result = $prep->fetch();
    if ($result === false){
        return false;
    }
    return $result;
}

function idNewsletter($id){
    global $pdo;
    $query = 'SELECT * FROM newsletters WHERE id=:id';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id);
    $prep->execute();
    return $prep->fetch();
}

function creatNewsletter($param){
    global $pdo;
    $date = date('Y-m-d H:i:s');
    $is_sent = isset($param['is_sent']) ? $param['is_sent'] : 0;
    $query = "INSERT INTO newsletters (nom, content, created_at, is_sent) VALUES (:nom, :content, :created_at, :is_sent)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':nom', $param['nom']);
    $prep->bindValue(':content', $param['content']);
    $prep->bindValue(':created_at', $date);
    $prep->bindValue(':is_sent', $is_sent, PDO::PARAM_BOOL);
    $prep->execute();
}


function idMail(){
    global $pdo;
    $email = $_POST['email'];
    $query = "SELECT id FROM users WHERE email = :email";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':email', $email);
    $prep->execute();
    $result = $prep->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $id = $result['id'];
        $param = [
            'id' => $id,
        ];
        subscribeToNewsletter($param);
    }
}

function subscribeToNewsletter($param) {
    try {
        global $pdo;
        $query = "UPDATE users SET newsletter = 1 WHERE id = :id";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':id', $param['id']);
        $prep->execute();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

function afficheNewsletters() {
    global $pdo;
    $query = 'SELECT * FROM newsletters';
    $prep = $pdo->prepare($query);
    if ($prep->execute()) {
        return $prep->fetchAll();
    }
    return false;
}

function eventsByUser($user_id){
    global $pdo;
    $query = 'SELECT events.nom, events.type, events.date
              FROM events
              JOIN events_users ON events.id = events_users.event_id
              JOIN users ON users.id = events_users.user_id
              WHERE users.id = :user_id';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':user_id', $user_id);
    $prep->execute();
    return $prep->fetchAll();
}

function usersByEvent($event_id){
    global $pdo;
    $query = 'SELECT * FROM events_users LEFT 
              JOIN users ON events_users.user_id = users.id 
              WHERE event_id=:event_id';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':event_id', $event_id);
    $prep->execute();
    return $prep->fetchAll();
}
