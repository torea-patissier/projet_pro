<?php
require_once('dbClass.php');
class boutique extends bdd
{
    public function query($sql, $data = array())
    { // Requête générique utilisé dans panier et produits.php

        $con = $this->connectDb();
        $req = $con->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function voirProduit() // VOIR LE OU LES PRODUITS
    {
        $con = $this->connectDb();

        if (isset($_GET['show'])) { // AFFICHER UN PRODUIT SELECTIONNE AVEC GET

            $product = $_GET['show'];             // GET stocké dans une variable
            $request = $con->prepare("SELECT * FROM produits WHERE id = '" . $product . "' "); // Requête SQL
            $request->execute(); // On execute
            $produit = $request->fetch(PDO::FETCH_OBJ);  // Résultat stocké dans la $S
?>
            <div class="row">

                <div class="center-align col s12 m12 l12">
                    <h3><?= $produit->nom; ?></h3><br />
                </div>
                
                <div class="center-align">
                    <img src="../Images/<?= $produit->image_nom; ?>.jpg" alt="" height="300px">
                </div>

                <div class="center-align col s12 m12 l12">
                    <p><?= $produit->description; ?></p><br />
                    <a href="" class="price "><?= number_format($produit->prix, 2, ',', ' '); ?> € </a><br />
                    <a class="addPanier add btn black" href="../addpanier.php?id=<?= $produit->id; ?>">Acheter</a>
                </div>

            </div>
            <?php
        } else { // VOIR TOUS LES ARTICLES STOCKE EN BASE DE DONNEES

            $request = $con->prepare("SELECT * FROM produits "); // Requête SQL
            $request->execute(); // On execute
            $produit = $request->fetchAll(PDO::FETCH_OBJ);  // Résultat stocké dans la $S

            foreach ($produit as $product) { ?>

                <div class="row"><br />
                    <div class="description center-align col s12"><br />
                        <a href="?show=<?= $product->id; ?>"><img class="hide-on-small-only" src="../Images/<?= $product->image_nom ?>.jpg" height="150px" alt=""></a><br />
                        <a href="?show=<?= $product->id; ?>"><img class="hide-on-med-and-up" src="../Images/<?= $product->image_nom ?>.jpg" height="100px" alt=""></a><br />
                        <a href="?show=<?= $product->id; ?>"><?= $product->nom; ?></a><br />
                        <!-- number_format 10€ devient 10,00€ -->
                        <a href="" class="price "><?= number_format($product->prix, 2, ',', ' '); ?> € </a><br />
                        <a class="addPanier add btn black" href="../addpanier.php?id=<?= $product->id; ?>">Acheter</a>
                    </div>
                </div>
<?php
            }
        }
    }
}

?>