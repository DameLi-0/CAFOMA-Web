<?php ob_start()?>
<?php var_dump($_SESSION); ?>
<head>
    <link rel="stylesheet" href="./css/accueil.style.css">
</head>
<body>
    <main>
        <section>
                <h2>Bienvenue sur notre site de formation en ligne</h2>
                <p>L’objectif de cafoma n’est pas de se former uniquement en ligne mais de mettre en œuvre une pédagogie inversée et, ainsi, de réserver l’accompagnement des professeurs à la mise en pratique et aux difficultés rencontrées. Notre plateforme a été conçue pour offrir une expérience d'apprentissage interactive et flexible, qui permet aux apprenants de prendre en charge leur propre processus d'apprentissage.</p>
                <p>Nous mettons l'accent sur l'accompagnement de votre formation par des professeurs expérimentés avec qui vous serez en relation toutes les semaines par des séances en présentielles ou en distancielles suivant vos besoins, afin de :</p>
                <ul>
                    <li>Personnaliser l'enseignement : adapter la formation à vos besoins individuels</li>
                    <li>Renforcer la motivation et la confiance : par un suivi étroit et une bienveillance</li>
                    <li>Créer un environnement d'apprentissage positif : fournir des conseils et des stratégies d'étude efficaces</li>
                    <li>Assurer une qualité de l'enseignement optimale : obtenir des explications claires et détaillées sur les sujets abordés</li>
                </ul>
                <a class="template_BTN" href="index.php?action=loginAccount" >Inscrivez-vous maintenant</a>
        </section>
        
        <section>
            <h2>Application Mobile</h2>
            <p>Grâce à l’application mobile que vous pouvez télécharger dans l'onglet "application android", cafoma offre aux apprenants la possibilité d'accéder aux formations en ligne à partir de leurs smartphones ou tablettes</p>
            <p>Notre approche pédagogique se base sur les dernières recherches en matière d'apprentissage et repose sur une combinaison de vidéos de cours, de modules interactifs, de forums de discussion et de séances de cours en présentielles. Les apprenants peuvent avancer à leur propre rythme, en fonction de leur propre niveau de compétence et de leur disponibilité</p>
            <p>Notre plateforme est facile à utiliser et accessible à tout moment, de n'importe où dans le monde, à condition d'avoir une connexion Internet. Les apprenants peuvent également échanger avec leurs pairs et l'enseignant via notre plateforme, pour discuter des questions de cours, des travaux à effectuer, des difficultés rencontrées ou des avancées réalisées</p>
            <p>Nous sommes convaincus que notre approche pédagogique inversée permettra aux apprenants d'acquérir de nouvelles compétences et de développer leur expertise dans leur domaine d'activité. Rejoignez-nous dès maintenant et commencez votre parcours de formation en toute confiance !</p>
        
        
        </section>

       

    </main>
</body>
<?php 
    $content=ob_get_clean();
    $titre = "StudentForm - Formation en ligne - Accueil";
    require 'template.view.php';
?>
