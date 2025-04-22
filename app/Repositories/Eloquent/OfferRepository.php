<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Models\Offer;

class OfferRepository implements OfferRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    protected $offers;
    public function __construct(Offer $offers)
    {
        $this->offers= $offers;
    }

    public function getAll()
    {
        return $this->offers->whereNotNull('category_id')->paginate(20);
    }

    public function getById($id)
    {
        return $this->offers->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->offers->create($data);
    }

    public function update($id, array $data)
    {
        $offer = $this->getById($id);
        $offer->update($data);
        return $offer; 
    }

    public function delete($id)
    {
        $offer = $this->getById($id);
        return $offer->delete();
    }

    public function reactivate($id)
    {
        $offer = $this->offers->where('id',$id)->update(["status"=>"Active"]);
        return $offer;
    }

    public function suspend($id)
    {
        $offer= $this->offers->where('id',$id)->update(["status"=>"Suspended"]);
        return $offer;
    }
}
