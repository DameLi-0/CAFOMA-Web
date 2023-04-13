<?php ob_start()?>

<head>
    <link rel="stylesheet" href="./css/form.style.css" />
</head>


<body>
    <div class="main">
      
    <h1>Créer une formation</h1>
    <form method="POST" action="index.php?action=validCreateFormation" enctype="multipart/form-data">
        
        <input type="hidden" name="fk_user_id" value="<?= $_SESSION['id'] ?>">
        
        <label for="libelle">Libellé</label>
        <input type="text" id="libelle" name="libelle" placeholder="Libellé" required>

        <label for="acronyme">Acronyme</label>
        <input type="text" id="acronyme" name="acronyme" placeholder="Acronyme" required>

        <label for="description">Description</label>
        <input type="text" id="description" name="description" placeholder="Description" required>

        <label for="img">Image</label>
        <input type="file" id="img" name="img" placeholder="Image" required>

        <label for="intro">Vidéo</label>
        <input type="text" id="intro" name="intro" placeholder="Lien de la vidéo">       
        
        
      <input type="submit" value="Create">
      
    </form>
    
  </div>
</body>
</html>

<?php
    $content=ob_get_clean();
    $titre = "Créer une formation !";
    require "vue/template.view.php";
?>

