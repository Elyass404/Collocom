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
    $thumbnailPath = $request->file('thumbnail')->store('offers/thumbnails', 'public');
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

        dd($request->file('photos')); // just to test if the code reached here successfully 

    }

    
    return redirect()->route('offers.index')->with('success', 'Offer created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $offer = $this->offerRepository->getById($id);
        $photos = $this->offerPhotoRepository->getOfferPhotos($id);
        
        
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
