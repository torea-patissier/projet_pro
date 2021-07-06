<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageConnexion = new users();

if($_SESSION){
    header('Location:http://localhost/projet_pro/index.php');
}

?>
<main>
    <div class="container">
        <h1>Connexion</h1>
        <form action="connexion.php" method="post">
            <label>Email</label>
            <input type="email" name="email" id="email" value="<?php if($_POST)echo $_POST['email'];?>">
            <label>Mot de passe</label>
            <input type="password" name="password" id="password">
            <input class="btn black"type="submit" value="Se connecter" id="connexion" name="connexion">
            <p>Vous n'avez pas de compte chez nous ? <a href="../users/inscription.php"><b>Inscrivez vous</b></a>.</p>
        </form><br/>
        <?php
        if(isset($_POST['connexion'])){
            $pageConnexion->connexion();
        }
        ?>
    </div>
</main>
<?php
require_once('../html_partials/footer.php');
?>