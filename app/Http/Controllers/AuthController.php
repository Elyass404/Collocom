<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\interfaces\SituationRepositoryInterface;

class AuthController extends Controller
{
    protected $authRepository;
    protected $situationRepository;

    public function __construct(AuthRepositoryInterface $authRepository, SituationRepositoryInterface $situationRepository)
    {
        $this->authRepository = $authRepository;
        $this->situationRepository = $situationRepository;

    }


    public function showLogin()
    {
        return view('auth.login'); 
    }

    public function showRegister()
    {
        $situations = $this->situationRepository->getAll();
        return view('auth.register',compact("situations")); 
    }

    public function register(RegisterRequest $request){

        $this->authRepository->register($request->validated());

        return redirect()->route('login')->with('success',"You have created you account with success! Please login.");
    }

    public function login(LoginRequest $request)
{
    if ($this->authRepository->login($request->validated())) {
        // Check if the logged-in user has the admin role
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route("dashboard")->with("success", "Welcome Back, Admin!");
        }

        // Redirect non-admin users to the home page
        return redirect()->route("home")->with("success", "Welcome Back!");
    }

    return back()->withErrors(["email" => "Invalid Credentials!"])->withInput();
}


    public function logout(){
        $this->authRepository->logout();
        return redirect()->route("login")->with("success","You are logged out!");
    }

}
