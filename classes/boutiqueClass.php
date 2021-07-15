<?php
require_once('dbClass.php');
class boutique2 extends bdd
{
    public function query($sql,$data = array()){

        $con = $this->connectDb();
        $req = $con->prepare($sql);
        $req->execute($data); 
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}
?>