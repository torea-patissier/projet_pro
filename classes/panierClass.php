<?php
require_once('dbClass.php');

class panier extends bdd{


    public function __construct(){
        // if(!$_SESSION){
        //     session_start();
        // } // Si pas de session on en crée une
        if(!isset($_SESSION['panier'])){

            $_SESSION['panier'] = array();
        } // Si pas de session panier, j'en crée un

        if(isset($_GET['delPanier'])){// Supprimer un élément du panier

            $this->del($_GET['delPanier']);
        }

        if(isset($_POST['panier']['quantity'])){
            $this->recalc();
        }
    }


    public function recalc(){ // Recalcule les éléments du panier

        foreach($_SESSION['panier'] as $product_id => $quantity){

            if(isset($_POST['panier']['quantity'][$product_id])
                && $_POST['panier']['quantity'][$product_id] >= 1 // Vérifie que la quantité est > 1
                && is_numeric($_POST['panier']['quantity'][$product_id]) // Vérifie que c'est un chiffre
                && ctype_digit($_POST['panier']['quantity'][$product_id])) // Vérifie que c'est un entier
            {
                $_SESSION['panier'][$product_id] = $_POST['panier']['quantity'][$product_id];
            }
        }
    }

    public function count(){// Retourne le nombre d'articles dans le panier

        return array_sum($_SESSION['panier']);
    }

    public function total(){ // Retourne le montant total du panier

        $con = $this->connectDb();
        $total = 0; // Instancier la $total à 0€
        $ids = array_keys($_SESSION['panier']); // Récupère les ID des articles en $_SESSION

        if(empty($ids)){  // Si pas d'ID $_SESSION

            $product = array(); // $product sera vide

        }else{ // sinon $product == $ids

            $product = $con->prepare('SELECT id,prix FROM produits WHERE id IN ('.implode(',', $ids).')');
            $product->execute();
            $prix = $product->fetchAll(PDO::FETCH_OBJ); // Récupère dans un tableau d'objet l'ID et les prix
        }
        foreach($prix as $prixTotal ){

            $total += $prixTotal->prix * $_SESSION['panier'][$prixTotal->id ]; // Attribue et incrémente total, le prix de chaque articles
        }
        return $total;
    }


    public function add($product_id){ //Ajoute ou incrémente un produit au panier

        if(isset($_SESSION['panier'][$product_id])){// Si un article est ajouté et qu'il existe dans le panier

            $_SESSION['panier'][$product_id]++; // On incrémente

        }else{

            $_SESSION['panier'][$product_id] =1;//Sinon on le rajoute
        }
    }

    public function del($product_id){ // Supprimer un élément du panier via GETid du produit

        unset($_SESSION['panier'][$product_id]);
    }
}
?>