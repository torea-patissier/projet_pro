<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Marika coiffure</title>
</head>
<body>
<header>
    <?php
    if (!isset($_SESSION['user'])) {
        $id_droits = 0;
    } else {
        $id_droits = $_SESSION['user']['id_droits'];
    }
    ?>
    <!-- Sidenav à mettre en navbar si écran mobile -->
<!--    <ul id="dropdown1" class="dropdown-content">-->
<!--        <li><a href="#!">Hommes</a></li>-->
<!--        <li class="divider"></li>-->
<!--        <li><a href="#!">Femmes</a></li>-->
<!--        <li class="divider"></li>-->
<!--        <li><a href="#!">Enfants</a></li>-->
<!--    </ul>-->
        <nav>
            <div class="nav-wrapper">
                <div class="hide-on-med-and-down">
                    <a href="index.php" class="brand-logo">Marika Coiffure</a>
                </div>

                <ul class="right">
                    <?php
                    if(isset($_SESSION['panier']) && $_SESSION['panier'] != null){
                    echo'<li><a href="boutique/panier.php"><i class="material-icons">shopping_cart</i></a></li>';
                    }
                    ?>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="boutique/produits.php">Boutique</a></li>
                    <?php
                    if(isset($_SESSION['user'])){
                        ?><li><a href="users/profil.php">Profil</a></li> <?php
                    }else{
                        ?><li><a href="users/connexion.php">Connexion</a></li> <?php
                    }
                    if(isset($_SESSION["user"]) && $_SESSION['user']['id_droits'] == 20260){
                        ?> <li><a href="backoffice/backoffice.php">Admin</a></li> <?php
                    }
                    ?>
                    <li><a href="galerie/galerie_hommes.php">Galerie</a></li>
                    <!-- Dropdown Trigger -->
    <!--                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Galerie<i class="material-icons right">arrow_drop_down</i></a></li>-->
                </ul>
            </div>
        </nav>


</header>