<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';

$pageProfil = new users();

if(isset($_POST['deco'])){
    $pageProfil->deco();
}

if(isset($_POST['modifier'])){
    $pageProfil->modifierProfil();
}


if(!$_SESSION['user']){
    header('location:http://localhost:8888/projet_pro/index.php');
}
?>
<main>
    <div class="center-align">
    <h1>Bonjour <?php $pageProfil->voirPrenom(); ?> !</h1>
        <p>Pour modifier vos informations, veuillez remplir les champs ci-dessous</p>
    </div>
    <form action="profil.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col m6 s12">

                    <label class="labelProfil">Nom :</label>
                    <input class="zonetxt_profil" type="text" name="nom" id="nom" placeholder="<?php $pageProfil->voirNom(); ?>"><br /><br />

                    <label class="labelProfil">Prénom :</label>
                    <input class="zonetxt_profil" type="text" name="prenom" id="prenom" placeholder="<?php $pageProfil->voirPrenom(); ?>"><br /><br />

                    <label class="labelProfil">Tel :</label><br />
                    <input class="zonetxt_profil" type="number" name="tel" id="tel" placeholder="<?php $pageProfil->voirTel(); ?>"><br /><br />

                </div>
                <div class="col m6 s12">

                    <label class="labelProfil">Email :</label><br />
                    <input class="zonetxt_profil" type="email" name="email" id="email" placeholder="<?php $pageProfil->voirEmail(); ?>"><br /><br />

                    <label class="labelProfil">Modifiez votre mot de passe :</label><br />
                    <input class="zonetxt_profil" type="password" name="password" id="password" placeholder="Mot de passe"><br /><br />

                    <label class="labelProfil">Confirmation de mot de passe :</label><br />
                    <input class="zonetxt_profil" type="password" name="confpass" id="confpass" placeholder="Confirmez ici"><br /><br />

                </div>
            </div>

            <div class="center-align">
                <a> <input class="btn black" type="submit" value="Modifier" name="modifier" id="modifier"></a>
                <a> <input class="btn black" type="submit" value=" Déconnexion" id ="deco" name="deco"> </a>
            </div>

        </div>
    </form><br/>
</main>
<?php
require_once('../html_partials/footer.php');
?>