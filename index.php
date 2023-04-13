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

            case "displayAllFormations": $formationControleur->displayAllFormation();
                break;

            case "createFormation": $formationControleur->displayCreateFormation();
                break;

            case "validCreateFormation": $formationControleur->validCreateFormation($_POST['libelle'], $_POST['acronyme'], $_POST['description'], $_POST['intro']);
                break;

            case "displayAllTabFormation": $formationControleur->displayAllTabFormation();
                break;

            case "displayFormationMore": $formationControleur->displayFormationMore($_GET['formation_id']);
                break;

            case "createSequence": $formationControleur->displayCreateSequence($_GET['formation_id']);
                break;            
            
            case "validCreateSequence": $formationControleur->validCreateSequence($_POST['fk_formation_id'], $_POST['libelle'], $_POST['description']);
                break;            

            case "displayMyTraining": $formationControleur->displayMyTraining($_SESSION['id']);
                break;  
                        
            case "addTraining": $formationControleur->registerTraining($_GET['id']);
                break;             
            /* --------------------- USER --------------------- */

            case "createAccount": $userControleur->displayCreateAccount();
                break;

            case "validCreateAccount": $userControleur->validCreateAccount($_POST['login'], $_POST['mdp'], $_POST['email']);
                break;
            
            case "validMailAccount": $userControleur->validMailAccount($_GET['login']);
                break;
            
            case "loginAccount": $userControleur->displayLoginAccount();
                break;

            case "validLogin": $userControleur->validLogin();
                break;

            case "deconnexion": $userControleur->deconnexion();
                break;

            case "editAccount": $userControleur->editUser($_GET['user_id']);
                break;

            case "validEditAccount": $userControleur->validEditAccount($_POST['user_id'], $_POST['login'], $_POST['mdp'], $_POST['email'], $_POST['role']);
                break;
            
            case "displayMenuAccount": $userControleur->displayMenuAccount();
                break;

            case "displayMyAccount": $userControleur->displayAccount($_SESSION['login']);
                break;

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