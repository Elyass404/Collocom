<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferRequest extends Model
{
    /** @use HasFactory<\Database\Factories\OfferRequestsFactory> */
    use HasFactory;

    protected $table = "offer_requests";
    protected $fillable = [
        'offer_id',
        'owner_id',
        'user_id',
    ];

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

    public function owner(){
        return $this->belongsTo(User::class,"owner_id");
    }

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
