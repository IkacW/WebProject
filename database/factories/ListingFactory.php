<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(), 
            'tags' => 'bmw, chasie, hook',
            'quantity' => $this->faker->randomDigitNotNull(),
            'location' => $this->faker->city(),
            'description' => $this->faker->paragraph(5)
        ];
    }
}
