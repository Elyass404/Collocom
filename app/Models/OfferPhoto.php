<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferPhoto extends Model
{

    protected $table = "offer_photos";
    
    public function offer(){
        return $this->belongsTo(Offer::class);
    }
}
