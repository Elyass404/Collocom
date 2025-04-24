<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\OfferRepositoryInterface;

class PagesController extends Controller
{

    protected $offerRepository ;

    public function __construct(OfferRepositoryInterface $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }
    public function home(){
        $latestOffers = Offer::with('category')->latest()->take(3)->get();
        $countOffers = Offer::count();
        $countUsers = User::count();
        $countCities = Offer::distinct('city')->count('city');
        $categories = Category::withCount("offer")->get(); // this eloquent give you the possibility to bring all the categories and the count of elements belongs to it (offer in this case)

        return view('home', compact("latestOffers","categories","countOffers","countUsers","countCities"));
    }

    public function showDetails($id){
        $offer = $this->offerRepository->getById($id);
        return view("offers.show_details",compact('offer'));
    }

    public function offersList(){
        $offers = $this->offerRepository->getAll();

        return view("offers.offers_list", compact("offers"));
    }
}
