<?php
require_once "crud.php";

//création de la class Membres
class Membres implements CRUD
{
    //Proprietés privées
    private $connexion;
    private $matricule;
    private $nom;
    private $prenom;
    private $tranche_age;
    private $sexe;
    private $situation_matrimoniale;
    private $statut;


    //creation de la methode construct
    public function __construct($connexion,$matricule,$nom,$prenom,$tranche_age,$sexe,$situation_matrimoniale,$statut)
    {
        $this->connexion=$connexion;
        $this->matricule=$matricule;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->tranche_age=$tranche_age;
        $this->sexe=$sexe;
        $this->situation_matrimoniale=$situation_matrimoniale;
        $this->statut=$statut;

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

    public function  getTranche_age()
    {
        return $this->tranche_age;
    }
    public function setTranche_age($nouveauTranche_age)
    {
        $this->tranche_age=$nouveauTranche_age;
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

    public function  getStatut()
    {
        return $this->statut;
    }
    public function setStatut($nouveauStatut)
    {
        $this->statut=$nouveauStatut;
    }


    //Methode pour ajouter des membres
    public function addMembres($matricule,$nom,$prenom,$tranche_age,$sexe,$situation_matrimoniale,$statut)
    {
        
        try {
            //requete pour inserer
            $sql= "INSERT INTO membres(matricule,nom,prenom,tranche_age,sexe,situation_matrimoniale,statut) VALUES(:matricule,:nom,:prenom,:tranche_age,:sexe,:situation_matrimoniale,:statut)";
    
               
            //preparation de la requete
            $stmt=$this->connexion->prepare($sql);
    
            //faire la liaison des valeurs aux paramètres
            $stmt->bindParam(':matricule',$matricule, PDO::PARAM_INT);
            $stmt->bindParam(':nom',$nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom',$prenom, PDO::PARAM_STR);
            $stmt->bindParam(':tranche_age',$tranche_age, PDO::PARAM_INT);
            $stmt->bindParam(':sexe',$sexe, PDO::PARAM_STR);
            $stmt->bindParam(':situation_matrimoniale',$situation_matrimoniale, PDO::PARAM_STR);
            $stmt->bindParam(':statut',$statut, PDO::PARAM_STR);
    
            //execute la requete
    
            $stmt->execute();
    
            //rediriger la page 
            header("location: index.php");
            exit();
    
    
        } catch (PDOException $e) {
            die("erreur: impossible d'inserer des données" .$e->getMessage());
        }
    }

    //Methode pour afficher les élèves
    public function readMembres()
    {
        try {
            //requete sql pour selectionner tout les élèves
            $sql="SELECT * FROM membres";

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
    public function updateMembres($id,$nom,$prenom,$tranche_age,$sexe,$situation_matrimoniale,$statut)
    {
        try{

            //J'écris la requete qui va me permettre de modifier un membre
            $sql = "UPDATE membres SET nom=:nom, prenom=:prenom, tranche_age=:tranche_age, sexe=:sexe, situation_matrimoniale=:situation_matrimoniale, statut=:statut WHERE id=:id";

            //Je prépare la requete
            $stmt=$this->connexion->prepare($sql);

            //Je lis les valeurs aux paramètres
            $stmt->bindParam(':nom',$nom);
            $stmt->bindParam(':prenom',$prenom);
            $stmt->bindParam(':tranche_age',$tranche_age);
            $stmt->bindParam(':sexe',$sexe);
            $stmt->bindParam(':situation_matrimoniale',$situation_matrimoniale);
            $stmt->bindParam(':statut',$statut);
            $stmt->bindParam(':id',$id);


            //J'execute la requete
            $stmt->execute();

            //Si la modification passe
            return true;

            //Je fait une redirection vers la page index
            header('location: index.php');
            exit;

        } catch(PDOException $e) {
            die("Erreur : Impossible de modifier le membre" .$e->getMessage());
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