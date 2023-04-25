<?php ob_start()?>

    <head>
        <link rel="stylesheet" href="./css/template.style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <h2 style="text-align: center; margin-top: 6rem">Liste des utilisateurs</h2>
        <section class="section_tab">
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Fk_user_id</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>


              <tbody>

                <?php foreach($tabInscription as $inscription) {?>  
                    <tr>
                        <td><?php echo $inscription->getFk_formation_id(); ?></td>
                        <td><?php echo $inscription->getFk_user_id(); ?></td>
                        <td><?php echo $inscription->getDate(); ?></td>
                        <td><a href="index.php?action=unsubscribe&id=<?= $inscription->getFk_user_id(); ?>"><img src="./public/Obligatory/icon_croix.png" width="32px" height="32px"></a></td>
                    </tr>
                <?php }?>

              </tbody>

            </table>
        </section>
        
    </body>    

<?php
    $content=ob_get_clean();
    $titre = "Administration - User";
    require "vue/template.view.php";
?>