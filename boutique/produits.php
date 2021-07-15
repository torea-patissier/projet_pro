<?php
session_start();
require_once('../html_partials/header.php');
require_once('../classes/boutiqueClass.php');
require_once('../classes/panierClass.php');
$pageProduits2 = new boutique2();
$panier = new panier();

?><br />
<h1 class="center-align">Les produits en vente dans notre boutique</h1>
<main class="divProduits">
        <?php
        $products = $pageProduits2->query('SELECT * FROM produits');
        // Boucle pour récupérer grâce à la req du dessus les éléments en Bdd (image_nom,nom,prix)
        foreach ($products as $k => $product) { ?>
                <div class="description">
                                <a href=""><img class="hide-on-small-only" src="../Images/<?= $product->image_nom ?>.jpg" height="150px" alt=""></a><br />
                                <a href=""><img class="hide-on-med-and-up" src="../Images/<?= $product->image_nom ?>.jpg" height="50px" alt=""></a><br />
                                <?= $product->nom; ?><br />
                                <!-- number_format 10€ devient 10,00€ -->
                                <a href="" class="price "><?= number_format($product->prix, 2, ',', ' '); ?> € </a><br />
                                <a class="addPanier add btn black" href="../addpanier.php?id=<?= $product->id; ?>">Acheter</a>
                </div>
        <?php
        }
        ?>
</main><br />
<?php
require_once('../html_partials/footer.php');

?>