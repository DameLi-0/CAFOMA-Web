<?php ob_start()?>

    <head>
        <link rel="stylesheet" href="./css/listFormation.style.css" />
    </head>

    <section>
        <h1 class="h1">Liste des formations</h1>
        
        <div class="cards">
        <?php foreach($tabFormations as $formation) {?>    
            <div class="card">
                <img src="public/Training/Image/<?php echo $formation->getImg(); ?>" width="100px" height="100px">
                <h2><?php echo $formation->getLibelle(); ?></h2>
                <h3><?php echo $formation->getAcronyme(); ?></h3>
                <h4><?php echo $formation->getDescription(); ?></h4>
                <div class="btns">
                    <a class="template_BTN"  href="index.php?action=displayFormationMore&formation_id=<?= $formation->getFormation_id();?>">En savoir +</a>
                    
                    <?php if(Securite::isConnected()){ ?>
                            <a class="template_BTN" href="index.php?action=addTraining&id=<?php echo $formation->getFormation_id(); ?>">M'inscrire</a>
                    <?php } ?>
         
                </div>
            </div>
        <?php } ?>    
        </div>    
        
    </section>

<?php
    $content=ob_get_clean();
    $titre = "Liste des formations !";
    require "vue/template.view.php";
?>