<?php

namespace App\Repositories\Eloquent;

use App\Models\OfferRequest;
use App\Repositories\Interfaces\OfferRequestRepositoryInterface;

class OfferRequestRepository implements OfferRequestRepositoryInterface
{
    /**
     * Create a new class instance.
     */

     protected $OfferRequest;

    public function __construct(OfferRequest $offerRequest)
    {
        $this->OfferRequest = $offerRequest;
    }

    public function askTojoin(array $data){
      return  $this->OfferRequest->create($data);
    }

    public function rejectRquest($id){
        return 
    }
}
