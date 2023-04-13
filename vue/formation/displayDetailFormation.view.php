<?php ob_start()?>

<head>
  <link rel="stylesheet" href="./css/detailFormation.style.css">
</head>

<body>
	<section id="introduction">
        <div>
           <iframe width="500" height="320" src="<?= $formation->getIntro(); ?>"> </iframe>
        </div>
        <div class="text_intro">
             <img src="public/PPformation/<?= $formation->getImg(); ?>" alt="Description de l'image" height="260px" width="260px">
            <h1><?=  $formation->getLibelle(); ?></h1>
            <h2><?= $formation->getAcronyme(); ?></h2>
            <p><?= $formation->getDescription(); ?></p>
            <a class="template_BTN" href="index.php?action=addTraining&id=<?php echo $formation->getFormation_id(); ?>">M'inscrire</a>
        </div>

    </section>

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
                                <p><?= $sequence->getDescription(); ?></p>
                                <p></p>
                            </div>
                        <?php } ?>
	</section>
</body>

<?php
    $content=ob_get_clean();
    $titre = "Détails de la formations !";
    require "vue/template.view.php";
?>
