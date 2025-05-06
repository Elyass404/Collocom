<?php

namespace App\Http\Controllers;

use App\Models\OfferRequest;
use App\Http\Requests\StoreOfferRequestsRequest;
use App\Http\Requests\UpdateOfferRequestsRequest;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Repositories\Interfaces\OfferRequestRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class OfferRequestController extends Controller 
{
    
    protected $offerRequestRepository; 
    protected $offerRepository;
    public function __construct(OfferRequestRepositoryInterface $offerRequestRepository, OfferRepositoryInterface $offerRepository){
        $this->offerRequestRepository = $offerRequestRepository;
        $this->offerRepository =$offerRepository;
    }

    public function askToJoin($offerId){

        try{
        $offer = $this->offerRepository->getById($offerId);
        $offerData = [
            'offer_id'=>$offerId,
            'owner_id'=>$offer->owner_id,
            'user_id'=>Auth::id(),
        ];

        $existOffer = $this->offerRequestRepository->getDemande($offerId,Auth::id());
        // dd($existOffer);
        if(!$existOffer){

        $this->offerRequestRepository->askToJoin($offerData);

        return response()->json(["success"=>"Your demande has been Sent successfully !"]);
        }else{
            return response()->json(["error"=>"You have alreadey sent a demand for this offer!"]);
        }

        }catch(Exception $e){
            return response()->json(["error"=>$e->getMessage()]);
        }
    }

    public function cancelDemande($offerId){

        try{

            $this->offerRequestRepository->cancelDamande($offerId);
            return response()->json(["success"=>"Your demande has been Canceled successfully !"]);

        }catch(Exception $e){
            return response()->json(["error"=>$e->getMessage()]);
            
        }

    }

    public function acceptRequest($offerRequestId){
        $this->offerRequestRepository->acceptRequest($offerRequestId);
        return redirect()->back()->with('success', 'The request has been accepted successfully!');
    }

    public function rejectRequest($offerRequestId){
        $this->offerRequestRepository->rejectRequest($offerRequestId);
        return redirect()->back()->with('success', 'The request has been accepted successfully!');
    }
}
