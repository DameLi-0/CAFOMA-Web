<?php
abstract class ConnexionBDD {
    private static $pdo;
    
    private static function setBdd(){
        self::$pdo = new PDO("mysql:host=localhost;dbname=cafoma;charset=utf8","root","");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }

    protected function getBdd(){
        if(self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
    
    function getPdo(){
        $login="root";
        $mdp="";
        $bd="cafoma";
        $serveur="localhost";
        $port="3306";
        
        try {
            $pdo = new PDO("mysql:host=$serveur;dbname=$bd;port=$port", $login, $mdp);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
            return $pdo;
        } catch (PDOException $e) {
            print "Erreur de connexion PDO :".$e;
            die();
        }
    }
    
}
