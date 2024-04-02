<?php
require_once "membre.php";

//Définition des constances pour les infos de la base de données
define('DB_SERVEUR','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','Patte_Doie');

//Connexion à la base de donnée en utilisant PDO
try{
    $connexion = new PDO("mysql:host=".DB_SERVEUR.";dbname=".DB_NAME,DB_USERNAME,DB_PASSWORD);
    $membre = new Membres($connexion, 99, "Sarr","Fatou", 25, "Féminin", "Marié", "Civile");
    //Appel de la méthode d'affichage
    $resultats= $membre->readMembres();

}
catch(PDOException $e){
    // Affichage d'un message d'erreur et arreter le script soi la connexion echoue
    die("erreur::impossible de se connecter à la base de donnée" .$e->getMessage());
}
?>