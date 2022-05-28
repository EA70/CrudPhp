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
        die();
    }

//SUPRRESIONN 

     //on nettoie l'id envoyé
     $id = strip_tags($_GET['id']);

     $sql = 'DELETE FROM  `liste` WHERE `id` = :id ;' ;
 
     //on prépare la requete
     $query = $db->prepare($sql);
     
     // On acroche les paramètres (id)
     $query->bindValue(':id', $id, PDO::PARAM_INT);
 
     //On exécute la requete 
     $query->execute();
     $_SESSION['message'] = "Produit supprimé " ;
     header('Location: index.php');


} else {
    $_SESSION['erreur'] = "URL invalide" ;
    header('Location: index.php');
}

