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
    $tranche_age = $_POST['tranche_age'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];
    $statut = $_POST['statut'];

    //Appel à la fonction updateMembre
    $membre->updateMembres($id,$nom,$prenom,$tranche_age,$sexe,$situation_matrimoniale,$statut);

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
        
        <!-- Formulaire d'ajout de membre -->
        <h2>Modifier un membre</h2>
                <?php
                    //requete sql pour selectionner les données de l'etudiant à partir de son id 

                    $sql = "SELECT * FROM membres WHERE id = :id";

                    //prepareation de la requete
                    $stmt=$connexion ->prepare($sql);

                    //liaison des valeurs aux parametre
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);


                    //execution de la requete
                    if($stmt->execute()){
                        //preparation du resultat
                        $membre=$stmt->fetch(PDO::FETCH_ASSOC);
                        //recuperation des donnés du membre
                        $id = $membre['id'];
                        // $matricule = $membre['matricule'];
                        $nom = $membre['nom'];
                        $prenom = $membre['prenom'];
                        $tranche_age = $membre['tranche_age'];
                        $sexe = $membre['sexe'];
                        $situation_matrimoniale = $membre['situation_matrimoniale'];
                        $statut = $membre['statut'];

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
            
            <label for="tranche_age">Tranche d'âge :</label>
            <input type="number" name="tranche_age" id="tranche_age" value="<?php echo $tranche_age?>"  required><br>
            
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
                <div class="options">
                    <label for="statut">Statut :</label>
                    <select name="statut" id="statut" required>
                        <option value="Chef de quartier" <?php if($statut == "Chef de quartier"){ echo "selected";}?>>Chef de quartier</option>
                        <option value="Civile" <?php if($statut == "Civile"){ echo "selected";}?>>Civile</option>
                        <option value="Badianou Ngokh" <?php if($statut == "Badianou Ngokh"){ echo "selected";}?>>Badianou Ngokh</option>
                        <!-- Ajoutez d'autres options si nécessaire -->
                    </select><br>
                </div>
            </div>        
            <input type="submit" name="submit" value="Modifier le membre">
        </form>
    </section>
    

</body>
</html>