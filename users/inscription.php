<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageInscription = new users();

if (isset($_POST["inscription"])) {
    $pageInscription->register();
}

?>
<main>

    <form action="" method="POST">
        <div class="container">
            <h1 class="center-align">Inscription</h1><br/><br/>
            <div class="row">
                <div class="col s12 m6 l6">
                    <label>Nom</label><br /><br />
                    <input type="text" name="iNom" id="iNom" value="<?php if($_POST)echo $_POST['iNom'];?>" autofocus required><br /><br />
                    <label>Prenom</label><br /><br />
                    <input type="text" name="iPrenom" id="iPrenom" value="<?php if($_POST)echo $_POST['iPrenom'];?>" required><br /><br />
                    <label>Email</label><br /><br />
                    <input type="email" name="iEmail" id="iEmail" value="<?php if($_POST)echo $_POST['iEmail'];?>" required><br /><br />
                </div>

                <div class="col s12 m6 l6">
                    <label>Tel</label><br /><br />
                    <input type="tel" name="iTel" id="iTel" value="<?php if($_POST)echo $_POST['iTel'];?>" required><br /><br />
                    <label>Mot de passe</label><br /><br />
                    <input type="password" name="iPassword" id="iPassword" value="<?php if($_POST)echo $_POST['iPassword'];?>" required><br /><br />
                    <label>Confirmation de passe</label><br /><br />
                    <input type="password" name="iConfPassword" id="iConfPassword" value="<?php if($_POST)echo $_POST['iConfPassword'];?>" required><br /><br />
                    
                </div>
                <input class="btn black" type="submit" value="S'inscrire" name="inscription"id="inscription">
                <p class="dejauncompte_inscription">Vous avez déjà un compte chez nous ? <a href="../users/connexion.php"><b>Connectez vous</b></a>.</p>
            </div>
        </div>
    </form>
</main>
<?php
require_once('../html_partials/footer.php');
?>