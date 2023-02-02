<!DOCTYPE html>
<html lang="fr">
    <head class="tete">
        <?php 
        session_start();
        require_once 'fonction.php';
        if(!isset($_SESSION['id'])){
            header('location:index.php');
        }
        $userId = $_SESSION['id'];
        $userEvents = getEventsByUser($userId);
        ?>
    </head>

    <body>
        <div class="container">
            <table class="table table-bordered table-dark">
                <h1> <?php echo $_SESSION['prenom'] ?> voici la liste des événements auxquels vous êtes inscrit</h1>
                <div style="text-align: center; margin-top: 10px;">
                    <a href="info_profil.php" class="btn btn-primary">Retour</a>
                </div>
                <tr>
                    <th>id</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Désinscrire</th>
                </tr>
                <?php foreach ($userEvents as $event): ?>
                <tr>
                    <td> <?php echo $event->id ?> </td>
                    <td> <?php echo $event->nom ?> </td>
                    <td> <?php echo $event->type ?> </td>
                    <td> <?php echo $event->date ?> </td>
                    <td><a href="desinscriptionEvent.php?event_id=<?php echo $event->id ?>"onclick="return confirm('Êtes-vous sûr de vouloir vous désinscrire ?');">Se désinscrire</a></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
    </body>
</html>


<style>
    body{
        font-family: 'Open Sans', sans-serif; /* Police d'écriture agréable */
    }
    table {
        border-collapse: collapse; /* Enlève les bordures doubles */
        width: 80%; /* ou toute autre largeur en pourcentage ou en pixels */
        margin: 0 auto; /* pour centrer le tableau horizontalement */
        margin-top: 1%;
    }

    th, td {
        border: 1px solid #ddd; /* Ajoute une bordure fine aux cellules */
        padding: 8px; /* Ajoute de l'espace entre le contenu et les bordures */
        text-align: left; /* Aligne le texte à gauche */
    }

    th {
        background-color: #f2f2f2; /* Couleur de fond des en-têtes */
        font-weight: bold; /* Met en gras les en-têtes */
    }
    tr:hover td {
        background-color: #f5f5f9;
    }

    tr:nth-child(even) {
        background-color: #f8f8f8; /* Couleur de fond des lignes paires */
    }

    .table {
        border-radius: 10px; /* Ajoute des formes légèrement arrondies */
    }
    .btn {
        padding: 8px 20px;
        border-radius: 5px;
        text-decoration: none;
        color: #fff;
    }
    .btn-primary {
        background-color: #4CAF50; /* Couleur de fond */
    }
    .btn:hover {
        background-color: #3e8e41; /* Couleur de fond lorsque le curseur est sur le bouton */
    }

</style>