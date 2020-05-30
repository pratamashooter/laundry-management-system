<?php

namespace App\Http\Controllers;

use PDF;
use Carbon;
use App\User;
use App\Transaksi;
use Illuminate\Http\Request;

class HalLaporanController extends Controller
{
    // Membuka Halaman Laporan Transaksi
    public function halamanLaporanTransaksi()
    {
    	$transaksis = Transaksi::join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
    	->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
    	->join('struks', 'struks.kd_invoice', '=', 'transaksis.kd_invoice')
    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan', 'users.name as nama_pegawai', 'struks.*')
    	->where('transaksis.status', 'diambil')
    	->get();
    	$hari_ini = Carbon\Carbon::now();
        $hari_ini2 = $hari_ini->isoFormat('MM/DD/YYYY');
        $bulan_depan = $hari_ini->add(1, 'month');
        $bulan_depan2 = $bulan_depan->isoFormat('MM/DD/YYYY');

    	return view('halaman_laporan.halaman_laporan_transaksi', compact('transaksis', 'hari_ini2', 'bulan_depan2'));
    }

    // Membuka Halaman Laporan Pegawai
    public function halamanLaporanPegawai()
    {
    	$users = User::all();
    	$baru = Transaksi::where('status', 'baru')
    	->count();
    	$proses = Transaksi::where('status', 'proses')
    	->count();
    	$selesai = Transaksi::where('status', 'selesai')
    	->count();
    	$diambil = Transaksi::where('status', 'diambil')
    	->count();
    	return view('halaman_laporan.halaman_laporan_pegawai', compact('users', 'baru', 'proses', 'selesai', 'diambil'));
    }

    // Membuka Halaman Riwayat Kerja Pegawai
    public function halamanLaporanPegawaiRiwayat($id)
    {
    	$users = User::find($id);
    	$riwayats = Transaksi::join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
    	->join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan')
    	->where('transaksis.kd_pegawai', $users->kd_pengguna)
    	->orderBy('transaksis.tgl_pemberian', 'DESC')
    	->get();
    	return view('halaman_laporan.halaman_laporan_riwayat', compact('users', 'id', 'riwayats'));
    }

    // Filter Laporan Pegawai
    public function filterLaporanPegawai(Request $req, $id)
    {
    	if($req->check_semua == 1){
    		$users = User::find($id);
    		$riwayats = Transaksi::join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
	    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
	    	->join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
	    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan')
	    	->where('transaksis.kd_pegawai', $users->kd_pengguna)
	    	->orderBy('transaksis.tgl_pemberian', 'DESC')
	    	->get();
	    	return view('halaman_laporan.sort_halaman_laporan_pegawai', compact('riwayats'));
    	}else{
    		$users = User::find($id);
    		$start_date = $req->start_date;
    		$end_date = $req->end_date;
    		$start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];
    		$end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];
    		$riwayats = Transaksi::join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
	    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
	    	->join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
	    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan')
	    	->where('transaksis.kd_pegawai', $users->kd_pengguna)
	    	->whereBetween('transaksis.tgl_pemberian', array($start_date2, $end_date2))
	    	->orderBy('transaksis.tgl_pemberian', 'DESC')
	    	->get();
	    	return view('halaman_laporan.sort_halaman_laporan_pegawai', compact('riwayats'));
    	}
    }

    // Filter Laporan Transaksi
    public function filterLaporanTransaksi(Request $req)
    {
		if($req->check_semua == 1){
    		$transaksis = Transaksi::join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
	    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
	    	->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
	    	->join('struks', 'struks.kd_invoice', '=', 'transaksis.kd_invoice')
	    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan', 'users.name as nama_pegawai', 'struks.*')
	    	->where('transaksis.status', 'diambil')
	    	->get();
	    	return view('halaman_laporan.sort_halaman_laporan_transaksi', compact('transaksis'));
    	}else{
    		$start_date = $req->start_date;
    		$end_date = $req->end_date;
    		$start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];
    		$end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];
    		$transaksis = Transaksi::join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
	    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
	    	->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
	    	->join('struks', 'struks.kd_invoice', '=', 'transaksis.kd_invoice')
	    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan', 'users.name as nama_pegawai', 'struks.*')
	    	->where('transaksis.status', 'diambil')
	    	->whereBetween('transaksis.tgl_bayar', array($start_date2, $end_date2))
	    	->get();
	    	return view('halaman_laporan.sort_halaman_laporan_transaksi', compact('transaksis'));
    	}
    }

    // Cetak PDF Laporan Pegawai
    public function pdfLaporanPegawai(Request $req, $id)
    {
    	if($req->check_semua == 1){
    		$users = User::find($id);
    		$riwayats = Transaksi::join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
	    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
	    	->join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
	    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan')
	    	->where('transaksis.kd_pegawai', $users->kd_pengguna)
	    	->orderBy('transaksis.tgl_pemberian', 'DESC')
	    	->get();
	    	$tanggal = "Semua Invoice";
	    	$start_date2 = "";
	    	$end_date2 = "";

	    	$pdf = PDF::loadview('halaman_laporan.pdf_laporan_pegawai', [
	    		'users' => $users,
	            'riwayats' => $riwayats,
	            'tanggal' => $tanggal,
	            'start_date2' => $start_date2,
	            'end_date2' => $end_date2
	        ]);
	        return $pdf->stream();
    	}else{
    		$users = User::find($id);
    		$start_date = $req->start_date;
    		$end_date = $req->end_date;
    		$start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];
    		$end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];
    		$riwayats = Transaksi::join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
	    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
	    	->join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
	    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan')
	    	->where('transaksis.kd_pegawai', $users->kd_pengguna)
	    	->whereBetween('transaksis.tgl_pemberian', array($start_date2, $end_date2))
	    	->orderBy('transaksis.tgl_pemberian', 'DESC')
	    	->get();
	    	$tanggal = "";

	    	$pdf = PDF::loadview('halaman_laporan.pdf_laporan_pegawai', [
	            'users' => $users,
	            'riwayats' => $riwayats,
	            'tanggal' => $tanggal,
	            'start_date2' => $start_date2,
	            'end_date2' => $end_date2
	        ]);
	        return $pdf->stream();
    	}
    }

    // Cetak PDF Laporan Transaksi
    public function pdfLaporanTransaksi(Request $req)
    {
    	if($req->check_semua == 1){
    		$transaksis = Transaksi::join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
	    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
	    	->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
	    	->join('struks', 'struks.kd_invoice', '=', 'transaksis.kd_invoice')
	    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan', 'users.name as nama_pegawai', 'struks.*')
	    	->where('transaksis.status', 'diambil')
	    	->get();
	    	$pemasukan = Transaksi::join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
	    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
	    	->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
	    	->join('struks', 'struks.kd_invoice', '=', 'transaksis.kd_invoice')
	    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan', 'users.name as nama_pegawai', 'struks.*')
	    	->where('transaksis.status', 'diambil')
	    	->sum('struks.harga_bayar');
	    	$tanggal = "Semua Invoice";
	    	$start_date2 = "";
	    	$end_date2 = "";

	    	$pdf = PDF::loadview('halaman_laporan.pdf_laporan_transaksi', [
	            'transaksis' => $transaksis,
	            'tanggal' => $tanggal,
	            'start_date2' => $start_date2,
	            'end_date2' => $end_date2,
	            'pemasukan' => $pemasukan
	        ]);
	        return $pdf->stream();
    	}else{
    		$start_date = $req->start_date;
    		$end_date = $req->end_date;
    		$start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];
    		$end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];
    		$transaksis = Transaksi::join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
	    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
	    	->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
	    	->join('struks', 'struks.kd_invoice', '=', 'transaksis.kd_invoice')
	    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan', 'users.name as nama_pegawai', 'struks.*')
	    	->where('transaksis.status', 'diambil')
	    	->whereBetween('transaksis.tgl_bayar', array($start_date2, $end_date2))
	    	->get();
	    	$pemasukan = Transaksi::join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
	    	->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
	    	->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
	    	->join('struks', 'struks.kd_invoice', '=', 'transaksis.kd_invoice')
	    	->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan', 'users.name as nama_pegawai', 'struks.*')
	    	->where('transaksis.status', 'diambil')
	    	->whereBetween('transaksis.tgl_bayar', array($start_date2, $end_date2))
	    	->sum('struks.harga_bayar');
	    	$tanggal = "";

	    	$pdf = PDF::loadview('halaman_laporan.pdf_laporan_transaksi', [
	            'transaksis' => $transaksis,
	            'tanggal' => $tanggal,
	            'start_date2' => $start_date2,
	            'end_date2' => $end_date2,
	            'pemasukan' => $pemasukan
	        ]);
	        return $pdf->stream();
    	}
    }
}
