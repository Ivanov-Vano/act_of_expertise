<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/database/data/tnved_position.json";
        $positions = json_decode(file_get_contents($path), true);
        foreach ($positions as $position) {
            Position::updateOrCreate(['code' => $position['id']],
                [
                    'code' => $position['id'],
                    'name' => $position['NAIM'],
                    'started_at' => $position['DATA'],
                ]
            );
        }
    }
}
