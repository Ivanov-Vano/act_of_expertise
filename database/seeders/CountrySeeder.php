<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/database/data/countries.json";
        $countries = json_decode(file_get_contents($path), true);
        foreach ($countries as $country) {
            Country::updateOrCreate(['short_name' => $country['short_name']],
                [
                    'short_name' => $country['short_name'],
                ]
            );
        }
    }
}
