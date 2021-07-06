<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$gestionGalerie = new backOffice;

$id_droits = $_SESSION['user']['id_droits'];
if ($id_droits != 20260) {
    header('location:http://localhost/projet_pro/404.php');
    exit();
}

    if(isset($_POST["sendNewGaleryCategory"]) && !empty($_POST["newGaleryCategory"])){
        $gestionGalerie->addNewGaleryCategory();
        header('location:http://localhost/projet_pro/backoffice/gestion_galerie?page=1.php');
    }

    if(isset($_POST["sendNewGaleryPhoto"]) && !empty($_POST["nameNewPhoto"])){
        $gestionGalerie->newPhoto();
        header('location:http://localhost/projet_pro/backoffice/gestion_galerie?page=1.php');
    }

    $gestionGalerie->deletePhoto();


?>
<main>
    <div class="container fluid center-align">
        <h1>Gestion galerie photos</h1>
        <div class="container">
            <div class="row">
                <div id="results_box"></div>
                <div id="pagination_controls"></div>
                   <div id="photosGalerie">
                        <?php $gestionGalerie->paginationGalerie(); ?>
                    </div>
                <div class="col s12 m12 l12">
                    <form action="" method="POST" name="formPhotoGalery" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="text" name="nameNewPhoto" placeholder="Nom de la photo" required>
                                </div>
                                <div class="input-field col s12">
                                    <input type="file" name="newPhoto" required>
                                </div>
                                <div class="input-field col s12">
                                    <select name="categoriePhoto">
                                        <option value="" disabled selected>Catégorie de la photo :</option>
                                        <?php $gestionGalerie->showPhotoCategory(); ?>
                                    </select><br /><br />
                                </div>
                                <div class="input-field col s12">
                                    <input class="btn black" type="submit" name="sendNewGaleryPhoto" value="Publier Photo">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col s12 m12 l12">
                    <?php $gestionGalerie->actualCategory(); ?>
                    <form action="" method="POST" name="formCategoryGalery">
                        <input type="text" name="newGaleryCategory">
                        <input class="btn black" type="submit" name="sendNewGaleryCategory" value="Ajouter Catégorie">
                    </form>
                </div>


            </div>
        </div>
    </div>
</main>

<?php require_once('../html_partials/footer.php'); ?>

<!--<div class="col s12 m12 l12">-->
<!--    <div class="carouselExtensions">-->
<!--        <p>Photos Extensions</p>-->
<!--        <div class="carousel">-->
<!--            --><?php //$gestionGalerie->carouselPhotosExtensions(); ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="col s12 m12 l12">-->
<!--    <div class="carousel">-->
<!--        --><?php //$gestionGalerie->carouselPhotosEnfant(); ?>
<!--    </div>-->
<!--</div>-->