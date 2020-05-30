<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // Table Transaksis
    protected $fillable = [
        'id_outlet', 'kd_invoice', 'kd_pelanggan', 'tgl_pemberian', 'tgl_selesai', 'tgl_bayar', 'diskon', 'pajak', 'status', 'ket_bayar', 'kd_pegawai'
    ];
}
