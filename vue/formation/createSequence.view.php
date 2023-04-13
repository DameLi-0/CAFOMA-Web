<?php ob_start()?>

<head>
    <link rel="stylesheet" href="./css/form.style.css" />
</head>


<body>
    <div class="main">
      
        <h1>Créer une séquence</h1>
        <form method="POST" action="index.php?action=validCreateSequence" enctype="multipart/form-data">

            <input type="hidden" name="fk_formation_id" value="<?=$formation_id?>">

            <label for="libelle">Libellé</label>
            <input type="text" id="libelle" name="libelle" placeholder="Libellé" required>
            
            <label for="description">Description</label>
            <input type="text" id="description" name="description" placeholder="Description" required>

          <input type="submit" value="Create">

        </form> 
    </div>
</body>
</html>

<?php
    $content=ob_get_clean();
    $titre = "Créer une séquence !";
    require "vue/template.view.php";
?>