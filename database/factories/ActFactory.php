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

            'gross' => $this->faker->randomFloat(2, 1, 99999),
            'netto' => $this->faker->randomFloat(2, 1, 99999),
            'measure' => $this->faker->randomElement(['кг', 'куб. м']),
            'position' => $this->faker->bothify('## ??????????????'),
            'contract' => $this->faker->bothify('Контракт № ## от ##.##.####'),
            'invoice' => $this->faker->bothify('Инвойс № ## от ##.##.####'),
            'exporter_id' => Organization::all()->random()->id,
            'shipper_id' => Organization::all()->random()->id,
            'manufacturer_id' => Organization::all()->random()->id,
            'importer_id' => Organization::all()->random()->id,
            'consignee_id' => Organization::all()->random()->id,
            'cargo' => $this->faker->realTextBetween(160,255),
            'package' => $this->faker->realTextBetween(160,255),
            ];
    }
}
