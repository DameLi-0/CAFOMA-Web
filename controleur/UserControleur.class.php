<?php
    require_once "./model/manager/UserDAO.class.php"; 
    require_once './outils/outil.php';
    require_once './outils/securite.php';
    
class UserControleur{
    private $userManager;

    public function __construct(){
        $this->userManager = new UserManager();
    }
    
    function displayLoginAccount(){
        if (!Securite::verifAccessAdmin()){ require 'vue/user/loginAccount.view.php';}
        else { header("Location: index.php");} 
    }
    
    function displayCreateAccount(){
        require 'vue/user/createAccount.view.php';
    }
    
    function validCreateAccount($login, $mdp, $email){
        
        /* GERER L'IMAGE */
        $file = $_FILES['img'];
        $dir = "public/PPusers/";
        $nomImageAjoute = ajouterImage($file, $dir);
        
        /* GERER LE MOT DE PASSE */
        $hpassword = password_hash($mdp, PASSWORD_DEFAULT);
        
        /* ENVOIS DE L'EMAIL DE VERIFICATION */
        $this->sendMailValidation($login, $email);
        
        /* CREATION DE L'OBJET 'User' */
        $user = new User("", $login, $hpassword, $email, $nomImageAjoute, "Abonner", 0);
        
        /* AJOUT DU USER EN BDD */
        $this->userManager->addAccount($user);
        
        header("Location: index.php");
    }
    
    private function sendMailValidation($login,$email){
        $mail = $email;
        $urlVerification = "http://localhost/Projets/CAFOMA/"."index.php?action=validMailAccount&login=".$login;
        $sujet = "Confirmation de création de votre compte !";
        $message = "Pour valider votre compte veuillez cliquer sur le lien suivant ".$urlVerification;
        sendMail($mail,$sujet,$message);
    }
    
    function validMailAccount($login){
        $this->userManager->validerAbonne($login);
        require "vue/user/loginAccount.view.php";
    }    


    function displayAllUsers(){
        $tabUsers = $this->userManager->displayAllUser();
        require 'vue/user/adminTabAllUser.view.php';
    }
    
    function displayAccount($login){
        $user = $this->userManager->displayUserByLogin($login);
        require 'vue/user/displayAccount.view.php';
    }
    
    function displayMenuAccount(){
        require 'vue/user/menuAccount.view.php';
    }    
    
    function editUser($id){
        $user = $this->userManager->displayUserById($id);
        require "vue/user/editAccount.view.php";
    }
    
    function validEditAccount($id, $login, $mdp, $email, $role){
        $nomImageAjoute = $_POST['image'];
       
        if($_FILES['img']['size'] > 0){
            unlink("public/PPusers/".$nomImageAjoute);
            
            $file = $_FILES['img'];
            $dir = "public/PPusers/";
            
            $nomImageAjoute = ajouterImage($file,$dir);
        }      
        $user = new User($id, $login, $mdp, $email, $nomImageAjoute, $role);

        $this->userManager->editUserBdd($user);
        header("Location: index.php");

    }     

    function validLogin(){
        echo "test";
        $alert = "";
            if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['mdp'])){
                $login = $_POST['login'];
                
                $user_id = $this->userManager->getIdUser($login);
                $passwdHash = $this->userManager->getPasswdHashUser($login);
                $role = $this->userManager->getRoleUser($login);
                $valid = $this->userManager->getIsValid($login);
                
                if ($valid === "1"){
                    if(password_verify($_POST['mdp'], $passwdHash)){
                        $_SESSION['id'] = $user_id;
                        $_SESSION['role'] = $role;  
                        $_SESSION['login'] = $login;
                        header("Location: index.php");
                        
                    }else {$alert = "Couple login/mot de passe invalide"; require 'vue/user/loginAccount.view.php';}                    
                }else {$alert = "Votre compte n'est pas vérifier !"; require 'vue/user/loginAccount.view.php';}
            } else {$alert = "Saisir un nom d'utilisateur et un mot de passe"; require 'vue/user/loginAccount.view.php';}
    }
    
    function deconnexion(){
            unset($_SESSION['role']);
            unset($_SESSION['login']);
            unset($_SESSION['id']);
            header("Location: index.php");      
    }  
}