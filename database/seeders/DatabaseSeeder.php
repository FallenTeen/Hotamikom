<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KamarSeeder::class,
            LayananHotelSeeder::class,
            ReservasiSeeder::class,
            PivotReservasiLayananSeeder::class,
        ]);

    }
}
