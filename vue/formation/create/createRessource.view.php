<?php ob_start()?>

<head>
    <link rel="stylesheet" href="./css/form.style.css" />
</head>


<body>
    <div class="main">
      
        <h1>Ajouter une ressource</h1>
        <form method="POST" action="index.php?action=validCreateRessource" enctype="multipart/form-data">
            
            <input type="text" name="formation_id" value="<?= $_GET['formation_id']?>">
            <input type="text" name="sequence_id" value="<?= $sequence_id?>">

            <label for="libelle">Libelle</label>
            <input type="text" id="libelle" name="libelle" placeholder="Libelle">    
            
            <label for="ressource">Ressource</label>
            <input type="file" id="ressource" name="ressource" >    
            
            <div>
                <input type="radio" id="mp4" name="extension" value="mp4" checked>
                <label for="mp4">Vidéo</label>
                
                <input type="radio" id="pdf" name="extension" value="pdf">
                <label for="pdf">PDF</label>   
                
                <input type="radio" id="zip" name="extension" value="zip">
                <label for="zip">ZIP</label>
            </div>          
            
            <input class="template_BTN" type="submit" value="Create">
        </form>
    </div>

    
</body>
</html>

<?php
    $content=ob_get_clean();
    $titre = "Ajouter une ressource !";
    require "vue/template.view.php";
?>  