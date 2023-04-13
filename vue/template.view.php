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

<body>
    <header>
        <img src="./public/obg/StudentFormFinal.png" alt="LOGO" width="300px" height="100px">
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php?action=displayAllFormations">Formations</a></li>
                
                <?php if (Securite::isConnected()){ ?>
                    <li><a href="index.php?action=displayMenuAccount">Mon compte</a></li>
                <?php }else{ ?>
                    <li><a href="index.php?action=loginAccount">Se Connecter</a></li>
                <?php } ?>      
                    
                    
                <?php if (Securite::verifAccessAdmin()){ ?>
                    <li><a class="dropdown-item" href="index.php?action=displayAllUsers">TabUsers</a></li>
                    <li><a class="dropdown-item" href="index.php?action=displayAllTabFormation">TabFormation</a></li>
                <?php } ?>
                    
                <?php if (Securite::verifAccessResponsable() || Securite::verifAccessAdmin()){?>
                    <li><a class="dropdown-item" href="index.php?action=createFormation">Créer formation</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    
    <div>
        <?php echo $content ?>
    </div>
    
    <footer>
        <p>Dameli © 2023 Formation en ligne. Tous droits réservés.</p>
    </footer> 
    
</body>
</html>