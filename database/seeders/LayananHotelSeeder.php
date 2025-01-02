<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LayananHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('tbl_layanan_hotel')->insert([
                'nama_layanan' => $faker->word(),
                'harga_layanan' => $faker->numberBetween(100000, 1000000),
                'tgl_layanan' => $faker->date(),
            ]);
        }
    }
}
