<?php

//Définition des constances pour les infos de la base de données
define('DB_SERVEUR','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','Patte_Doie');

//Connexion à la base de donnée en utilisant PDO
try{
    $conn = new PDO("mysql:host=".DB_SERVEUR.";dbname=".DB_NAME,DB_USERNAME,DB_PASSWORD);
    //echo "connexion reussie";
}
catch(PDOException $e){
    // Affichage d'un message d'erreur et arreter le script soi la connexion echoue
    die("erreur::impossible de se connecter à la base de donnée" .$e->getMessage());
}
?>