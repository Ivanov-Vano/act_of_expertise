<?php

namespace Database\Seeders;

use App\Models\Measure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/database/data/measures.json";
        $measures = json_decode(file_get_contents($path), true);
        foreach ($measures as $measure) {
            Measure::updateOrCreate(['short_name' => $measure['short_name']],
                [
                    'short_name' => $measure['short_name'],
                ]
            );
        }
    }
}
