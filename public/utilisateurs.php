<?php
    require_once 'fonction.php';
    //print_r($_POST);
    $users = affichUsers();
    
    if (isset($_POST['update'])){
    getUpdateUsers($_POST);
    }
?>
<html>
    <header>
        <meta charset ="UTF-8">
        <link href="styleUtilisateurs.css" rel="stylesheet">
    </header>

<table class="table">
    <tr>
        <td>id</td>
        <td>email</td>
        <td>roles</td>
        <td>prenom</td>
        <td>nom</td>
        <td>Inscrit Newsletters</td>
        <!-- <td>Inscrit Evenements</td>
        <td>Nom Evenements</td> -->
        <td>Modifier</td>
    </tr>
    <?php foreach ($users as $use): ?>
    <tr>    
        <td><?php echo $use->id ?></td>
        <td><?php echo $use->email ?></td>
        <td><?php echo $use->roles ?></td>
        <td><?php echo $use->prenom ?></td>
        <td><?php echo $use->nom ?></td>
        <td><?php echo $use->newsletters ?></td>
        <!-- <td><?php echo $use->Inscrit_Evenements ?></td>
        <td><?php echo $use->Nom_evenements ?></td> -->
        <td><a href="UpdateUsers.php?id=<?php echo $use->id?> "><input type='submit' class='btn btn-primary' value='Modifier Utilisateur'></a></td>
    </tr>
<?php endforeach; ?>
<a href="index.php?"><input type='submit' class='btn btn-primary' value='Accueil'></a></td>
</html>