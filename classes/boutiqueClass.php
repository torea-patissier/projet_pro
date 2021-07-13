<?php
require_once('dbClass.php');
class boutique extends bdd
{

    // Montrer les articles stocké en Bdd avec la possibilité d'en selectionner un pour en afficher QU'UN SEUL
    public function showArticles()
    {
        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM produits");
        $request->execute();
        // ICI ON VERRA CE QUE CONTIENT UN SEUL ARTICLE
        // Si on appuie sur show
        if (isset($_GET['show'])) {

            $product = $_GET['show'];             // GET stocké dans une variable
            $request = $con->prepare("SELECT * FROM produits WHERE nom = '" . $product . "' "); // Requête SQL
            $request->execute(); // On execute

            $s = $request->fetch(PDO::FETCH_OBJ);  // Résultat stocké dans la $S

?>
            <div class="row ">
                <div class="kiki col s12 center-align">
                    <h4><?php echo $s->nom; ?></h4>
                    <img class="hide-on-small-only" src="../Images/<?php echo $s->image_nom; ?>.jpg" width="400px" height="400px" />
                    <img class="hide-on-med-and-up" src="../Images/<?php echo $s->image_nom; ?>.jpg" width="250px" height="250px" />
                        <h5 class="hide-on-med-and-down"> <?php echo $s->description; ?></h5>
                    </h3>
                    <h4> Prix : <?php echo $s->prix; ?> €</h4>
                    <?php

                    if ($s->stock > 10) { // Si le stock > 10 on affiche le produit, sinon on affiche la rupture de stock

                    ?>
                        <!-- l=titre // q=1 par défaut car on ajoute 1 quantité au panier // p=prix -->
                        <a class="btn black" href="panier.php?action=ajout&amp;l=<?php echo $s->nom; ?>&amp;q=1&amp;p=<?php echo $s->prix; ?>&amp;i=<?php echo $s->id ?>">Ajouter au panier</a>
                        <!-- Dans ce href TOUT doit être collé -->
                    <?php
                    } else {

                        echo ' <h3> Produit en rupture de stock </h3>';
                    }?>

                </div>
            </div>
                    <?php
                } else {
                    // ICI ON VERRA TOUS LES ARTICLES STOCKE EN BDD

                    while ($r = $request->fetch(PDO::FETCH_OBJ)) { // Boucle while pour récup les éléments de produits

                    ?>
                        <div class="row">

                            <div class="coco col s6 m3 l12">

                                <?php
                                $lenght = 10; // Cette $ pour limiter a 50 caractères le nb de lettres affiché pour la description
                                $description = $r->description; // On stock dans une var
                                $new_description = substr($description, 0, $lenght) . '...';
                                ?>
                                <!-- On récupère l'ID d'un article pour l'ajouter à show -->
                                    <a href="?show=<?php echo $r->nom; ?>"><img  class ="bordureProduit" src="../Images/<?php echo $r->image_nom; ?>.jpg" width="150px" height="150px" /></a>
                                    <a href="?show=<?php echo $r->nom; ?>">

                                <p><?php echo $r->nom; ?></p>
                                </a>
                                <h5> <?php echo $r->prix; ?>€</h5>
                                <!-- HREF pour ajouter un produit au panier + redirection sur panier.php IL FAUT PRENDRE EN COMPTE QU'IL N Y A PAS D ESPACE -->

                                <?php if ($r->stock > 10) { // Si le stock > 10 on affiche le produit, sinon on affiche la rupture de stock
                                ?>
                                    <a class="btn black" href="panier.php?action=ajout&amp;l=<?php echo $r->nom; ?>&amp;q=1&amp;p=<?php echo $r->prix; ?>&amp;i=<?php echo $r->id ?>">Acheter</a>
                                    <br /><br />
                                <?php
                                } else {
                                    echo ' <h6 class="red-text"> Produit en rupture de stock </h6>';
                                }
                                ?>

                            </div>

                        </div>
        <?php
                    }
                }
            }
        }
        ?>