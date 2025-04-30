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
    
    public function index(){
        $messages = $this->supportMessage->paginate(20);
        $countMessages =5 ;
        $unreadMessages=  552;
        $latestMessages = 2;
        return view ("support.index",compact("messages","countMessages","unreadMessages","latestMessages"));
    }

    public function sendMessage(SupportMessageRequest $request){

        $validatedData = $request->validated();

        if(Auth::check()){
            $user =  Auth::user();
            $validatedData["user_id"] = $user->id;
        }

        // dd($validatedData["phone_number"]);
        $this->supportMessage->create($validatedData);
        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
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
    public function show($id)
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
    public function destroy($id)
    {
        $message = $this->supportMessage->where("message_id",$id); // i did this instead of "find/findOrFail' because when i was creating the table in the DB i chnaged the Id column with "messages_id" and find/findOrFail is looking for the column that called id
        $message->delete();
        return redirect()->back()->with('success', 'Message deleted successfully.');

    }
}
