<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CodeGroup;
use Illuminate\Database\Seeder;

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
            ExpertSeeder::class,
            TypeActSeeder::class,
            CountrySeeder::class,
            OrganizationSeeder::class,
            ActSeeder::class,
            CodeGroupSeeder::class,
            HsCodeSeeder::class,
            ProductSeeder::class,
            AttachmentSeeder::class,
        ]);
    }
}
