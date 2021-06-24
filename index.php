<?php
session_start();
require_once('html_partials/headerIndex.php');
?>
<main>
    <!-- Carrousel -->
    <div class="row container">
        <div class=" col s12 m12  offset-l2 l8">
            <div class="carousel carousel-slider center">
                <div class="carousel-fixed-item center"></div>
                <!-- <div class="carousel-item red white-text" href="#one!">
                    <h2>First Panel</h2>
                    <p class="white-text">This is your first panel</p>
                </div> -->
                <img class="carousel-item" src="images/cheveux001.jpg" href="#two!">
                <img class="carousel-item" src="images/cheveux002.jpg" href="#two!">
                <img class="carousel-item" src="images/cheveux003.jpg" href="#two!">
                <img class="carousel-item" src="images/cheveux004.jpg" href="#two!">
                <!-- <h2>Second Panel</h2>
                    <p class="white-text">This is your second panel</p>
                </div> -->
                <!-- <div class="carousel-item green white-text" href="#three!">
                    <h2>Third Panel</h2>
                    <p class="white-text">This is your third panel</p>
                </div>
                <div class="carousel-item blue white-text" href="#four!">
                    <h2>Fourth Panel</h2>
                    <p class="white-text">This is your fourth panel</p>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Carrousel -->
    <div class="divIndex1">
        <div class="container">
            <div class="row">
                <div class="txtIndex">
                    <h2 class="left-align">Qui sommes nous</h2>
                </div>
                <p class="col s12 l6">Fondé en l’an 2000 le salon MARIKA est l’aboutissement d’un parcours professionnel qui m’a conduit à ancrer mon espace de travail au centre de la ville de Calvi, Cité Semper Fidelis, sous les Remparts de la Citadelle.<br /><br />
                    Nous avons fidélisé une clientèle calvaise exigeante et toute empreinte de nouveautés.<br /><br />
                    Aux fondamentaux de la coiffure mixte se sont greffés, au fil du temps, des techniques que savent apprécier les connaisseurs au travers de l’espace barbier et les élégantes auprès du pôle extensions capillaires de très grandes marques comme GREAT LENGTHS.<br /><br />
                    Le salon, ces dernières années s’est aussi résolument tourné vers les techniques naturelles, et notamment de la coloration végétale.<br /><br />
                    Le salon MARIKA à Calvi vous propose un espace dynamique et chaleureux où il fait bon passer du temps auprès de son équipe.<br /><br />
                    Vous qui passez par là, poussez la porte d’un monde de douceur et de bien être.</p>
                <img class="col s12 l6" src="images/cheveux005.jpg">
            </div>
        </div><br/>
    </div>

    <div class="container">
        <div class="row">
            <div class="txtIndex">
                <h2 class="right-align">L'avis des clients</h2>
            </div>
        </div>
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