<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Situation;
use App\Repositories\interfaces\SituationRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $userRepository;
    protected $situationRepository;
    public function __construct(UserRepositoryInterface $userRepository, SituationRepositoryInterface $situationRepository)
    {
        $this->userRepository = $userRepository;
        $this->situationRepository = $situationRepository;
    }

    public function index()
    {
        $users=$this->userRepository->getAll();
        $countUsers = User::count();

        return view("dashboard",compact("users","countUsers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();

        if (!empty($validatedData['password'])) {

            $validatedData['password'] = Hash::make($validatedData['password']);

        }else{

            $validatedData['password'] = Hash::make("password");
        }

        $this->userRepository->create($validatedData);


        return redirect()->route("dashboard")->with("success","The user has been added successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = $this->userRepository->findById($id);
        return view("users.show",compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */ 
    public function edit($id)
    {
        $user = $this->userRepository->findById($id);
        return view("users.edit",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */

    public function editProfile($id){
        if(Auth::id() != $id){
            return ("you can't aceess this page!");
        }

        $user = Auth::user();
        $situations =$this->situationRepository->getAll();

        return view("users.edit_profile",compact("user","situations"));
    }


    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userRepository->findById($id);
        $validatedData= $request->validated();

        

        if (!is_null($validatedData['password'])) {
            unset($validatedData['current_password'],$validatedData['pssword_validation']);
            $validatedData['password'] = Hash::make($validatedData['password']);

        }else{
            unset($validatedData["password"]);
        }

        // if the user has modified  the profile picture, we do this 
        if($request->hasFile("profile_picture")){

            // firstly i delete the old profile picture in the storege 
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // now i save the profile picture the user choosed  in the strage
            $profile_picture_path = $request->file('profile_picture')->store('users/profile_pictures', 'public');
            $validatedData['profile_picture'] = $profile_picture_path;
        }

        //what if the user just want to remove the picture, this is what we gonna handle now
        if($request["remove_picture"]){
            // if the remove picture checkbox is checked we delete the picture from the storage
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $validatedData["profile_picture"] = null;
        }
        
        $this->userRepository->update($id,$validatedData);

        return redirect()->route("users.profile",$id)->with("success","The user updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return redirect()->route("users.index")->with('success',"The user has been deleted successfully!");
    }

    public function profile($id){
        if(isset($id)){
            $user = $this->userRepository->findById($id);
        }else{
            $user = Auth::user();
            dd($user);  
        }

        return view("users.profile",compact("user"));
    }
}
