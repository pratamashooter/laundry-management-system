<?php

namespace App\Http\Controllers;

use Session;
use App\Outlet;
use App\Paket_kilo;
use App\Paket_satu;
use Illuminate\Http\Request;

class HalPaketController extends Controller
{
    // Membuka Halaman Paket
    public function halamanPaket()
    {
        $outlets = Outlet::select('outlets.*')
        ->count();
    	$paket_kilos = Paket_kilo::all();
    	$paket_satus = Paket_satu::all();
    	return view('halaman_paket.halaman_paket', compact('paket_kilos', 'paket_satus', 'outlets'));
    }

    // Membuka Halaman Tambah Paket Kiloan
    public function tambahPaketKiloan()
    {
        $outlets = Outlet::all();
    	$max = Paket_kilo::max('kd_paket');
        $check_maks = Paket_kilo::select('paket_kilos.kd_paket')
        ->count();
        if($check_maks == null){
            $max_code = "PK001";
        }else{
            $max_code = $max[2].$max[3].$max[4];
            $max_code++;
            if($max_code <= 9){
                $max_code = "PK00".$max_code;
            }elseif ($max_code <= 99) {
                $max_code = "PK0".$max_code;
            }elseif ($max_code <= 999) {
                $max_code = "PK".$max_code;
            }
        }
    	return view('halaman_paket.halaman_tambah_paket_kiloan', compact('max_code', 'outlets'));
    }

    // Membuka Halaman Tambah Paket Satuan
    public function tambahPaketSatuan()
    {
        $outlets = Outlet::all();
    	$max = Paket_satu::max('kd_barang');
        $check_maks = Paket_satu::select('paket_kilos.kd_barang')
        ->count();
        if($check_maks == null){
            $max_code = "PS001";
        }else{
            $max_code = $max[2].$max[3].$max[4];
            $max_code++;
            if($max_code <= 9){
                $max_code = "PS00".$max_code;
            }elseif ($max_code <= 99) {
                $max_code = "PS0".$max_code;
            }elseif ($max_code <= 999) {
                $max_code = "PS".$max_code;
            }
        }
    	return view('halaman_paket.halaman_tambah_paket_satuan', compact('max_code', 'outlets'));
    }

    // Menyimpan Paket Kiloan Baru
    public function simpanPaketKiloan(Request $req)
    {
    	$paket_kilos = new Paket_kilo;
    	$paket_kilos->kd_paket = $req->kd_paket;
    	$paket_kilos->nama_paket = $req->nama_paket;
    	$paket_kilos->harga_paket = $req->harga_paket;
    	$paket_kilos->hari_paket = $req->hari_paket;
    	$paket_kilos->min_berat_paket = $req->min_berat_paket;
        $paket_kilos->id_outlet = $req->id_outlet;
    	if($req->antar_jemput_paket != '')
    	{
    		$paket_kilos->antar_jemput_paket = $req->antar_jemput_paket;	
    	}
    	$paket_kilos->save();
    	Session::flash('tersimpan', 'kiloan');
		return redirect('/kelola_paket');
    }

    // Menyimpan Paket Satuan Baru
    public function simpanPaketSatuan(Request $req)
    {
    	$paket_satus = new Paket_satu;
    	$paket_satus->kd_barang = $req->kd_barang;
    	$paket_satus->nama_barang = $req->nama_barang;
    	$paket_satus->harga_barang = $req->harga_barang;
        $paket_satus->id_outlet = $req->id_outlet;
    	if($req->ket_barang != '')
    	{
    		$paket_satus->ket_barang = $req->ket_barang;	
    	}
    	$paket_satus->save();
    	Session::flash('tersimpan', 'satuan');
		return redirect('/kelola_paket');
    }

    // Melihat detail Paket Kiloan
    public function lihatPaketKiloan($id)
    {
        $paket_kilos = Paket_kilo::join('outlets', 'outlets.id', '=', 'paket_kilos.id_outlet')
        ->select('paket_kilos.*', 'outlets.nama as nama_outlet')
        ->where('paket_kilos.id', $id)
        ->first();
        return response()->json($paket_kilos);
    }

    // Melihat detail Paket Satuan
    public function lihatPaketSatuan($id)
    {
        $paket_satus = Paket_satu::join('outlets', 'outlets.id', '=', 'paket_satus.id_outlet')
        ->select('paket_satus.*', 'outlets.nama as nama_outlet')
        ->where('paket_satus.id', $id)
        ->first();
        return response()->json($paket_satus);
    }

    // Mengirim data edit Paket Kiloan
    public function editPaketKiloan($id)
    {
        $outlets = Outlet::all();
    	$paket_kilos = Paket_kilo::find($id);
    	return view('halaman_paket.halaman_edit_paket_kiloan', compact('paket_kilos', 'id', 'outlets'));
    }

    // Mengirim data edit Paket Satuan
    public function editPaketSatuan($id)
    {
        $outlets = Outlet::all();
    	$paket_satus = Paket_satu::find($id);
    	return view('halaman_paket.halaman_edit_paket_satuan', compact('paket_satus', 'id', 'outlets'));
    }

    // Mengubah data Paket Kiloan
    public function updatePaketKiloan(Request $req, $id)
    {
    	$paket_kilos = Paket_kilo::find($id);
    	$paket_kilos->nama_paket = $req->nama_paket;
    	$paket_kilos->harga_paket = $req->harga_paket;
    	$paket_kilos->hari_paket = $req->hari_paket;
    	$paket_kilos->min_berat_paket = $req->min_berat_paket;
        $paket_kilos->id_outlet = $req->id_outlet;
    	if($req->antar_jemput_paket != '')
    	{
    		$paket_kilos->antar_jemput_paket = $req->antar_jemput_paket;
    	}else{
    		$paket_kilos->antar_jemput_paket = 0;
    	}
    	$paket_kilos->save();
    	Session::flash('terubah', 'kiloan');
		return redirect('/kelola_paket');
    }

    // Mengubah data Paket Satuan
    public function updatePaketSatuan(Request $req, $id)
    {
    	$paket_satus = Paket_satu::find($id);
    	$paket_satus->nama_barang = $req->nama_barang;
    	$paket_satus->harga_barang = $req->harga_barang;
        $paket_satus->id_outlet = $req->id_outlet;
    	if($req->ket_barang != '')
    	{
    		$paket_satus->ket_barang = $req->ket_barang;	
    	}
    	$paket_satus->save();
    	Session::flash('terubah', 'satuan');
		return redirect('/kelola_paket');
    }

    // Menghapus Paket Kiloan
    public function hapusPaketKiloan($id)
    {
    	$paket_kilos = Paket_kilo::find($id);
    	$paket_kilos->delete();
    	Session::flash('terhapus', 'kiloan');
		return redirect('/kelola_paket');
    }

	// Menghapus Paket Satuan
    public function hapusPaketSatuan($id)
    {
    	$paket_satus = Paket_satu::find($id);
    	$paket_satus->delete();
    	Session::flash('terhapus', 'satuan');
		return redirect('/kelola_paket');
    }
}
