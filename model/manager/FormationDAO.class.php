<?php
require_once "./model/ConnexionBDD.class.php";
require_once "./model/class/Formation.class.php";
require_once "./model/class/Sequence.class.php";
require_once "./model/class/Ressource.class.php";
require_once "./model/class/Inscription.class.php";
require_once "./outils/outil.php";?>
<?php
class FormationManager extends ConnexionBDD {
    private $formations;
    
    public function getFormations(){
        return $this->formations;
    }
/* --------------------------- AFFICHAGE DU CATALOGUE DE FORMATION --------------------------- */    
    
    function displayAllFormation(){
        $stmt = $this->getBdd()->prepare("SELECT * FROM formation");
        $stmt->execute();
        $bddFormation = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        foreach($bddFormation as $formation){
            $f=new Formation($formation['formation_id'], $formation['fk_user_id'], $formation['libelle'], $formation['acronyme'], $formation['description'], $formation['img'], $formation['video'], "");
            $this->formations[]=$f;
        }
        return $this->formations;
    }
    
    
    
/* --------------------------- AFFICHAGE DE LA FORMATION COMPLETE --------------------------- */      
    
    function displayFormationById($formation_id){
        $stmt = $this->getBdd()->prepare("SELECT * FROM formation WHERE formation_id = :formation_id");
        $stmt->bindValue(":formation_id",$formation_id,PDO::PARAM_INT);
        $stmt->execute();
        $formation = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        
        $f = new Formation($formation['formation_id'], $formation['fk_user_id'], $formation['libelle'], $formation['acronyme'], $formation['description'], $formation['img'], $formation['video']);
            $s = $this->displaySequenceByFormationId($formation_id);
            $f -> setTab_sequence($s);
        return $f; 
    }
    
    function displaySequenceByFormationId($formation_id){
        $stmt = $this->getBdd()->prepare("SELECT * FROM sequence WHERE fk_formation_id = :formation_id");
        $stmt->bindValue(":formation_id",$formation_id,PDO::PARAM_INT);
        $stmt->execute();
        $bddSequence = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        $sequenceList = array();
        
        foreach ($bddSequence as $sequence){
            $si = new Sequence($sequence['sequence_id'], $sequence['fk_formation_id'], $sequence['libelle'], $sequence['description']);
            $si -> setTab_ressource($this->displayRessource($sequence['sequence_id']));
            $sequenceList[] = $si;
        }
        return $sequenceList; 
    }
    
    function displayRessource($sequence_id){
        $stmt = $this->getBdd()->prepare("SELECT * FROM ressource WHERE fk_sequence_id = :sequence_id");
        $stmt->bindValue(":sequence_id",$sequence_id,PDO::PARAM_INT);
        $stmt->execute();
        $bddRessource = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $ressourceList = array();
        
        foreach ($bddRessource as $ressource){
            $r = new Ressource($ressource['ressource_id'], $ressource['fk_formation_id'], $ressource['fk_sequence_id'], $ressource['libelle'], $ressource['link'], $ressource['extension']);
            $ressourceList[]=$r;
        }
        return $ressourceList ; 
    }
    
    function displayMyCreatedTrainings($user_id){
        $stmt = $this->getBdd()->prepare("SELECT * FROM formation WHERE fk_user_id = :user_id");
        $stmt->bindValue(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        $bddFormation = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        foreach($bddFormation as $formation){
            $f=new Formation($formation['formation_id'], $formation['fk_user_id'], $formation['libelle'], $formation['acronyme'], $formation['description'], $formation['img'], $formation['video'], "");
            $this->formations[]=$f;
        }
        return $this->formations;
    }
    
    
    
/* --------------------------- AFFICHAGE DES FORMATIONS INSCRITES --------------------------- */        
    /*function displayMyTraining($user_id){
        $stmt = $this->getBdd()->prepare("SELECT * FROM inscription WHERE fk_user_id = :user_id");
        $stmt->bindValue(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        $bddInscription = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        foreach($bddInscription as $inscription){
            $i=new Inscription($inscription['fk_formation_id'], $inscription['fk_user_id'], $inscription['date']);
            $this->inscriptions[]=$i;
        }
        return $this->inscriptions;
    }*/

    function displayMyTraining($user_id){
        $stmt = $this->getBdd()->prepare("SELECT inscription.fk_formation_id, inscription.fk_user_id, formation.formation_id, formation.libelle FROM inscription INNER JOIN formation ON inscription.fk_formation_id = formation.formation_id WHERE inscription.fk_user_id = 27;");
        $stmt->bindValue(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        $bddInscription = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        foreach($bddInscription as $inscription){
            $i=new Inscription($inscription['fk_formation_id'], $inscription['fk_user_id'], $inscription['date']);
            $this->inscriptions[]=$i;
        }
        return $this->inscriptions;
    }
    

    /* --------------------------- AJOUT EN BASE DE DONNEE --------------------------- */
    
    
/**
 * 
 * @param type $formation
 */
    function addFormation($formation){
        $pdo = $this->getBdd();
        $req = "
        INSERT INTO formation (fk_user_id, libelle, acronyme, description, img, video)
        VALUES (:fk_user_id, :libelle, :acronyme, :description, :img, :video)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":fk_user_id",$formation->getFk_user_id(),PDO::PARAM_INT);
        $stmt->bindValue(":libelle",$formation->getLibelle(),PDO::PARAM_STR);
        $stmt->bindValue(":acronyme",$formation->getAcronyme(),PDO::PARAM_STR);
        $stmt->bindValue(":description",$formation->getDescription(),PDO::PARAM_STR);
        $stmt->bindValue(":img",$formation->getImg(),PDO::PARAM_STR);
        $stmt->bindValue(":video",$formation->getVideo(),PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    
    
/**
 * 
 * @param type $sequence
 */   
    function addSequence($sequence){
        $pdo = $this->getBdd();
        $req = "
        INSERT INTO sequence (fk_formation_id, libelle, description)
        VALUES (:fk_formation_id, :libelle, :description)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":fk_formation_id",$sequence->getFk_formation_id(),PDO::PARAM_INT);
        $stmt->bindValue(":libelle",$sequence->getLibelle(),PDO::PARAM_STR);
        $stmt->bindValue(":description",$sequence->getDescription(),PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();  
    }
    

    function registerTraining($inscription){
        $pdo = $this->getBdd();
        $req = "
        INSERT INTO inscription (fk_formation_id, fk_user_id, date)
        VALUES (:fk_formation_id, :fk_user_id, :date)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":fk_formation_id",$inscription->getFk_formation_id(),PDO::PARAM_INT);
        $stmt->bindValue(":fk_user_id",$inscription->getFk_user_id(),PDO::PARAM_STR);
        $stmt->bindValue(":date",$inscription->getDate(),PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();  
    }
    
    function addRessource($ressource){
        $pdo = $this->getBdd();
        $req = "
        INSERT INTO ressource (fk_formation_id, fk_sequence_id, libelle, link, extension)
        VALUES (:fk_formation_id, :fk_sequence_id, :libelle, :link, :extension)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":fk_formation_id",$ressource->getFk_formation_id(),PDO::PARAM_INT);
        $stmt->bindValue(":fk_sequence_id",$ressource->getFk_sequence_id(),PDO::PARAM_INT);
        $stmt->bindValue(":libelle",$ressource->getLibelle(),PDO::PARAM_STR);
        $stmt->bindValue(":link",$ressource->getLink(),PDO::PARAM_STR);
        $stmt->bindValue(":extension",$ressource->getExtension(),PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();          
    }
    
    
}    
?>