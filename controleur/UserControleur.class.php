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
        $alert = "";
        require 'vue/user/createAccount.view.php';
    }
    
    function validCreateAccount($login, $mdp, $email, $acceptServ, $acceptData){
        $alert = "";
        $emailExist = $this->userManager->verifExistEmail($email); 
        
        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/", $mdp )) {
            $alert = "Votre mot de passe doit contenir au moins 12 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.";
            require "vue/user/createAccount.view.php";
            return;
        }   
        
        if($emailExist > 0){
            $alert = "Ce mail est déjà renseigner pour un compte";
            require "vue/user/createAccount.view.php";
        } 
        
        if(!$acceptServ || !$acceptData){
            $alert = "Vous devez valider les cases à cocher pour pouvoir créer votre compte !"; 
            require "vue/user/createAccount.view.php";
        }     
        
        else{
            $hpassword = password_hash($mdp, PASSWORD_DEFAULT);  

            /* GERER L'IMAGE */
            $file = $_FILES['img'];
            $dir = "public/User/";
            $nomImageAjoute = ajouterImage($file, $dir);

            /* ENVOIS DE L'EMAIL DE VERIFICATION */
            $this->sendMailValidation($login, $email);

            /* CREATION DE L'OBJET 'User' */
            $user = new User("", $login, $hpassword, $email, $nomImageAjoute, "Abonner", 0);

            /* AJOUT DU USER EN BDD */
            if($this->userManager->addAccount($user)){
               header("Location: index.php");   
            }else throw new Exception ("Le compte n'a pu être créé.");

                      
        }

    }
    
    private function sendMailValidation($login,$email){
        $mail = $email;
        $urlVerification = "http://localhost/CAFOMA/"."index.php?action=validMailAccount&login=".$login;
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
        require 'vue/admin/adminTabAllUser.view.php';
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
    
    function validEditAccount($id, $login, $mdp, $email, $img, $role){
             
        $user = new User($id, $login, $mdp, $email, $img, $role, 1);
        
        $this->userManager->editUserBdd($user);
        var_dump($user);
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
    
    function deleteAccount($id){
        $user = $this->userManager->deleteAccount($id);
        unset($_SESSION['role']);
        unset($_SESSION['login']);
        unset($_SESSION['id']);
        header("Location: index.php");    
    }
    
    function refuseCookie() {        
        require "vue/error/ConsentementCookie.view.php";
    }
}