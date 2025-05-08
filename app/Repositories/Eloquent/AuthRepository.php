<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function register(Array $data){
    // Handle the profile picture upload
    $profilePicturePath = null;
    if (isset($data['profile_picture'])) {
        // Store the file in the public disk under users/profile_picture directory
        // This automatically generates a unique filename
        $profilePicturePath = $data['profile_picture']->store('users/profile_picture', 'public');
    }

    // Create the user with all form fields
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'gender' => $data['gender'],
        'birthdate' => $data['birthdate'],
        'bio' => $data['bio'] ?? null,
        'situation_id' => $data['situation'],
        'phone_number' => $data['phone_number'],
        'profile_picture' => $profilePicturePath,
    ]);
}

    public function login(Array $credentials){

        return Auth::attempt($credentials);
    }

    public function logout(){
        Auth::logout();
    }
}
