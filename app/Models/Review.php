<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'tbl_review';
    protected $fillable = [
        'id_user',
        'id_reservasi',
        'rating',
        'komentar',
        'tgl_review',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
    public function reservasi(){
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }
}
