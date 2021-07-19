<?php
session_start();
require_once('../html_partials/header.php');
require_once('../classes/boutiqueClass.php');
require_once('../classes/panierClass.php');
$pageProduits = new boutique();
$panier = new panier();

?>
    <form class="container" action="panier.php" method="post">
        <?php

        if ($_SESSION['panier']) { // Si panier existant on affiche le H1
            echo '<h1 class="center align">Votre panier</h1>';
        }

        if ($_SESSION['panier'] && isset($_POST['supprimerTout'])) { // Supprimer le panier entièrement
            unset($_SESSION['panier']);
            header('location:../index.php');
            exit;
        }

        if (empty($_SESSION['panier'])) { // Si pas de panier => redirection index
            header('location:../index.php');
            exit;
        }

        $ids = array_keys($_SESSION['panier']); // Récupère les clés du tableau

        if (empty($ids)) {
            $product = array();
        } else {
            $product = $pageProduits->query('SELECT * FROM produits WHERE id IN (' . implode(',', $ids) . ')');
        }
        // implode rassemble les éléments d'un tableau en une chaîne

        foreach ($product as $products) :
            ?>
            <table class="responsive table">
                <div class="row">
                    <td class="hide-on-small-only"><img src="../Images/<?= $products->image_nom; ?>.jpg" height='100px' alt="shampoing"></td>
                    <td class="hide-on-med-and-up"><img src="../Images/<?= $products->image_nom; ?>.jpg" height='70px' alt="shampoing"></td>

                    <td><?= $products->nom; ?></td>
                    <td> <?= number_format($products->prix, 2, ',', ' '); ?> €</td>
                    <!-- pour name = panier[quantity] on met dans un tableau chaque ID de produit pour pouvoir
                les modifier UN PAR UN dans le formulaire -->
                    <div class="row">
                        <td><input class="col s12 m6 l6" type="text" name="panier[quantity][<?= $products->id; ?>]" value="<?= $_SESSION['panier'][$products->id]; ?>"></td>
                    </div>
                    <td><a href="panier.php?delPanier=<?= $products->id; ?>"><i class="material-icons">delete_outline</i></a></td>
                </div>

            </table>
        <?php
        endforeach;
        ?><br />
        <?php
        if ($_SESSION['panier']) {
            ?>
            <div id="boxPanier">

                <div class="boxPanier0">
                    <h5>Total : <?= $panier->total(); ?> €</h5>
                    <h5> <?= $panier->count(); ?> article(s) <h5>
                </div>

                <div class="boxPanier1">
                    <input class="btn black col s12 m6 l4" type="submit" value="Modifier panier"><br /><br />
                    <input class="btn black col s12 m6 l4 left-align" name="supprimerTout" type="submit" value="Tout supprimer">
                </div>
            </div><br/>
            <?php
        } else {
            echo '<h1 class="center-align">Votre panier est vide </h1>';
        }

        require_once('../paypal/paypal.php');
        ?>
    </form>
<?php
require_once('../html_partials/footer.php');
?>