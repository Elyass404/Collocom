<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $offerRepository; 
    protected $categoryRepository;
    public function __construct(OfferRepositoryInterface $offerRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->offerRepository = $offerRepository;
        $this->categoryRepository = $categoryRepository;
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
        return view("offers.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {
        $validatedData = $request->validated();
        $this->offerRepository->create($validatedData);
        return redirect()->route("offers.index")->with("success","The offer has been added with success!");

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
