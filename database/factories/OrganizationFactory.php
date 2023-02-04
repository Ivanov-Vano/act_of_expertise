<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
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
            'inn' => $this->faker->numerify('##########'),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
        ];
    }
}
