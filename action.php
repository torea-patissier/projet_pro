<?php
session_start();
include 'autoloader.php';
$pageAction = new index();

if (isset($_POST['commentaire'])) { // CF JS #avis est devenu var commentaire donc indirectement $_POST['commentaire'];

    $avisClient = htmlspecialchars(trim(addslashes($_POST['commentaire']))); // Idem
    $pageAction->envoyerCommentaire($avisClient);
}

echo $pageAction->voirAvisClients();


?>