    <?php ob_start()?>

<head>
    <link rel="stylesheet" href="./css/form.style.css" />
</head>


<body>
  <div class="main">
      
    <h1>Modification</h1>
    
    <form method="POST" action="index.php?action=validEditAccount"  enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?= $user->getId() ?>">

        <label for="login">Login</label>
        <input type="text" id="login" name="login" placeholder="Login" value="<?php echo $user->getLogin(); ?>" required>   
       
        <input type="hidden" name="mdp" value="<?= $user->getMdp() ?>">        
        
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="E-mail" value="<?php echo $user->getEmail(); ?>" required >
        
        <label class="form-label" for="img">Photo de profil</label>
        <input class="form-control" type="file" id="img" name="img">
        <input type="hidden" name="image" value="<?= $user->getImg() ?>">

        <?php if (Securite::verifAccessAdmin()){ ?>
            <label for="role">Rôle</label>
            <input type="text" id="role" name="role" placeholder="Rôle" value="<?php echo $user->getRole(); ?>" required>   
        <?php } ?>
            
        <!--<div>
            <input type="checkbox" id="accept" name="accept" value="accept" required>
            <label for="accept">J'accepte les conditions d'utilisations de mes données.</label>
        </div>-->
      
      <input type="submit" value="Editer">
      
    </form>
    
  </div>
</body>

<?php
    $content=ob_get_clean();
    $titre = "Modifier mon compte !";
    require "vue/template.view.php";
?>