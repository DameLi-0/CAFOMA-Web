<?php ob_start()?>
    <head>
        <link rel="stylesheet" href="./css/listFormation.style.css" />
    </head>
    
    <body>

        <div class="video">
            <video width="600" height="420" controls preload auto>
                 <source src="public/Training/Ressource/<?= $ressource->getLink(); ?>">
            </video>
        </div>
    </body>
</html>

<?php
    $content=ob_get_clean();
    $titre = "Créer une séquence !";
    require "vue/template.view.php";
?>