<?php require_once "./outils/securite.php"; ?>


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
                <div class="nav_item">
                    <a href="index.php?action=loginAccount">
                        <div class="item-text">Se connecter</div>
                    </a>
                </div>            
            <?php } ?>
            
            <?php if (Securite::verifAccessAdmin()){ ?>
                <div class="nav_item">
                  <a href="index.php?action=displayAllUsers">
                    <div class="item-text">TabUsers</div>
                  </a>
                </div>

                <div class="nav_item">
                   <a href="index.php?action=displayAllTabFormation">
                     <div class="item-text">TabFormation</div>
                   </a>
                </div>   
            <?php } ?>
  </div>
        
    </header>
    
    <div>
        <?php echo $content ?>
    </div>
    
    <footer>
        <p><i>DameLi © 2023 Formation en ligne. Tous droits réservés.</i></p>
        <div class="doc">
            <a>Mentions Légales</a>
            <p> | </p>
            <a>Cookies</a>
            <p> | </p>
            <a>Données personnelles</a>
        </div>
    </footer> 
    
</body>
</html>