<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Process\FakeProcessResult;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'phone_number' => $this->faker->phoneNumber(),
            'region' => $this->faker->state(),
            'city' => $this->faker->city(),
            'thumbnail' => $this->faker->imageUrl(300, 200, 'business'), 
            'available_places' => $this->faker->numberBetween(1,10),
            'category_id' => $this->faker->randomElement([1,2,3,4,9,10]), 
            'owner_id' =>  $this->faker->randomElement([1,3,4,5,6,7]),
            'status' => $this->faker->randomElement(['Active', 'Suspended']),
            'description'=>$this->faker->paragraph(),
            'price'=>$this->faker->numberBetween(100,4000),
            'place_capacity'=>$this->faker->numberBetween(2,10), //i decided to make minimum of 2 because the first one the user that creating the offer him self 
            'number_of_rooms'=>$this->faker->numberBetween(1,5),
        ];
    }
}
