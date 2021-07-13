<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageProduit = new boutique();
?><br/>
    <main class="divProduits">
        <?php
        $pageProduit->showArticles();
        ?>
    </main>
<?php
require_once('../html_partials/footer.php');

?>