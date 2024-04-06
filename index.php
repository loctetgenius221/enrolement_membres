<?php
// Inclure le fichier config
require_once "config.php";
//Inclure le fichier d'ajout pour insérer les Script qui permettent de récupérer les données des tables tranche_age et statut.
require_once "adddata.php";
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
        <div class="entete">
            <img src="images/pattedoie.jpg" width="80px" height="80px">
            <h1>Gestion des membres de la commune de Patte d'Oie</h1>
            <img src="images/pattedoie.jpg" width="80px" height="80px">
        </div>
        
        <!-- Formulaire d'ajout de membre -->
        <h2>Ajouter un nouveau membre</h2>
        <form action="adddata.php" method="POST">

            <label for="nom">Nom :</label><br>
            <input type="text" name="nom" id="nom" required><br>
            
            <label for="prenom">Prénom :</label><br>
            <input type="text" name="prenom" id="prenom" required><br>

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
                <label for="tranche_age">Tranche d'âge :</label><br>
                    <select name="tranche_age" id="tranche_age" required>
                        <option value="">Sélectionnez la tranche d'âge</option>
                    <!-- On utilisez PHP pour générer les options à partir des données de la table tranche_age -->
                    <?php
        
                        foreach ($liste_tranche_age as $tranche_age) {
                        echo "<option value=\"{$tranche_age['id']}\">{$tranche_age['libelle_tranche_age']}</option>";
                        }
                    ?>
                    </select><br>
                <label for="statut">Statut :</label><br>
                    <select name="statut" id="statut" required>
                        <option value="">Sélectionnez le statut</option>
                        <!-- On utilise PHP pour générer les options à partir des données de la table statut -->
                    <?php
                        foreach ($liste_statut as $statut) {
                        echo "<option value=\"{$statut['id']}\">{$statut['libelle_statut']}</option>";
                        }
                    ?>
                    </select><br>       
                    
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
                echo "<td>" . $membre['libelle_tranche_age'] . "</td>";
                echo "<td>" . $membre['sexe'] . "</td>";
                echo "<td>" . $membre['situation_matrimoniale'] . "</td>";
                echo "<td>" . $membre['libelle_statut'] . "</td>";
                echo "<td><span class='btnmodifier'><a href='update.php?id=" . $membre['id'] . "' >Modifier</a></span> | <span class='btnsupprimer'><a href='delete.php?id=" . $membre['id'] . "'>Supprimer</a></span></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </section>
    
</body>
</html>
