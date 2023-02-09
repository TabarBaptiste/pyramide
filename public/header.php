<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <title>La Pyramide</title>

    <!--
    Breezed Template
    https://templatemo.com/tm-543-breezed
    -->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/about_us.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-breezed.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

    </head>
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                            .La Pyramide
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Accueil</a></li>

                            <li class="scroll-to-section"><a href="#about">À propos de nous</a></li>

                            <!-- <li class="scroll-to-section"><a href="">Faire un don</a></li> -->

                            <li class="scroll-to-section"><a href="#projects">Les évenements</a></li>

                            <!--<li><a href="utilisateurs.php">Utilisateurs</a></li> -->

                            <li class="submenu">
                                <a href="javascript:;">User<?php
                                    global $pdo;
                                    require_once('fonction.php');
                                    session_start();
                                    if(!empty($_SESSION['id'])): ?>
                                        <t class="connected" style="color: blue;">◉</t>
                                    <?php else: ?>
                                        <t class="disconnected" style="color: red;">◉</t>
                                    <?php endif; ?></a>
                                <ul>
                                <?php
                                    
                                    if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
                                        echo '<li><a href="info_profil.php">'.$_SESSION['prenom'].'</a></li>';
                                        echo '<li><a href="logout.php" onclick="return confirm("Vous vous déconnecter ?");">Se déconnecter</a></li>';
                                        if ($_SESSION['role']=='ROLE_ADMIN'){
                                            echo '<li><a href="listeUser.php">Afficher users</a></li>';
                                            echo '<li><a href="listeEvents.php">Afficher events</a></li>';
                                        }
                                    } else {
                                        echo '<li><a href="authentification.php">Se connecter</a></li>';
                                        echo '<li><a href="register.php">S\'inscrire</a></li>';
                                    }
                                ?>
                                </ul>
                            </li>

                            <li class="scroll-to-section"><a href="#contact-us">Contactez nous</a></li> 
                            <!-- <div class="search-icon">
                                <a href="#search"><i class="fa fa-search"></i></a>
                            </div>-->
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
</html>