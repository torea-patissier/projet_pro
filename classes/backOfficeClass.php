<?php

require_once ('dbClass.php');

class backOffice extends bdd {

    function buttonsBackoffice(){

        if(isset($_POST["btn_produits"])){
            header('Location: http://localhost/projet_pro/backoffice/gestion_produits?page=1.php');
        }

        if(isset($_POST["btn_clients"])){
            header('Location: http://localhost/projet_pro/backoffice/clients.php');
        }

        if(isset($_POST["btn_galerie"])){
            header('Location: http://localhost/projet_pro/backoffice/gestion_galerie?page=1.php');
        }

        if(isset($_POST["btn_categories"])){
            header('Location: http://localhost/projet_pro/backoffice/gestion_categories.php');
        }


    }

    public function ajoutProduitBdd()
    {
        $nomProduit = trim(htmlspecialchars($_POST['productName']));
        $prixProduit = trim(htmlspecialchars($_POST['productPrice']));
        $descriptionProduit = trim(htmlspecialchars($_POST['productDescription']));
        $volumeProduit = trim(htmlspecialchars($_POST['productVolume']));
        $idCategorie = trim(htmlspecialchars($_POST['productCategory']));
        $idSCategorie = trim(htmlspecialchars($_POST['productSCategory']));
        $stockProduit = trim(htmlspecialchars($_POST['productStock']));
        
        //Traitement de l'image
        
        $Img = $_FILES["Img"]["name"];
        $img_Tmp = $_FILES["Img"]["tmp_name"];

        if(!empty($img_Tmp)){ //Si nom temporaire n'esst pas vide

            $img_Name = explode(".", $Img); //On sépare la chaine de caractères en deux parties, avant et apres le point
            $img_Ext = end($img_Name); //On attribue a img_Ext la valeur du dernier element du tableau, l'extesion du fichier

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
                    $encName = md5(uniqid());
                    imagejpeg($img_Finale, "../Images/" . $encName . ".jpg");
                }
            }

        }else{
            echo "Veuillez insérer une image à votre Produit.";
        }
        
        //Fin du traitement de l'image

        // <!-- POUR AFFICHER L'IMAGE ON A JUSTE A FAIRE DANS NOTRE BOUCLE D'AFFICHAGE <img src="../Images/php echo $result->nomProduit; .jpg"/>

        $con = $this->connectDb();
        $req = $con->prepare("INSERT INTO produits(nom, description, prix, volume, id_categorie, id_sous_categorie, stock, image_nom) values (:nom, :description, :prix, :volume, :id_categorie, :id_sous_categorie, :stock, :encname)");
        $req->bindValue("nom", $nomProduit, PDO::PARAM_STR);
        $req->bindValue("prix", $prixProduit, PDO::PARAM_STR);
        $req->bindValue("volume", $volumeProduit, PDO::PARAM_STR);
        $req->bindValue("description", $descriptionProduit, PDO::PARAM_STR);
        $req->bindValue("id_categorie", $idCategorie, PDO::PARAM_INT);
        $req->bindValue("id_sous_categorie", $idSCategorie, PDO::PARAM_INT);
        $req->bindValue("stock", $stockProduit, PDO::PARAM_INT);
        $req->bindValue("encname", $encName, PDO::PARAM_STR);
        
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
            echo "<td><a id='modifyProduct' href='?show=" . $r->id . "' onclick='toggleModifProduits();'>Modifier</a><br/>";
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
                    header('location:http://localhost/projet_pro/backoffice/gestion_produits?page=1.php');
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
                        <img class="hide-on-small-only" src="../Images/<?php echo $s->image_nom;?>.jpg" width="500px" height="500px"/><br/><br/>
                        <img class="hide-on-med-and-up" src="../Images/<?php echo $s->image_nom;?>.jpg" width="290px" height="290px"/><br/><br/>
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
                

                $nom = trim(htmlspecialchars(addslashes($_POST['nom'])));
                $description = trim(htmlspecialchars(addslashes($_POST['description'])));
                $prix = trim(htmlspecialchars($_POST['prix']));
                $stock = trim(htmlspecialchars($_POST['stock']));

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
                echo '<script language="Javascript"> document.location.replace("http://localhost/projet_pro/backoffice/gestion_produits?page=1.php"); </script>';
                $gestionProduits -> viewAllProduits();

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

            $id = htmlspecialchars($_GET['id']);
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
        $newCategorie = trim(htmlspecialchars($_POST["newCategorie"]));
        $con = $this->connectDb();
        $req = $con->prepare("INSERT into categories (categorie) value (:newCategorie)");
        $req->bindValue("newCategorie", $newCategorie, PDO::PARAM_STR);
        $req->execute();
    }

    public function AjouterSCategorieBdd()
    {
        $newSCategorie = trim(htmlspecialchars($_POST["newSCategorie"])); //
        $con = $this->connectDb(); // Connexion Db
        $stmt = $con->prepare("INSERT INTO sous_categories (sous_categorie) values (:nom)");
        $stmt->bindValue('nom', $newSCategorie, PDO::PARAM_STR);
        $stmt->execute();
    }
                                    //!!!!!!!! DEBUT CLASSES GALERIE !!!!!!!//
    public function addNewGaleryCategory(){

        $newCategory = trim(htmlspecialchars($_POST["newGaleryCategory"]));

        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM categories_galerie");
        $request->execute();
        $resultat = $request->fetchAll();

        foreach($resultat as $result){
            if($result["categorie"] === $newCategory){
                return false;
            }
        }

        $insertRequest = $con->prepare("INSERT INTO categories_galerie (categorie) VALUES (:newCategory)");
        $insertRequest->bindValue("newCategory", $newCategory, PDO::PARAM_STR);
        $insertRequest->execute();

    }

    public function showPhotoCategory(){

        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM categories_galerie");
        $request->execute();
        $resultat = $request->fetchAll();

        foreach($resultat as $result){
//            $categorie = $result["categorie"];
//            $idCategorie = $result["id"];


            echo "<option value=" . $result['id'] . ">". $result['categorie'] . "</option>";
        }
    }

    public function actualCategory(){

        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM categories_galerie");
        $request->execute();
        $resultat = $request->fetchAll();

        echo "<p> Categories galerie existantes : </p>";
        foreach ($resultat as $result) {
            echo $result["categorie"] . ' ' . ' <a class="href_admin" href="gestion_galerie.php?id=' . $result['id'] . '">' . ' <b>Supprimer</b>' . '</a>' . "<br />";
        }

        if (isset($_GET['id']) and !empty($_GET['id'])) {

            $id = htmlspecialchars($_GET['id']);
            $supp = $con->prepare("DELETE FROM categories_galerie WHERE id = :id ");
            $supp->bindValue('id', $id, PDO::PARAM_INT);
            $supp->execute();
            header('location:http://localhost/projet_pro/backoffice/gestion_galerie?page=1.php');
        }
    }

    public function newPhoto(){

        $nomProduit = trim(htmlspecialchars($_POST["nameNewPhoto"])); //On récupère le nom de la photo
        $photoCategory = trim(htmlspecialchars($_POST["categoriePhoto"])); //On récupère l'id de la catégorie de la photo

        //Traitement de l'image

        $Img = $_FILES["newPhoto"]["name"];
        $img_Tmp = $_FILES["newPhoto"]["tmp_name"];

        if(!empty($img_Tmp)){ //Si nom temporaire n'esst pas vide
            $img_Name = explode(".", $Img); //On eleve le point du nom
            $img_Ext = end($img_Name); //On attribue a img_Ext la valeur du dernier element du tableau

            if(in_array(strtolower($img_Ext),array("png", "jpg", "jpeg")) === false){ //Si le dernier element ne correspond pas a ces type de fichier

                echo "L'image insérée doit avoir pour extension : .png, .jpg, .jpeg"; //On affiche un message d'erreur

            }else{ //Sinon

                $img_Size = getimagesize($img_Tmp); //On attribue a la variable $img_Size la valeur du poids de l'image

                if($img_Size["mime"] == "image/jpeg"){ //si l'extension d'image est egale a jpeg
                    $img_Src = imagecreatefromjpeg($img_Tmp);

                }else if ($img_Size["mime"] == "image/png"){ //si l'extension d'image est egale a png
                    $img_Src = imagecreatefrompng($img_Tmp);

                }else{
                    $img_Src = false; //Source d'image = false
                    echo "Veuillez rentrer une image valide"; //On affiche le message d'erreur comme quoi l'image n'est pas valide
                }

                if($img_Src !== false){ //Si l'image est au bon format

                    $img_Width = 1000;

                    if($img_Size[0] == $img_Width){

                        $img_Finale = $img_Src;
                    }else{
                        $new_Width[0] = $img_Width;
                        $new_Heigth[1] = 1000;
                        $img_Finale = imagecreatetruecolor($new_Width[0], $new_Heigth[1]);
                        imagecopyresampled($img_Finale, $img_Src, 0, 0, 0, 0, $new_Width[0], $new_Heigth[1], $img_Size[0], $img_Size[1]);
                    }

                    $encName = md5(uniqid());
                    imagejpeg($img_Finale, "../Images_Galerie/" . $encName . ".jpg");
                }
            }
        }else{
            echo "Veuillez insérer une image.";
        }

        //Fin du traitement de l'image
        // <!-- POUR AFFICHER L'IMAGE ON A JUSTE A FAIRE DANS NOTRE BOUCLE D'AFFICHAGE <img src="../Images/php echo $result->nomProduit; .jpg"/>

            $con = $this->connectDb();
            $request = $con->prepare("INSERT INTO images_galerie(nom_image, id_categorie, enc_name) VALUES (:nom, :id_categorie, :encname)");
            $request->bindValue("nom", $nomProduit, PDO::PARAM_STR);
            $request->bindValue("id_categorie", $photoCategory, PDO::PARAM_INT);
            $request->bindValue("encname", $encName, PDO::PARAM_STR);
            $request->execute();
    }


    function deletePhoto(){
        $con = $this->connectDb();

        // Supprimer un article de la Bdd
        if(isset($_GET['action'])&&($_GET['action']== 'delete')){
            $id = htmlspecialchars($_GET['id']);
            $req = $con->prepare("DELETE FROM images_galerie WHERE id = :id ");
            $req->bindValue("id", $id, PDO::PARAM_INT);
            $req->execute();
            header('location:http://localhost/projet_pro/backoffice/gestion_galerie?page=1.php');
        }
    }
                  //    !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function paginationGalerie()
    {
        //Connexion Bdd
        $con = $this->connectDb();
        $page = intval($_GET['page']); //conversion forcée en entier
        //Si le nombre est invalide, on demande la première page par défaut
        if ($page <= 0) {
            $page = 1;
        }

        $limite = 5;

        $resultFoundRows = $con->query("SELECT count(id) FROM images_galerie");
        $nombreElementsTotal = $resultFoundRows->fetchColumn();
        $debut = ($page - 1) * $limite;
        // Partie "Requête"
        //  On construit la requête, en remplaçant les valeurs par des marqueurs. Ici, on
        //  n'a qu'une valeur, limite. On place donc un marqueur là où la valeur devrait se
        //  trouver, sans oublier les deux points « : »

        $query = $con->prepare("SELECT * FROM images_galerie INNER JOIN categories_galerie ON images_galerie.id_categorie = categories_galerie.id LIMIT :limite OFFSET :debut");
        //On lie les valeurs
        $query->bindValue('limite', $limite, PDO::PARAM_INT);
        $query->bindValue('debut', $debut, PDO::PARAM_INT);
        $query->execute();

        echo "<br /><br /><br />";
        echo "<div class='row'>";
        echo "<table id='tableProducts' class='responsive-table' ><thead>";
        echo "<th>Image</th>";
        echo "<th>Catégorie de l'image</th>";
        echo "</thead><tbody>";

        while($r = $query->fetch(PDO::FETCH_OBJ)){

            echo "<tr>";
            echo "<td><img src='../Images_Galerie/" . $r->enc_name . ".jpg' width='100px' height='100px'/></td>";
            echo "<td>" . $r->categorie . "</td>";
            echo "<td><a href='?action=delete&amp;id=" . $r->id . "'>Supprimer</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table></div>";

        //On calcule le nombre de pages
        $nombreDePages = ceil($nombreElementsTotal / $limite);

        /* Si on est sur la première page, on n'a pas besoin d'afficher de lien*/
        /* vers la précédente. On va donc ne l'afficher que si on est sur une autre*/
        /* page que la première*/

        if ($page > 1) :
            ?><button class="btn black"><a href="?page=<?php echo $page - 1; ?>">Page précédente</a></button>
        <?php endif;

        for ($i = 1; $i <= $nombreDePages; $i++) :
            ?><u><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></u>
        <?php endfor;

        //Avec le nombre total de pages, on peut aussi masquer le lien vers la page sivante quand on est sur la derniere//
        if ($page < $nombreDePages) :
            ?><button class="btn black s"><a href="?page=<?php echo $page + 1; ?>">Page suivante</a></button>
        <?php endif; ?><?php
    }

    function encCode(){
        $i = 0;

        while($i != 20){
            echo md5(uniqid()) . "<br />";
            $i++;
        }
    }


    public function paginationProduits()
    {
        //Connexion Bdd
        $con = $this->connectDb();
        $page = intval($_GET['page']); //conversion forcée en entier
        //Si le nombre est invalide, on demande la première page par défaut
        if ($page <= 0) {
            $page = 1;
        }

        $limite = 5;

        $resultFoundRows = $con->query("SELECT count(id) FROM produits");
        $nombreElementsTotal = $resultFoundRows->fetchColumn();
        $debut = ($page - 1) * $limite;
        // Partie "Requête"
        //  On construit la requête, en remplaçant les valeurs par des marqueurs. Ici, on
        //  n'a qu'une valeur, limite. On place donc un marqueur là où la valeur devrait se
        //  trouver, sans oublier les deux points « : »

        $query = $con->prepare("SELECT * FROM produits LIMIT :limite OFFSET :debut");
        //On lie les valeurs
        $query->bindValue('limite', $limite, PDO::PARAM_INT);
        $query->bindValue('debut', $debut, PDO::PARAM_INT);
        $query->execute();

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

        while($r = $query->fetch(PDO::FETCH_OBJ)){

            echo "<tr>";
            echo "<td><img src='../Images/" . $r->image_nom .".jpg' width='100px' height='100px'/></td>";
            echo "<td>" . $r->nom . "</td>";
            echo "<td>" . $r->prix . "€</td>";
            echo "<td>" . $r->volume . "</td>";
            echo "<td class='hide-on-med-and-down'>" . $r->description . "</td>";
            echo "<td>" . $r->stock . "</td>";
            echo "<td><a id='modifyProduct' href='?show=" . $r->id . "' onclick='modifyProductsHideForms();'>Modifier</a><br/>";
            echo "<a href='?action=delete&amp;id=" . $r->id . "'>Supprimer</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table></div><br /><br/>";

        //On calcule le nombre de pages
        $nombreDePages = ceil($nombreElementsTotal / $limite);

        /* Si on est sur la première page, on n'a pas besoin d'afficher de lien*/
        /* vers la précédente. On va donc ne l'afficher que si on est sur une autre*/
        /* page que la première*/

        if ($page > 1) :
            ?><button class="btn black"><a class="aFooter" href="?page=<?php echo $page - 1; ?>">←</a></button>
        <?php endif;
        echo "    ";
        for ($i = 1; $i <= $nombreDePages; $i++) :
            ?><u><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></u>
        <?php endfor;
        echo "    ";
        //Avec le nombre total de pages, on peut aussi masquer le lien vers la page sivante quand on est sur la derniere//
        if ($page < $nombreDePages) :
            ?><button class="btn black s"><a class="aFooter" href="?page=<?php echo $page + 1; ?>">→</a></button>
        <?php endif; ?><?php
    }

    public function showTableUsers(){

        $con = $this->connectDb();

        if (isset($_GET['id']) and !empty($_GET['id'])) {

            if ($_SESSION['user']['id'] == $_GET['id']) {

                echo '<div class="container">Impossible de supprimer un compte qui est connecté'.'</div>';
            } else {

                $id = $_GET['id'];
                $supp = $con->prepare("DELETE FROM utilisateurs WHERE id = :id ");
                $supp->bindValue('id', $id, PDO::PARAM_INT);
                $supp->execute();
                header('Refresh 0;');
            }
        }

        $query = $con->prepare("SELECT * FROM utilisateurs");
        $query->execute();
        $resultats = $query->fetchAll();


            foreach($resultats as $result){
                ?>
                <tr>
                <td><?php echo $result["prenom"] ?></td>
                <td><?php echo $result["nom"] ?></td>
                <td><?php echo $result["email"] ?></td>
                <td><?php echo $result["tel"] ?></td>
                <td><?php echo $result["id_droits"] ?></td>
                <td>
                    <a href='?show=<?php echo $result["id"] ?>'>Modifier</a><br />
                    <a href='?action=delete&amp;id=<?php echo $result["id"] ?>'>Supprimer</a>
                </td>
                </tr>
            <?php
    }


    }

    function modifierUser(){

        $id = $_GET["show"];
        $con = $this->connectDb();
        $query = $con->prepare("SELECT * FROM utilisateurs WHERE id = :id");
        $query->bindValue("id", $id, PDO::PARAM_INT);
        $query->execute();
        $resultats = $query->fetchAll();

        foreach($resultats as $result){
            $nom = $result["nom"];
            $prenom = $result["prenom"];
            $email = $result["email"];
            $tel = $result["tel"];
            $id_droits = $result["id_droits"];
        }
//        var_dump($resultats);
        ?>
        <div class="container">
            <div class="row">
                <form id='modifierArticle' class="col s12" action="" method="post">

                    <div class="input-field col s12 m4 l4">
                        <label>Nom :</label><br/><br />
                        <input type="text" name="nom" value="<?php echo $nom;?>" required><br/><br />
                    </div>

                    <div class="input-field col s12 m4 l4">
                        <label>Prénom :</label><br/><br />
                        <input type="text" name="prenom" value="<?php echo $prenom;?>" required><br/><br />
                    </div>

                    <div class="input-field col s12 m4 l4">
                        <label>Email :</label><br/><br />
                        <input type="text" name="email" value="<?php echo $email;?>" required><br/><br />
                    </div>

                    <div class="input-field col s12 m4 l4">
                        <label>Téléphone :</label><br/><br />
                        <input type="text" name="tel" value="<?php echo $tel;?>" required><br/><br />
                    </div><br/>

                    <div class="input-field col s12 m4 l4">
                        <label>Id_Droits :</label><br/><br />
                        <input type="text" name="id_droits" value="<?php echo $id_droits;?>" required><br/><br />
                    </div><br/>

                    <input class="btn black center-align" type="submit" name="modifier" value="Modifier"><br/><br />
                </form>
            </div>
        </div>

        <?php

        if (isset($_POST['modifier'])) {
            $newPrenom = trim(htmlspecialchars($_POST['prenom']));
            $newNom = trim(htmlspecialchars($_POST['nom']));
            $newEmail = trim(htmlspecialchars($_POST['email']));
            $newTel = trim(htmlspecialchars($_POST['tel']));
            $newId_droits = trim(htmlspecialchars($_POST['id_droits']));

            if (!empty($_POST['prenom'])) {
                $reqID = $con->prepare("UPDATE utilsateurs SET  prenom = :newPrenom WHERE id = :id ");
                $reqID->bindValue('newPrenom', $newPrenom, PDO::PARAM_STR);
                $reqID->bindValue('id', $id, PDO::PARAM_INT);
                $reqID->execute();
            }
            if (!empty($_POST['nom'])) {
                $reqEmail = $con->prepare("UPDATE utilisateurs SET  nom = :newNom WHERE id = :id ");
                $reqEmail->bindValue('newNom', $newNom, PDO::PARAM_STR);
                $reqEmail->bindValue('id', $id, PDO::PARAM_INT);
                $reqEmail->execute();

            }
            if (!empty($_POST['email'])) {
                $reqEmail = $con->prepare("UPDATE utilisateurs SET  email = :newEmail WHERE id = :id ");
                $reqEmail->bindValue('newEmail', $newEmail, PDO::PARAM_STR);
                $reqEmail->bindValue('id', $id, PDO::PARAM_INT);
                $reqEmail->execute();

            }
            if (!empty($_POST['tel'])) {
                $reqEmail = $con->prepare("UPDATE utilisateurs SET  tel = :newTel WHERE id = :id ");
                $reqEmail->bindValue('newTel', $newTel, PDO::PARAM_STR);
                $reqEmail->bindValue('id', $id, PDO::PARAM_INT);
                $reqEmail->execute();

            }
            if (!empty($_POST['id_droits'])) {
                $reqIdDroits = $con->prepare("UPDATE utilisateurs SET  id_droits = :newIdDroits WHERE id = :id ");
                $reqIdDroits->bindValue('newIdDroits', $newId_droits, PDO::PARAM_INT);
                $reqIdDroits->bindValue('id', $id, PDO::PARAM_INT);
                $reqIdDroits->execute();
            }
            header("Refresh: 0;url=http://localhost/projet_pro/backoffice/clients.php");

        }
    }

}
