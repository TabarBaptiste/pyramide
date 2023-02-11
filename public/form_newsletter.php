<!DOCTYPE html>
<html lang="fr">

<head class="tete">
    <?php
    session_start();
    require_once 'fonction.php';
    $newsletters = afficheNewsletters();
    ?>
</head>

<body>

    <!-- Formulaire -->
    <form class="formulaire" action="index.php" method="post">
        <div class="form-group">
            <label class="ecrit" for="nom">Nom de la newsletter :</label>
            <input type="text" class="objet" id="nom" placeholder="Entrez le nom de la newsletter" name="nom" required>
        </div>
        <div class="form-group">
            <label class="ecrit" for="content">Contenu de la newsletter :</label>
            <textarea class="objet" id="content" rows="4" placeholder="Entrez le contenu de la newsletter"
                name="content" required></textarea>
        </div>
        <input type="submit" name="news" value="Créer" class="bout">
    </form>

    <!-- Liste -->
    <div class="container">
        <table class="table table-bordered table-dark">
            <h1>
                <?php echo $_SESSION['prenom'] ?> voici la liste des newsletters
            </h1>
            <div style="text-align: center; margin-top: 10px;">
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
            <tr>
                <th>id</th>
                <th>Nom</th>
                <th>Contenu</th>
                <th>Créé le</th>
                <th>Envoyé ?</th>
                <th>Update</th>
                <th>Envoyer</th>
            </tr>
            <?php foreach ($newsletters as $newsl): ?>
                <tr>
                    <td>
                        <?php echo $newsl->id ?>
                    </td>
                    <td>
                        <?php echo $newsl->nom ?>
                    </td>
                    <td>
                        <?php echo $newsl->content ?>
                    </td>
                    <td>
                        <?php echo $newsl->created_at ?>
                    </td>
                    <td>
                        <?php if ($newsl->is_sent == 0) {
                            echo "Non";
                        } else {
                            echo "Oui";
                        } ?>
                    </td>
                    <td>
                        <a href="updateNewsletters.php?id=<?php echo $newsl->id ?>"><button
                                type="button">Modifier</button></a>
                    </td>
                    <td>
                        <a href="envoieNews.php?id=<?php echo $newsl->id ?>"><button type="button">Envoyer</button></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>

</html>

<style>
    body {
        font-family: 'Open Sans', sans-serif;
        /* Police d'écriture agréable */
        background-image: url('assets/images/img/DJI_0007.JPG');
        background-size: cover;
        background-repeat: no-repeat;
        backdrop-filter: blur(0px);
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

    .login_btn {
        background-color: blue;
    }

    .formulaire {
        background-color: #F0F0F0;
        width: 50%;
        margin: 0 auto;
        border-radius: 10px;
        padding: 40px;
        background-color: rgba(255, 255, 255, 0.7);


        background-image: url('assets/images/img/logo.png');
        background-size: 100%;
        background-repeat: no-repeat;
        background-position: center;
        background-blend-mode: screen;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .ecrit {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    .objet {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid gray;
    }

    .bout {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    .bout:hover {
        background-color: #3e8e41;
    }

    .container {
        background-color: #F0F0F0;
        width: 90%;
        height: 10%;
        margin: 0 auto;
        margin-top: 1%;
        border-radius: 10px;
        padding: 9px;
    }
</style>