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
            
            <input class="template_BTN" type="submit" value="Create">

        </form>
        
    </div>
    
    
    <div class="main">
        <section id="cards">
        <h1>Séquences de la formation</h1>
            <div class="cartes">

        <?php $tabSequence = $formation->getTab_sequence(); ?>
        <?php $numSeq = 0; ?>        
                
                <?php foreach($tabSequence as $sequence) {?>
                <?php $numSeq++ ?>
                    <div class="carte">  
                        
                        <h2>Séquence n°<?php echo $numSeq; ?></h2>
                        <h3><?= $sequence->getLibelle(); ?></h3>
                        <a href="index.php?action=createRessource&formation_id=<?php echo $sequence->getFk_formation_id(); ?>&sequence_id=<?php echo $sequence->getSequence_id(); ?>"><img src="./public/Obligatory/icon_edit.png" width="30px" height="30px"></a>
                    </div>
                <?php } ?>
            </div>
	</section>    
    </div>
</body>
</html>

<?php
    $content=ob_get_clean();
    $titre = "Créer une séquence !";
    require "vue/template.view.php";
?>