<?php

namespace Database\Seeders;

use App\Models\Transport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/database/data/transports.json";
        $transports = json_decode(file_get_contents($path), true);
        foreach ($transports as $transport) {
            Transport::updateOrCreate(['name' => $transport['name']],
                [
                    'name' => $transport['name'],
                ]
            );
        }
    }
}
