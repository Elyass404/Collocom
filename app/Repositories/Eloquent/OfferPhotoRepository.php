<?php

namespace App\Repositories\Eloquent;

use App\Models\OfferPhoto;
use App\Repositories\Interfaces\OfferPhotoRepositoryInterface;

class OfferPhotoRepository implements OfferPhotoRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    protected $offerPhoto;
    public function __construct(OfferPhoto $offerPhoto)
    {
        $this->offerPhoto = $offerPhoto;
    }

    public function storePhoto(array $data)
    {
        return $this->offerPhoto->create($data);
    }

    public function getOfferPhotos($id)
    {
        return $this->offerPhoto->where('offer_id', $id)->get();
    }

    public function deletePhoto($id){
        $offer = $this->offerPhoto->findOrFail($id);
        return $offer->delete();
        
    }
}
