<?php
    require_once "controleur/FormationControleur.class.php";
    require_once 'controleur/UserControleur.class.php';
    require_once "outils/outil.php";
    session_start();
    
    $formationControleur = new FormationsControleur;
    $userControleur = new UserControleur;

try{    
    if (empty($_GET['action']) || !isset($_GET['action'])) {
        $formationControleur->displayAccueil();
    } else {
        switch ($_GET['action']) {

            /*
             * Route vers l'affichage de toutes les formations
             */
            case "displayAllFormations": $formationControleur->displayAllFormation();
                break;

            /*
             * Route vers l'affichage du formulaire de création de formation
             */
            case "createFormation": $formationControleur->displayCreateFormation();
                break;

            /*
             * Route vers la gestion et l'ajout des données entrer dans le formulaire de création de formation
             */
            case "validCreateFormation": $formationControleur->validCreateFormation($_POST['libelle'], $_POST['acronyme'], $_POST['description']);
                break;

            /*
             * Route vers l'affichage des formations créer par l'utilisateur 
             */
            case "displayMyCreatedTrainings": $formationControleur->displayMyCreatedTrainings($_SESSION['id']);
                break;

            /*
             * Route vers l'affichage complet d'une formation
             */
            case "displayFormationMore": $formationControleur->displayFormationMore($_GET['formation_id']);
                break;

            /*
             * Route vers l'affichage du formulaire de création de séquence
             */
            case "createSequence": $formationControleur->displayCreateSequence($_GET['formation_id']);
                break;            
            
            /*
             * Route vers la gestion et l'ajout des données entrer dans le formulaire de création de sequence
             */
            case "validCreateSequence": $formationControleur->validCreateSequence($_POST['fk_formation_id'], $_POST['libelle'], $_POST['description']);
                break;            

            /*
             * Route vers l'affichage des formations auquelles l'utilisateur est inscrit
             */
            case "displayMyTraining": $formationControleur->displayMyTraining($_SESSION['id']);
                break;  
                      
            /*
             * Route vers la gestion de l'inscription d'un utilisateur à une formation
             */
            case "addTraining": $formationControleur->registerTraining($_GET['id']);
                break;   
            
            /*
             * Route vers l'affichage du menu de création 
             */
            case "displayMenuCreation": $formationControleur->displayMenuCreation();
                break;               
            
            /**
             *  Route vers l'affichage du formulaire de création de ressource
             */
            case "createRessource": $formationControleur->displayCreateRessource($_GET['sequence_id']);
                break;                
            
             /**
             * Route vers la gestion et l'ajout des données entrer dans le formulaire de création de ressource
             */
            case "validCreateRessource": $formationControleur->validCreateRessource($_POST['formation_id'],$_POST['sequence_id'], $_POST['libelle'], $_POST['extension']);
                break;                 
            
            /**
             * Route vers l'affichage de toute les formations (ADMIN)
             */
            case "displayAdminTabAllFormation": $formationControleur->displayAdminTabAllFormation();
                break;              

            case "displayVideo": $formationControleur->displayVideo($_GET['link']);
                break;             
            
            
            
            
            
            
            
            
            
            
            
            
            /* --------------------- USER --------------------- */

            /*
             * Route vers l'affichage du formaulaire de création de compte
             */
            case "createAccount": $userControleur->displayCreateAccount();
                break;

            /*
             * Route vers la gestion et l'ajout des données entrer dans le formulaire de création de compte
             */
            case "validCreateAccount": $userControleur->validCreateAccount($_POST['login'], $_POST['mdp'], $_POST['email']);
                break;
            
            /*
             * Route vers la validation d'un utilisateur via mail
             */
            case "validMailAccount": $userControleur->validMailAccount($_GET['login']);
                break;
            
            /*
             * Route vers l'affichage du formaulaire de connexion
             */
            case "loginAccount": $userControleur->displayLoginAccount();
                break;

           /*
            * Route vers la vérification des données entrer dans le formulaire de création de compte
            */ 
            case "validLogin": $userControleur->validLogin();
                break;

            /*
            * Route vers la déconnexion d'un utilsateur
            */ 
            case "deconnexion": $userControleur->deconnexion();
                break;

            case "editAccount": $userControleur->editUser($_GET['id']);
                break;

            //case "validEditAccount": $userControleur->validEditAccount($_POST['user_id'], $_POST['login'], $_POST['mdp'], $_POST['email'], $_POST['role']);
              //  break;
            
            /*
             * Route vers l'affichage du menu de compte
             */
            case "displayMenuAccount": $userControleur->displayMenuAccount();
                break;

            /*
             * Route vers l'affichage du compte
             */
            case "displayMyAccount": $userControleur->displayAccount($_SESSION['login']);
                break;

            /*
             * Route vers l'affichage de tout les utilisateurs (ADMIN)
             */
            case "displayAllUsers": $userControleur->displayAllUsers();
                break;     
            
            default: throw new Exception("La page n'existe pas");
        }
    }
}
catch(Exception $e){
    $erreurMsg = $e->getMessage();
    require "vue/error/error404.view.php";
} 