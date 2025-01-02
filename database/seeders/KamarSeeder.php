<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('tbl_kamar')->insert([
                'nomor_kamar' => 'K' . str_pad($index, 3, '0', STR_PAD_LEFT),
                'tipe_kamar' => $faker->randomElement(['vip', 'reguler']),
                'harga_per_malam' => $faker->numberBetween(50000, 150000),
                'kapasitas' => $faker->numberBetween(1, 4),
                'status' => $faker->randomElement(['tersedia', 'terisi']),
            ]);
        }
    }
}
