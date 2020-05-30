<?php

namespace App\Http\Controllers;

use Session;
use App\Outlet;
use Illuminate\Http\Request;

class HalOutletController extends Controller
{
    // Membuka Halaman Outlet
    public function halamanOutlet()
    {
    	$outlets = Outlet::all();
    	return view('halaman_outlet.halaman_outlet', compact('outlets'));
    }

    // Membuka Halaman Tambah Outlet
    public function tambahOutlet()
    {
    	return view('halaman_outlet.halaman_tambah_outlet');
    }

    // Menyimpan Outlet Baru
    public function simpanOutlet(Request $req)
    {
    	$outlets = new Outlet;
    	$outlets->nama = $req->nama;
    	$outlets->alamat = $req->alamat;
    	$outlets->hotline = $req->hotline;
    	$outlets->email = $req->email;
    	if($req->iframe_script != '')
    	{
    		$outlets->iframe_script = $req->iframe_script;	
    	}
    	$outlets->save();
    	Session::flash('tersimpan', 'Outlet baru berhasil ditambahkan');
		return redirect('/kelola_outlet');
    }

    // Melihat detail Outlet
    public function lihatOutlet($id)
    {
    	$outlets = Outlet::find($id);
    	return response()->json($outlets);
    }

    // Mengirim data edit Outlet
    public function editOutlet($id)
    {
    	$outlets = Outlet::find($id);
    	return view('halaman_outlet.halaman_edit_outlet', compact('outlets', 'id'));
    }

    // Mengubah data Outlet
    public function updateOutlet(Request $req, $id)
    {
    	$outlets = Outlet::find($id);
    	$outlets->nama = $req->nama;
    	$outlets->alamat = $req->alamat;
    	$outlets->hotline = $req->hotline;
    	$outlets->email = $req->email;
    	if($req->iframe_script != '')
    	{
    		$outlets->iframe_script = $req->iframe_script;	
    	}
    	$outlets->save();
    	Session::flash('terubah', 'Outlet berhasil diubah');
		return redirect('/kelola_outlet');
    }

    // Menghapus Outlet
    public function hapusOutlet($id)
    {
    	$outlets = Outlet::find($id);
    	$outlets->delete();
    	Session::flash('terhapus', 'Outlet berhasil dihapus');
		return redirect('/kelola_outlet');
    }
}