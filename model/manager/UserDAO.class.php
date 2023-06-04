<?php
require_once "./model/ConnexionBDD.class.php";
require_once "./model/class/User.class.php";


class UserManager extends ConnexionBDD {
    private static $_instance = null;

    private function __construct() {}
    
    public static function getInstance() {
        if(is_null(self::$_instance)){
            self::$_instance = new UserManager();  
        }
        return self::$_instance;
    }
    
    public function getUser(){
        return $this->users;
    }
    
    function addAccount($user){
        $pdo = $this->getBdd();
        $req = "
        INSERT INTO user (login, mdp, email, img, role, valid)
        values (:login, :mdp, :email, :img, :role, :valid)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$user->getLogin(),PDO::PARAM_STR);
        $stmt->bindValue(":mdp",$user->getMdp(),PDO::PARAM_STR);
        $stmt->bindValue(":email",$user->getEmail(),PDO::PARAM_STR);
        $stmt->bindValue(":img",$user->getImg(),PDO::PARAM_STR);
        $stmt->bindValue(":role",$user->getRole(), PDO::PARAM_STR);
        $stmt->bindValue(":valid",$user->getValid(), PDO::PARAM_BOOL);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    function validerAbonne($login){
        $pdo = $this->getBdd();
        $req = "UPDATE user SET valid = 1 WHERE login = :login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    function displayAllUser(){
        $stmt = $this->getBdd()->prepare("SELECT * FROM user");
        $stmt->execute();
        $bddUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        foreach($bddUsers as $user){
            $u=new User($user['user_id'], $user['login'], $user['mdp'], $user['email'], $user['img'],$user['role'], $user['valid']);
            $this->users[]=$u;
        }
        return $this->users;
    }
    
    function displayUserByLogin($login){
        $stmt = $this->getBdd()->prepare("SELECT * FROM user WHERE login=:login");
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        $u = new User($user['user_id'], $user['login'], $user['mdp'], $user['email'], $user['img'], $user['role'], $user['valid']);
        return $u; 
    }
    
    function displayUserById($id){
        $stmt = $this->getBdd()->prepare("SELECT * FROM user WHERE user_id = :id");
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        $u = new User($user['user_id'], $user['login'], $user['mdp'], $user['email'], $user['img'], $user['role'], $user['valid']);
        return $u; 
    }
    
    function editUserBdd($user){
        $pdo = $this->getBdd();
        $req = "
        UPDATE user 
        SET user_id = 'user_id', login = 'login', mdp = 'mdp', email = 'email', img = 'img', role = 'role', valid = 'valid' 
        WHERE id = :id";
        
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":user_id",$user->getUser_id(),PDO::PARAM_INT);
        $stmt->bindValue(":login",$user->getLogin(),PDO::PARAM_STR);
        $stmt->bindValue(":mdp",$user->getMdp(),PDO::PARAM_STR);
        $stmt->bindValue(":email",$user->getemail(),PDO::PARAM_STR);
        $stmt->bindValue(":img",$user->getImg(),PDO::PARAM_STR);
        $stmt->bindValue(":role",$user->getRole(),PDO::PARAM_STR);
        $stmt->bindValue(":valid",$user->getValid(),PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }
  
    //GETTER
    function getPasswdHashUser($login){
        $pdo = $this->getBdd();
        $req = "SELECT mdp FROM user WHERE login=:login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $passwd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        return $passwd['mdp'];
    } 
    
    function getRoleUser($login){
        $pdo = $this->getBdd();
        $req = "SELECT role FROM user WHERE login=:login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        return $role['role'];
    }
    
    function getIdUser($login){
        $pdo = $this->getBdd();
        $req = "SELECT user_id FROM user WHERE login=:login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $user_id = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        return $user_id['user_id'];
    }
    
    function getIsValid($login){
        $pdo = $this->getBdd();
        $req = "SELECT valid FROM user WHERE login=:login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $valid = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $valid['valid'];
    }
    
    function deleteAccount($id){
        $pdo = $this->getBdd();
        $req = "DELETE FROM `user` WHERE user_id=:id";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();        
    }
    
    function verifExistEmail($email){
        $pdo = $this->getBdd();
        $req = "SELECT email FROM user WHERE email=:email";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":email",$email,PDO::PARAM_STR);
        $stmt->execute();
        $email = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        return $email['email'];        
    }
    
    function getUserIdByLogin($login){
        $stmt = $this->getBdd()->prepare("SELECT 'user_id' FROM user WHERE login=:login");
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        $user_id = $user['user_id'];
        return $user_id; 
    }
} 