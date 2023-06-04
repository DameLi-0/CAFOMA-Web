    <?php ob_start()?>

<head>
    <link rel="stylesheet" href="./css/form.style.css" />
</head>


<body>
  <div class="main">
      
    <h1>Modification</h1>
    
    <form method="POST" action="index.php?action=validEditAccount"  enctype="multipart/form-data">
        
        <input type="hidden" name="user_id" value="<?= $user->getUser_id() ?>">
        <input type="hidden" name="img" value="<?= $user->getImg() ?>">

        <label for="login">Login</label>
        <input type="text" id="login" name="login" placeholder="Login" value="<?php echo $user->getLogin(); ?>" required>   
       
        <input type="hidden" name="mdp" value="<?= $user->getMdp() ?>">        
        
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="E-mail" value="<?php echo $user->getEmail(); ?>" required >
        

        <?php if (Securite::verifAccessAdmin()){ ?>
            <label for="role">Rôle</label>
            <input type="text" id="role" name="role" placeholder="Rôle" value="<?php echo $user->getRole(); ?>" required>   
        <?php } ?>
            
      
      <input type="submit" value="Editer">
      
    </form>
    
  </div>
</body>

<?php
    $content=ob_get_clean();
    $titre = "Modifier mon compte !";
    require "vue/template.view.php";
?>