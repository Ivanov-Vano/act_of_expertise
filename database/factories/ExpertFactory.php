<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expert>
 */
class ExpertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $parts = explode(" ", fake()->name());
        $patronymic = array_pop($parts);

        return [
            'surname' => fake()->lastName(),
            'name' => fake()->firstName(),
            'patronymic' => $patronymic,
        ];
    }
}
