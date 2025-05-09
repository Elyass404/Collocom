<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email'     => 'required|email|unique:users,email',
            'gender'    => 'required|in:Male,Female',
            'role_id'      => 'required|exists:roles,id',
            'password'  => 'required|string|min:8|confirmed',
            'profile_picture'     => 'nullable|image|mimes:jpeg,png,jpg|max:3000',
            'birthdate' => 'nullable|date|before:' . now()->subYears(5)->format('Y-m-d'), //this to make sure that the one who is registering is at least 5 years old
            'bio'       => 'nullable|string|max:1000',
            'situation_id' => 'nullable|string|exists:situations,id',
            'phone_number' => "string|required|min:8|max:15|unique:users,phone_number|regex:/^\+?[0-9\s\-]+$/",

        ];
    }

    public function messages()
    {
        return[
            'phone_number.regex'=>"Phone number format is invalid. Use only numbers, spaces, +, and dashes."
        ];
    }
}
