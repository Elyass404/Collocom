<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\OfferRepositoryInterface;

class PagesController extends Controller
{

    protected $offerRepository ;

    public function __construct(OfferRepositoryInterface $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }
    public function home(){
        $latestOffers = Offer::with('category')->where("status","Active")->latest()->take(3)->get();
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
    //     $offer = $this->offerRepository->getById(83);
    //    dd($offer->demands) ;

        return view("offers.offers_list", compact("offers"));
    }

    public function contact(){
        if (Auth::check()){
            $user = Auth::user();
            return view("contact_us",compact("user"));
        
        }
        return view("contact_us");
    }

    public function aboutUs(){
        return view('about_us');
    }
}
