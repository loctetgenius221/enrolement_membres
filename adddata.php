<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//inclusion du fichier de connexion
require_once "config.php"; 
//verifier si le formulaire a été soumis
if(isset($_POST['submit'])){

    // var_dump($_POST);
    //recuperation des données
    $matricule= $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tranche_age= $_POST['tranche_age'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];
    $statut = $_POST['statut'];

    //verifier si les champs ne sont pas vide 
    if($matricule !="" && $nom !="" && $prenom !="" && $tranche_age !="" && $sexe !="" && $situation_matrimoniale !="" && $statut !=""){
        //appel de la methode 
        $membre->addMembres($matricule, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut);
    }
}
?>