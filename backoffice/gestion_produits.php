<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$gestionProduits = new backOffice;

$id_droits = $_SESSION['user']['id_droits'];
if ($id_droits != 20260) {
    header('location:http://localhost/projet_pro/404.php');
    exit();
}

if(isset($_POST["addProduct"])){
    $gestionProduits -> ajoutProduitBdd();
}

if (isset($_GET['show'])) {
    $gestionProduits->ModifierProduit();
}

$gestionProduits->DeleteProduit();
?>


<main id="mainProduits">
    <div class="container fluid center-align">
        <h1> Gestion des produits </h1>
        <div id="divAjouterProduit">
            <p>Sur cet interfance vous pourrez ajouter, modifier ou encore surprimmer les articles disponibles sur votre espace Boutique </p>
            <div class="btnProduits">
                <button class="btn black"> <a class="aFooter" href="http://localhost/projet_pro/backoffice/backoffice.php">Retour</a></button>
                <button id="toggleAddProduct" class="btn black" onclick="showHideAddProduct();">Ajouter un produit</button>
            </div>
        </div>
                <div id="formAddProduct" style="display: none;">
                    <button class="btn black"><a class="btnHref" href="http://localhost/projet_pro/backoffice/gestion_produits?page=1.php">Retour</a></button>
                    <p>Avec ce formulaire vous pouvez ajouter un produit à votre page Boutique.<br />
                    En cas d'erreur il est possible de le supprimer dans l'onglet "Liste des produits"</p>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row">
                                <div class="input-field col s12 ">
                                    <input type="text" name="productName" placeholder="Nom du produit" required>
                                </div>
                                <div class="input-field col s12 ">
                                    <input type="text" name="productPrice" placeholder="Prix" required>
                                </div>
                                
                                <div class="input-field col s12 ">
                                    <input type="text" name="productDescription" placeholder="Description" required>
                                </div>
                                <div class="input-field col s12 ">
                                    <input type="text" name="productVolume" placeholder="Volume" required>
                                </div>
                                <div class="input-field col s12 ">
                                    <label>Catégorie du produit :</label><br /><br />
                                    <div class="input-field">
                                        <select name="productCategory" required>
                                            <option value="" disabled selected>Catégorie :</option>
                                            <?php $gestionProduits->selectCategory(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-field col s12 ">
                                    <label>Sous catégorie du produit :</label><br /><br />
                                    <div class="input-field">
                                        <select name="productSCategory" required>
                                        <option value="" disabled selected>Sous catégorie :</option>
                                            <?php $gestionProduits->selectSCategory(); ?>
                                        </select><br /><br />
                                    </div>
                                </div>
                                <div class="input-field col s12 ">
                                    <input type="text" name="productStock" placeholder="Produits en stock" required>
                                </div><br />
                                <p class="left-align">Chemin vers image du produit :</p>
                                <input type="file" name="Img" required><br /><br />
                                <input id="addProduct" class="btn black" type="submit" name="addProduct" value="Valider ✓">
                            </div>
                        </div>
                    </form>
                </div>

                
                <div id="tableProduct">
                   <?php $gestionProduits -> paginationProduits(); ?>
                </div>
                <br /><br /><br />
    </div>
</main>
<?php require_once('../html_partials/footer.php'); ?>