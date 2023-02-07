<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{HsCode, Act, CodeGroup};

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
            'code_group_id' => CodeGroup::all()->random()->id,
        ];
    }
}
