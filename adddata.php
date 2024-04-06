<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//inclusion du fichier de connexion
require_once "config.php"; 

// Script pour récupérer les données de la table statut
$sql_statut = "SELECT id, libelle_statut FROM statut";
$stmt_statut = $connexion->query($sql_statut);
$liste_statut = $stmt_statut->fetchAll(PDO::FETCH_ASSOC);

// Script pour récupérer les données de la table tranche_age
$sql_tranche_age = "SELECT id, libelle_tranche_age FROM tranche_age";
$stmt_tranche_age = $connexion->query($sql_tranche_age);
$liste_tranche_age = $stmt_tranche_age->fetchAll(PDO::FETCH_ASSOC);

//verifier si le formulaire a été soumis
if(isset($_POST['submit'])){

    //recuperation des données
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];

    // Récupération des valeurs sélectionnées du statut et de la tranche d'âge
    $id_tranche_age = $_POST['tranche_age'];
    $id_statut = $_POST['statut'];

    //verifier si les champs ne sont pas vide 
    if($nom !="" && $prenom !="" && $id_tranche_age !="" && $sexe !="" && $situation_matrimoniale !="" && $id_statut !=""){
        //appel de la methode 
        $membre->addMembres($nom, $prenom, $sexe, $situation_matrimoniale, $id_tranche_age, $id_statut);
    }
}
?>