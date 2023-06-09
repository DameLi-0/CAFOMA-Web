<?php ob_start()?>

    <head>
          <link rel="stylesheet" href="./css/table.style.css" />
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
                        <th scope="col">Login</th>
                        <th scope="col">MDP</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Image</th>
                        <th scope="col">Role</th>
                        <th scope="col">Valid</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>


              <tbody>

                <?php if ($tabUsers > 0){ foreach($tabUsers as $user) {?>  
                    <tr>
                        <td><?php echo $user->getUser_id(); ?></td>
                        <td><?php echo $user->getLogin(); ?></td>
                        <td><?php echo $user->getMdp(); ?></td>
                        <td><?php echo $user->getEmail(); ?></td>
                        <td><?php echo $user->getImg(); ?></td>
                        <td><?php echo $user->getRole(); ?></td>
                        <td><?php echo $user->getValid(); ?></td>
                        <td><a href="index.php?action=editUser&id=<?= $user->getUser_id(); ?>"><img src="./public/Obligatory/icon_edit.png" width="32px" height="32px"></a>
                            <a href="index.php?action=deleteUser&id=<?= $user->getUser_id(); ?>"><img src="./public/Obligatory/icon_trash.png" width="32px" height="32px"></a></td>
                    </tr>
                <?php } } else{ ?>
                    <div>
                        <h1>Il n'y a pas d'utilisateur</h1>
                    </div>
                <?php } ?>

              </tbody>

            </table>
        </section>
        
    </body>    

<?php
    $content=ob_get_clean();
    $titre = "Administration - User";
    require "vue/template.view.php";
?>