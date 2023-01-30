<?php

namespace Database\Factories;

use App\Models\Expert;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Act>
 */
class ActFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'expert_id' => Expert::all()->random()->id,
            'number' => $this->faker->numerify('###.##/##-##'),
            'date' => $this->faker->date('Y-m-d'),
            ];
    }
}
