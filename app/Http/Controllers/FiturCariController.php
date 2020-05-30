<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class FiturCariController extends Controller
{
    // Fitur Cari Halaman
    public function cariHalaman($kata)
    {
    	$halaman_admin = array(
    		'dashboard' => 'Dashboard',
    		'kelola_profil' => 'Kelola Profil',
    		'kelola_pengguna' => 'Kelola Pengguna',
    		'tambah_pengguna' => 'Tambah Pengguna',
    		'kelola_paket' => 'Kelola Paket',
    		'tambah_paket_kiloan' => 'Tambah Paket Kiloan',
    		'tambah_paket_satuan' => 'Tambah Paket Satuan',
    		'kelola_outlet' => 'Kelola Outlet',
    		'tambah_outlet' => 'Tambah Outlet',
    		'registrasi_pelanggan' => 'Registrasi Pelanggan',
    		'kelola_pelanggan' => 'Kelola Pelanggan',
    		'kelola_transaksi' => 'Transaksi',
    		'laporan_pegawai' => 'Laporan Pegawai',
    		'laporan_transaksi' => 'Laporan Transaksi'
    	);
    	$halaman_kasir = array(
    		'dashboard' => 'Dashboard',
    		'kelola_profil' => 'Kelola Profil',
    		'registrasi_pelanggan' => 'Registrasi Pelanggan',
    		'kelola_pelanggan' => 'Kelola Pelanggan',
    		'kelola_transaksi' => 'Transaksi',
    		'laporan_pegawai' => 'Laporan Pegawai',
    		'laporan_transaksi' => 'Laporan Transaksi'
    	);
    	$halaman_pelanggan = array(
    		'dashboard' => 'Dashboard',
            'pesanan_saya' => 'Pesanan Saya'
    	);
    	$data_trash = array();
    	$data_result = array();
    	if(Auth::user()->role == 'admin'){
    		$number = 0;
    		foreach ($halaman_admin as $key => $page) {
    			if (stripos($page, $kata) === FALSE) {
    				$data_trash[$number] = array(
    					'page_name' => $page,
    					'page_url' => $key
    				);
				}else{
					$data_result[$number] = array(
						'page_name' => $page,
						'page_url' => $key
					);
				$number += 1;
				}
    		}
    	}elseif(Auth::user()->role == 'kasir'){
    		$number = 0;
    		foreach ($halaman_kasir as $key => $page) {
    			if (stripos($page, $kata) === FALSE) {
    				$data_trash[$number] = array(
    					'page_name' => $page,
    					'page_url' => $key
    				);
				}else{
					$data_result[$number] = array(
						'page_name' => $page,
						'page_url' => $key
					);
				$number += 1;
				}
    		}
    	}elseif(Auth::user()->role == 'member' || Auth::user()->role == 'non_member'){
    		$number = 0;
    		foreach ($halaman_pelanggan as $key => $page) {
    			if (stripos($page, $kata) === FALSE) {
    				$data_trash[$number] = array(
    					'page_name' => $page,
    					'page_url' => $key
    				);
				}else{
					$data_result[$number] = array(
						'page_name' => $page,
						'page_url' => $key
					);
				$number += 1;
				}
    		}
    	}

    	// echo json_encode($data_result);
    	return response()->json($data_result);
    }
}
