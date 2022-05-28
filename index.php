<?php

//On démarre une session 
session_start();

    require_once('connect.php');
    $sql = 'SELECT * FROM `liste`';
    //on prépare la requete
    $query = $db->prepare($sql) ;
    //on execute la requete
    $query->execute();
    //on stocke le resultat dans un tableau associatif
    $result  = $query->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);

    require_once('close.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php | CRUD</title>
    <link rel="stylesheet" href="./styles/bootstrap.min.css">
</head>
<body>


    <main class="container mb-5">
        <div class="row">
            <section class="col-md-12">
                <h1 class="text-center display-5 m-5">Liste produits</h1>

                <?php 
                    if (!empty($_SESSION['erreur'])) {

                        echo ' <div class="alert alert-danger">'. $_SESSION['erreur'] .'</div> ';
                        $_SESSION['erreur'] = "";
                        
                    }
                ?>
                <?php 
                    if (!empty($_SESSION['message'])) {

                        echo ' <div class="alert alert-success">'. $_SESSION['message'] .'</div> ';
                        $_SESSION['message'] = "";
                        
                    }
                ?>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Produit</th>
                        <th>Prix $ </th>
                        <th>Nombre</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        
                        <?php 
                            //On boucle le resultat
                            foreach ($result as $produit) { 
                                
                        ?>

                            
                            <tr>
                                <td> <?= $produit['id'] ?> </td>
                                <td> <?= $produit['produit'] ?> </td>
                                <td> <?= $produit['prix'] ?>  </td>
                                <td><?= $produit['nombre'] ?></td>
                                <td> <a class="btn btn-primary" href="details.php?id=<?= $produit['id']?>">Voir</a> <a class="btn btn-info" href="edit.php?id=<?= $produit['id']?>">Editer</a> <a class="btn btn-danger" href="delete.php?id=<?= $produit['id']?>">Supprimer</a> </td>
                            </tr>
                            
                        <?php 
                            }
                        ?>
                    </tbody>

                </table>

                <a href="add.php" class="btn btn-dark">Ajouter un produit</a>
            </section>
        </div>
    </main>

</body>
</html>