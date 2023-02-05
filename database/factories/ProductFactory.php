<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{HsCode, Act};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'act_id' => Act::all()->random()->id,
            'hs_code_id' => HsCode::all()->random()->id,
            'name' => $this->faker->word,
            'item_number' => $this->faker->numerify('##########'),
        ];
    }
}
