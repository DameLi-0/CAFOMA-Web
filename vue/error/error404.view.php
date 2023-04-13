<?php ob_start()?>

<html>
    <head>
        <link rel="stylesheet" href="./css/error.style.css" />
    </head>
    
    <body>
        <div class="noise"></div>
        <div class="overlay"></div>
        <div class="terminal">
            <h1>Error <span class="errorcode">404</span></h1>
            <p class="output">The page you are looking for might have been removed, had its name changed or is temporarily unavailable.</p>
            <p class="output">Please try to <a href="index.php">return to the homepage</a>.</p>
            <p class="output">Good luck.</p>
        </div>
    </body>
</html>

<?php
    $content=ob_get_clean();
    $titre = "ERROR 404";
?>