<?php

namespace App\Repositories\Eloquent;

use App\Models\Offer;
use App\Models\OfferRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Repositories\Interfaces\OfferRequestRepositoryInterface;
use Dom\Attr;

class OfferRequestRepository implements OfferRequestRepositoryInterface
{
    /**
     * Create a new class instance.
     */

     protected $OfferRequest;
     protected $offers;

    public function __construct(OfferRequest $offerRequest, Offer $offers)
    {
        $this->OfferRequest = $offerRequest;
        $this->offers = $offers;
    }

    public function getById($id)
    {
        return $this->OfferRequest->findOrFail($id);
    }

    public function getRequests() //this method for the user to see his applied demands
    {
        return $this->OfferRequest->where("user_id", Auth::id());
    }

    public function getDemandes(){ //this method for the owner of the offer to get the demandes people sent 
        return $this->OfferRequest->where("owner_id",Auth::id());
    }

    public function askTojoin(array $data){
      return  $this->OfferRequest->create($data);
    }

    public function cancelDamande($offerId)
    {
        $offer = $this->OfferRequest->where('offer_id', $offerId)
                        ->where('user_id', Auth::id())
                        ->first();

        return $offer->delete();
    }

    public function rejectRequest($id){
        $offer = $this->getById($id);
        $offerId = $offer->offer_id;

        if($offer->status == "accepted"){
            $this->offers->where('id', $offerId)->increment("available_places", 1); //since we are rejecting someone that is already accepted, the available places should increase by 1
        }

        return $offer->update(["status"=>"rejected"]);
    }

    public function pendingRequest($id){
        $offer = $this->getById($id);
        $offerId = $offer->offer_id;

        if($offer->status == "accepted"){
            $this->offers->where('id', $offerId)->increment("available_places", 1); //since we are pending someone that is already accepted, the available places should increase by 1
        }

        return $offer->update(["status"=>"pending"]);
    }

    public function acceptRequest($id){
        $offer = $this->getById($id);
        $offerId = $offer->offer_id;
        $this->offers->where('id',$offerId)->decrement("available_places", 1); //since we accepted someone , now the needed places for the house/appartment... should decrease, thats why iam decreasing 1 from the available places so the other users know how many places are available 
        return $offer->update(["status"=>"accepted"]);
    }

    public function cancelDecision($id){
        $offer = $this->getById($id);
        if($offer->status ==="accepted"){

            //if you it is accepted then we already decreased one; By canceling the decision then we should increament to go back to the number before we accepted
            //but if the decision is rejecting it, then the number will not be affected, so we just change the status to pending directly 
            $this->offers->where('id',$id)->increment("available_places", 1);
        }
        
        return $offer->update(["status"=>"Pending"]);
    }

    public function getDemande($offerId, $userId) {
        //i made this method in order to check if a certain user applied/sent demande to  a certain offer or not, in order to prevent the user to apply a demande more than once to the same offer
           return $this->OfferRequest
                    ->where('offer_id',$offerId)
                    ->where('user_id', $userId)
                    ->exists(); 
    }

    public function getPending(){
        return $this->OfferRequest->where("status","pending")->get();
    }

    public function getAccepted(){
        return $this->OfferRequest->where("status","accepted")->get();
    }

    public function getRejected(){
        return $this->OfferRequest->where("status","rejected")->get();
    }
}
