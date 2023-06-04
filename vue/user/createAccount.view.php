<?php ob_start()?>

<head>
    <link rel="stylesheet" href="./css/form.style.css" />
</head>


<body>
  <div class="main">
      
<?php if($alert !== ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $alert ?>
    </div>              
<?php } ?>     
      
    <h1>Inscription</h1>
    
    <form method="POST" action="index.php?action=validCreateAccount"  enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="">  
        <input type="hidden" name="role" value="">

        <label for="login">Login</label>
        <input type="text" id="login" name="login" placeholder="Login" required pattern="^[A-Aa-z '-]+$" maxlenght="20">

         
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="mdp" placeholder="Mot de passe" required>

        
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="E-mail" required >
        
        <label class="form-label" for="img">Photo de profil : </label>
        <input class="form-control" type="file" id="img" name="img">

        <div>
            <input type="checkbox" id="accept" name="acceptServ" value="accept" required>
            <label for="acceptServ">J'ai lu et j'accepte les conditions de service décrites dans les <a>mentions légales</a></label>
        </div>
        
        <div>
            <input type="checkbox" id="accept" name="acceptData" value="accept" required>
            <label for="acceptData">J'accepte que mes données soient conservées pour avoir accès aux services du site de formation.</label>
        </div>
      
      <input type="submit" value="S'inscrire">
      
    </form>
    
  </div>
</body>


<?php
    $content=ob_get_clean();
    $titre = "Créer un compte !";
    require "vue/template.view.php";
?>



