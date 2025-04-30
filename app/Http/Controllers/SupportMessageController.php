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
        $countMessages =$this->supportMessage->count() ;
        $unreadMessages=  $this->supportMessage->where("status","Unread")->count();
        $latestMessages = $this->supportMessage->whereDate('created_at', '>=', now()->subDays(3))->count(); //whereDate() is the same as the where but wihtout considering the exact time with minutes and secounds
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

    public function show($id){
        $message = $this->supportMessage->findOrFail($id); // i used directly findOrFail because i defined a variable in the model "primaryKey", so now laravel knows that the primary key in the table is "message_id" not id;
        $previousMessages = $this->supportMessage->where("user_id",$message->user_id)->get(); // this to get the messages that sent from the same user that we are seeing his message now
        return view("support.show",compact("message","previousMessages"));
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
        $message = $this->supportMessage->where("message_id",$id)->first(); // i did this instead of "find/findOrFail' because when i was creating the table in the DB i chnaged the Id column with "messages_id" and find/findOrFail is looking for the column that called id
        //but now since i defined a variable in the model called $primaryKey i can use findOrFail directly, because laravel now knows that the "message_id" is the primary Key.
       
        $message->delete();
        return redirect()->back()->with('success', 'Message deleted successfully.');

    }

    public function markRead($id){
        $message = $this->supportMessage->where("message_id",$id)->first();
        $message->update(["status" => "Read"]);
        return redirect()->back()->with('success',"Message marked as Read with success!");
    }

    public function markUnread($id){
        $message = $this->supportMessage->where("message_id",$id)->first();
        $message->update(["status"=>"Unread"]);
        return redirect()->back()->with("success","Message is marked as Unread with success!");
    }

    public function reply($id){
        dd("this feature is cooming soon!");
    }
}
