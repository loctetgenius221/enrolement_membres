<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//inclusion du fichier de connexion
require_once "config.php"; 
// Vérifier si un identifiant a été fourni et si l'idention est un nombre
if (isset($_GET['id'])){
    $id = $_GET['id'];
    // Appeler la méthode de suppression avec l'identifiant fourni
    $membre->deleteMembres($id);
}
?>