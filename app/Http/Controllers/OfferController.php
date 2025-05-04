<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Offer;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use Illuminate\Contracts\Support\ValidatedData;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\OfferPhotoRepositoryInterface;

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
        // dd($offers->demands);
        $countOffers = $this->offerRepository->getAll()->count();
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

   public function createUserOffer(){
        $categories = $this->categoryRepository->getAll();
        $regions= Region::all();
        $cities= City::all();
    return view("offers.createUser",compact("categories","regions","cities"));
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
        $cities = City::all();
        $regions = Region::all();
        $offerCreator = User::findOrFail($offer->owner_id);
        $offerPhotos = $this->offerPhotoRepository->getOfferPhotos($id);
        return view("offers.edit", compact("offer","categories","cities","regions","offerCreator","offerPhotos"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, $id)
    {
        $user = Auth::user();
        $validatedData = $request->validated();
        
        // Get the existing offer to access its current data
        $existingOffer = $this->offerRepository->getById($id);
        
        // Prepare the offer data array with validated fields
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
            'phone_number' => $user->phone_number,
            'situation_id' => $user->situation_id
        ];
        
        // if the user has modifies the thumbnail of the offer, we do this 
        if ($request->hasFile('thumbnail')) {

            // firstly i delete the old thumbnail in the storege 
            if ($existingOffer->thumbnail && Storage::disk('public')->exists($existingOffer->thumbnail)) {
                Storage::disk('public')->delete($existingOffer->thumbnail);
            }
            
            // now i save the thumbnail the user choosed  in the strage
            $thumbnailPath = $request->file('thumbnail')->store('offers/thumbnails', 'public');
            $offerData['thumbnail'] = $thumbnailPath;
        }
        
        //now we chnage the information of the offer in the table offers
        $this->offerRepository->update($id, $offerData);

        
        // if the user changed the additional photos we should do the same we did with the thumbnail
        if ($request->hasFile('photos')) {

            // bring  all existing photos for this offer
            $existingPhotos = $this->offerPhotoRepository->getOfferPhotos($id);
            
            // now we delete all existing photos from storage and database
            foreach ($existingPhotos as $photo) {
                if (Storage::disk('public')->exists($photo->photo)) {
                    Storage::disk('public')->delete($photo->photo);
                }
                $this->offerPhotoRepository->deletePhoto($photo->id);
            }
            
            // Store the new photos
            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('offers/photos', 'public');
                $offerPhotoData = [
                    "offer_id" => $id,
                    "photo" => $photoPath,
                ];
                
                $this->offerPhotoRepository->storePhoto($offerPhotoData);
            }
        }
        
        return redirect()->route('offers.index')->with('success', 'Offer updated successfully!');
        
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
        $this->offerRepository->suspend($id);
        return redirect()->route("offers.index")->with("success","The offer has been Suspended!");
    }

}
