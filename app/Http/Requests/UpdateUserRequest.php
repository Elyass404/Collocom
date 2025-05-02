<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:30', 
            'email'     => 'required|email|unique:users,email,' . Auth::id(),
            'gender'    => 'required|in:Male,Female',
            'password'  => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|max:3000',
            'birthdate' => 'nullable|date|before:' . now()->subYears(5)->format('Y-m-d'),
            'bio'       => 'nullable|string|max:1000',
            'situation_id' => 'nullable|string|exists:situations,id',
            'phone_number' => "string|required|min:8|max:15|unique:users,phone_number," . Auth::id() . "|regex:/^\+?[0-9\s\-]+$/",
        ];
    }
}
