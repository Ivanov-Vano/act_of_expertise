<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CodeGroup;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;
use bfinlay\SpreadsheetSeeder\SpreadsheetSeeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            RolesAndPermissionsSeeder::class,
            ExpertSeeder::class,
            TypeActSeeder::class,
            CountrySeeder::class,
            OrganizationSeeder::class,
            CountrySeeder::class,
            PositionSeeder::class,
            SubpositionSeeder::class,
            TransportSeeder::class,
            ActSeeder::class,
            SpreadsheetSeeder::class,
        //    CodeGroupSeeder::class,
        //    HsCodeSeeder::class,
            ProductSeeder::class,
            AttachmentSeeder::class,

        ]);
    }
}
