<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Struk;
use App\Transaksi;
use App\Checkout_kilo;
use App\Checkout_satu;
use Illuminate\Http\Request;

class HalPesananPelangganController extends Controller
{
    // Halaman Pesanan Pelanggan
    public function halamanPesananPelanggan()
    {
    	$id = Auth::id();
    	$users = User::find($id);
        if($users->role == 'member')
        {
            $transaksis = Transaksi::join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
            ->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
            ->select('transaksis.*', 'outlets.nama as nama_outlet', 'users.name as nama_pegawai')
            ->where('kd_pelanggan', $users->kd_pengguna)
            ->get();
            return view('halaman_pesanan_pelanggan.pesanan_pelanggan_member', compact('transaksis'));
        }else{
            $transaksis = Transaksi::join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
            ->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
            ->select('transaksis.*', 'outlets.nama as nama_outlet', 'users.name as nama_pegawai')
            ->where('kd_pelanggan', $users->kd_pengguna)
            ->first();
            $check_kilo = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
            ->count();
            $check_satu = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
            ->count();
            $check_struk = Struk::where('kd_invoice', $transaksis->kd_invoice)
            ->count();
            if($check_kilo != 0){
                $checkout_kilos = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
                ->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.harga_paket as harga_paket_satuan')
                ->where('checkout_kilos.kd_invoice', $transaksis->kd_invoice)
                ->get();
                $checkout_kilo = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
                ->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.antar_jemput_paket', 'paket_kilos.harga_paket as harga_paket_satuan')
                ->where('checkout_kilos.kd_invoice', $transaksis->kd_invoice)
                ->first();
                $checkout_satus = "";
                $checkout_satu = "";
                $harga_paket = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
                ->sum('checkout_kilos.harga_paket');
            }elseif ($check_satu != 0){
                $checkout_satus = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
                ->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
                ->where('checkout_satus.kd_invoice', $transaksis->kd_invoice)
                ->get();
                $checkout_satu = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
                ->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
                ->where('checkout_satus.kd_invoice', $transaksis->kd_invoice)
                ->first();
                $checkout_kilos = "";
                $checkout_kilo = "";
                $harga_paket = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
                ->sum('checkout_satus.harga_barang');
            }
            if($check_struk != 0){
                $struks = Struk::select('struks.*')
                ->where('kd_invoice', $transaksis->kd_invoice)
                ->first();
            }else{
                $struks = "";
            }
            return view('halaman_pesanan_pelanggan.pesanan_pelanggan_non_member', compact('transaksis', 'checkout_kilos', 'checkout_satus', 'checkout_kilo', 'checkout_satu', 'harga_paket', 'struks'));
        }
    }

    // Melihat Pesanan Pelanggan
    public function lihatPesananPelanggan($id)
    {
    	$transaksis = Transaksi::find($id);
    	$check_kilo = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        $check_satu = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        $check_struk = Struk::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        if($check_kilo != 0){
            $checkout_kilos = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
            ->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.harga_paket as harga_paket_satuan')
            ->where('checkout_kilos.kd_invoice', $transaksis->kd_invoice)
            ->get();
            $checkout_kilo = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
            ->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.antar_jemput_paket', 'paket_kilos.harga_paket as harga_paket_satuan')
            ->where('checkout_kilos.kd_invoice', $transaksis->kd_invoice)
            ->first();
            $checkout_satus = "";
            $checkout_satu = "";
            $harga_paket = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
            ->sum('checkout_kilos.harga_paket');
        }elseif ($check_satu != 0){
            $checkout_satus = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
            ->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
            ->where('checkout_satus.kd_invoice', $transaksis->kd_invoice)
            ->get();
            $checkout_satu = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
            ->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
            ->where('checkout_satus.kd_invoice', $transaksis->kd_invoice)
            ->first();
            $checkout_kilos = "";
            $checkout_kilo = "";
            $harga_paket = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
            ->sum('checkout_satus.harga_barang');
        }
        if($check_struk != 0){
            $struks = Struk::select('struks.*')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->first();
        }else{
            $struks = "";
        }

        return response()->json([
            'transaksis' => $transaksis,
            'checkout_kilos' => $checkout_kilos,
            'checkout_kilo' => $checkout_kilo,
            'checkout_satus' => $checkout_satus,
            'checkout_satu' => $checkout_satu,
            'harga_paket' => $harga_paket,
            'struks' => $struks
        ]);
    }
}
