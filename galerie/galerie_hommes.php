<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$galerie = new galerie;

if(isset($_GET["hommes"])){
    $galerie->galerieHommes();
}

if(isset($_GET["femmes"])){
    $galerie->galerieFemmes();
}

if(isset($_GET["enfants"])){
    $galerie->galerieEnfants();
}
?>

<main>
    <div class="grid">
    <?php $galerie->galerieHommes(); ?>
    </div>
</main>

<?php require_once('../html_partials/footer.php'); ?>
