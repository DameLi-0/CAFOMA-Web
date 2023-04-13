<?php ob_start()?>

<head>
    <link rel="stylesheet" href="./css/form.style.css" />
</head>


<body>
  <div class="main">
      
    <h1>Inscription</h1>
    
    <form method="POST" action="index.php?action=validCreateAccount"  enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="">  
        <input type="hidden" name="role" value="">

        <label for="login">Login</label>
        <input type="text" id="login" name="login" placeholder="Login" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="mdp" placeholder="Mot de passe" required >        
        
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="E-mail" required >
        
        <label class="form-label" for="img">Photo de profil : </label>
        <input class="form-control" type="file" id="img" name="img">

        <!--<div>
            <input type="checkbox" id="accept" name="accept" value="accept" required>
            <label for="accept">J'accepte les conditions d'utilisations de mes données.</label>
        </div>-->
      
      <input type="submit" value="S'inscrire">
      
    </form>
    
  </div>
</body>


<?php
    $content=ob_get_clean();
    $titre = "Créer un compte !";
    require "vue/template.view.php";
?>