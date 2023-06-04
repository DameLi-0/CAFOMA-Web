<?php
abstract class ConnexionBDD {
   /* private static $pdo;
    
    private static function setBdd(){
        self::$pdo = new PDO("mysql:host=localhost;dbname=cafoma;charset=utf8","dameli","dameliAdminBDD03042003*");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }*/

    private static $pdo;
    private static $servername = 'localhost';
    private static $username = 'dameli';
    private static $password = 'dameliAdminBDD03042003*';
    private static $dbname = 'cafoma';
   
    private static function setBdd(){
        self::$pdo = new PDO("mysql:host=".self::$servername.";dbname=".self::$dbname.";charset=utf8",self::$username,self::$password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }
    
    
    
    protected function getBdd(){
        if(self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
    
    public static function getPdo(){
        $login="dameli";
        $mdp="dameliAdminBDD03042003*";
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
