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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="ajout">
        <h1>Gestion des membres de la commune de Patte d'Oie</h1>
        
        <!-- Formulaire d'ajout de membre -->
        <h2>Ajouter un nouveau membre</h2>
        <form action="adddata.php" method="POST">
            <label for="matricule">Matricule :</label> <br>
            <input type="number" name="matricule" id="matricule" required><br>
            
            <label for="nom">Nom :</label><br>
            <input type="text" name="nom" id="nom" required><br>
            
            <label for="prenom">Prénom :</label><br>
            <input type="text" name="prenom" id="prenom" required><br>
            
            <label for="tranche_age">Tranche d'âge :</label><br>
            <input type="number" name="tranche_age" id="tranche_age" required><br>
            <div class="les-options">

                <div class="options">
                    <label for="sexe">Sexe :</label><br>
                    <select name="sexe" id="sexe" required>
                        <option value="Masculin">Masculin</option>
                        <option value="Féminin">Féminin</option>
                    </select><br> 
                </div>       
                <div class="options">
                <label for="situation_matrimoniale">Situation matrimoniale :</label><br>
                    <select name="situation_matrimoniale" id="situation_matrimoniale" required>
                        <option value="Célibataire">Célibataire</option>
                        <option value="Marié(e)">Marié(e)</option>
                        <option value="Divorcé">Divorcé</option>
                        <option value="Veuf(ve)">Veuf(ve)</option>
                    </select><br>
                    </div>        
                <div class="options">
                <label for="statut">Statut :</label><br>
                    <select name="statut" id="statut" required>
                        <option value="Chef de quartier">Chef de quartier</option>
                        <option value="Civile">Civile</option>
                        <option value="Badianou Ngokh">Badianou Ngokh</option>
                        <!-- Ajoutez d'autres options si nécessaire -->
                    </select><br>
                </div>        
            </div>
            <input type="submit" name="submit" value="Ajouter le membre">

        </form>
    </section>

    
    <section class="liste">
        <!-- Afficher les membres de la commune -->
        <h2>Liste des membres</h2>
        <table>
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
            
            foreach ($resultats as $membre) {
                echo "<tr>";
                echo "<td>" . $membre['matricule'] . "</td>";
                echo "<td>" . $membre['nom'] . "</td>";
                echo "<td>" . $membre['prenom'] . "</td>";
                echo "<td>" . $membre['tranche_age'] . "</td>";
                echo "<td>" . $membre['sexe'] . "</td>";
                echo "<td>" . $membre['situation_matrimoniale'] . "</td>";
                echo "<td>" . $membre['statut'] . "</td>";
                echo "<td><span class='btnmodifier'><a href='update.php?id=" . $membre['id'] . "' >Modifier</a></span> | <span class='btnsupprimer'><a href='delete.php?id=" . $membre['id'] . "'>Supprimer</a></span></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </section>
    
</body>
</html>
