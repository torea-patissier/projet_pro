<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$gestionProduits = new backOffice;
// if ($id_droits != 2) {
//     header('location:http://localhost/boutique/Error/404.php');
//     exit();
// }

if(isset($_POST["addProduct"])){
    $gestionProduits -> ajoutProduitBdd();
}

if (isset($_GET['show'])) {

    $gestionProduits->ModifierProduit();
}

$gestionProduits->DeleteProduit();
?>


<main>
    <div class="container fluid center-align">
        <h1> Gestion des produits </h1>
        <p>Sur cet interfance vous pourrez ajouter, modifier ou encore surprimmer les articles disponibles sur votre espace Boutique </p>
        <div class="btnProduits">
            <button id="toggleAddProduct" class="btn black" onclick="showHideAddProduct();">Ajouter un produit</button>
        </div>
                <div id="formAddProduct" style="display: none;">
                    <p>Avec ce formulaire vous pouvez ajouter un produit à votre page Boutique.<br />
                    En cas d'erreur il est possible de le supprimer dans l'onglet "Liste des produits"</p>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row">
                                <div class="input-field col s12 ">
                                    <input type="text" name="productName" placeholder="Nom du produit">
                                </div>
                                <div class="input-field col s12 ">
                                    <input type="text" name="productPrice" placeholder="Prix">
                                </div>
                                <div class="input-field col s12 ">
                                    <input type="text" name="productDescription" placeholder="Description">
                                </div>
                                <div class="input-field col s12 ">
                                    <label>Catégorie du produit :</label><br /><br />
                                    <div class="input-field">
                                        <select name="productCategory">
                                            <option value="" disabled selected>Catégorie :</option>
                                            <?php $gestionProduits->selectCategory(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-field col s12 ">
                                    <label>Sous catégorie du produit :</label><br /><br />
                                    <div class="input-field">
                                        <select name="productSCategory">
                                        <option value="" disabled selected>Sous catégorie :</option>
                                            <?php $gestionProduits->selectSCategory(); ?>
                                        </select><br /><br />
                                    </div>
                                </div>
                                <div class="input-field col s12 ">
                                    <input type="text" name="productStock" placeholder="Produits en stock">
                                </div><br />
                                <p class="left-align">Chemin vers image du produit :</p>
                                <input type="file" name="Img"><br /><br />
                                <input id="addProduct" class="btn black" type="submit" name="addProduct" value="Valider ✓">
                            </div>
                        </div>
                    </form>
                </div>

                
                <div id="tableProduct">
                   <?php $gestionProduits -> viewAllProduits(); ?>
                </div>
        
    </div>
</main>
<?php require_once('../html_partials/footer.php'); ?>