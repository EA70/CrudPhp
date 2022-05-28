<?php 

try {
    //connexion à la base de données
    $db = new PDO ('mysql:host=localhost; dbname=crud', 'root', '');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $error) {
    echo 'Cause Erreur : ' .$error->getMessage();
    die () ; //Arret de l'éxecution du code
}
