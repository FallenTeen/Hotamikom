<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananHotel extends Model
{
    protected $table = 'tbl_layanan';
    protected $fillable = [
        'nama_layanan',
        'harga_layanan',
        'tgl_layanan',
    ];

    public function reservasi()
    {
        return $this->belongsToMany(Reservasi::class, 'reservasi_layanan')
            ->withPivot('jumlah')
            ->withTimestamps();
    }
}
