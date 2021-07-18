<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$gestionGalerie = new backOffice;

$id_droits = $_SESSION['user']['id_droits'];
if ($id_droits != 20260) {
    header('location:http://localhost:8888/projet_pro/404.php');
    exit();
}

    if(isset($_POST["sendNewGaleryCategory"]) && !empty($_POST["newGaleryCategory"])){
        $gestionGalerie->addNewGaleryCategory();
        header('location:http://localhost:8888/projet_pro/backoffice/gestion_galerie.php?page=1');
    }

    if(isset($_POST["sendNewGaleryPhoto"]) && !empty($_POST["nameNewPhoto"])){
        $gestionGalerie->newPhoto();
        header('location:http://localhost:8888/projet_pro/backoffice/gestion_galerie.php?page=1');
    }

    
    if (isset($_GET['deleteGCategory']) and !empty($_GET['deleteGCategory'])) {
        $gestionGalerie->deleteGCategory();
    }
    
    if(isset($_GET['delete'])){

        $gestionGalerie->deletePhoto();

    }

?>
<main>
    <div class="container fluid center-align">
        <h1><u>Gestion galerie photos</u></h1>
        <div class="container">
            <div class="row">
                   <div id="photosGalerie">
                       <h2>Photos en ligne</h2>
                       <p>Dans le tableau ci dessous vous pouvez consulter les photos qui sont actuellement présentées dans la page galerie</p>
                        <?php $gestionGalerie->paginationGalerie(); ?>
                    </div>
                    <br /><br /><br />
                <div class="col s12 m12 l12">
                    <hr><hr>
                    <h3>Ajouter photo</h3>
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
                    <hr><hr>
                    <h4>Ajouter Catégorie</h4>
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
