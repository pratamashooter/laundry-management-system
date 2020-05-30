<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout_kilo extends Model
{
    // Table Checkout Kilos
    protected $fillable = [
        'kd_invoice', 'kd_paket', 'berat_barang', 'metode_pembayaran', 'harga_paket', 'harga_antar', 'harga_total'
    ];
}
