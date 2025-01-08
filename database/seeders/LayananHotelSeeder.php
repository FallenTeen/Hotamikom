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
        DB::table('tbl_layanan_hotel')->insert([
            [
                'nama_layanan' => 'Room Service',
                'harga_layanan' => 300000,
                'kategori' => 'layanan_tambahan',
                'deskripsi' => 'Layanan makanan dan minuman yang dapat dinikmati langsung di kamar.',
                'tgl_layanan' => '2025-01-01',
            ],
            [
                'nama_layanan' => 'Spa',
                'harga_layanan' => 500000,
                'kategori' => 'layanan_tambahan',
                'deskripsi' => 'Layanan spa dan relaksasi untuk menghilangkan stres.',
                'tgl_layanan' => '2025-01-02',
            ],
            [
                'nama_layanan' => 'Minuman Dingin',
                'harga_layanan' => 50000,
                'kategori' => 'minuman',
                'deskripsi' => 'Minuman dingin untuk menyegarkan hari Anda.',
                'tgl_layanan' => '2025-01-03',
            ],
            [
                'nama_layanan' => 'Minuman Panas',
                'harga_layanan' => 30000,
                'kategori' => 'minuman',
                'deskripsi' => 'Minuman panas seperti kopi atau teh.',
                'tgl_layanan' => '2025-01-04',
            ],
            [
                'nama_layanan' => 'Makan Malam Spesial',
                'harga_layanan' => 700000,
                'kategori' => 'makanan',
                'deskripsi' => 'Makan malam dengan menu spesial dari chef hotel.',
                'tgl_layanan' => '2025-01-05',
            ],
            [
                'nama_layanan' => 'Sarapan Pagi',
                'harga_layanan' => 100000,
                'kategori' => 'makanan',
                'deskripsi' => 'Sarapan pagi dengan berbagai pilihan menu.',
                'tgl_layanan' => '2025-01-06',
            ],
            [
                'nama_layanan' => 'Laundry',
                'harga_layanan' => 200000,
                'kategori' => 'layanan_tambahan',
                'deskripsi' => 'Layanan laundry untuk pakaian Anda.',
                'tgl_layanan' => '2025-01-07',
            ],
            [
                'nama_layanan' => 'Parkir Valet',
                'harga_layanan' => 150000,
                'kategori' => 'layanan_tambahan',
                'deskripsi' => 'Layanan parkir valet untuk kenyamanan Anda.',
                'tgl_layanan' => '2025-01-08',
            ],
            [
                'nama_layanan' => 'Pijat Kaki',
                'harga_layanan' => 250000,
                'kategori' => 'layanan_tambahan',
                'deskripsi' => 'Layanan pijat kaki untuk meredakan kelelahan.',
                'tgl_layanan' => '2025-01-09',
            ],
            [
                'nama_layanan' => 'Makan Siang Buffet',
                'harga_layanan' => 400000,
                'kategori' => 'makanan',
                'deskripsi' => 'Makan siang dengan pilihan buffet yang lezat.',
                'tgl_layanan' => '2025-01-10',
            ],
        ]);
    }
}
