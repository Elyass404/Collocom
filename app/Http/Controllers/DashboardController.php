<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Users related 
        $users= User::all()->except(Auth::id()); //this will help us get all the users in the platdform without bringing the user logged in in the moment
        $countUsers = User::count();
        $countOffers = Offer::count();

        //Categories related
        // $categories=Category::all();
        // $countCategories= Category::count();

        // //Offers related
        // $offers=Offer::all();
        // $countOffers=Offer::count();

        //in the view, when you pass the variables to show the data, you can also use the array(associative array) method instead of compact
        return view("/dashboard",compact("users","countUsers","countOffers"));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
