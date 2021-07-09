<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Marika coiffure</title>
</head>

<body>
<div class="hide-on-med-and-down">
    <header>
        <!-- Sidenav à mettre en navbar si écran mobile -->
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="#!">Hommes</a></li>
            <li class="divider"></li>
            <li><a href="#!">Femmes</a></li>
            <li class="divider"></li>
            <li><a href="#!">Enfants</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <ul class="right hide-on-med-and-down">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="boutique/produits.php">Boutique</a></li>
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
                    <!-- Dropdown Trigger -->
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Galerie<i class="material-icons right">arrow_drop_down</i></a></li>
                </ul>
            </div>
        </nav>
</div>

<div class="hide-on-large-only">
            <!-- Sidenav à mettre en navbar si écran mobile -->
            <ul id="slide-out" class="sidenav">
                <li><a class="waves-effect" href="index.php"><i class="material-icons">home</i>Accueil</a></li>
                <li><a class="waves-effect" href="#"><i class="material-icons">star_outline</i>Boutique</a></li>
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
                <li><a class="waves-effect" href="#"><i class="material-icons">shopping_cart</i>Panier</a></li><br />                                
                </ul>
            <a data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
</div>
    </header>