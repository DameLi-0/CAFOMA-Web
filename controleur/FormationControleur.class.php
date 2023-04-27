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
     * Affichage de toute les formations
     */
    function displayAllFormation(){        
        $tabFormations=$this->formationManager->displayAllFormation();
        require 'vue/formation/display/displayAllFormation.view.php';
    }
    
    /**
     * Affichage de toute les formations 
     */
    function displayMyCreatedTrainings($user_id){
        $tabFormations=$this->formationManager->displayMyCreatedTrainings($user_id);
        require 'vue/formation/display/displayMyCreatedTraining.view.php';
    }    
    
    /**
     * Affichage de la vue détailer de la formation
     */
    function displayFormationMore($formation_id){  
        $formation = $this->formationManager->displayFormationById($formation_id);
        require 'vue/formation/display/displayDetailFormation.view.php';
    }        
    
    
    /**
     * Envoie vers le formulaire de création de formation 
     */
    function displayCreateFormation(){
        require 'vue/formation/create/createFormation.view.php';
    }

    /**
     * Gestion de l'image et de la vidéo récupéré via le formulaire
     * Création de l'objet "Formation"
     * Ajout des données en base de données
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
     * Redrection vers la vue du formulaires de création de séquence
     * 
     * @param type $formation_id
     * @param type $libelle
     * @param type $description
     */
    function validCreateSequence($formation_id, $libelle, $description){
        $sequence = new Sequence("", $formation_id, $libelle, $description);
        $this->formationManager->addSequence($sequence);
        header("Location: index.php?action=createSequence&formation_id=".$formation_id);        
    }
    
    /**
     * Récupération des formations auquelle l'utilsateur est inscrit en base de données
     * Redirection vers la vue d'affichage des formations auquelle l'utilsateur est inscrite
     * 
     * @param type $user_id
     */
    function displayMyTraining($user_id){
        $tabInscription = $this->formationManager->displayMyTraining($user_id);
        require 'vue/formation/display/displayMyTraining.view.php';        
    }
    
    /**
     * Stockage de la variable superglobal 
     * Création de l'objet "Inscription"
     * Ajout de l'inscription en base de données
     * Redirection vers la page d'accueil
     * 
     * @param type $formation_id
     */
    function registerTraining($formation_id){    
        $fk_user_id = $_SESSION['id'];
        $inscription = new Inscription($formation_id, $fk_user_id);
        $this->formationManager->registerTraining($inscription);
        header("Location: index.php");       
    }
    
    /**
     * Affichage du menu de création
     */
    function displayMenuCreation(){
        require 'vue/formation/menuCreation.view.php';
    }
    
    /**
     * Affichage du formulaire de création de ressource
     */
    function displayCreateRessource($sequence_id){
        $sequence = $this->formationManager->displayRessource($sequence_id);
        require 'vue/formation/create/createRessource.view.php';
    }
    
    /**
     * Gestion du fichier reçue dans le formulaire
     * Création de l'objet "Ressource"
     * Ajout de l'objet en base de données
     * Redirection vers le formulaire de création de séquence
     * 
     * @param type $formation_id
     * @param type $sequence_id
     * @param type $libelle
     * @param type $extension
     */
    function validCreateRessource($formation_id,$sequence_id, $libelle, $extension){

        $file = $_FILES['ressource'];
        $dir = "public/Training/Ressource/";
        $nomRessourceAjoute = ajouterImage($file, $dir); 
        
        $ressource = new Ressource("", $formation_id, $sequence_id, $libelle, $nomRessourceAjoute, $extension);
        $this->formationManager->addRessource($ressource);
        header("Location: index.php?action=createSequence&formation_id=".$formation_id);       
    }    
    
    /**
     * Récupération de toutes les formations en base de données
     * Redirection vers la vue d'affichage de toute les formations
     */
    function displayAdminTabAllFormation(){
        $tabFormations=$this->formationManager->displayAllFormation();
        require 'vue/admin/adminTabAllFormation.view.php';
    }
    
    function displayVideo($link){
        require 'vue/formation/display/displayVideo.view.php';
    }
}
    