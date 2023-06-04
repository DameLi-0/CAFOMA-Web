<?php
    require_once "controleur/FormationControleur.class.php";
    require_once 'controleur/UserControleur.class.php';
    require_once "outils/outil.php";
    
    if (Securite::autoriserCookie()){
        session_start();
    }
    
    
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

            case "validCreateFormation": $formationControleur->validCreateFormation(Securite::validerInputData($_POST['libelle']), Securite::validerInputData($_POST['acronyme']), Securite::validerInputData($_POST['description']));
                break;

            case "displayMyCreatedTrainings": $formationControleur->displayMyCreatedTrainings($_SESSION['id']);
                break;

            case "displayFormationMore": $formationControleur->displayFormationMore($_GET['formation_id']);
                break;

            case "createSequence": $formationControleur->displayCreateSequence($_GET['formation_id']);
                break;            
            
            case "validCreateSequence": $formationControleur->validCreateSequence(Securite::validerInputData($_POST['fk_formation_id']), Securite::validerInputData($_POST['libelle']), Securite::validerInputData($_POST['description']));
                break;            

            case "displayMyTraining": $formationControleur->displayMyTraining($_SESSION['id']);
                break;  
                      
            case "addTraining": $formationControleur->registerTraining($_GET['id']);
                break;   
            
            case "displayMenuCreation": $formationControleur->displayMenuCreation();
                break;               
            
            case "createRessource": $formationControleur->displayCreateRessource($_GET['sequence_id']);
                break;                

            case "validCreateRessource": $formationControleur->validCreateRessource(Securite::validerInputData($_POST['formation_id']),Securite::validerInputData($_POST['sequence_id']), Securite::validerInputData($_POST['libelle']), Securite::validerInputData($_POST['extension']));
                break;                 
 
            case "displayAdminTabAllFormation": $formationControleur->displayAdminTabAllFormation();
                break;              

            case "displayVideo": $formationControleur->displayVideo($_GET['link']);
                break;             
            
            case "deleteInsc": $formationControleur->deleteInsc($_GET['formation_id']);
                break;               
            
            case "deleteFormationAdmin": $formationControleur->deleteFormationAdmin($_GET['formation_id']);
                break;              
            
            
            
            
            
            
            
            
            /* --------------------- USER --------------------- */

            case "createAccount": $userControleur->displayCreateAccount();
                break;

            case "validCreateAccount": $userControleur->validCreateAccount(Securite::validerInputData($_POST['login']), Securite::validerInputData($_POST['mdp']), Securite::validerInputData($_POST['email']), isset($_POST['acceptServ']),isset($_POST['acceptData']));
                break;
            
            case "validMailAccount": $userControleur->validMailAccount($_GET['login']);
                break;

            case "loginAccount": $userControleur->displayLoginAccount();
                break;

            case "validLogin": $userControleur->validLogin();
                break;

            case "deconnexion": $userControleur->deconnexion();
                break;
            
            case "editAccount": $userControleur->editUser($_GET['id']);
                break;

            case "validEditAccount": $userControleur->validEditAccount(Securite::validerInputData($_POST['user_id']), Securite::validerInputData($_POST['login']), Securite::validerInputData($_POST['mdp']), Securite::validerInputData($_POST['email']), Securite::validerInputData($_POST['img']), Securite::validerInputData($_POST['role']));
                break;
            
            case "displayMenuAccount": $userControleur->displayMenuAccount();
                break;

            case "displayMyAccount": $userControleur->displayAccount($_SESSION['login']);
                break;

            case "displayAllUsers": $userControleur->displayAllUsers();
                break;   
            
            case "deleteAccount": $userControleur->deleteAccount($_GET['id']);
                break;   
            
            /* --------------------- COOKIES --------------------- */
            case "supprimer-cookies": echo "supprimer-cookie";
                session_destroy();
                setcookie('cookie-accept', '', time()-3600, '/', '', false, false);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;            

            case "cookie-accept" : setcookie('cookie-accept', 'true', time() + 365 * 24 * 60 * 60, '/');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;
        
            case "cookie-refuse": $userControleur->refuseCookie();
            break;
        
            default: throw new Exception("La page n'existe pas");
        }
    }
}
catch(Exception $e){
    $erreurMsg = $e->getMessage();
    require "vue/error/error404.view.php";
} 