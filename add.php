<?php

//On démarre une session 
session_start();


    if ($_POST) {
        if (
            isset($_POST['produit']) && !empty($_POST['produit'])
            && isset($_POST['prix']) && !empty($_POST['prix'])
            && isset($_POST['nombre']) && !empty($_POST['nombre'])

        ) {
            //Connexion à la base de données
            require_once('connect.php');
            

            // on nettoie les données envoyées
            $produit = strip_tags($_POST['produit']);
            $prix = strip_tags($_POST['prix']);
            $nombre = strip_tags($_POST['nombre']);


            $sql = 'INSERT INTO `liste` (`produit`, `prix`, `nombre`) VALUES (:produit, :prix, :nombre);';
        
            $query=$db->prepare($sql);

            $query->bindValue(':produit', $produit, PDO::PARAM_STR);
            $query->bindValue(':prix', $prix, PDO::PARAM_STR);
            $query->bindValue(':nombre', $nombre, PDO::PARAM_INT);

            $query->execute() ;


            $_SESSION['message'] = "Produit ajouté ! " ;
            require_once('close.php');


            header('Location: index.php');



        }else {
            $_SESSION['erreur'] = "Le formulaire est incomplet";
        }
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="./styles/bootstrap.min.css">
</head>
<body>


    <main class="container">
        <h1 class="text-center display-5 m-5">Ajouter un produit</h1>
        <div class="row">
            <section class="col-md-6 mx-auto">

                <?php 
                    if (!empty($_SESSION['erreur'])) {

                        echo ' <div class="alert alert-danger">'. $_SESSION['erreur'] .'</div> ';
                        $_SESSION['erreur'] = "";
                        
                    }
                ?>

                <form method="post">
                    <div class="form-group mb-3">
                        <label for="produit" class="form-label">Produit</label>
                        <input type="text" id="produit" class="form-control" name="produit">
                    </div>
                    <div class="form-group mb-3">
                        <label for="prix" class="form-label">Prix</label>
                        <input type="text" id="prix" class="form-control" name="prix">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="number" id="nombre" class="form-control" name="nombre">
                    </div>

                    <div>
                        <button class="btn btn-success">Envoyer</button>
                        <a class="btn btn-dark" href="index.php">Annuler</a>
                    </div>

                </form>

            </section>
        </div>
    </main>

</body>
</html>