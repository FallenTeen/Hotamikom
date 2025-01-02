<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'tbl_kamar';
    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'harga_per_malam',
        'kapasitas',
        'status'
    ];
    public $timestamps = false;

    function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_kamar');
    }
}
