<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{HsCode, Act, CodeGroup, Measure, Organization, Subposition};

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
            'name' => $this->faker->sentence(2),
            'brand' => $this->faker->sentence(1),
            'manufacturer_id' => Organization::all()->random()->id,
            'item_number' => $this->faker->numerify('##########'),
            'gross' => $this->faker->randomFloat(2, 1, 99999),
            'netto' => $this->faker->randomFloat(2, 1, 99999),
//            'measure' => $this->faker->randomElement(['кг', 'куб. м']),
            'measure_id' => Measure::all()->random()->id,
            'origin_criterion' => $this->faker->randomElement(['Полная', 'Достаточная']),
            'description' => $this->faker->sentence(),
            'code_group_id' => CodeGroup::all()->random()->id,
            'subposition_id' => Subposition::all()->random()->id,
        ];
    }
}
