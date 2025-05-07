<?php

namespace App\Repositories\Interfaces;

interface OfferRequestRepositoryInterface
{
    public function askToJoin(array $data);
    public function getRequests();
    public function getById($id);
    public function getDemandes();
    public function acceptRequest($id);
    public function rejectRequest($id);
    public function pendingRequest($id);
    public function cancelDamande($id);
    public function getDemande($offerId,$userId); // in order to chekc the deand exists already in the table of demands or not
    public function cancelDecision($id); //to give the owner to cancel the accept/reject decision he made for a demand 
    public function getPending();
    public function getAccepted();
    public function getRejected();
    public function getUserPending();//to get the pending demands someone sent to the offers
    public function getUserAccepted();//to get the accepted demands someone sent to the offers
    public function getUserRejected();//to get the rejected demands someone sent to the offers
}
