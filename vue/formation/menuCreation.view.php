<?php ob_start()?>

<head>
  <link rel="stylesheet" href="./css/account.style.css" />
</head>

<body>
    <div class="container">
        
        <?php if (Securite::verifAccessResponsable() || Securite::verifAccessAdmin()){?>
            <div class="item">
              <a href="index.php?action=createFormation">
                <div class="item-image">
                  <img src="./public/Obligatory/icon_formation.png" width="64" height="64">
                </div>
                <div class="item-text">Create Training</div>
                <div class="item-link-desc">Access...</div>
              </a>
            </div>
        
           <div class="item">
              <a href="index.php?action=displayMyCreatedTrainings">
                <div class="item-image">
                  <img src="./public/Obligatory/icon_sequence.png" width="64" height="64">
                </div>
                <div class="item-text">Create Sequence</div>
                <div class="item-link-desc">Access...</div>
              </a>
            </div>        
            
           <div class="item">
              <a href="index.php?action=displayMyCreatedTrainings">
                <div class="item-image">
                  <img src="./public/Obligatory/icon_ressource.png" width="64" height="64">
                </div>
                <div class="item-text">Add Resource</div>
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