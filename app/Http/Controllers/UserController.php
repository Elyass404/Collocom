<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users=$this->userRepository->getAll();
        return view("dashboard",compact("users"));
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
    public function update( $id, UserRequest $request)
    {
        $validatedData= $request->validated();

        $this->userRepository->update($id,$validatedData);

        return redirect()->route("users.index")->with("success","The user updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return redirect()->route("users.index")->with('success',"The user has been deleted successfully!");
    }
}
