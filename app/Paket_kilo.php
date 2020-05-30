<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket_kilo extends Model
{
    // Table Paket Kiloan
    protected $fillable = [
        'kd_paket', 'nama_paket', 'harga_paket', 'hari_paket', 'min_berat_paket', 'antar_jemput_paket'
    ];
}
