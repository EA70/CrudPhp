<?php
//On démarre une session 
session_start();



if (isset($_GET['id']) && !empty($_GET['id']) ) {
    require_once('connect.php');

    //on nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM  `liste` WHERE `id` = :id ;' ;

    //on prépare la requete
    $query = $db->prepare($sql);
    
    // On acroche les paramètres (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    //On exécute la requete 
    $query->execute();


    //On récupere le produit
    $produit = $query->fetch();

    //on verifie l'existence du produit
    if(!$produit) {
        $_SESSION['erreur'] = "Cet id n'existe pas ! " ;
        header('Location: index.php');
    }

} else {
    $_SESSION['erreur'] = "URL invalide" ;
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du Produit</title>
    <link rel="stylesheet" href="./styles/bootstrap.min.css">
</head>
<body>

    <main class="container">
        <div class="row">
            <section class="col-md-6 mx-auto">
                <h1 class="text-center mt-5 mb-5 display-5 lead ">Détails du produit : <?= $produit['produit'] ?> </h1>
                <ul>
                    <li>ID : <?= $produit['id'] ?></li>
                    <li>Produit : <?= $produit['produit'] ?></li>
                    <li>Prix : <?= $produit['prix'] ?></li>
                    <li>Nombre : <?= $produit['nombre'] ?></li>
                </ul>

                <div>
                    <a href="index.php" class="btn btn-dark">Retour</a>
                    <a href="edit.php?id=<?= $produit['id'] ?> " class="btn btn-info">Editer</a>
                    <a href="delete.php?id=<?= $produit['id'] ?> " class="btn btn-danger">Supprimer</a>
                </div>

            </section>
        </div>
    </main>
    
</body>
</html>