<?php

namespace App\Http\Controllers;

use PDF;
use Carbon;
use Session;
use App\User;
use App\Struk;
use App\Pelanggan;
use App\Transaksi;
use App\Checkout_satu;
use App\Checkout_kilo;
use Illuminate\Http\Request;

class HalTransaksiController extends Controller
{
    // Melihat Transaksi Selesai
    public function lihatTransaksiSelesai($id)
    {
    	$transaksis = Transaksi::find($id);
    	$pelanggans = Pelanggan::select('pelanggans.*')
    	->where('kd_pelanggan', $transaksis->kd_pelanggan)
    	->first();
    	$check_kiloan = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
    	->count();
    	$check_satuan = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
    	->count();
    	$check_struk = Struk::where('kd_invoice', $transaksis->kd_invoice)
    	->count();
    	if($check_kiloan != 0){
    		$checkout_kilos = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
    		->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.harga_paket as harga_paket_satuan')
    		->where('kd_invoice', $transaksis->kd_invoice)
    		->get();
    		$checkout_kilo = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
    		->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.harga_paket as harga_paket_satuan', 'paket_kilos.antar_jemput_paket')
    		->where('kd_invoice', $transaksis->kd_invoice)
    		->first();
    		$kiloan_total = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
        	->sum('checkout_kilos.harga_paket');
        	$satuan_total = "";
    		$checkout_satus = "";
    		$checkout_satu = "";
    	}elseif ($check_satuan != 0){
    		$checkout_satus = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
    		->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
    		->where('kd_invoice', $transaksis->kd_invoice)
    		->get();
    		$checkout_satu = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
    		->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
    		->where('kd_invoice', $transaksis->kd_invoice)
    		->first();
    		$satuan_total = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
    		->sum('checkout_satus.harga_barang');
    		$kiloan_total = "";
    		$checkout_kilos = "";
    		$checkout_kilo = "";
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
            'pelanggans' => $pelanggans,
            'checkout_satus' => $checkout_satus,
            'checkout_kilos' => $checkout_kilos,
            'checkout_satu' => $checkout_satu,
            'checkout_kilo' => $checkout_kilo,
            'kiloan_total' => $kiloan_total,
            'satuan_total' => $satuan_total,
            'struks' => $struks
        ]);
    }

    // Membuka PDF Transaksi
    public function pdfTransaksi($id)
    {
        $transaksis = Transaksi::join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
        ->join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
        ->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
        ->select('transaksis.*', 'outlets.nama as nama_outlet', 'outlets.alamat as alamat_outlet', 'outlets.hotline', 'outlets.email as email_outlet', 'pelanggans.nama_pelanggan', 'pelanggans.jk_pelanggan', 'pelanggans.email_pelanggan', 'no_hp_pelanggan', 'pelanggans.alamat_pelanggan', 'pelanggans.cek_member', 'users.name as nama_pegawai')
        ->where('transaksis.id', $id)
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

        $pdf = PDF::loadview('halaman_transaksi.pdf_transaksi', [
            'transaksis' => $transaksis,
            'checkout_kilos' => $checkout_kilos,
            'checkout_satus' => $checkout_satus,
            'checkout_kilo' => $checkout_kilo,
            'checkout_satu' => $checkout_satu,
            'harga_paket' => $harga_paket,
            'struks' => $struks
        ]);
        return $pdf->stream();
    }

    // Melihat Transaksi Diantar
    public function lihatTransaksiDiantar($id)
    {
        $transaksis = Transaksi::find($id);
        $pelanggans = Pelanggan::select('pelanggans.*')
        ->where('kd_pelanggan', $transaksis->kd_pelanggan)
        ->first();
        $pegawais = User::select('users.*')
        ->where('kd_pengguna', $transaksis->kd_pegawai)
        ->first();
        $pegawai = $pegawais->name;
        $check_kiloan = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        $check_satuan = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        if($check_kiloan != 0){
            $checkout_kilos = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
            ->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.harga_paket as harga_paket_satuan')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->get();
            $checkout_kilo = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
            ->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.harga_paket as harga_paket_satuan', 'paket_kilos.antar_jemput_paket')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->first();
            $kiloan_total = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
            ->sum('checkout_kilos.harga_paket');
            $satuan_total = "";
            $checkout_satus = "";
            $checkout_satu = "";
        }elseif ($check_satuan != 0){
            $checkout_satus = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
            ->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->get();
            $checkout_satu = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
            ->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->first();
            $satuan_total = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
            ->sum('checkout_satus.harga_barang');
            $kiloan_total = "";
            $checkout_kilos = "";
            $checkout_kilo = "";
        }
        $struks = Struk::select('struks.*')
        ->where('kd_invoice', $transaksis->kd_invoice)
        ->first();
        return response()->json([
            'transaksis' => $transaksis,
            'pelanggans' => $pelanggans,
            'checkout_satus' => $checkout_satus,
            'checkout_kilos' => $checkout_kilos,
            'checkout_satu' => $checkout_satu,
            'checkout_kilo' => $checkout_kilo,
            'kiloan_total' => $kiloan_total,
            'satuan_total' => $satuan_total,
            'struks' => $struks,
            'pegawai' => $pegawai
        ]);
    }

    // Melihat Transaksi Diambil
    public function lihatTransaksiDiambil($id)
    {
        $transaksis = Transaksi::find($id);
        $pelanggans = Pelanggan::select('pelanggans.*')
        ->where('kd_pelanggan', $transaksis->kd_pelanggan)
        ->first();
        $pegawais = User::select('users.*')
        ->where('kd_pengguna', $transaksis->kd_pegawai)
        ->first();
        $pegawai = $pegawais->name;
        $check_kiloan = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        $check_satuan = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        if($check_kiloan != 0){
            $checkout_kilos = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
            ->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.harga_paket as harga_paket_satuan')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->get();
            $checkout_kilo = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
            ->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.harga_paket as harga_paket_satuan', 'paket_kilos.antar_jemput_paket')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->first();
            $kiloan_total = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
            ->sum('checkout_kilos.harga_paket');
            $satuan_total = "";
            $checkout_satus = "";
            $checkout_satu = "";
        }elseif ($check_satuan != 0){
            $checkout_satus = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
            ->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->get();
            $checkout_satu = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
            ->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->first();
            $satuan_total = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
            ->sum('checkout_satus.harga_barang');
            $kiloan_total = "";
            $checkout_kilos = "";
            $checkout_kilo = "";
        }
        $struks = Struk::select('struks.*')
        ->where('kd_invoice', $transaksis->kd_invoice)
        ->first();
        return response()->json([
            'transaksis' => $transaksis,
            'pelanggans' => $pelanggans,
            'checkout_satus' => $checkout_satus,
            'checkout_kilos' => $checkout_kilos,
            'checkout_satu' => $checkout_satu,
            'checkout_kilo' => $checkout_kilo,
            'kiloan_total' => $kiloan_total,
            'satuan_total' => $satuan_total,
            'struks' => $struks,
            'pegawai' => $pegawai
        ]);
    }

    // Membayar Pesanan
    public function bayarPesanan(Request $req)
    {
    	$hari_ini = Carbon\Carbon::now();
        $hari_ini2 = $hari_ini->isoFormat('Y-M-D');

    	$transaksis = Transaksi::find($req->id_transaksi_input);
        $check_kiloan = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        $check_satuan = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
    	$transaksis->tgl_bayar = $hari_ini2;
    	$transaksis->diskon = $req->diskon_bayar;
    	$transaksis->pajak = $req->pajak_bayar;
    	if($check_kiloan != 0){
            $checkout_kilos = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
            ->select('checkout_kilos.*', 'paket_kilos.antar_jemput_paket')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->first();
            if($checkout_kilos->antar_jemput_paket == 1 || $checkout_kilos->harga_antar != 0){
                $transaksis->status = 'diantar';
            }else{
                $transaksis->status = 'diambil';
            }
        }elseif ($check_satuan != 0){
            $checkout_satus = Checkout_satu::select('checkout_satus.*')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->first();
            if($checkout_satus->harga_antar != 0){
                $transaksis->status = 'diantar';
            }else{
                $transaksis->status = 'diambil';                
            }
        }
    	$transaksis->ket_bayar = 'dibayar';

    	$struks = new Struk;
        $struks->kd_invoice = $transaksis->kd_invoice;
        $struks->harga_total = $req->total_bayar_2;
        $struks->harga_bayar = $req->bayar_bayar;
        $struks->harga_kembali = $req->kembali_bayar_2;
        $struks->save();

        $transaksis->save();
        Session::flash('dibayar', 'Transaksis berhasil');
        echo "sukses";
    }

    // Mengubah Status Transaksi
    public function ubahStatusTransaksi($status, $id)
    {
        $transaksis = Transaksi::find($id);
        $transaksis->status = $status;
        $transaksis->save();
        if($status == 'diantar'){
            Session::flash('diantar', 'Pesanan telah diantar');
        }elseif ($status == 'diambil'){
            Session::flash('diambil', 'Pesanan telah diterima');
        }
        echo "sukses";
    }
}