<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

//On vérifie dabord que le formulaire est soumis
if(isset($_POST['submit'])) {

    //On recupère les valeurs dans des variables
    $id = $_GET['id'];

    // $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];

    // Récupérer les valeurs sélectionnées du statut et de la tranche d'âge
    $id_statut = $_POST['statut'];
    $id_tranche_age = $_POST['tranche_age'];

    //Appel à la fonction updateMembre
    $membre->updateMembres($id,$nom,$prenom,$sexe,$situation_matrimoniale,$id_tranche_age,$id_statut);

    //On fait une redirection vers index.php
    header('location: index.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un membre</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <section class="ajout">
        <h1>Gestion des membres de la commune de Patte d'Oie</h1>
        
        <!-- Formulaire pour modifier les information d'un membre -->
        <h2>Modifier un membre</h2>
                <?php
                    //requete sql pour selectionner les données d'un membre à partir de son id 

                    $sql = "SELECT * FROM membres WHERE id = :id";

                    //prepareation de la requete
                    $stmt=$connexion ->prepare($sql);

                    //liaison des valeurs aux parametre
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);


                    //execution de la requete
                    if($stmt->execute()){
                        //preparation du resultat
                        $membre=$stmt->fetch(PDO::FETCH_ASSOC);
                        //recuperation des données du membre
                        $id = $membre['id'];
                        $nom = $membre['nom'];
                        $prenom = $membre['prenom'];
                        $tranche_age = $membre['id_tranche_age'];
                        $sexe = $membre['sexe'];
                        $situation_matrimoniale = $membre['situation_matrimoniale'];
                        $statut = $membre['id_statut'];

                    }else{
                        echo"Erreur lors de la recuperation des données";
                    }
        ?>

        <span class="btnretour">
            <a href="index.php">Retour</a>
        </span>
        <form action="update.php?id=<?php echo $id;?>" method="POST">
            
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?php echo $nom?>"  required><br>
            
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" value="<?php echo $prenom?>"  required><br>
            
            <div class="les-options">
                <div class="options">
                    <label for="sexe">Sexe :</label>
                    <select name="sexe" id="sexe" required>
                        <option value="Masculin" <?php if($sexe == "Masculin"){ echo "selected";}?>>Masculin</option>
                        <option value="Féminin" <?php if($sexe == "Féminin"){ echo "selected";}?>>Féminin</option>
                    </select><br> 
                </div>       
                <div class="options">
                    <label for="situation_matrimoniale">Situation matrimoniale :</label>
                    <select name="situation_matrimoniale" id="situation_matrimoniale" required>
                        <option value="Célibataire" <?php if($situation_matrimoniale == "Célibataire"){ echo "selected";}?>>Célibataire</option>
                        <option value="Marié(e)"  <?php if($situation_matrimoniale == "Marié(e)"){ echo "selected";}?>>Marié(e)</option>
                        <option value="Divorcé"  <?php if($situation_matrimoniale == "Divorcé"){ echo "selected";}?>>Divorcé</option>
                        <option value="Veuf(ve)"  <?php if($situation_matrimoniale == "Veuf(ve)"){ echo "selected";}?>>Veuf(ve)</option>
                    </select><br>
                </div>        
            </div>  
            </select><br>  
         <label for="tranche_age">Tranche d'âge :</label><br>
            <select name="tranche_age" id="tranche_age" required>
            <option value="">Sélectionnez la tranche d'âge</option>
        <?php
        // Script pour récupérer les données de la table tranche_age
            $sql_tranche_age = "SELECT id, libelle_tranche_age FROM tranche_age";
            $stmt_tranche_age = $connexion->query($sql_tranche_age);
            $liste_tranche_age = $stmt_tranche_age->fetchAll(PDO::FETCH_ASSOC);
            //générer les options à partir des données de la table tranche_age
            foreach ($liste_tranche_age as $tranche_age) {
            echo "<option value=\"{$tranche_age['id']}\">{$tranche_age['libelle_tranche_age']}</option>";
            }
        ?>
        </select><br> 

    <label for="statut">Statut :</label><br>
        <select name="statut" id="statut" required>
            <option value="">Sélectionnez le statut</option>
        <?php
        // Script pour récupérer les données de la table statut
        $sql_statut = "SELECT id, libelle_statut FROM statut";
        $stmt_statut = $connexion->query($sql_statut);
        $liste_statut = $stmt_statut->fetchAll(PDO::FETCH_ASSOC);
        //générer les options à partir des données de la table statut 
        foreach ($liste_statut as $statut) {
            echo "<option value=\"{$statut['id']}\">{$statut['libelle_statut']}</option>";
        }
        ?>
    </select><br>    

            <input type="submit" name="submit" value="Modifier le membre">
        </form>
    </section>
    

</body>
</html>