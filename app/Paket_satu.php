<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket_satu extends Model
{
    // Table Paket Satuan
    protected $fillable = [
        'kd_barang', 'nama_barang', 'ket_barang', 'harga_barang'
    ];
}
