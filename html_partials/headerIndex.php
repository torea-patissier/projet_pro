<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Toréa Patissier">
    <meta name="keywords" content="marika, coiffure, salon, barbier, calvi, salons, tondeuse, rasoir, ciseaux, activités">
    <meta name="description" content="Le salon Marika à Calvi, est un salon de coiffure et barbier depuis 2000, expert dans son domaine, mais également depuis peu en teinture végétale. La qualité des préstations et services proposés, font de ce salon un endroit de référence.">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../css/lightbox.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Marika coiffure</title>
</head>

<body>
<div class="hide-on-med-and-down">
    <header>
        <!-- Sidenav à mettre en navbar si écran mobile -->
        <nav>
            <div class="nav-wrapper">
                <ul class="right hide-on-med-and-down">
                <?php

                    if(isset($_SESSION['panier']) && $_SESSION['panier'] != null){
                        echo'<li><a href="boutique/panier.php"><i class="material-icons">shopping_cart</i></a></li>';
                    }

                    ?>                
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="boutique/produits.php">Boutique</a></li>
                    <!-- Dropdown Trigger -->
                    <li><a class="waves-effect" href="galerie/galerie_homme.php">Galerie</a></li>
                    <?php
                    if(isset($_SESSION['user'])){
                        
                        ?><li><a href="users/profil.php">Profil</a></li> <?php

                        if(($_SESSION['user']['id_droits']) == 20260){
                            ?> <li><a href="backoffice/backoffice.php">Admin</a></li> <?php
                        }                
                    }else{
                        ?><li><a href="users/connexion.php">Connexion</a></li> <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
</div>

<div class="hide-on-large-only">
            <!-- Sidenav à mettre en navbar si écran mobile -->
            <ul id="slide-out" class="sidenav">
                    <?php
                    if(isset($_SESSION['panier']) && $_SESSION['panier'] != null){
                        echo'<li><a href="boutique/panier.php"><i class="material-icons">shopping_cart</i>Panier</a></li>';
                    }
                    ?>
                <li><a class="waves-effect" href="index.php"><i class="material-icons">home</i>Accueil</a></li>
                <li><a class="waves-effect" href="boutique/produits.php"><i class="material-icons">star_outline</i>Boutique</a></li>
                <li><a class="waves-effect" href="galerie/galerie_homme.php"><i class="material-icons">image</i>Galerie</a></li>
                <?php
                    if(isset($_SESSION['user'])){

                        ?><li><a class="waves-effect" href="users/profil.php"><i class="material-icons">person</i>Profil</a></li><?php

                        if(($_SESSION['user']['id_droits']) == 20260){
                            ?> <li><a class="waves-effect" href="backoffice/backoffice.php"><i class="material-icons">settings</i>Admin</a></li><?php
                        } 

                    }else{
                        ?><li><a class="waves-effect" href="users/connexion.php"><i class="material-icons">person</i>Connexion</a></li><?php
                    }                    
                    ?>
                </ul>
            <a data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
</div>
    </header>