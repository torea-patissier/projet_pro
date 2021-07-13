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
    <input type="search" name="q" placeholder="Recherche..." />
    <input class="btn black" type="submit" value="Valider" /><br />
</form><br />

<?php
        $con = $this->connectDb();
        $articles = $con->query('SELECT * FROM produits ORDER BY id DESC');

        if (isset($_GET['q']) && !empty($_GET['q'])) {

            $q = htmlspecialchars($_GET['q']);
            $articles = $con->query('SELECT * FROM produits WHERE nom LIKE "%' . $q . '%" ORDER BY id DESC LIMIT 4');

            if ($articles->rowCount() == 0) {

                $articles = $con->query('SELECT * FROM produits WHERE CONCAT(nom, description) LIKE "%' . $q . '%" ORDER BY id DESC LIMIT 4');
            }
        }

        if ($articles->rowCount() > 0) {

            while ($a = $articles->fetch()) {

                if (!empty($q)) { ?>

<div class="produitRecherche">
    <a href="../boutique/produits.php?show=<?= $a['nom'] ?>"><br />
        <img src="Images/<?= $a['nom'] ?>.jpg" width="100px" height="100px"><br />
        <?= $a['nom']; ?> <br />
        <?= $a['prix']; ?> € <br /></a>
</div>
<?php
                }
            }
        } else {
            echo 'Aucun résultat pour : ' . $q;
        }
    }

    public function repondreAvis(){
        if(isset($_GET["posterRep"]) && !empty($_GET["posterRep"])){
            $idAvis = intval(htmlspecialchars($_GET["posterRep"]));

        }
    }
}
?>