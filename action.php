<?php
session_start();
include 'autoloader.php';
$pageAction = new index();

// POSTER UN COMMENTAIRE
if (isset($_POST['newCom']) ) { // CF JS #avis est devenu var commentaire donc indirectement $_POST['commentaire'];

    $avisClient = htmlspecialchars(trim($_POST['newCom'])); // Idem
    $noteClient = htmlspecialchars(intval($_POST["note"]));
    echo $pageAction->envoyerCommentaire($avisClient, $noteClient);

}
// POSTER UN COMMENTAIRE


// VOIR COMMENTAIRE QUAND ON EN POSTE UN
if(isset($_GET['voirCom'])){  // CF JS fonction afficherCommentaire sen('voirCom')

    $resultat = $pageAction->voirAvisClients(); // Ici affiche les commentaires quand on poste un commentaire
    echo json_encode($resultat);
}
// VOIR COMMENTAIRE QUAND ON EN POSTE UN

    $resultat = $pageAction->voirAvisClients(); // Ici afficher les commentaires en bdd
    echo json_encode($resultat); // On encode le résultat au format JSON


?>