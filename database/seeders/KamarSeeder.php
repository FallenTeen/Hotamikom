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
        DB::table('tbl_kamar')->insert([
            [
                'nomor_kamar' => 'K001',
                'tipe_kamar' => 'vip',
                'rekomendasi' => true,
                'harga_per_malam' => 100000,
                'kapasitas' => 2,
                'status' => 'tersedia',
            ],
            [
                'nomor_kamar' => 'K002',
                'tipe_kamar' => 'reguler',
                'rekomendasi' => false,
                'harga_per_malam' => 75000,
                'kapasitas' => 3,
                'status' => 'terisi',
            ],
            [
                'nomor_kamar' => 'K003',
                'tipe_kamar' => 'suite',
                'rekomendasi' => true,
                'harga_per_malam' => 150000,
                'kapasitas' => 4,
                'status' => 'tersedia',
            ],
            [
                'nomor_kamar' => 'K004',
                'tipe_kamar' => 'vip',
                'rekomendasi' => true,
                'harga_per_malam' => 120000,
                'kapasitas' => 2,
                'status' => 'terisi',
            ],
            [
                'nomor_kamar' => 'K005',
                'tipe_kamar' => 'reguler',
                'rekomendasi' => false,
                'harga_per_malam' => 65000,
                'kapasitas' => 3,
                'status' => 'tersedia',
            ],
            [
                'nomor_kamar' => 'K006',
                'tipe_kamar' => 'suite',
                'rekomendasi' => false,
                'harga_per_malam' => 140000,
                'kapasitas' => 4,
                'status' => 'terisi',
            ],
            [
                'nomor_kamar' => 'K007',
                'tipe_kamar' => 'vip',
                'rekomendasi' => true,
                'harga_per_malam' => 110000,
                'kapasitas' => 2,
                'status' => 'tersedia',
            ],
            [
                'nomor_kamar' => 'K008',
                'tipe_kamar' => 'reguler',
                'rekomendasi' => true,
                'harga_per_malam' => 80000,
                'kapasitas' => 3,
                'status' => 'terisi',
            ],
            [
                'nomor_kamar' => 'K009',
                'tipe_kamar' => 'suite',
                'rekomendasi' => false,
                'harga_per_malam' => 160000,
                'kapasitas' => 4,
                'status' => 'tersedia',
            ],
            [
                'nomor_kamar' => 'K010',
                'tipe_kamar' => 'reguler',
                'rekomendasi' => false,
                'harga_per_malam' => 70000,
                'kapasitas' => 3,
                'status' => 'terisi',
            ],
        ]);
    }
}
