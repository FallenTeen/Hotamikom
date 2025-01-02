<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PivotReservasiLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('pivot_reservasi_layanan')->insert([
                'reservasi_id' => $faker->numberBetween(1, 10),
                'layanan_id' => $faker->numberBetween(1, 10),
                'jumlah' => $faker->numberBetween(1, 5),
            ]);
        }
    }
}
