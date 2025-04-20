<?php

namespace App\Http\Requests;

use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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

             
             'title' => 'required|string|min:5|max:255',
             'price' => 'required|numeric|min:0',
             'category_id' => 'required|exists:categories,id',
             
             // Location
             'region' => 'required|exists:regions,region',
             'city' => [
                 'required',
                 'exists:cities,city',
                //  function ($attribute, $value, $fail) {
                //      // Verify that the city belongs to the selected region
                //      $cityBelongsToRegion = City::where('city', $value)
                //          ->where('region_id', $this->region)
                //          ->exists();
                     
                //      if (!$cityBelongsToRegion) {
                //          $fail('The selected city does not belong to the selected region.');
                //      }
                //  },
             ],
             
             // Property Details
             'rooms' => 'required|integer|min:1',
             'capacity' => 'required|integer|min:2',
             'available_places' => 'required|integer|min:1',
             'description' => 'required|string|min:20|max:5000',
             
             // Images
             'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:3000',
             'photos' => 'required|array|min:1|',
             'photos.*' => 'image|mimes:jpeg,png,jpg|max:3000',
            
        ];
    }

    public function attributes()
    {
        return[
            "photos.*"=>"photo",
        ];

    }
}
