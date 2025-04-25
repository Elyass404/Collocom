<?php

namespace App\Models;

use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'title' ,
        'price' ,
        'category_id',
        'region',
        'city',
        'number_of_rooms' ,
        'place_capacity',
        'available_places',
        'description', 
        'thumbnail',
        'owner_id',
        'phone_number',
        'situation_id'

    ];

    public function owner(){
        return $this->belongsTo(User::class,"owner_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function offerPhotos(){
        return $this->hasMany(OfferPhoto::class);
    }

    public function demands(){
        return $this->hasMany(OfferRequest::class, 'offer_id');
    }

}
