<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReservasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('tbl_reservasi')->insert([
                'id_user' => $faker->numberBetween(1, 10), 
                'id_kamar' => $faker->numberBetween(1, 10),
                'id_layanan' => $faker->numberBetween(1, 10),
                'tgl_checkin' => $faker->date(),
                'tgl_checkout' => $faker->date(),
                'total_harga' => $faker->numberBetween(100000, 1000000),
                'status' => $faker->randomElement(['pending', 'approved', 'canceled']),
            ]);
        }
    }
}
