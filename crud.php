<?php
interface CRUD
{
    public function addMembres($matricule,$nom,$prenom,$tranche_age, $sexe, $situation_matrimoniale, $statut);
    public function readMembres();
    public function updateMembres($id,$nom,$prenom,$tranche_age, $sexe, $situation_matrimoniale, $statut);
    public function deleteMembres($id);
}
?>