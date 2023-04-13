<?php ob_start()?>



<head>
  <link rel="stylesheet" href="./css/account.style.css" />
</head>

<body>
    <div class="container">
        <div class="item">
          <a href="index.php?action=displayMyTraining">
            <div class="item-image">
              <img src="./public/obg/training.png" width="64" height="64">
            </div>
            <div class="item-text">My Training</div>
            <div class="item-link-desc">Access...</div>
          </a>
        </div>

        <div class="item">
          <a href="index.php?action=displayMyAccount">
            <div class="item-image">
              <img src="./public/obg/account.png" width="64" height="64">
            </div>
            <div class="item-text">My Account</div>
            <div class="item-link-desc">Access...</div>
          </a>
        </div>
    </div>
</body>

<?php
    $content=ob_get_clean();
    $titre = "Connexion";
    require "vue/template.view.php";
?>