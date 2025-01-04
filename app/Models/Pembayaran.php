<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'tbl_pembayaran';
    protected $fillable = [
        'id_reservasi',
        'tgl_pembayaran',
        'jumlah_pembayaran',
        'metode_pembayaran',
        'status_pembayaran',
        'status_pembayaran',
    ];

    public function reservasi(){
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }
}
