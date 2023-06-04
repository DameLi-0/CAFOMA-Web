<?php

class Securite {
    
    public static function verifAccessAdmin(){
        return (isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] === "Admin");
    }
    
    public static function verifAccessResponsable(){
        return (isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] === "Responsable");
    }    
    
    public static function isConnected(){
        return (isset($_SESSION['role']) && !empty($_SESSION['role']));
    }
    
    public static function validerInputData($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
    
    public static function autoriserCookie(){
        return (isset($_COOKIE['cookie-accept']));
    }
}

