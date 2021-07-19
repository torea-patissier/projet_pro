<?php
require_once('dbClass.php');
class index extends bdd
{

    public function envoyerCommentaire($avisClient, $noteClient) // Envoi un commentaire en Bdd
    {

        $con = $this->connectDb();
        $id_client = $_SESSION['user']['id'];
        $req = $con->prepare("INSERT INTO avis(id_client, avis, note) VALUES(:id_client, :avisClient, :noteClient)");
        $req->bindValue("id_client", $id_client, PDO::PARAM_INT);
        $req->bindValue("avisClient", $avisClient, PDO::PARAM_STR);
        $req->bindValue("noteClient", $noteClient, PDO::PARAM_INT);

        $req->execute();
    }

    public function voirAvisClients() // Affiche les avis des clients
    {

        $con = $this->connectDb();

        $req = $con->prepare("SELECT * FROM avis INNER JOIN utilisateurs ON avis.id_client = utilisateurs.id");
        $req->execute();
        $resultat = $req->fetchAll();
        return $resultat;
    }

    public function voirDerniersArticles() // Voi les 3 derniers articles en Bdd
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM produits ORDER BY id DESC limit 0,3");
        $req->execute();
    }

    public function recherche() // Barre de recherche 
    {

        ?>
        <form method="GET">
            <input class="barreRecherche" type="search" name="q" placeholder="Recherche..." />
            <input class="btn black" type="submit" value="Rechercher" /><br />
        </form><br />

        <?php
        $con = $this->connectDb();
        $articles = $con->query('SELECT * FROM produits ORDER BY id DESC');

        if (isset($_GET['q']) && !empty($_GET['q'])) {

            $q = htmlspecialchars($_GET['q']);
            $articles = $con->query('SELECT * FROM produits WHERE nom LIKE "%' . $q . '%" ORDER BY id DESC LIMIT 3');

            if ($articles->rowCount() == 0) {

                $articles = $con->query('SELECT * FROM produits WHERE CONCAT(nom, description) LIKE "%' . $q . '%" ORDER BY id DESC LIMIT 3');
            }
        }

        if ($articles->rowCount() > 0) {

            while ($a = $articles->fetch()) {

                if (!empty($q)) { ?>

                        <div class="col s12 m4 l4">
                            <div class="produitRecherche">
                                <a href="../projet_pro/boutique/produits.php?show=<?= $a['id'] ?>"><br />

                                    <img src="Images/<?= $a['image_nom'] ?>.jpg" width="100px" height="100px"><br />
                                    <b style="color: white; text-shadow: 1px 1px 1px black;"><?= $a['nom']; ?> </b><br />
                                    <b style="color: white; text-shadow: 1px 1px 1px black;"><?= $a['prix']; ?> € </b><br /></a>
                            </div>
                        </div>

                    <?php
                }
            }
        } else {
            echo 'Aucun résultat pour : ' . $q;
        }
    }


    public function recupDerniersProds(){

        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM produits ORDER BY id DESC limit 0,3");
        $req->execute();
        $resultat = $req->fetchAll();


        foreach($resultat as $result){

            echo "
            <div class='derArt'>
            <div class='col s12 m4 l4'>
            <br /><br /><br />
            <a href='../projet_pro/boutique/produits.php?show=" . $result['id'] . "'><img src='Images/" . $result['image_nom'] . ".jpg' width='150px' height='150px'></a><br />" . $result['nom'] . "<br />" . $result['prix'] . "€
            <br /><br /><a class='addPanier add btn black' href='../addpanier.php?id=<?=" . $result['id'] . "'>Acheter</a>
            </div></div>";
        }
    }
}
?>