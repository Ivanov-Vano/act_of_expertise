<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Expert;
use App\Models\Measure;
use App\Models\Organization;
use App\Models\Transport;
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
            'type_act_id' => TypeAct::all()->random()->id,
            'customer_id' => Organization::all()->random()->id,
            'number' => $this->faker->numerify('###.##/##-##'),
            'date' => $this->faker->date('Y-m-d'),
            'reason' => $this->faker->realTextBetween(160,255),
            'gross' => $this->faker->randomFloat(2, 1, 99999),
            'netto' => $this->faker->randomFloat(2, 1, 99999),
//            'measure' => $this->faker->randomElement(['кг', 'куб. м']),
            'measure_id' => Measure::all()->random()->id,
            'position' => $this->faker->bothify('## ??????????????'),
            'contract' => $this->faker->bothify('Контракт № ## от ##.##.####'),
            'invoice' => $this->faker->bothify('Инвойс № ## от ##.##.####'),
            'exporter_id' => Organization::all()->random()->id,
            'shipper_id' => Organization::all()->random()->id,
            'importer_id' => Company::all()->random()->id,
            'consignee_id' => Company::all()->random()->id,
            'cargo' => $this->faker->realTextBetween(160,255), // TODO удалить
            'package' => $this->faker->realTextBetween(160,255),
            'description' => $this->faker->realTextBetween(160,255),
            'transport_id' => Transport::all()->random()->id,
            ];
    }
}
