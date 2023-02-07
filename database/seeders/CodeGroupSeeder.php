<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CodeGroup;

class CodeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/database/data/code_group.json";
        $codes = json_decode(file_get_contents($path), true);
        foreach ($codes as $code) {
            CodeGroup::updateOrCreate(['number' => $code['number']],
                [
                    'number' => $code['number'],
                    'name' => $code['name'],
                    'condition' => $code['condition'],
                ]
            );
        }
    }
}
