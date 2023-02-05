<?php

namespace Database\Factories;

use App\Models\Expert;
use App\Models\Organization;
use App\Models\TypeAct;
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
            'customer_id' => Organization::all()->random()->id,
            'type_act_id' => TypeAct::all()->random()->id,
            'number' => $this->faker->numerify('###.##/##-##'),
            'date' => $this->faker->date('Y-m-d'),
            'reason' => $this->faker->realTextBetween(160,255),
            ];
    }
}
