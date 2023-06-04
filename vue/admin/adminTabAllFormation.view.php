<?php ob_start()?>

    <head>
          <link rel="stylesheet" href="./css/table.style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <h2 style="text-align: center; margin-top: 6rem">Liste des formations</h2>
        <section class="section_tab">
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">addBy</th>
                        <th scope="col">Libelle</th>
                        <th scope="col">Acronyme</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Vidéo</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>


              <tbody>

                <?php foreach($tabFormations as $formation) {?>  
                    <tr>
                        <td><?php echo $formation->getFormation_id(); ?></td>
                        <td><?php echo $formation->getFk_user_id(); ?></td>
                        <td><?php echo $formation->getLibelle(); ?></td>
                        <td><?php echo $formation->getAcronyme(); ?></td>
                        <td><?php echo $formation->getDescription(); ?></td>
                        <td><?php echo $formation->getImg(); ?></td>
                        <td><?php echo $formation->getVideo(); ?></td>
                        <td><!--<a href="index.php?action=editFormation&formation_id=<?php //$formation->getFormation_id(); ?>"><img src="./public/Obligatory/icon_edit.png" width="32px" height="32px"></a>-->
                            <a href="index.php?action=deleteFormationAdmin&formation_id=<?= $formation->getFormation_id(); ?>"><img src="./public/Obligatory/icon_trash.png" width="32px" height="32px"></a></td>
                    </tr>
                <?php } ?>

              </tbody>

            </table>
        </section>
        
    </body>    

<?php
    $content=ob_get_clean();
    $titre = "Administration - Training";
    require "vue/template.view.php";
?>