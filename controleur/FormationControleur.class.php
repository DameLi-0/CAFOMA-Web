<?php
    require_once "./model/manager/FormationDAO.class.php"; 
    require_once './outils/outil.php';
    
class FormationsControleur{
    private $formationManager;
    
    public function __construct(){
        $this->formationManager = new FormationManager();
    }
    
    /**
     * Affichage de la page d'accueil (VUE ALL)
     */
    function displayAccueil(){
        require "vue/accueil.view.php";
    }
    
    /**
     * Affichage de toute les formations (VUE ALL)
     */
    function displayAllFormation(){
        $tabFormations=$this->formationManager->displayAllFormation();
        require 'vue/formation/display/displayAllFormation.view.php';
    }
    
    /**
     * Affichage de toute les formations (VUE ADMIN)
     */
    function displayMyCreatedTrainings($user_id){
        $tabFormations=$this->formationManager->displayMyCreatedTrainings($user_id);
        require 'vue/formation/display/displayMyCreatedTraining.view.php';
    }    
    
    /**
     * Affichage de la vue détailer de la formation (VUE ALL)
     */
    function displayFormationMore($formation_id){
        $formation = $this->formationManager->displayFormationById($formation_id);
        require 'vue/formation/display/displayDetailFormation.view.php';
    }        
    
    
    /**
     * Création d'une formation (VUE ADMIN / RESPONSABLE)
     */
    function displayCreateFormation(){
        require 'vue/formation/create/createFormation.view.php';
    }

    /**
     * Ajout de la formation en BDD et gestion de l'image 
     * 
     * @param type $libelle
     * @param type $acronyme
     * @param type $description
     */
    function validCreateFormation($libelle, $acronyme, $description){
        
        /* GESTION DE L'IMAGE */
        $file = $_FILES['img'];
        $dir = "public/Training/Image/";
        $nomImageAjoute = ajouterImage($file, $dir);  
        
        /* GESTION DE LA VIDEO */
        $file = $_FILES['video'];
        $dir = "public/Training/Ressource/";
        $nomVideoAjoute = ajouterImage($file, $dir); 
        
        $formation = new Formation("",$_SESSION['id'], $libelle, $acronyme, $description, $nomImageAjoute, $nomVideoAjoute);
        $this->formationManager->addFormation($formation);
        header("Location: index.php?action=displayMenuCreation");
    }
    
    /**
     * Affichage du formulaire de création de séquence
     * @param type $formation_id
     */
    function displayCreateSequence($formation_id){
        $formation = $this->formationManager->displayFormationById($formation_id);
        require 'vue/formation/create/createSequence.view.php';
    }
    
    /**
     * Création de l'objet séquence
     * Ajout de la séquence en BDD 
     * @param type $formation_id
     * @param type $libelle
     * @param type $description
     */
    function validCreateSequence($formation_id, $libelle, $description){
        $sequence = new Sequence("", $formation_id, $libelle, $description);
        $this->formationManager->addSequence($sequence);
        header("Location: index.php?action=createSequence&formation_id=".$formation_id);        
    }
    
    function displayMyTraining($user_id){
        $tabInscription = $this->formationManager->displayMyTraining($user_id);
        require 'vue/formation/display/displayMyTraining.view.php';        
    }
    
    function registerTraining($formation_id){    
        $fk_user_id = $_SESSION['id'];
        $inscription = new Inscription($formation_id, $fk_user_id);
        $this->formationManager->registerTraining($inscription);
        header("Location: index.php");       
    }
    
    
    function displayMenuCreation(){
        require 'vue/formation/menuCreation.view.php';
    }
    
    function createRessource(){
        require 'vue/formation/create/createRessource.view.php';
    }
    
    function validCreateRessource($formation_id,$sequence_id, $libelle, $extension){

        $file = $_FILES['ressource'];
        $dir = "public/Training/Ressource/";
        $nomRessourceAjoute = ajouterImage($file, $dir); 
        
        $ressource = new Ressource("", $formation_id, $sequence_id, $libelle, $nomRessourceAjoute, $extension);
        $this->formationManager->addRessource($ressource);
        header("Location: index.php?action=createSequence&formation_id=".$formation_id);       
    }    
}
    