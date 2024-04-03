<?php
//inclusion du fichier de connexion
require_once "config.php"; 
//verifier si le formulaire a été soumis
if(isset($_POST['submit'])){
    //recuperation des données
    $matricule= $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tranche_age= $_POST['tranche_age'];
    $sexe = $_POST['sexe'];
    $siuation_matrimoniale = $_POST['siuation_matrimoniale'];
    $statut = $_POST['statut'];

    //verifier si les champs ne sont pas vide 
    if($matricule !="" && $nom !="" && $prenom !="" && $tranche_age !="" && $sexe !="" && $situation_matrimoniale !="" && $statut !=""){
        //appel de la methode 
        $resultats->addMembres($matricule, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut);
    }
}
?>