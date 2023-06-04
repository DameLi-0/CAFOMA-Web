<?php
    if(isset($_GET['cookie-accept'])){
        setcookie('cookie-accept','true', time() + 3600); 
        header("Location: index.php");
    }
    require_once "outils/securite.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $titre ?></title>
  <link rel="stylesheet" href="./css/template.style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="./outils/script.js"></script>
</head>

<body class="nav_body">
    <header>
        <div class="header_logo">
            <a href="index.php"><img src="./public/Obligatory/logo_cafoma.png"></a>
        </div>
        <div class="nav">
            <div class="nav_item">
                <a href="index.php?action=displayAllFormations">
                    <div class="item-text">Formations</div>
                </a>
            </div>
            
            <?php if (Securite::isConnected()){ ?>
                <div class="nav_item">
                    <a href="index.php?action=displayMenuAccount">
                        <div class="item-text">Mon compte</div>
                    </a>
                </div>
            <?php }else{ ?>
                <?php if(Securite::autoriserCookie()){ ?>
                    <div class="nav_item">
                        <a href="index.php?action=loginAccount">
                            <div class="item-text">Se connecter</div>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
            
            <?php if (Securite::verifAccessAdmin()){ ?>
                <div class="nav_item">
                  <a href="index.php?action=displayAllUsers">
                    <div class="item-text">AdminUser</div>
                  </a>
                </div>

                <div class="nav_item">
                   <a href="index.php?action=displayAdminTabAllFormation">
                     <div class="item-text">AdminTraining</div>
                   </a>
                </div>   
            <?php } ?>
  </div>
        
    </header>
    
    <div>
        <?php echo $content ?>
    </div>
    
    <?php if(!isset($_COOKIE['cookie-accept'])){ ?>
        <div class="banniere">
            <div class="text-banniere">
                <p>
                    Notre site utilise un cookies de session pour l'authentification et d'autres fonctions pour utiliser nos services.<br>
                    Voire notre <a href="index.php?action=cookies">politique en matiére de cookie</a><br>
                    Voire notre <a href="index.php?action=donnees-personnelles">politique relatif aux données personnelles</a>
                </p>
            </div>
            <div class="button-banniere">
                <a href="index.php?action=cookie-accept">OK, j'accepte</a>
                <a href="index.php?action=cookie-refuse">Continuer sans accepter</a>
            </div>
        </div>
    <?php } ?>    
    
</body>
    <footer>
        <p><i>DameLi © 2023 Formation en ligne. Tous droits réservés.</i></p>
        <div class="doc">
            <a class="doc_item">Mentions Légales</a>
            <p class="doc_sep"> | </p>
            <a class="doc_item">Cookies</a>
            <p class="doc_sep"> | </p>
            <a class="doc_item">Données personnelles</a>
        </div>
    </footer> 



</html>