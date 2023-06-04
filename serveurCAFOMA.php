<?php
require_once './model/manager/FormationDAO.class.php';
require_once './model/manager/UserDAO.class.php';
require_once './outils/outil.php'; 

$formationDao = FormationManager::getInstance();
$userDao = UserManager::getInstance();

if(isset($_GET["operation"])){
    if($_GET["operation"]=="lister"){
        try{
            $formations=$formationDao->displayAllFormation();
            print("lister#");
            print(json_encode($formations));
            echo(json_encode($formations));
        }catch(PDOException $e){
            print "erreur#".$e->getMessage();
        }
    }
    if($_GET["operation"]=="login"){
        try{
            $login = $_GET["login"];
            $password = $_GET["password"];
            $passwdHashbd = $userDao->getPasswdHashUser($login);
            $formationUndefined[] = array('id' => '-1','libelle' => 'undefined','acronyme' => 'undefined','description' => 'undefined', 'image' => 'undefined');
            print("login#");
            
            if(password_verify($password, $passwdHashbd)){
                
                $user_id = $userDao->getUserIdByLogin($login);   
                $inscriptions = $formationDao->displayMyTraining($user_id);
            
                foreach($inscriptions as $inscrit){
                    $formation = $formationDao->displayFormationById($inscrit->getFk_formation_id());
                    $formations[] = $formation;
                }
                    
                if(!isset($formations)){ 
                    $arr = array('login' => $login, 'verif' => 'vrai','formations' => $formationUndefined);
                    print(json_encode($arr));
                }
                else{ 
                    $arr = array('login' => $login, 'verif' => 'vrai','formations' => $formations);
                    print(json_encode($arr));
                }
            }
            else {
                $arr = array('login' => $login, 'verif' => 'faux','formations' => $formationUndefined);
                print(json_encode($arr));
            }
        }catch(PDOException $e){
            print "erreur#".$e->getMessage();
        }
    }
}



/*
include "./ConnexionBDD.class.php";
require_once "../outils/outil.php";

if(isset($_GET["operation"])){
    
	if($_GET["operation"]=="lister"){
            try{
                $stmt = ConnexionBDD::getPdo()->prepare("SELECT * FROM formation");
                $stmt->execute();
                $formationBDD = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                print("lister#");
                /*foreach($formationBDD as $formation){
                        $formations[]= $formation;
                }
                print(json_encode($formationBDD));
            }
            catch(PDOException $e){
                print "erreur#".$e->getMessage();
            }
        }
        
	if($_GET["operation"]=="mdp"){
            
                $stmt = ConnexionBDD::getPdo()->prepare("SELECT valid, mdp FROM user WHERE login=:login");
                $stmt->bindValue(":login",$_GET["login"],PDO::PARAM_STR);
                $stmt->execute();
                $userBdd = $stmt->fetch(PDO::FETCH_ASSOC);
                if(!isset($userBdd)||empty($userBdd)){
                    print ("authentifier#NOK#Le compte n'existe pas");
                }else{
                    
                    $stmt->closeCursor();
                    $valid = $userBdd['valid'];
                    $mdpHash = $userBdd['mdp'];
                    $mdp = $_GET['passwd'];

                    if($valid != 1){
                         print ("authentifier#NOK#Compte non validé");
                    }
                    else if(password_verify($mdp, $mdpHash)){
                        print("authentifier#OK");
                    }
                    else  print ("authentifier#NOK#Couple login/mot de passe invalide");
           
        }       }
        
        
        
    
}

//Passer serveurCAFOMA en racine 
//Inclure les DAO 
// Supprimer les requetes et utiliser les fonctions des DAO*/