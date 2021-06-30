<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$gestionCategories = new backOffice;
// if ($id_droits != 2) {
//     header('location:http://localhost:8888/boutique/Error/404.php');
//     exit();
// }

if (isset($_POST["valider"])) {
    if (!empty($_POST["newCategorie"])) {
        $gestionCategories->AjouterCategorieBdd();
        header('location:http://localhost:8888/projet_pro/backoffice/gestion_categories.php');
    }
    if (!empty($_POST["newSCategorie"])) {
        $gestionCategories->AjouterSCategorieBdd();
        header('location:http://localhost:8888/projet_pro/backoffice/gestion_categories.php');

    }
}

?>

<main>
    <?php
    echo "<div class='container'>";
    echo "<div class='row'>";
    echo "<div class='input-field col s12 m6 l6'>";
    $gestionCategories->AfficherCategoriesBdd();
    echo "</div><br/>";
    echo "<div class='input-field col s12 m6 l6'>";
    $gestionCategories->AfficherSCategoriesBdd();
    echo "</div>";
    echo "</div>";
    echo "</div>";
    ?>
    <br /><br />
    <form name="Ajouter_Catégorie" action="" id="formcategorie" method="POST">
        <div class="container">
            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <label>Nom de la nouvelle Catégorie :</label><br />
                    <input type="text" name="newCategorie" placeholder="Ajouter Categorie"><br /><br />
                </div>

                <div class="input-field col s12 m6 l6">
                    <label>Nom de la nouvelles Sous-Catégorie</label><br />
                    <input type="text" name="newSCategorie" placeholder="Ajouter Sous-Catégorie">
                </div>
            </div>
            <input id="submitForm" class="btn black" type="submit" name="valider" value="Ajouter">
        </div><br/>

    </form>
</main>
<?php require_once('../html_partials/footer.php'); ?>