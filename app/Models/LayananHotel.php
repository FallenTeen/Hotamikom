<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananHotel extends Model
{
    protected $table = 'tbl_layanan_hotel';
    protected $fillable = [
        'nama_layanan',
        'harga_layanan',
        'kategori',
        'deskripsi',
        'tgl_layanan',
    ];

    public function reservasi()
    {
        return $this->belongsToMany(Reservasi::class, 'pivot_reservasi_layanan')
            ->withPivot('jumlah')
            ->withTimestamps();
    }
}
