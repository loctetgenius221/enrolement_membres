<?php
// Inclure le fichier contenant la classe Member
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des membres de la commune</title>
</head>
<body>
    <h1>Gestion des membres de la commune de Patte d'Oie</h1>
    
    <!-- Formulaire d'ajout de membre -->
    <h2>Ajouter un nouveau membre</h2>
    <form action="adddata.php" method="post">
        <label for="matricule">Matricule :</label>
        <input type="text" name="matricule" id="matricule" required><br>
        
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required><br>
        
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required><br>
        
        <label for="tranche_age">Tranche d'âge :</label>
        <input type="text" name="tranche_age" id="tranche_age" required><br>
        
        <label for="sexe">Sexe :</label>
        <input type="text" name="sexe" id="sexe" required><br>
        
        <label for="situation_matrimoniale">Situation matrimoniale :</label>
        <input type="text" name="situation_matrimoniale" id="situation_matrimoniale" required><br>
        
        <label for="statut">Statut :</label>
        <input type="text" name="statut" id="statut" required><br>
        
        <input type="submit" name="submit" value="Ajouter le membre">
    </form>
    
    <!-- Afficher les membres de la commune -->
    <h2>Liste des membres</h2>
    <table border="1">
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Tranche d'âge</th>
            <th>Sexe</th>
            <th>Situation matrimoniale</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        <?php
        // Récupérer et afficher les membres de la commune
        
        foreach ($resultats as $membres) {
            echo "<tr>";
            echo "<td>" . $membres['matricule'] . "</td>";
            echo "<td>" . $membres['nom'] . "</td>";
            echo "<td>" . $membres['prenom'] . "</td>";
            echo "<td>" . $membres['tranche_age'] . "</td>";
            echo "<td>" . $membres['sexe'] . "</td>";
            echo "<td>" . $membres['situation_matrimoniale'] . "</td>";
            echo "<td>" . $membres['statut'] . "</td>";
            echo "<td><a href='update.php?id=" . $membres['id'] . "'>Modifier</a> | <a href='delete.php?id=" . $membres['id'] . "'>Supprimer</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
