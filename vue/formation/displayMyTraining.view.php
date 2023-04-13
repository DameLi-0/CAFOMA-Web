<?php ob_start()?>

    <head>
        <link rel="stylesheet" href="./css/template.style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
    
    <table class="table table-striped">
        
      <thead>
        <tr>
            <th scope="col">ID_Formation</th>
            <th scope="col">ID_User</th>
            <th scope="col">Date d'inscription</th>
            <th scope="col">Action</th>
        </tr>
      </thead>
      
      
      <tbody>
          
        <?php if ($tabInscription > 0){ foreach($tabInscription as $inscription) {?>  
            <tr>
                <td><?php echo $inscription->getFk_formation_id(); ?></td>
                <td><?php echo $inscription->getFk_user_id(); ?></td>
                <td><?php echo $inscription->getDate(); ?></td>
                <td><a href="index.php?action=displayFormationMore&formation_id=<?= $inscription->getFk_formation_id(); ?>">Accèder</a></td>
            </tr>
        <?php } } else{ ?>
            <div>
                <h1>Tu est inscrit a aucune formation !</h1>
            </div>
        <?php } ?>
        
      </tbody>
      
    </table>

<?php
    $content=ob_get_clean();
    $titre = "My Training";
    require "vue/template.view.php";
?>