<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeAct;

class TypeActSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/database/data/types.json";
        $types = json_decode(file_get_contents($path), true);
        foreach ($types as $type) {
            TypeAct::updateOrCreate(['short_name' => $type['short_name']],
                [
                    'short_name' => $type['short_name'],
                ]
            );
        }
    }
}
