<?php ob_start()?>

    <head>
        <link rel="stylesheet" href="./css/listFormation.style.css" />
    </head>

    <section>
        <h1 class="h1">Liste de mes formations créées</h1>
        
        <div class="cards">
        <?php foreach($tabFormations as $formation) {?>    
            <div class="card">
                <img src="public/Training/Image/<?php echo $formation->getImg(); ?>" width="100px" height="100px">
                <h2><?php echo $formation->getLibelle(); ?></h2>
                <h3><?php echo $formation->getAcronyme(); ?></h3>
                <h4><?php echo $formation->getDescription(); ?></h4>
                <br>
                <a href="index.php?action=createSequence&formation_id=<?php echo $formation->getFormation_id(); ?>"><img src="./public/Obligatory/edit.png" width="30px" height="30px"></a>

            </div>
        <?php } ?>    
        </div>    
        
    </section>

<?php
    $content=ob_get_clean();
    $titre = "Vos formations !";
    require "vue/template.view.php";
?>