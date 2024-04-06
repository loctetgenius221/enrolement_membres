<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "crud.php";

//création de la class Membres
class Membres implements CRUD
{
    //Proprietés privées
    private $connexion;
    private $matricule;
    private $nom;
    private $prenom;
    private $sexe;
    private $situation_matrimoniale;
    private $id_tranche_age;
    private $id_statut;


    //creation de la methode construct
    public function __construct($connexion,$matricule,$nom,$prenom,$sexe,$situation_matrimoniale,$id_tranche_age,$id_statut)
    {
        $this->connexion=$connexion;
        $this->matricule=$matricule;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->sexe=$sexe;
        $this->situation_matrimoniale=$situation_matrimoniale;
        $this->id_tranche_age=$id_tranche_age;
        $this->id_statut=$id_statut;

    }

    //les methodes getters et setters
    public function  getMatricule()
    {
        return $this->matricule;
    }
    public function setMatricule($nouveauMatricule)
    {
        $this->matricule=$nouveauMatricule;
    }

    public function  getNom()
    {
        return $this->nom;
    }
    public function setNom($nouveauNom)
    {
        $this->nom=$nouveauNom;

    }

    public function  getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($nouveauPrenom)
    {
        $this->prenom=$nouveauPrenom;
    }

    public function  getSexe()
    {
        return $this->sexe;
    }
    public function setSexe($nouveauSexe)
    {
        $this->sexe=$nouveauSexe;
    }

    public function  getSituation_matrimoniale()
    {
        return $this->situation_matrimoniale;
    }
    public function setSituation_matrimoniale($nouveauSituation_matrimoniale)
    {
        $this->situation_matrimoniale=$nouveauSituation_matrimoniale;
    }
    public function  getTranche_age()
    {
        return $this->id_tranche_age;
    }
    public function setTranche_age($nouveauTranche_age)
    {
        $this->id_tranche_age=$nouveauTranche_age;
    }


    public function  getStatut()
    {
        return $this->id_statut;
    }
    public function setStatut($nouveauStatut)
    {
        $this->id_statut=$nouveauStatut;
    }

    //Methode pour ajouter des membres
    public function addMembres($nom,$prenom,$sexe,$situation_matrimoniale,$id_tranche_age,$id_statut)
    {
        
        try {
            // Procédure pour générer de façon automatique les matricule et commençant par PO

            // Récupérer le dernier identifiant inséré dans la table membres
            $sql = "SELECT MAX(id) AS last_id FROM membres";
            $result = $this->connexion->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $last_id = $row['last_id'];
    
            // Incrémenter l'identifiant pour obtenir le prochain numéro de matricule
            $next_id = $last_id + 1;
    
            // Formater le numéro de matricule
            $matricule = 'PO_' . str_pad($next_id, 3, '0', STR_PAD_LEFT);
            //requete pour inserer
            $sql= "INSERT INTO membres(matricule,nom,prenom,sexe,situation_matrimoniale,id_tranche_age,id_statut) VALUES(:matricule,:nom,:prenom,:sexe,:situation_matrimoniale,:tranche_age,:statut)";
    
               
            //preparation de la requete
            $stmt=$this->connexion->prepare($sql);
    
            //faire la liaison des valeurs aux paramètres
            $stmt->bindParam(':matricule',$matricule, PDO::PARAM_STR);
            $stmt->bindParam(':nom',$nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom',$prenom, PDO::PARAM_STR);
            $stmt->bindParam(':sexe',$sexe, PDO::PARAM_STR);
            $stmt->bindParam(':situation_matrimoniale',$situation_matrimoniale, PDO::PARAM_STR);
            $stmt->bindParam(':tranche_age',$id_tranche_age, PDO::PARAM_INT);
            $stmt->bindParam(':statut',$id_statut, PDO::PARAM_INT);
    
            //execute la requete
    
            $stmt->execute();
    
            //rediriger la page 
            header("location: index.php");
            exit();
    
    
        } catch (PDOException $e) {
            die("erreur: impossible d'inserer des données" .$e->getMessage());
        }
    }

    //Methode pour afficher les membres
    public function readMembres()
    {
        try {
            //requete sql pour selectionner tout les membres
            $sql="SELECT  m.*, t.libelle_tranche_age, s.libelle_statut FROM membres m 
            LEFT JOIN tranche_age t ON m.id_tranche_age = t.id 
            LEFT JOIN statut s ON m.id_statut = s.id";

            //preparation de la requete
            $stmt=$this->connexion->prepare($sql);

            //exécution de la requete
            $stmt->execute();

            //recuperation des resultats
            $resultats=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultats;
        } 
        catch (PDOException $e) {
            die("erreur:Impossible d'afficher les membres" .$e->getMessage());
        }
    }

    //Methode pour modifier les membres
    public function updateMembres($id,$nom,$prenom,$sexe,$situation_matrimoniale,$id_tranche_age,$id_statut)
    {
        try{

            //J'écris la requete qui va me permettre de modifier un membre
            $sql = "UPDATE membres SET nom=:nom, prenom=:prenom, id_tranche_age=:tranche_age, sexe=:sexe, situation_matrimoniale=:situation_matrimoniale, id_statut=:statut WHERE id=:id";

            //Préparation de la requete
            $stmt=$this->connexion->prepare($sql);

            //Liaison des valeurs aux paramètres
            $stmt->bindParam(':nom',$nom);
            $stmt->bindParam(':prenom',$prenom);
            $stmt->bindParam(':sexe',$sexe);
            $stmt->bindParam(':situation_matrimoniale',$situation_matrimoniale);
            $stmt->bindParam(':tranche_age',$id_tranche_age);
            $stmt->bindParam(':statut',$id_statut);
            $stmt->bindParam(':id',$id);


            //J'execute la requete
            $stmt->execute();

            //Si la modification passe
            return true;

            //Je fait une redirection vers la page index
            header('location: index.php');
            exit;

        } catch(PDOException $e) {
            die("Erreur : Impossible de modifier les informations du membre" .$e->getMessage());
        }
    }

    //methode pour supprimer les membres
    public function deleteMembres($id)
    {
        try{
            // Préparez votre requête de suppression
            $sql = "DELETE  FROM membres WHERE id = :id";

            //Préparer la requête
            $stmt = $this->connexion->prepare($sql);

            //Faire la liaison des valeurs aux paramètres
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Exécutez la requête
            $stmt->execute();

            //rediriger la page 
            header("location: index.php");
            exit();
        } catch (PDOException $e){
            die("Identifiant invalide" .$e->getMessage());
        }
    }
}