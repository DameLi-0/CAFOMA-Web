<?php ob_start()?>
    <head>
        <link rel="stylesheet" href="./css/template.style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
    
    <table class="table table-striped">
        
      <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Add By</th>
            <th scope="col">Libelle</th>
            <th scope="col">Acronyme</th>
            <th scope="col">Description</th>
            <th scope="col">Img</th>
            <th scope="col">Intro</th>
            <th scope="col">Action</th>
        </tr>
      </thead>
      
      
      <tbody>
          
        <?php if ($tabFormations > 0){ foreach($tabFormations as $formation) {?>  
            <tr>
                <td><?php echo $formation->getFormation_id(); ?></td>
                <td><?php echo $formation->getFk_user_id(); ?></td>
                <td><?php echo $formation->getLibelle(); ?></td>
                <td><?php echo $formation->getAcronyme(); ?></td>
                <td><?php echo $formation->getDescription(); ?></td>
                <td><?php echo $formation->getImg(); ?></td>
                <td><?php echo $formation->getIntro(); ?></td>
                <td><a href="index.php?action=createSequence&formation_id=<?= $formation->getFormation_id(); ?>">Séquence</a></td>
            </tr>
        <?php } } else{ ?>
            <div>
                <h1>Il n'y a pas de formation</h1>
            </div>
        <?php } ?>
        
      </tbody>
      
    </table>


<?php
    $content=ob_get_clean();
    $titre = "Administration - Formation";
    require "vue/template.view.php";
?>