<?php
require_once('dbClass.php');
class users extends bdd
{
    // Function pour s'inscrire
    public function register(){
        if(isset($_POST['inscription'])){
            
            //Connexion Db
            $con = $this->connectDb();
            //HTMLSPECHARS
            $nom = trim(htmlspecialchars($_POST['iNom']));
            $prenom = trim(htmlspecialchars($_POST['iPrenom']));
            $email = trim(htmlspecialchars($_POST['iEmail']));
            $tel = trim(htmlspecialchars($_POST['iTel']));
            $password = trim(htmlspecialchars($_POST['iPassword']));
            $confpassword = trim(htmlspecialchars($_POST['iConfPassword']));
            $chiffre = 1;
            $testpwd = preg_match("#[A-Z]#", $password) + preg_match("#[a-z]#", $password) + preg_match("#[0-9]#", $password) + preg_match("#[^a-zA-Z0-9]#", $password);
            // Hashage mdp
            $options = ['cost' => 12,];
            $hash = password_hash($password, PASSWORD_BCRYPT, $options);
            //Vérifier si un eMail est déjà existant en Bdd
            $stmt = $con->prepare("SELECT email FROM utilisateurs WHERE email = '" . $email . "' ");
            $stmt->execute();

            if(!is_numeric($tel) || strlen($tel) != 10 ){
                echo '<br/> <b><p class="container center-align red-text">Veuillez rentrer un numéro valide.</p></b>';
                return false;
            }

            if ($stmt->fetch(PDO::FETCH_ASSOC) == true) {
                // Si il existe déjà echo message d'erreur
                echo '<br/> <b><p class="container center-align red-text">Email déjà existant.</p></b>';
                return false;
                // Vérifier si les MDP sont les mêmes
            } elseif ($testpwd < 4) {
                echo '<br />' . '<b><p class="container center-align red-text"><b>Rappel : Votre mot de passe doit contenir au minimum 7 caractères, incluant une majuscule, un chiffre et un caractère spécial.</p></b></b>';
                return false;
            } elseif ([$password] != [$confpassword]) {
                echo '<br />' . '<b><p class="container center-align red-text">Les mots de passe ne correspondent pas.</p></b>';
                return false;
            } else { // Si oui on créer le compte en Db

                $infoUser = $con->prepare("INSERT INTO `utilisateurs`
                        (`nom`, `prenom`, `email`, `password`, `id_droits`, `tel`) 
                        VALUES
                        ('$nom','$prenom','$email','$hash','$chiffre','$tel')");
                $infoUser->execute();

                header("location:http://localhost:8888/projet_pro/users/connexion.php");
            }
        }
    }

    public function connexion(){

    if(isset($_POST['connexion']) && !empty($_POST['connexion'])){

        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));

        if( $email != '' && $password != ''){

            $con = $this->connectDb();
            $req = $con->prepare("SELECT * FROM utilisateurs ");
            $req->execute();
            $result = $req->fetchAll();

            for ($i = 0; isset($result[$i]); $i++) { // Boucle for pour parcourir le tableau
                $logcheck = $result[$i]['email']; // On recupère le login dans le tableau parcouru
                $passcheck = $result[$i]['password']; // Et ici le MDP 
                if ($email == $logcheck and password_verify($password, $passcheck) == TRUE) { // Si Login et MDP == aux valeurs dans le tab alors co + Verify pass                     
                    $_SESSION['user'] = $result[$i]; 
                    header('location:http://localhost:8888/projet_pro/users/profil.php');
                }
            }
                if ($email == $logcheck and password_verify($password, $passcheck) == FALSE) { // Si Login et MDP == aux valeurs dans le tab alors co + Verify pass 
                    echo '<p class="container red-text"><b>Identifiant ou mot de passe incorrect.</b></p><br />';
                    return FALSE; 
                }
            
        }else{
            echo '<p class="container red-text"><b>Remplissez tous les champs.</b></p><br />';
            return FALSE; 
        }
    }
}
    public function deco(){

        session_destroy();  
        header('location:http://localhost:8888/projet_pro/index.php');
    }

    public function modifierProfil()
    {

        if (isset($_POST['modifier'])) {

            $con = $this->connectDb();
            $id = $_SESSION['user']['id'];
            $nom = trim(htmlspecialchars($_POST['nom']));
            $prenom = trim(htmlspecialchars($_POST['prenom']));
            $tel = trim(htmlspecialchars($_POST['tel']));
            $mdp = trim(htmlspecialchars($_POST['password']));
            $conf =  htmlspecialchars($_POST['confpass']);
            $email = trim(htmlspecialchars($_POST['email']));
            $options = ['cost' => 12,];
            $hash = password_hash($mdp, PASSWORD_BCRYPT, $options);
            $testpwd = preg_match("#[A-Z]#", $mdp) + preg_match("#[a-z]#", $mdp) + preg_match("#[0-9]#", $mdp) + preg_match("#[^a-zA-Z0-9]#", $mdp);
            // header("Refresh: 0");

//Modification du Nom en Bdd

            if (isset($nom) && !empty($nom)) {
                $sql = $con->prepare("UPDATE utilisateurs SET nom = '" . $nom . "' WHERE id = '" . $id . "' ");
                $sql->execute();
                $_SESSION['nom'] = $nom;
            }

//Modification du Prénom en Bdd

            if (isset($prenom) && !empty($prenom)) {
                $sql = $con->prepare("UPDATE utilisateurs SET prenom = '" . $prenom . "' WHERE id = '" . $id . "' ");
                $sql->execute();
                $_SESSION['prenom'] = $prenom;
            }
 
//Modifiation du n de Tel en Bdd           

            if (isset($tel) && !empty($tel)) {

                if(is_numeric($tel) && strlen($tel) == 10){   
                    $sql = $con->prepare("UPDATE utilisateurs SET tel = '" . $tel . "' WHERE id = '" . $id . "' ");
                    $sql->execute();
                    $_SESSION['tel'] = $tel;
                }else{
                    echo '<br />' . '<p class="erreur_inscription center-align red-text"><b>Rappel : Le numéro n\'est pas valide.</b></p>';
                }
            }

//Modification du Mot de passe en Bdd

            if(isset($mdp) && !empty($conf)){

                if($testpwd < 4){

                    echo '<br />' . '<p class="erreur_inscription center-align red-text"><b>Rappel : Votre mot de passe doit contenir une majuscule, minuscule un chiffre et un caractère spécial.</b></p>';
                }else { // Si oui on créer le compte en Db

                    if ($mdp != $conf) {
                        echo ('<br/><p class="erreur_profil"> Mot de passe incorrect </p>');
                        return false;

                        } elseif (isset($hash) || isset($conf) && !empty($hash) && !empty($conf)) {
                            $sql = $con->prepare("UPDATE utilisateurs SET password = '" . $hash . "' WHERE id = '" . $id . "' ");
                            $sql->execute();
                            $_SESSION['password'] = $hash;
                        }
            }
        }
        
//Modification de l'E-mail en Bdd

            if(isset($email) && !empty($email)){

                $sql = $con->prepare("UPDATE utilisateurs SET email = '" . $email . "' WHERE id = '" . $id . "' ");
                $sql->execute();
                $_SESSION['email'] = $email;

            }
        }
    }

    public function voirPrenom()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT prenom FROM utilisateurs WHERE id = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();

        foreach($result as $resultat){
            $prenom = $resultat['prenom'];
        }
        echo $prenom;
    }

    public function voirNom()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT nom FROM utilisateurs WHERE id = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();
        foreach($result as $resultat){
            $nom = $resultat['nom'];
        }
        echo $nom;
    }

    public function voirEmail()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT email FROM utilisateurs WHERE id = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();

        foreach($result as $resultat){
            $email = $resultat['email'];
        }
        echo $email;
    }

    public function voirTel()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT tel FROM utilisateurs WHERE id = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();

        foreach($result as $resultat){
            $tel = $resultat['tel'];
        }
        echo $tel;
    }
}
?>