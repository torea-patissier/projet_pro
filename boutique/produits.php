<?php
session_start();
require_once('../html_partials/header.php');
require_once('../classes/boutiqueClass.php');
require_once('../classes/panierClass.php');
$pageProduits = new boutique();
$panier = new panier();

?><br />
    <main class="divProduits">
        <?php
        $pageProduits->voirProduit(); // On peut voir avec cette classe LE ($_GET) ou TOUS les produits en Bdd
        ?>
    </main><br />
<?php
require_once('../html_partials/footer.php');
?>