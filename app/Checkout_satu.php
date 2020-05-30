<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout_satu extends Model
{
    // Table Checkout Satus
    protected $fillable = [
        'kd_invoice', 'kd_barang', 'jumlah_barang', 'metode_pembayaran', 'harga_barang', 'harga_antar', 'harga_total'
    ];
}
