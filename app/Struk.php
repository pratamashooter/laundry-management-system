<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Struk extends Model
{
    // Table Struks
    protected $fillable = [
        'kd_invoice', 'harga_total', 'harga_bayar', 'harga_kembali'
    ];
}
