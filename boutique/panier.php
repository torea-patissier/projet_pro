<?php
session_start();
require_once('../html_partials/header.php');
require_once('../classes/boutiqueClass.php');
require_once('../classes/panierClass.php');
$pageProduits2 = new boutique2();
$panier = new panier();
// echo'<pre>';
// var_dump($_SESSION);
// echo'</pre>';
?>
<form class="container" action="panier.php" method="post">
    <?php

    if ($_SESSION['panier']) { // Si panier existant on affiche le H1
        echo '<h1 class="center align">Votre panier</h1>';
    }

    if($_SESSION['panier'] && isset($_POST['supprimerTout'])){ // Supprimer le panier entièrement
        unset($_SESSION['panier']);
        header('location:../index.php');
        exit;
    }
    
    if(empty($_SESSION['panier'])){
        header('location:../index.php');
        exit;
    }
    
    $ids = array_keys($_SESSION['panier']); // Récupère les clés du tableau

    if (empty($ids)) {
        $product = array();
    } else {
        $product = $pageProduits2->query('SELECT * FROM produits WHERE id IN (' . implode(',', $ids) . ')');
    }
    // implode rassemble les éléments d'un tableau en une chaîne

    foreach ($product as $products) :
    ?>
        <table>
            <td><img src="../Images/<?= $products->image_nom; ?>.jpg" height='100px' alt="shampoing"></td>
            <td><?= $products->nom; ?></td>
            <td> <?= number_format($products->prix, 2, ',', ' '); ?> €</td>
            <!-- pour name = panier[quantity] on met dans un tableau chaque ID de produit pour pouvoir 
            les modifier UN PAR UN dans le formulaire -->
            <div class="row">
                <td><input class="col s12 m6 l6" type="text" name="panier[quantity][<?= $products->id; ?>]" value="<?= $_SESSION['panier'][$products->id]; ?>"></td>
            </div>
            <td><a href="panier.php?delPanier=<?= $products->id; ?>"><b>Supprimer</b></a></td>
        </table>
    <?php
    endforeach;
    ?><br />
    <?php
    if ($_SESSION['panier']) {
    ?>
            <div class="row boutonPanier">
                <input class="btn black col s12 m6 l4" type="submit" value="Modifier"><br /><br />
                <input class="btn black col s12 m6 l4 left-align" name="supprimerTout" type="submit" value="Supprimer le panier"><br /><br />
            </div>
    <?php
        echo '<b>Total : ' . $panier->total() . ' €</b><br/>';
        echo $panier->count() . ' article(s)';
    } else {
        echo '<h1 class="center-align">Votre panier est vide </h1>';
    }
    ?>
</form>
<?php
require_once('../html_partials/footer.php');
?>