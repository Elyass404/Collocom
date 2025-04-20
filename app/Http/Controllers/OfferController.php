<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Models\City;
use App\Models\Region;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\OfferPhotoRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $offerRepository; 
    protected $categoryRepository;
    protected $offerPhotoRepository;
    public function __construct(OfferRepositoryInterface $offerRepository, CategoryRepositoryInterface $categoryRepository, OfferPhotoRepositoryInterface $offerPhotoRepository)
    {
        $this->offerRepository = $offerRepository;
        $this->categoryRepository = $categoryRepository;
        $this->offerPhotoRepository = $offerPhotoRepository;
    }
    public function index()
    {
        $offers= $this->offerRepository->getAll();
        $countOffers = 174;
        $activeOffers = 144;
        $latestOffers = 23;
        return view("offers.index",compact(
            "offers",
            "countOffers",
            "activeOffers",
            "latestOffers",
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        $regions= Region::all();
        $cities= City::all();

        return view("offers.create",compact("categories","regions","cities"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {
        $user= Auth::user();
        $validatedData = $request->validated();
         


    
    // Handle thumbnail upload
    // $thumbnailPath = $request->file('thumbnail')->store('offers/thumbnails', 'public');
    $thumbnailPath = "testing";
    // Create the offer record with only validated data


    $offerData = [
        'title' => $validatedData['title'],
        'price' => $validatedData['price'],
        'category_id' => $validatedData['category_id'],
        'region' => $validatedData['region'],
        'city' => $validatedData['city'],
        'number_of_rooms' => $validatedData['rooms'],
        'place_capacity' => $validatedData['capacity'],
        'available_places' => $validatedData['available_places'],
        'description' => $validatedData['description'],
        'thumbnail' => $thumbnailPath,
        'owner_id' => $user->id ,
        'phone_number' => $user->phone_number ,
        'situation_id'=>$user->situation_id
    ];
    dd($offerData); // just to test if the code reached here successfully 


    $recentOffer =$this->offerRepository->create($offerData);

    $recentOfferId = $recentOffer->id;

    // insert those multiple photos inserted by the user multiple photos
    if ($request->hasFile('photos')) {

        foreach ($request->file('photos') as $photo) {
            $photoPath = $photo->store('offers/photos', 'public');
            $offerPhotoData = [
                "offer_id"=>$recentOfferId,
                "photo"=>$photoPath,
            ];
            
            // to store each photo of the photos the user uploaded in each itiration 
            $this->offerPhotoRepository->storePhoto($offerPhotoData);
            
        }
    }

    
    return redirect()->route('offers.index')->with('success', 'Offer created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $offer = $this->offerRepository->getById($id);
        $photos = ["https://th.bing.com/th/id/R.f8d04c765b226b0dc9f41edaa2b55555?rik=4ARprhP%2fkCTt9A&pid=ImgRaw&r=0",
                   "https://th.bing.com/th/id/R.f8d04c765b226b0dc9f41edaa2b55555?rik=4ARprhP%2fkCTt9A&pid=ImgRaw&r=0https://th.bing.com/th/id/OIP.iE7mcw3w2aFFDhXP9A1lggHaE8?rs=1&pid=ImgDetMain",
                    "https://th.bing.com/th/id/OIP.bFGklHsqtTS_fpHd1-eb3AHaJ3?rs=1&pid=ImgDetMain"];
        
        return view("offers.show", compact("offer","photos"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $offer = $this->offerRepository->getById($id);
        $categories = $this->categoryRepository->getAll();

        return view("offers.edit", compact("offer","categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, $id)
    {
        $validatedData = $request->validated();
        $this->offerRepository->update($id, $validatedData);
        return redirect()->route("offers.index")->with("success","The offer has been updated successfully");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->offerRepository->delete($id);
        return redirect()->route("offers.index")->with("success","The offer has been delted with success!");
    }

    public function reactivate($id){
        $this->offerRepository->reactivate($id);
        return redirect()->route("offers.index")->with("success","The offer has been Activated!");
    }

    public function suspend($id){
        $this->offerRepository->reactivate($id);
        return redirect()->route("offers.index")->with("success","The offer has been Suspended!");
    }

}
