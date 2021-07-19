<?php

require_once ('dbClass.php');

class galerie extends bdd {

    public function galerieHommes(){

        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM `images_galerie` INNER JOIN categories_galerie WHERE categories_galerie.id = images_galerie.id_categorie");
        $request->execute();
        $resultat = $request->fetchAll();

        foreach($resultat as $result){
            $encImg = $result["enc_name"];
            $categorieImg = $result["categorie"];
            $categorie = explode(" - ", $categorieImg);

            if($categorie[0] == "Homme"){
                ?>
                <a href="../Images_Galerie/<?php echo $encImg ?>.jpg">
                    <img class="imgGalerie" src="../Images_Galerie/<?php echo $encImg ?>.jpg">
                </a>
                <?php
            }
        }
    }

    public function galerieFemmes(){

        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM `images_galerie` INNER JOIN categories_galerie WHERE categories_galerie.id = images_galerie.id_categorie");
        $request->execute();
        $resultat = $request->fetchAll();

        foreach($resultat as $result){
            $encImg = $result["enc_name"];
            $categorieImg = $result["categorie"];

            $categorie = explode(" - ", $categorieImg);

            if($categorie[0] == "Femmes"){
                ?>
                <a href="../Images_Galerie/<?php echo $encImg ?>.jpg">
                    <img class="imgGalerie" src="../Images_Galerie/<?php echo $encImg ?>.jpg">
                </a>
                <?php
            }
        }
    }
}