<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$gestionUtilisateurs = new backOffice;
// if ($id_droits != 2) {
//     header('location:http://localhost/boutique/Error/404.php');
//     exit();
// }


?>

<main id="hideUsers">
    <div class="center-align">
        <h1>Gestion des utilisateurs</h1>
        <p>Le tableau des utilisateurs ci-dessous vous permet de modifier les informations les concernant ou encore les supprimer.</p>
        <button class="btn black"> <a class="btnHref" href="http://localhost/projet_pro/backoffice/backoffice.php">Retour</a></button>
    </div>

    <?php
        if (isset($_GET['show'])) {
            $gestionUtilisateurs->modifierUser();
        }
    ?>

    <div class="container">
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>E-Mail</th>
                        <th>Téléphone</th>
                        <th>Droits</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $gestionUtilisateurs->showTableUsers(); ?>
                </tbody>
            </table>
            <div class="left-align">
                <p>Droits : <br />
                1 = Utilisateur<br />
                2 = Administrateur</p>
            </div>
    </div>
</main>

<?php require_once('../html_partials/footer.php'); ?>
<script>

</script>