<?php ob_start()?>

<head>
  <link rel="stylesheet" href="./css/form.style.css" />
</head>

<body>
    
    <div id="alert">
        <?php $alert = ""; ?>
    </div>    
    <div class="main">
      <h1>Connexion</h1>
      <form method="POST" action="index.php?action=validLogin">

          <label for="username">Login</label>
          <input type="text" id="login" name="login" placeholder="Login">

          <label for="password">Mot de passe</label>
          <input type="password" id="mdp" name="mdp" placeholder="Mot de passe">

          <input type="submit" href="index.php?action=validco" value="Se connecter">

        <a href="index.php?action=createAccount">Créer un compte</a>
      </form>
    </div>
</body>

<?php
    $content=ob_get_clean();
    $titre = "Connexion";
    require "./vue/template.view.php";
?>