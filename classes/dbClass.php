<?php

class bdd
{
        //Function pour se connecter à la Db
<<<<<<< Updated upstream
        public function connectDb()
=======
        protected function connectDb()
>>>>>>> Stashed changes
        {
            $local = 'mysql:host=localhost;dbname=projet_pro';
            $user = 'root';
            $pass = 'root';
            try {
                $db = new PDO($local, $user, $pass);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $db;
            // Important le return sinon la function ne marche pas
        }
}