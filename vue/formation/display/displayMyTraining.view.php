<?php ob_start()?>

    <head>
        <link rel="stylesheet" href="./css/listFormation.style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <h2 style="text-align: center; margin-top: 6rem">Your learning</h2>
        <section>
            <div class="cards">
            <?php if(is_array($tabInscription)){ ?>
            <?php foreach($tabInscription as $inscription) {?>    
 
                <div class="card">

                    <h2><?php echo $inscription->getLibelle(); ?></h2>

                    <div class="btns">
                        <a class="template_BTN"  href="index.php?action=displayFormationMore&formation_id=<?= $inscription->getFk_formation_id();?>">En savoir +</a>

                    </div>
                </div>
            <?php } }else{?>
            <div class="foreachVide">
                <img src="public/Obligatory/img_tab_vide.png" width="450px" height="450px">
                <p class="foreachVide_text">Oupss... On dirait que tu est inscrit à aucune formation ^^</p>
            </div>
            <?php }?>    
            </div>
        </section>
    </body>    

<?php
    $content=ob_get_clean();
    $titre = "Administration - User";
    require "vue/template.view.php";
?>