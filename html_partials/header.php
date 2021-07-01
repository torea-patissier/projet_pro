<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Marika coiffure</title>
</head>

<body>
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
                <a href="#!" class="brand-logo">Logo</a>
                <ul class="right hide-on-med-and-down">

                    <li><a href="../index.php">Accueil</a></li>

                    <li><a href="#">Boutique</a></li>

                    <?php

                    if(isset($_SESSION['user'])){

                        ?><li><a href="../users/profil.php">Profil</a></li> <?php

                    }else{

                        ?><li><a href="../users/connexion.php">Connexion</a></li> <?php
                    }

                    if(($_SESSION['user']['id_droits']) == 20260){

                        ?> <li><a href="../backoffice/backoffice.php">Admin</a></li> <?php
                    }
                
                    ?>
                    <!-- Dropdown Trigger -->
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Galerie<i class="material-icons right">arrow_drop_down</i></a></li>
                </ul>
            </div>
        </nav>
    </header>