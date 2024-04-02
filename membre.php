<?php
require_once "crud.php";

//création de la class Student
class Membres implements crud
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


    //Methode pour ajouter des élèves
    public function addMembres($matricule,$nom,$prenom,$tranche_age,$sexe,$situation_matrimoniale,$statut)
    {
       
    }

    //Methode pour afficher les élèves
    public function readMembres()
    {
       
    }

    //Methode pour modifier les élèves
    public function updateMembres($id,$matricule,$nom,$prenom,$tranche_age,$sexe,$situation_matrimoniale,$statut)
    {
        
    }

    //methode pour supprimer les élèves
    public function deleteMembres($id)
    {
   
    }

    
}