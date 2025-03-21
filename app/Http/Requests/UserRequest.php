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
            'gender'    => 'required|in:male,female',
            'role'      => 'required|exists:roles,id',
            'password'  => 'required|string|min:8|confirmed',
            'photo'     => 'nullable|image|max:3000',
            'birthdate' => 'nullable|date|before:' . now()->subYears(5)->format('Y-m-d'), //this to make sure that the one who is registering is at least 5 years old
            'bio'       => 'nullable|string|max:1000',
            'situation' => 'nullable|string|exists:situations,id',
        ];
    }
}
