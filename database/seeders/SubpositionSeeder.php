<?php

namespace Database\Seeders;

use App\Models\Subposition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubpositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/database/data/tnved_subposition.json";
        $subpositions = json_decode(file_get_contents($path), true);
        foreach ($subpositions as $subposition) {
            Subposition::updateOrCreate(['code' => $subposition['SUB_POZ']],
                [
                    'group' => $subposition['GRUPPA'],
                    'product_position' => $subposition['TOV_POZ'],
                    'name' => $subposition['KR_NAIM'],
                    'started_at' => $subposition['DATA'],
                    'group_position' => $subposition['position_id'],
                    'full_code' => $subposition['position_id'].' '.$subposition['SUB_POZ'],
                ]
            );
        }
    }
}
