<?php
session_start();
require_once('html_partials/headerIndex.php');
include('autoloader.php');
$pageIndex = new index();


if(isset($_GET["posterRep"])){

}
?>
    <main class="mainIndex">
        <div class="barreRecherche">
            <div class="container center-align">
                <?php $pageIndex->recherche(); ?>

            </div>
        </div>

        <!-- Div N0 -->
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="divIndex0">
                        <div class="hide-on-small-only">
                            <p class="titrePhoto coll12">Bienvenue</p>
                        </div>
                        <div class="hide-on-med-and-up">
                            <p class="titrePhotoPetit col s12">Bienvenue</p>
                        </div>
                        <!--            <img src="Images/fondindex.jpg">-->
                        <!-- <div class="container h2Index">
                            <h2 class="left-align txtIndex">Coiffure</h2>
                            <h2 class="right-align txtIndex">Barbier</h2>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Div N0 -->

        <!-- Div N1 -->
        <div class="divIndex1">
            <div class="container">
                <div class="row">
                    <h2 class="txtIndexBlanc center-align">Qui sommes nous</h2>
                    <img class="imageEquipe col s12 l6" src="images/cheveux005.jpg">
                    <p class="qSN col s12 l6">Fondé en l’an 2000 le salon MARIKA est l’aboutissement d’un parcours professionnel qui m’a conduit à ancrer mon espace de travail au centre de la ville de Calvi, Cité Semper Fidelis, sous les Remparts de la Citadelle.<br /><br />
                        Nous avons fidélisé une clientèle calvaise exigeante et toute empreinte de nouveautés.<br /><br />
                        Aux fondamentaux de la coiffure mixte se sont greffés, au fil du temps, des techniques que savent apprécier les connaisseurs au travers de l’espace barbier et les élégantes auprès du pôle extensions capillaires de très grandes marques comme GREAT LENGTHS.<br /><br />
                        Le salon, ces dernières années s’est aussi résolument tourné vers les techniques naturelles, et notamment de la coloration végétale.<br /><br />
                        Le salon MARIKA à Calvi vous propose un espace dynamique et chaleureux où il fait bon de passer du temps auprès de son équipe.<br /><br />
                        Vous qui passez par là, poussez la porte d’un monde de douceur et de bien être.</p>
                </div>
            </div><br />
        </div>
        <!-- Div N1 -->

        <div class="divDerniersAjouts">
            <div class="container">
                <div class="row">
                    <h2 class="txtIndexNoir left-align">Les nouveautés</h2>
<!--                    <div class="container">-->
                        <div class="row center-align">
                           <?php $pageIndex->recupDerniersProds(); ?>
                        </div>
<!--                    </div>-->
                </div>
            </div>

        <!-- Div N2 -->
        <div class="divIndex2">
            <div class="container">
                <div class="row ">
                    <h2 class="txtIndexNoir right-align">L'avis des clients</h2>
                    <!-- Ici seront affiché les commentaires des clients -->
                    <div id="afficherCommentaire"></div>

                            <?php // Voir les avis des clients
                            if (isset($_SESSION['user']['id'])) { // Si je suis connecté je peux poster un commentaire
                            ?>

                            <form id="formIndex" method="" action="">
                                <div class="input-field">
                                    <input type="text" id="avis" name="avis" placeholder="Rédigez votre avis ici...">
                                </div>
                                <div class="stars">
                                    <i class="lar la-star" data-value="1"></i><i class="lar la-star" data-value="2"></i><i class="lar la-star" data-value="3"></i><i class="lar la-star" data-value="4"></i><i class="lar la-star" data-value="5"></i>
                                </div>
                                <input hidden id="note" type="text" name="note" value="0">
                                <input class="btn_avis btn black" type="submit" id="envoyerCommentaire" name="envoyerCommentaire">
                            </form>
                                <?php
                            } else { // Sinon je dois me connecter pour pouvoir le faire
                                echo '<br/> Veuillez vous connecter pour poster un commentaire';
                            } ?>

                            <div id="response"></div>


                </div>
            </div>
        </div><br />
        <!-- Div N2 -->

        <!-- Div N3 -->
        <div class="container">
            <h2 class="txtIndexNoir left-align">Nos marques</h2>
                <div class="row">
                    <div class="partenaires">
                        <img class="col s12 m4 l4" src="Images/furterer.png" alt="furterer">
                        <img class="col s12 m4 l4" src="Images/great-lengths.png" alt="great-lengths">
                        <img class="col s12 m4 l4" src="Images/wella.png" alt="wella">
                    </div>
                </div>
        </div>
        <!-- Div N3 -->

        <div class="container">
            <h2 class="txtIndexNoir right-align">Nous trouver</h2><br />
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