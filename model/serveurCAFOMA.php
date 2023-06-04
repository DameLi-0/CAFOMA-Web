<?php
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
                }*/
                print(json_encode($formationBDD));
            }
            catch(PDOException $e){
                print "erreur#".$e->getMessage();
            }
        }
        
	if($_GET["operation"]=="authentifier"){
            
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
// Supprimer les requetes et utiliser les fonctions des DAO