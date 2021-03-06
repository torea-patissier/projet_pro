<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$accueilBackoffice = new backOffice;
$accueilBackoffice -> buttonsBackoffice();

$id_droits = $_SESSION['user']['id_droits'];
if ($id_droits != 20260) {
    header('location:http://localhost:8888/projet_pro/404.php');
    exit();
}

?>
<main>
    <div class="resteEnBas">
        <h1 style="text-align: center;">Bienvenue dans le backoffice</h1>
            <div class="container center-align">
                <form action="" method="POST">
                    <div class="flex_backoffice">
                        <div class="row">
                            <div class="col s12 m6 l6 ">
                                <input type="submit" name="btn_produits" class="btn black" id="btn_backoffice" value="Produits">
                            </div>
                            <div class="col s12 m6 l6 ">
                                <input type="submit" name="btn_clients" class="btn black" id="btn_backoffice" value="Clients">
                            </div>
                        </div>
                    </div>
                    <div class="flex_backoffice">
                        <div class="row">
                            <div class="col s12 m6 l6 ">
                                <input type="submit" name="btn_galerie" class="btn black" id="btn_backoffice" value="Galerie">
                            </div>
                            <div class="col s12 m6 l6 ">
                                <input type="submit" name="btn_categories" class="btn black" id="btn_backoffice" value="Categories">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</main>
<?php
require_once('../html_partials/footer.php');
?>