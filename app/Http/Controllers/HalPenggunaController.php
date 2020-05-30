<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Outlet;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class HalPenggunaController extends Controller
{
    // Membuka Halaman Pengguna
    public function halamanPengguna()
    {
    	$penggunas = User::all();
        $outlets = Outlet::select('outlets.*')
        ->count();
    	return view('halaman_pengguna.halaman_pengguna', compact('penggunas', 'outlets'));
    }

    // Melihat Detail Pengguna
    public function lihatPengguna($id)
    {
        $penggunas = User::find($id);
        $transaksis = Transaksi::join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
        ->join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
        ->select('transaksis.*', 'outlets.nama as nama_outlet', 'pelanggans.nama_pelanggan')
        ->where('transaksis.kd_pegawai', $penggunas->kd_pengguna)
        ->take(5)
        ->get();
        return response()->json([
            'penggunas' => $penggunas,
            'transaksis' => $transaksis
        ]);
    }

    // Membuka Halaman Tambah Pengguna
    public function tambahPengguna()
    {
        $outlets = Outlet::all();
        $max = User::max('kd_pengguna');
        $check_maks = User::select('users.kd_pengguna')
        ->count();
        if($check_maks == null){
            $max_code = "U0001";
        }else{
            $max_code = $max[1].$max[2].$max[3].$max[4];
            $max_code++;
            if($max_code <= 9){
                $max_code = "U000".$max_code;
            }elseif ($max_code <= 99) {
                $max_code = "U00".$max_code;
            }elseif ($max_code <= 999) {
                $max_code = "U0".$max_code;
            }elseif ($max_code <= 9999) {
                $max_code = "U".$max_code;
            }
        }
    	return view('halaman_pengguna.halaman_tambah_pengguna', compact('max_code', 'outlets'));
    }

    // Menyimpan Pengguna Baru
    public function simpanPengguna(Request $req)
    {
    	$cek_username = User::where('username', '=', $req->username)
    	->count();
    	if($cek_username == 1)
    	{
    		Session::flash('tidak_tersimpan', 'Maaf username telah digunakan');
    		return redirect('/tambah_pengguna');
    	}else{
    		if($req->avatar != "")
    		{
    			$penggunas = new User;
                $penggunas->kd_pengguna = $req->kd_pengguna;
		    	$penggunas->name = $req->nama;
		    	$penggunas->role = $req->role;
                if($req->id_outlet != '')
                {
                    $penggunas->id_outlet = $req->id_outlet;
                }
		    	$penggunas->username = $req->username;
		    	$penggunas->password = Hash::make($req->password);
		    	$penggunas->remember_token = Str::random(60);
		    	$avatar = $req->file('avatar');
                $penggunas->avatar = $avatar->getClientOriginalName();
                $avatar->move(public_path('pictures/'), $avatar->getClientOriginalName());
		    	$penggunas->save();
		    	Session::flash('tersimpan', 'Pengguna baru berhasil ditambahkan');
		    	return redirect('/kelola_pengguna');
    		}else{
    			$penggunas = new User;
                $penggunas->kd_pengguna = $req->kd_pengguna;
		    	$penggunas->name = $req->nama;
		    	$penggunas->role = $req->role;
                if($req->id_outlet != '')
                {
                    $penggunas->id_outlet = $req->id_outlet;
                }
		    	$penggunas->avatar = 'default.png';
		    	$penggunas->username = $req->username;
		    	$penggunas->password = Hash::make($req->password);
		    	$penggunas->remember_token = Str::random(60);
		    	$penggunas->save();
		    	Session::flash('tersimpan', 'Pengguna baru berhasil ditambahkan');
		    	return redirect('/kelola_pengguna');
    		}
    	}

    }

    // Mengirim data edit Pengguna
    public function editPengguna($id)
    {
    	$penggunas = User::find($id);
        $outlets = Outlet::all();
    	return view('halaman_pengguna.halaman_edit_pengguna', compact('id', 'penggunas', 'outlets'));
    }

    // Mengubah data Pengguna
    public function updatePengguna(Request $req, $id)
    {
    	$cek_username1 = User::where('username', '=', $req->username)
    	->count();
    	$cek_username2 = User::find($id);
    	if($req->username == $cek_username2->username || $cek_username1 == 0)
    	{
    		if($req->avatar != '')
	    	{
	    		$penggunas = User::find($id);
		    	$penggunas->name = $req->nama;
		    	$penggunas->username = $req->username;
		    	$penggunas->role = $req->role;
                if($req->id_outlet == '')
                {
                    $penggunas->id_outlet = 0;
                }else{
                    $penggunas->id_outlet = $req->id_outlet;
                }
		    	$avatar = $req->file('avatar');
	            $penggunas->avatar = $avatar->getClientOriginalName();
	            $avatar->move(public_path('pictures/'), $avatar->getClientOriginalName());	
	            $penggunas->save();
	            Session::flash('terubah', 'Pengguna berhasil diubah');
			    return redirect('/kelola_pengguna');
	    	}else{
	    		$penggunas = User::find($id);
		    	$penggunas->name = $req->nama;
				$penggunas->username = $req->username;
		    	$penggunas->role = $req->role;
                if($req->id_outlet == '')
                {
                    $penggunas->id_outlet = 0;
                }else{
                    $penggunas->id_outlet = $req->id_outlet;
                }
	            $penggunas->save();
	            Session::flash('terubah', 'Pengguna berhasil diubah');
			    return redirect('/kelola_pengguna');
	    	}
    	}else{
    		Session::flash('tidak_terubah', 'Maaf username telah digunakan');
    		return redirect()->back();
    	}
    }

    // Menghapus Pengguna
    public function hapusPengguna($id)
    {
    	$penggunas = User::find($id);
    	$penggunas->delete();
    	Session::flash('terhapus', 'Pengguna berhasil dihapus');
		return redirect('/kelola_pengguna');
    }
}
