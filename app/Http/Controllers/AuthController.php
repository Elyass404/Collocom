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

    public function login(LoginRequest $request){

        if($this->authRepository->login($request->validated())){
           return redirect()->route("dashboard")->with("seccess","Welcome Back!");
        }

        return back()->withErrors(["email","Invalid Credential!"])->withInput();
    }

    public function logout(){
        $this->authRepository->logout();
        return redirect()->route("login")->with("success","You are logged out!");
    }







//the method without the repository design patter

    /* public function register(RegisterRequest  $request){

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6|confirmed',
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log in the user
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }

public function login(LoginRequest $request){

    
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('success', 'Login successful!');
    }

    return back()->withErrors(['password' => 'Invalid Information','email' => 'hadchi ghalet'])->withInput();

}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login')->with('success', 'You have been logged out.');
} */

}
