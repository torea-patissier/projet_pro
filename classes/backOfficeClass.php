<?php

require_once ('dbClass.php');

class backOffice extends bdd {

    function buttonsBackoffice(){

        if(isset($_POST["btn_produits"])){
            header('Location: http://localhost/projet_pro/backoffice/gestion_produits.php');
        }

        if(isset($_POST["btn_clients"])){
            header('Location: http://localhost/projet_pro/backoffice/clients.php');
        }

        if(isset($_POST["btn_galerie"])){
            header('Location: http://localhost/projet_pro/backoffice/gestion_galerie.php');
        }

        if(isset($_POST["btn_categories"])){
            header('Location: http://localhost/projet_pro/backoffice/gestion_categories.php');
        }


    }

    public function ajoutProduitBdd()
    {
        $nomProduit = htmlspecialchars($_POST['productName']);
        $prixProduit = htmlspecialchars($_POST['productPrice']);
        $descriptionProduit = htmlspecialchars($_POST['productDescription']);
        $volumeProduit = htmlspecialchars($_POST['productVolume']);
        $idCategorie = htmlspecialchars($_POST['productCategory']);
        $idSCategorie = htmlspecialchars($_POST['productSCategory']);
        $stockProduit = htmlspecialchars($_POST['productStock']);
        
        //Traitement de l'image
        
        $Img = $_FILES["Img"]["name"];
        $img_Tmp = $_FILES["Img"]["tmp_name"];

        if(!empty($img_Tmp)){ //Si nom temporaire n'esst pas vide

            $img_Name = explode(".", $Img); //On enleve le point du nom
            $img_Ext = end($img_Name); //On attribue a img_Ext la valeur du dernier element du tableau

            if(in_array(strtolower($img_Ext),array("png", "jpg", "jpeg")) === false){ //si le dernier element du tableau ne correspond pas a un de ces types de fichier

                echo "L'image insérée doit avoir pour extension : .png, .jpg, .jpeg"; //On affiche un message d'erreur

            }else{ //sinon

                $img_Size = getimagesize($img_Tmp); //On attribue a la varirable img_Size la valeur du poids de l'image

                if($img_Size["mime"] == "image/jpeg"){  //si l'extension d'image est egale a jpeg

                    $img_Src = imagecreatefromjpeg($img_Tmp); //On recrée une nouvelle image a partir du jpeg

                }else if ($img_Size["mime"] == "image/png"){ //Si l'extension d'image est egale a png

                    $img_Src = imagecreatefrompng($img_Tmp); //On recrée une image a partir du png

                }else{ //sinon

                    $img_Src = false; //Source d'image = false
                    echo "Veuillez rentrer une image valide"; //On affiche le message d'erreur comme quoi l'image n'est pas valide
                }

                if($img_Src !== false){ //Si l'image est au bon format

                    $img_Width = 1000; 

                    if($img_Size[0] == $img_Width){

                        $img_Finale = $img_Src;

                    }else{

                        $new_Width[0] = $img_Width;

                        $new_Height[1] = 1000;

                        $img_Finale = imagecreatetruecolor($new_Width[0], $new_Height[1]);

                        imagecopyresampled($img_Finale, $img_Src, 0, 0, 0, 0, $new_Width[0], $new_Height[1], $img_Size[0], $img_Size[1]);

                    }

                    imagejpeg($img_Finale, "../Images/" .addslashes($nomProduit). ".jpg");
                }
            }

        }else{
            echo "Veuillez insérer une image à votre Produit.";
        }
        
        //Fin du traitement de l'image

        // <!-- POUR AFFICHER L'IMAGE ON A JUSTE A FAIRE DANS NOTRE BOUCLE D'AFFICHAGE <img src="../Images/php echo $result->nomProduit; .jpg"/>

        $con = $this->connectDb();
        $req = $con->prepare("INSERT INTO produits(nom, description, prix, volume, id_categorie, id_sous_categorie, stock) values (:nom, :description, :prix, :volume, :id_categorie, :id_sous_categorie, :stock)");
        $req->bindValue("nom", $nomProduit, PDO::PARAM_STR);
        $req->bindValue("prix", $prixProduit, PDO::PARAM_STR);
        $req->bindValue("volume", $volumeProduit, PDO::PARAM_STR);
        $req->bindValue("description", $descriptionProduit, PDO::PARAM_STR);
        $req->bindValue("id_categorie", $idCategorie, PDO::PARAM_INT);
        $req->bindValue("id_sous_categorie", $idSCategorie, PDO::PARAM_INT);
        $req->bindValue("stock", $stockProduit, PDO::PARAM_INT);
        
        $req->execute();
    }

    function selectCategory()
    {
        $con = $this->connectDb(); // Connexion Db 
        $stmt = $con->prepare("SELECT * FROM categories ORDER BY categorie ASC");// Requete
        $stmt->execute();//J'éxécute la requete
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//Result devient un tableau des valeurs obtenues
            echo'ok';
        foreach($result as $resultat){
            $categorie = $resultat["categorie"];
            $idCategorie = $resultat["id"];

            echo "<option value='$idCategorie'>$categorie</option>";
        }
    }

    function selectSCategory()
    {
        $con = $this->connectDb(); // Connexion Db 
        $stmt = $con->prepare("SELECT * FROM sous_categories ORDER BY sous_categorie ASC");// Requete
        $stmt->execute();//J'éxécute la requete
        $result = $stmt->fetchAll();//Result devient un tableau des valeurs obtenues

        foreach($result as $resultat){
            $categorie = $resultat["sous_categorie"];
            $idCategorie = $resultat["id"];


            echo "<option value='$idCategorie'>$categorie</option>";
        
        }
    }

    public function viewAllProduits()
    {
        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM produits");
        $request->execute();

        echo "<br /><br /><br />";
        echo "<div class='rox'>";
        echo "<table id='tableProducts' class='responsive-table' ><thead>";
        echo "<th>Image Produit</th>";
        echo "<th>Nom Produit</th>";
        echo "<th>Prix Produit</th>";
        echo "<th>Volume</th>";
        echo '<th class="hide-on-med-and-down">Description Produit</th>';
        echo "<th>N° en Stock</th>";
        echo "</thead><tbody>";
        while($r = $request->fetch(PDO::FETCH_OBJ)){
        
        
            echo "<tr>";
            echo "<td><img src='../Images/" . addslashes($r->nom) .".jpg' width='100px' height='100px'/></td>";
            echo "<td>" . $r->nom . "</td>";
            echo "<td>" . $r->prix . "€</td>";
            echo "<td>" . $r->volume . "</td>";
            echo "<td class='hide-on-med-and-down'>" . $r->description . "</td>";
            echo "<td>" . $r->stock . "</td>";
            echo "<td><a id='modifyProduct' href='?show=" . $r->id . "' onclick='modifyProductsHideForms();'>Modifier</a><br/>";
            echo "<a href='?action=delete&amp;id=" . $r->id . "'>Supprimer</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table></div>";
    }

    function DeleteProduit(){
        $con = $this->connectDb();

                // Supprimer un article de la Bdd
                if(isset($_GET['action'])&&($_GET['action']== 'delete')){
                    $id = htmlspecialchars($_GET['id']);
                    $req = $con->prepare("DELETE FROM produits WHERE id = :id ");
                    $req->bindValue("id", $id, PDO::PARAM_INT);
                    $req->execute(); 
                    header('location:http://localhost/projet_pro/backoffice/gestion_produits.php');
                }
    }


    function ModifierProduit()
    {   
            $id = $_GET["show"];
            $con = $this->connectDb();
            $product = htmlspecialchars($_GET['show']);
            $request = $con->prepare("SELECT * FROM produits WHERE id = :id"); // Requête SQL
            $request->bindValue("id", $id, PDO::PARAM_INT);
            $request->execute(); // On execute

            $s = $request->fetch(PDO::FETCH_OBJ);  // Résultat stocké dans la $S

            ?> 
            <br /><br /><br />
                <div class="container">
                    <div class="center-align">
                        <img class="hide-on-small-only" src="../Images/<?php echo $s->nom;?>.jpg" width="500px" height="500px"/><br/><br/>
                        <img class="hide-on-med-and-up" src="../Images/<?php echo $s->nom;?>.jpg" width="290px" height="290px"/><br/><br/>
                    </div>
            <div class="row">
            <form id='modifierArticle' class="col s12" action="" method="post">
                <div class="input-field col s12 m4 l4">
                    <label>Titre :</label><br/><br />
                    <input type="text" name="nom" value="<?php echo $s->nom;?>" required><br/><br />
                </div>
                <div class="input-field col s12 m4 l4">
                <label>Description :</label><br/><br />
                <textarea name="description" rows="4" cols="50" required><?php echo $s->description;?></textarea><br/><br />
                </div>

                <div class="input-field col s12 m4 l4">
                <label>Prix :</label><br/><br />
                <input type="text" name="prix" value="<?php echo $s->prix;?>" required><br/><br />
                </div>

                <div class="input-field col s12 m4 l4">
                <label>Stock :</label><br/><br />
                <input type="text" name="stock" value="<?php echo $s->stock;?>" required><br/><br />
                </div><br/>

                <input class="btn black center-align" type="submit" name="envoyer" value="Modifier"><br/><br />
            </form>
            </div>
            </div>

            <?php
            // Si on appuie sur modifier
            if(isset($_POST['envoyer'])){
                

                $nom = htmlspecialchars(addslashes($_POST['nom']));
                $description = htmlspecialchars(addslashes($_POST['description']));
                $prix = htmlspecialchars($_POST['prix']);
                $stock = htmlspecialchars($_POST['stock']);

                // Requête de modification
                //UPDATE produits SET nom = 'coco', prix = 10, description = 'Oui', id_categorie = 21, id_sous_categorie = 22, stock = 23, chemin_image = 0 WHERE id = 36

                $update = $con->prepare("UPDATE produits SET nom = :nom, prix = :prix, description = :description, stock = :stock WHERE id = :id ");
                $update->bindValue("nom", $nom, PDO::PARAM_STR);
                $update->bindValue("prix", $prix, PDO::PARAM_INT);
                $update->bindValue("description", $description, PDO::PARAM_STR);
                $update->bindValue("stock", $stock, PDO::PARAM_INT);
                $update->bindValue("id", $id, PDO::PARAM_INT);
                $update->execute();

                //REFRESH / HEADER LOCATION AVEC JAVASCRIPT
                $gestionProduits = new backOffice;
                echo '<script language="Javascript"> document.location.replace("http://localhost/projet_pro/backoffice/gestion_produits.php"); </script>';
                $gestionProduits -> viewAllProduits();




            }

    
    }

    function tableauClients() {

    $con = $this->connectDb();
    $request = $con -> prepare("SELECT * FROM utilisateurs");
    $request -> execute(); 
        while($r = $request->fetch(PDO::FETCH_OBJ)){
            
            
            echo "<tr id ='$r->id'>";
            echo "<td data-target='nom'>" . $r->nom . "</td>";
            echo "<td data-target='prenom'>" . $r->prenom . "</td>";
            echo "<td data-target='email'>" . $r->email . "€</td>";
            echo "<td data-target='tel'>" . $r->tel . "</td>";
            // echo "<td><a id='modifyProduct' href='?show=" . $r->id . "' onclick='modifyProductsHideForms();'>Modifier</a><br/>";
            // echo "<a href='?action=delete&amp;id=" . $r->id . "'>Supprimer</a></td>";
            echo "<td><a href='#' data-role='update' data-id='$r->id'> Update </a></td>";
            echo "<td></td>";

            echo "</tr>";
        }

    }

    public function AfficherCategoriesBdd()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM categories ORDER BY categorie ASC");
        $req->execute();
        $result = $req->fetchAll();

        echo "<h2> Catégories : </h2>";
        foreach ($result as $resultat) {

            echo $resultat["categorie"] . ' ' . ' <a class="href_admin" href="gestion_categories.php?id=' . $resultat['id'] . '">' . ' <b>Supprimer</b>' . '</a>' . "<br />";
        }

        if (isset($_GET['id']) and !empty($_GET['id'])) {

            $id = $_GET['id'];
            $supp = $con->prepare("DELETE FROM categories WHERE id = :id ");
            $supp->bindValue('id', $id, PDO::PARAM_INT);
            $supp->execute();
            header('location:http://localhost/projet_pro/backoffice/gestion_categories.php');
        }
    }

    public function AfficherSCategoriesBdd()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM sous_categories ORDER BY sous_categorie ASC");
        $req->execute();
        $result = $req->fetchAll();

        echo "<h2> Sous Catégories : </h2>";
        foreach ($result as $resultat) {
            echo $resultat["sous_categorie"] . ' ' . ' <a class="href_admin" href="gestion_categories.php?id=' . $resultat['id'] . '">' . ' <b>Supprimer</b>' . '</a>' . "<br />";
        }

        if (isset($_GET['id']) and !empty($_GET['id'])) {

            $id = $_GET['id'];
            $supp = $con->prepare("DELETE FROM sous_categories WHERE id = :id ");
            $supp->bindValue('id', $id, PDO::PARAM_INT);
            $supp->execute();
            header('location:http://localhost/projet_pro/backoffice/gestion_categories.php');
        }
    }



    public function AjouterCategorieBdd()
    {
        $newCategorie = htmlspecialchars($_POST["newCategorie"]);
        $con = $this->connectDb();
        $req = $con->prepare("INSERT into categories (categorie) value (:newCategorie)");
        $req->bindValue("newCategorie", $newCategorie, PDO::PARAM_STR);
        $req->execute();
    }

    public function AjouterSCategorieBdd()
    {
        $con = $this->connectDb(); // Connexion Db 
        $stmt = $con->prepare("SELECT * FROM sous_categories"); // Requete
        $stmt->execute(); //J'éxécute la requete
        $result = $stmt->fetchAll(); //Result devient un tableau des valeurs obtenues
        $newSCategorie = htmlspecialchars($_POST["newSCategorie"]); //
        foreach ($result as $resultat) {
            if ($newSCategorie == $resultat['sous_categorie']) {
                echo "La sous catégorie existe dejà en base de données";
            }
        }
        $stmt = $con->prepare("INSERT INTO sous_categories (sous_categorie) values (:nom)");
        $stmt->bindValue('nom', $newSCategorie, PDO::PARAM_STR);
        $stmt->execute();
    }




}