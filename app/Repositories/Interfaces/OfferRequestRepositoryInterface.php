<?php

namespace App\Repositories\Interfaces;

interface OfferRequestRepositoryInterface
{
    public function askToJoin(array $data);
    public function getRequests();
    public function getById($id);
    public function getDemandes();
    public function acceptRequest($id);
    public function rejectRquest($id);
    public function cancelDamande($id);
    public function getDemande($offerId,$userId); // in order to chekc the deand exists already in the table of demands or not
    public function cancelDecision($id); //to give the owner to cancel the accept/reject decision he made for a demand 
    public function getPending();
}
