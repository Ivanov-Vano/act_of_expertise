<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{HsCode, Act, CodeGroup, Organization};

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
            'name' => $this->faker->sentence(2),
            'brand' => $this->faker->sentence(1),
            'item_number' => $this->faker->numerify('##########'),
            'manufacturer_id' => Organization::all()->random()->id,
            'code_group_id' => CodeGroup::all()->random()->id,
            'gross' => $this->faker->randomFloat(2, 1, 99999),
            'netto' => $this->faker->randomFloat(2, 1, 99999),
            'origin_criterion' => $this->faker->randomElement(['Полная', 'Достаточная']),
            'measure' => $this->faker->randomElement(['кг', 'куб. м']),
        ];
    }
}
