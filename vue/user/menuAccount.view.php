<?php ob_start()?>

<head>
  <link rel="stylesheet" href="./css/account.style.css" />
</head>

<body>
    <div class="container">
        <div class="item">
          <a href="index.php?action=displayMyTraining">
            <div class="item-image">
              <img src="./public/Obligatory/icon_education.png" width="64" height="64">
            </div>
            <div class="item-text">My Training</div>
            <div class="item-link-desc">Access...</div>
          </a>
        </div>

        <div class="item">
          <a href="index.php?action=displayMyAccount">
            <div class="item-image">
              <img src="./public/Obligatory/icon_account.png" width="64" height="64">
            </div>
            <div class="item-text">My Account</div>
            <div class="item-link-desc">Access...</div>
          </a>
        </div>
        
        <?php if (Securite::verifAccessResponsable() || Securite::verifAccessAdmin()){?>
            <div class="item">
              <a href="index.php?action=displayMenuCreation">
                <div class="item-image">
                  <img src="./public/Obligatory/icon_bdd.png" width="64" height="64">
                </div>
                <div class="item-text">Creation Area</div>
                <div class="item-link-desc">Access...</div>
              </a>
            </div>
        
           <div class="item">
              <a href="index.php?action=displayMyCreatedTrainings">
                <div class="item-image">
                  <img src="./public/Obligatory/Save.png" width="64" height="64">
                </div>
                <div class="item-text">Save Area</div>
                <div class="item-link-desc">Access...</div>
              </a>
            </div>        
            
        <?php } ?>
        
    </div>
</body>

<?php
    $content=ob_get_clean();
    $titre = "Connexion";
    require "vue/template.view.php";
?>