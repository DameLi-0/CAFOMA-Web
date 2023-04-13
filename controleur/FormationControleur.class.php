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
        require 'vue/formation/displayAllFormation.view.php';
    }
    
    /**
     * Affichage de toute les formations (VUE ADMIN)
     */
    function displayAllTabFormation(){
        $tabFormations=$this->formationManager->displayAllFormation();
        require 'vue/formation/adminTabAllFormation.view.php';
    }    
    
    /**
     * Affichage de la vue détailer de la formation (VUE ALL)
     */
    function displayFormationMore($formation_id){
        $formation = $this->formationManager->displayFormationById($formation_id);
        require 'vue/formation/displayDetailFormation.view.php';
    }        
    
    
    /**
     * Création d'une formation (VUE ADMIN / RESPONSABLE)
     */
    function displayCreateFormation(){
        require 'vue/formation/createFormation.view.php';
    }

    /**
     * Ajout de la formation en BDD et gestion de l'image 
     * 
     * @param type $libelle
     * @param type $acronyme
     * @param type $description
     */
    function validCreateFormation($libelle, $acronyme, $description, $intro){
        
        $file = $_FILES['img'];
        $dir = "public/PPformation/";
        $nomImageAjoute = ajouterImage($file, $dir);        
        
        $formation = new Formation("",$_SESSION['id'], $libelle, $acronyme, $description, $nomImageAjoute, $intro, "");
        $this->formationManager->addFormation($formation);
        header("Location: index.php");
    }
    
    /**
     * Affichage du formulaire de création de séquence
     * @param type $formation_id
     */
    function displayCreateSequence($formation_id){
        require 'vue/formation/createSequence.view.php';
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
        header("Location: index.php");        
    }
    
    function displayMyTraining($user_id){
        $tabInscription = $this->formationManager->displayMyTraining($user_id);
        require 'vue/formation/displayMyTraining.view.php';        
    }
    
    function registerTraining($formation_id){    
        $fk_user_id = $_SESSION['id'];
        $inscription = new Inscription($formation_id, $fk_user_id);
        $this->formationManager->registerTraining($inscription);
        header("Location: index.php");       
    }
}
    