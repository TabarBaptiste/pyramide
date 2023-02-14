<!DOCTYPE html>
<html lang="fr">

<head class="tete">
    <?php
    session_start();
    require_once 'fonction.php';
    //print_r($_POST);

    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];

        $user = idUser($user_id);
        $users = eventsByUser($user_id);
    }
    ?>
</head>

<body>
    <div class="container">
        <table class="table table-bordered table-dark">
            <h1>
            <?php echo $_SESSION['prenom'] ?> voici la liste des évènements auxquels <?php echo $user->prenom; ?> est inscrit            </h1>
            <div style="text-align: center; margin-top: 10px;">
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Date</th>
            </tr>
            <?php foreach ($users as $us): ?>
                <tr>
                    <td>
                        <?php echo $us->nom ?>
                    </td>
                    <td>
                        <?php echo $us->type ?>
                    </td>
                    <td>
                        <?php echo $us->date ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>

<style>
    body {
        font-family: 'Open Sans', sans-serif;
        /* Police d'écriture agréable */
    }

    table {
        border-collapse: collapse;
        /* Enlève les bordures doubles */
        width: 80%;
        /* ou toute autre largeur en pourcentage ou en pixels */
        margin: 0 auto;
        /* pour centrer le tableau horizontalement */
        margin-top: 1%;
    }

    th,
    td {
        border: 1px solid #ddd;
        /* Ajoute une bordure fine aux cellules */
        padding: 8px;
        /* Ajoute de l'espace entre le contenu et les bordures */
        text-align: left;
        /* Aligne le texte à gauche */
    }

    th {
        background-color: #f2f2f2;
        /* Couleur de fond des en-têtes */
        font-weight: bold;
        /* Met en gras les en-têtes */
    }

    tr:hover td {
        background-color: #f5f5f9;
    }

    tr:nth-child(even) {
        background-color: #f8f8f8;
        /* Couleur de fond des lignes paires */
    }

    .table {
        border-radius: 10px;
        /* Ajoute des formes légèrement arrondies */
    }

    .btn {
        padding: 8px 20px;
        border-radius: 5px;
        text-decoration: none;
        color: #fff;
    }

    .btn-primary {
        background-color: #4CAF50;
        /* Couleur de fond */
    }

    .btn:hover {
        background-color: #3e8e41;
        /* Couleur de fond lorsque le curseur est sur le bouton */
    }
</style>