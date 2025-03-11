<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login'); 
    }

    public function showRegister()
    {
        return view('auth.register'); 
    }

    public function register(RegisterRequest  $request)
{
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

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
}

}
