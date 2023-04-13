<?php ob_start()?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/accueil.style.css">
</head>

<?php var_dump($_SESSION); ?>



<main>
    <section>
            <h2>Bienvenue sur notre site de formation en ligne</h2>
            <p>Nous proposons une large sélection de cours en ligne pour vous aider à améliorer vos compétences et votre carrière professionnelle. Nos cours sont dispensés par des experts de l'industrie et couvrent une variété de domaines, allant de la programmation et du développement web au marketing digital et à la gestion de projet.</p>
            <a class="template_BTN" href="index.php?action=loginAccount" >Inscrivez-vous maintenant</a>
    </section>
    
    <section>
        <h3>Nos derniers cours</h3>
        <ul>
            <li class="accueil_li">Introduction au développement web</li>
            <li class="accueil_li">Marketing digital pour les débutants</li>
            <li class="accueil_li">Gestion de projet pour les PME</li>
        </ul>
        <a class="template_BTN" href='index.php?action=displayAllFormations' >Voir tous les cours</a>
    </section>
    
    <section>
        <h3>Pourquoi choisir notre site de formation en ligne ?</h3>
        
        <ul>
                <li class="accueil_li">Cours dispensés par des experts de l'industrie</li>
                <li class="accueil_li" >Large sélection de cours dans différents domaines</li>
                <li class="accueil_li">Flexibilité pour étudier quand et où vous le souhaitez</li>
                <li class="accueil_li">Prix abordables pour tous les budgets</li>
        </ul>
        
        <p>Inscrivez-vous dès maintenant pour commencer votre voyage de formation en ligne avec nous.</p>
        <a class="template_BTN" href="index.php?action=loginAccount" >Inscrivez-vous maintenant</a>
    </section>
    
</main>

<?php 
    $content=ob_get_clean();
    $titre = "StudentForm - Formation en ligne - Accueil";
    require 'template.view.php';
?>
