<?php

namespace App\Http\Controllers;

use App\Models\OfferRequest;
use App\Http\Requests\StoreOfferRequestsRequest;
use App\Http\Requests\UpdateOfferRequestsRequest;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Repositories\Interfaces\OfferRequestRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;

class OfferRequestController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    protected $offerRequestRepository; 
    protected $offerRepository;
    public function __construct(OfferRequestRepositoryInterface $offerRequestRepository, OfferRepositoryInterface $offerRepository)
    {
        $this->offerRequestRepository = $offerRequestRepository;
        $this->offerRepository =$offerRepository;
    }

    public function askToJoin($offerId)
    {
        try{
        $offer = $this->offerRepository->getById($offerId);
        $offerData = [
            'offer_id'=>$offerId,
            'owner_id'=>$offer->owner_id,
            'user_id'=>Auth::id(),
        ];

        $this->offerRequestRepository->askToJoin($offerData);

        

        return response()->json(["success"=>"Your has been joined successfully !"]);

        }catch(Exception $e){
            return response()->json(["error"=>$e->getMessage()]);
        }
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OfferRequest $offerRequests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OfferRequest $offerRequests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequestsRequest $request, OfferRequest $offerRequests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OfferRequest $offerRequests)
    {
        //
    }
}
