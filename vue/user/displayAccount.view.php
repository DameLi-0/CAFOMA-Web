<?php ob_start()?>

<head>
    <link rel="stylesheet" href="./css/account.style.css" />
</head>

<body>
    
  <div class="container_displayAccount">
      <h3>Mon compte</h3>
      <img id="PPuser" src="public/User/<?php echo $user->getImg(); ?>">
      
      <i class="fa-solid fa-pen-to-square"></i>
      <ul>
          <li><img src="public/Obligatory/icon_user.png" ><?php echo $user->getLogin(); ?></li>
          <li><img src="public/Obligatory/icon_email.png"><?php echo $user->getEmail(); ?></li>
          <li><img src="public/Obligatory/icon_role.png"><?php echo $user->getRole(); ?></li>
      </ul>
      
      <a class="template_BTN" href="index.php?action=deconnexion">Déconnexion</a>
      <br>
      <a id="edit" href="index.php?action=editAccount&id=<?php echo $user->getUser_id();?>"><img src="./public/Obligatory/icon_edit.png" width="32px" height="32px"></a>
  </div>
    
    
</body>
</html>

<?php
    $content=ob_get_clean();
    $titre = "Mon compte !";
    require "vue/template.view.php";
?>