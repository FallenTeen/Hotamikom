<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PivotReservasiLayanan extends Model
{
    protected $table = 'pivot_reservasi_layanan';

    protected $fillable = [
        'reservasi_id',
        'layanan_hotel_id',
        'jumlah',
    ];
    public $timestamps = true;
}
