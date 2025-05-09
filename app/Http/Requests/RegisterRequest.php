<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'gender' => 'required|in:Male,Female',
            'birthdate' => 'required|date',
            'bio' => 'nullable|string|min:100',
            'situation' => 'required|exists:situations,id',
            'phone_number' => 'required|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
