<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SistemLoginController extends Controller
{
    // Membuka Halaman Login
    public function halamanLogin()
    {
        $penggunas = User::all();
    	return view('halaman_login', compact('penggunas'));
    }

    // Verifikasi Login
    public function verifikasiLogin(Request $request)
    {
    	if(Auth::attempt($request->only('username', 'password')))
    	{
    		return redirect('/dashboard');
    	}
        Session::flash('gagal_login', 'Maaf username atau password anda salah');
    	return redirect('/login');
    }

    // Proses Logout
    public function prosesLogout()
    {
    	Auth::logout();
    	return redirect('/login');
    }

    // Registrasi Awal
    public function registrasiAwal(Request $req)
    {
        if($req->avatar != "")
        {
            $penggunas = new User;
            $penggunas->kd_pengguna = "U0001";
            $penggunas->name = $req->nama;
            $penggunas->role = "admin";
            $penggunas->username = $req->username;
            $penggunas->password = Hash::make($req->password);
            $penggunas->remember_token = Str::random(60);
            $avatar = $req->file('avatar');
            $penggunas->avatar = $avatar->getClientOriginalName();
            $avatar->move(public_path('pictures/'), $avatar->getClientOriginalName());
            $penggunas->save();
            Session::flash('tersimpan', 'Registrasi Berhasil');
            return redirect('/login');
        }else{
            $penggunas = new User;
            $penggunas->kd_pengguna = "U0001";
            $penggunas->name = $req->nama;
            $penggunas->role = "admin";
            $penggunas->avatar = "default.png";
            $penggunas->username = $req->username;
            $penggunas->password = Hash::make($req->password);
            $penggunas->remember_token = Str::random(60);
            $penggunas->save();
            Session::flash('tersimpan', 'Registrasi Berhasil');
            return redirect('/login');
        }
    }
}
