<?php ob_start()?>

<head>
  <link rel="stylesheet" href="./css/detailFormation.style.css">
</head>

<body>
	<section id="introduction">
       
            
         <video width="600" height="420" controls preload auto>
             <source src="public/Training/Ressource/<?= $formation->getVideo(); ?>">
        </video>
            
        <div class="text_intro">
             <img src="public/Training/Image/<?= $formation->getImg(); ?>" alt="Description de l'image" height="260px" width="260px" class="forma">
            <h1 class="forma"><?=  $formation->getLibelle(); ?></h1>
            <h2 class="forma"><?= $formation->getAcronyme(); ?></h2>
            <p class="forma"><?= $formation->getDescription(); ?></p>
            <a class="template_BTN" href="index.php?action=addTraining&id=<?php echo $formation->getFormation_id(); ?>">M'inscrire</a>
        </div>

    </section>

    <?php if (Securite::isConnected()){ ?>
        <section id="cards">
                <h1>Séquences de la formation</h1>
                    <div class="cartes">

                <?php $tabSequence = $formation->getTab_sequence(); ?>

                <?php $numSeq = 0; ?>    
                    <?php foreach($tabSequence as $sequence) {?>
                    <?php $numSeq++ ?>
                        <div class="carte">  
                            <h2 class="seq">Séquence n°<?php echo $numSeq; ?></h2>
                            <h3 class="seq"><?= $sequence->getLibelle(); ?></h3>
                            <p class="seq"><?= $sequence->getDescription(); ?></p>


                            <?php $tabRessource = $sequence->getTab_ressource(); ?>  
                            <?php foreach($tabRessource as $ressource) {?>
                                <div class="ressource">
                                    <?php $extension = $ressource->getExtension(); ?>
                                    <?php if ($extension === "mp4"){ ?><div><p>Video | <?= $ressource->getLibelle(); ?></p></div><?php } ?>
                                    <?php if ($extension === "pdf"){ ?><div><p>PDF | <?= $ressource->getLibelle(); ?></p></div><?php } ?>
                                    <?php if ($extension === "zip"){ ?><div><p>Archive | <?= $ressource->getLibelle(); ?></p></div><?php } ?>

                                    <?php if ($extension === "mp4"){ ?>
                                        <div><a href="index.php?action=displayVideo&link=<?php echo $ressource->getLink(); ?>"><img src="./public/Obligatory/icon_video.png" height="30px" width="30px"></a></div>
                                    <?php }else{ ?>
                                        <div class="template_BTN_dwl"><a href="public/Training/Ressource/<?php echo $ressource->getLink(); ?>"><img src="./public/Obligatory/icon_loupe.png" height="30px" width="30px"></a></div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
        </section>
    <?php }else { ?>
        <section>
            <h2 class="noco">Connectez et inscrivez-vous pour accéder aux ressources de la formation !</h2>
        </section>
    <?php } ?>
</body>

<?php
    $content=ob_get_clean();
    $titre = "Détails de la formations !";
    require "vue/template.view.php";
?>

