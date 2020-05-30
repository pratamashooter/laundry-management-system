<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    // Table Pelanggans
    protected $fillable = [
        'kd_pelanggan', 'nama_pelanggan', 'jk_pelanggan', 'email_pelanggan', 'no_hp_pelanggan', 'alamat_pelanggan'
    ];
}
