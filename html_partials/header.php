<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/lightbox.css">
    <script src="../js/lightbox.js" type="module" defer></script>
    <title>Marika coiffure</title>
</head>

<body>
<header>

        <nav class="headerN">
            <div class="nav-wrapper">
                <div class="hide-on-small-only">
                    <a href="../index.php" class="brand-logo-header">Marika Coiffure</a>
                </div>
                <div class="hide-on-small-only">

                <ul class="ulHeader right">
                    <?php
                    if(isset($_SESSION['panier']) && $_SESSION['panier'] != null){
                        echo'<li><a href="boutique/panier.php"><i class="material-icons">shopping_cart</i></a></li>';
                    }
                    ?>
                        <li><a class="headerG" href="../index.php">Accueil</a></li>

                        <li><a class="headerG" href="../boutique/produits.php">Boutique</a></li>

                        <?php

                        if(isset($_SESSION['user'])){

                            ?><li><a class="headerG" href="../users/profil.php">Profil</a></li> <?php

                        }else{

                            ?><li><a class="headerG" href="../users/connexion.php">Connexion</a></li> <?php
                        }

                        if(isset($_SESSION["user"]) && $_SESSION['user']['id_droits'] == 20260){

                            ?> <li><a class="headerG" href="../backoffice/backoffice.php">Admin</a></li> <?php
                        }

                        ?>
                        <!-- Dropdown Trigger -->
                        <li><a class="headerG" href="../galerie/galerie_hommes.php" data-target="dropdown1">Galerie</a></li>
                    </ul>
                </div>
                <div class="hide-on-med-and-up">
                    <ul class="right">
                        <?php
                        if(isset($_SESSION['panier']) && $_SESSION['panier'] != null){
                            echo'<li><a href="../boutique/panier.php"><i class="material-icons">shopping_cart</i></a></li>';
                        }
                        ?>
                        <li><a class="headerG" href="../index.php">Accueil</a></li>

                        <li><a class="headerG" href="../boutique/produits.php">Boutique</a></li>

                        <?php

                        if(isset($_SESSION['user'])){

                            ?><li><a class="headerG" href="../users/profil.php">Profil</a></li> <?php

                        }else{

                            ?><li><a class="headerG" href="../users/connexion.php">Connexion</a></li> <?php
                        }

                        if(isset($_SESSION["user"]) && $_SESSION['user']['id_droits'] == 20260){

                            ?> <li><a class="headerG" href="../backoffice/backoffice.php">Admin</a></li> <?php
                        }

                        ?>
                        <!-- Dropdown Trigger -->
                        <li><a class="headerG" href="../galerie/galerie_hommes.php" data-target="dropdown1">Galerie</a></li>
                    </ul>
                </div>
            </div>
        </nav>


</header>