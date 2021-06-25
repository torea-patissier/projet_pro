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

<main> 

    <div class="container">
        <h2> Gestion des Utilisateurs </h2>
        <p>Tableau des utilisateurs du site </p>
        <table class="responsive-table">
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>E-Mail</th>
                    <th>Téléphone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $gestionUtilisateurs->tableauClients();
                ?>
            </tbody>
        </table>
    </div>
    
    <!-- Modal Trigger
    <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a> -->

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <div class="form-group">
            <label>Prenom</label>
            <input type="text" id="prenom" class="validate">
        </div>
        <div class="form-group">
            <label>Nom</label>
            <input type="text" id="nom" class="validate">
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input type="text" id="email" class="validate">
        </div>
        <div class="form-group">
            <label>Téléphone</label>
            <input type="text" id="tel" class="validate">
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" id="save" class="modal-close waves-effect black btn-flat ">Mettre à Jour</a>
        <a href="#!" class="modal-close waves-effect black btn-flat ">Annuler</a>
    </div>
    </div>
        



</main>

<?php require_once('../html_partials/footer.php'); ?>
<script>
$(document).ready(function () {
  $(document).on("click", "a[data-role=update]", function () {
    var id = $(this).data('id');
    var prenom = $('#'+id).children('td[data-target=prenom]').text();
    var nom = $('#'+id).children('td[data-target=nom]').text();
    var email = $('#'+id).children('td[data-target=email]').text();
    var tel = $('#'+id).children('td[data-target=tel]').text();

    $('#prenom').val(prenom);
    $('#nom').val(nom);
    $('#email').val(email);
    $('#tel').val(tel);
    $('#modal1').modal("toggle");
  });
});
</script>