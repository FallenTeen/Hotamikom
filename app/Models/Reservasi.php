<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'tbl_reservasi';
    protected $fillable = [
        'id_user',
        'id_kamar',
        'id_layanan',
        'tgl_checkin',
        'tgl_checkout',
        'total_harga',
        'status'
    ];
    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_reservasi');
    }
    public function layanan()
    {
        return $this->belongsToMany(LayananHotel::class, 'pivot_reservasi_layanan')
            ->withPivot('jumlah')
            ->withTimestamps();
    }

    public function review(){
        return $this->hasOne(Review::class, 'id_reservasi');
    }
}
