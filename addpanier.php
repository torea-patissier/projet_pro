<?php
session_start();
require_once('classes/boutiqueClass.php');
require_once('classes/panierClass.php'); 
$pageProduits = new boutique();
$panier = new panier();
$json = array('error' => true);
if(isset($_GET['id'])){
     $product = $pageProduits->query('SELECT id FROM produits WHERE id = :id',array('id' => $_GET['id']));
    if(empty($product)){
        $json['message'] = 'Ce produit existe pas';
    }
    $panier->add($product[0]->id); // Récup l'id du produit
    $json['error'] = false;
    $json['message'] = 'Produit ajouté au panier';
}else{
    $json['message'] = 'Aucun produit séléctionné pour la panier';
}
echo json_encode($json);
?>