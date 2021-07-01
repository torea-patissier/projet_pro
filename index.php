<?php
session_start();
require_once('html_partials/headerIndex.php');
include('autoloader.php');
$pageIndex = new index();

?>
<main>
    <div class="container">
        <?php $pageIndex->recherche(); ?>
    </div>

    <!-- Div N0 -->
    <div class="divIndex0">

        <h1 class="center-align txtIndex">Marika</h1><br />
        <!-- <div class="container h2Index">
            <h2 class="left-align txtIndex">Coiffure</h2>
            <h2 class="right-align txtIndex">Barbier</h2>
        </div> -->

    </div>
    <!-- Div N0 -->

    <!-- Div N1 -->
    <div class="divIndex1">
        <div class="container">
            <div class="row">
                <h2 class="txtIndex right-align">Qui sommes nous</h2>
                <img class="col s12 l6" src="images/cheveux005.jpg">
                <p class="col s12 l6">Fondé en l’an 2000 le salon MARIKA est l’aboutissement d’un parcours professionnel qui m’a conduit à ancrer mon espace de travail au centre de la ville de Calvi, Cité Semper Fidelis, sous les Remparts de la Citadelle.<br /><br />
                    Nous avons fidélisé une clientèle calvaise exigeante et toute empreinte de nouveautés.<br /><br />
                    Aux fondamentaux de la coiffure mixte se sont greffés, au fil du temps, des techniques que savent apprécier les connaisseurs au travers de l’espace barbier et les élégantes auprès du pôle extensions capillaires de très grandes marques comme GREAT LENGTHS.<br /><br />
                    Le salon, ces dernières années s’est aussi résolument tourné vers les techniques naturelles, et notamment de la coloration végétale.<br /><br />
                    Le salon MARIKA à Calvi vous propose un espace dynamique et chaleureux où il fait bon de passer du temps auprès de son équipe.<br /><br />
                    Vous qui passez par là, poussez la porte d’un monde de douceur et de bien être.</p>
            </div>
        </div><br />
    </div>
    <!-- Div N1 -->

    <div class="divIndex1a">
        <div class="container">
            <div class="row">
                <h2 class="txtIndex left-align">Les nouveautés</h2>

            </div>
        </div>
    </div>

    <!-- Parallax -->
    <div class="parallax-container">
        <div class="parallax"><img class="imgParallax" src="images/avant.jpg"></div>
    </div>
    <!-- Parallax -->

    <!-- Div N2 -->
    <div class="divIndex2">
        <div class="container">
            <div class="row ">
                <h2 class="txtIndex right-align">L'avis des clients</h2>
                <!-- Ici seront affiché les commentaires des clients -->
                <div id="afficherCommentaire"></div>
                <?php // Voir les avis des clients
                if (isset($_SESSION['user']['id'])) { // Si je suis connecté je peux poster un commentaire
                ?>

                    <form id="formIndex" method="" action="">
                        <input type="text" id="avis" name="avis">
                    </form>
                    <input class="btn black" type="submit" id="envoyerCommentaire" name="envoyerCommentaire">

                    <div id="response"></div>

                <?php
                } else { // Sinon je dois me connecter pour pouvoir le faire
                    echo '<br/> Veuillez vous connecter pour poster un commentaire';
                } ?>
            </div>
        </div>
    </div><br />
    <!-- Div N2 -->

    <!-- Div N3 -->
    <div class="container">
        <h2 class="txtIndex left-align">Nos marques</h2>
        <div class="row">
            <img class="col s12 m4 l4" src="images/furterer.png" alt="furterer">
            <img class="col s12 m4 l4" src="images/great-lengths.png" alt="great-lengths">
            <img class="col s12 m4 l4" src="images/wella.png" alt="wella">
        </div>
    </div>
    <!-- Div N3 -->

    <div class="container">
        <h2 class="txtIndex right-align">Nous trouver</h2><br />
    </div>

    <!-- Google map -->
    <div class="row">
        <iframe class="col s12 l12" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d734.6066058099755!2d8.757762461900706!3d42.56747073780077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12d0eb78690fb88f%3A0x348e8b08302089b8!2sMarika%20Coiffure!5e0!3m2!1sfr!2sfr!4v1624465617904!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <!-- Google map -->
</main>
<?php
require_once('html_partials/footerIndex.php');
?>