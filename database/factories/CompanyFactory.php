<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'country_id' => Country::all()->random()->id,
            'short_name' => $this->faker->company,
            'name' => $this->faker->companySuffix,
            'registration_number' => $this->faker->numerify('##########'),
            'address' => $this->faker->address,
        ];
    }
}
