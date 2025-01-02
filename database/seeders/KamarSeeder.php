<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_kamar')->insert([
            [
                'nomor_kamar' => 'K001',
                'tipe_kamar' => 'vip',
                'harga_per_malam' => 100000,
                'kapasitas' => 2,
                'status' => 'tersedia',
            ],
            [
                'nomor_kamar' => 'K002',
                'tipe_kamar' => 'reguler',
                'harga_per_malam' => 50000,
                'kapasitas' => 3,
                'status' => 'terisi',
            ],
            [
                'nomor_kamar' => 'K003',
                'tipe_kamar' => 'vip',
                'harga_per_malam' => 120000,
                'kapasitas' => 2,
                'status' => 'tersedia',
            ],
            [
                'nomor_kamar' => 'K004',
                'tipe_kamar' => 'reguler',
                'harga_per_malam' => 60000,
                'kapasitas' => 4,
                'status' => 'terisi',
            ],
            [
                'nomor_kamar' => 'K005',
                'tipe_kamar' => 'vip',
                'harga_per_malam' => 150000,
                'kapasitas' => 1,
                'status' => 'tersedia',
            ],
        ]);
    }
}
