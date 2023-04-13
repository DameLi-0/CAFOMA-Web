<?php ob_start()?>

<head>
    <link rel="stylesheet" href="./css/account.style.css" />
</head>

<body>
    
  <div class="container_displayAccount">
      <h3>Mon compte</h3>
      <img id="PPuser" src="public/PPusers/<?php echo $user->getImg(); ?>">
      
      <i class="fa-solid fa-pen-to-square"></i>
      <ul>
          <li>ID : <?php echo $user->getUser_id(); ?></li>
          <li>Login : <?php echo $user->getLogin(); ?></li>
          <li>Email : <?php echo $user->getEmail(); ?></li>
          <li>Rôle : <?php echo $user->getRole(); ?></li>
      </ul>
      
      <a class="template_BTN" href="index.php?action=deconnexion">Déconnexion</a>
      <br>
      <a id="edit" href="index.php?action=editAccount&id=<?php echo $user->getUser_id();?>"><img src="./public/obg/edit.png" width="25px" height="25px"></a>
  </div>
    
    
</body>
</html>

<?php
    $content=ob_get_clean();
    $titre = "Mon compte !";
    require "vue/template.view.php";
?>