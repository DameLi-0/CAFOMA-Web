<?php
include "./ConnexionBDD.class.php";
require_once "../outils/outil.php";

if(isset($_GET["operation"])){
	if($_GET["operation"]=="lister"){
            try{
                $stmt = getPdo()->prepare("SELECT * FROM formation");
                $stmt->execute();
                $formationBDD = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                print("lister#");
                foreach($formationBDD as $formation){
                        $formations[]= $formation;
                }
                afficherTableau($formations,"formations");
                print(json_encode($formationBDD));
        }catch(PDOException $e){
                print "erreur#".$e->getMessage();
        }
    }
}