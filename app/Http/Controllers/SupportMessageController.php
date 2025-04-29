<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SupportMessageRequest;

class SupportMessageController extends Controller
{

    protected $supportMessage;
    public function __construct(SupportMessage $supportMessage)
    {
        $this->supportMessage= $supportMessage;
    }
    

    public function sendMessage(SupportMessageRequest $request){

        $validatedData = $request->validated();

        if(Auth::check()){
            $user =  Auth::user();
            $validatedData["user_id"] = $user->id;
        }

        // dd($validatedData["phone_number"]);
        $this->supportMessage->create($validatedData);
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
    public function show(support_message $support_message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(support_message $support_message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, support_message $support_message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(support_message $support_message)
    {
        //
    }
}
