<?php
interface CRUD
{
    public function addMembres($nom,$prenom, $sexe, $situation_matrimoniale, $id_tranche_age, $id_statut);
    public function readMembres();
    public function updateMembres($id,$nom,$prenom, $sexe, $situation_matrimoniale, $id_tranche_age, $id_statut);
    public function deleteMembres($id);
}
?>