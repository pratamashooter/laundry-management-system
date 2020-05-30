<?php

namespace App\Http\Controllers;

use PDF;
use Carbon;
use Session;
use App\User;
use App\Struk;
use App\Outlet;
use App\Transaksi;
use App\Pelanggan;
use App\Paket_kilo;
use App\Paket_satu;
use App\Checkout_kilo;
use App\Checkout_satu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class HalPelangganController extends Controller
{
    // Membuka Halaman Registrasi Pelanggan
    public function registrasiPelanggan()
    {
        $outlets = Outlet::all();
    	return view('halaman_pelanggan.registrasi_pelanggan', compact('outlets'));
    }

    // Membuka Halaman Kelola Pelanggan
    public function halamanPelanggan()
    {
        $pelanggans = Pelanggan::all();
        return view('halaman_pelanggan.halaman_pelanggan', compact('pelanggans'));
    }

    // Membuka Halaman Detail Pelanggan Member
    public function detailPelangganMember($id)
    {
        $pelanggans = Pelanggan::find($id);
        $akun_pelanggans = User::select('users.*')
        ->where('kd_pengguna', $pelanggans->kd_pelanggan)
        ->first();
        $transaksis = Transaksi::join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
        ->select('transaksis.*', 'outlets.nama as nama_outlet')
        ->where('kd_pelanggan', $pelanggans->kd_pelanggan)
        ->get();
        return view('halaman_pelanggan.detail_pelanggan_member', compact('id', 'pelanggans', 'akun_pelanggans', 'transaksis'));
    }

    // Membuka Halaman Detail Pelanggan Non Member
    public function detailPelangganNonMember($id)
    {
        $pelanggans = Pelanggan::find($id);
        $akun_pelanggans = User::select('users.*')
        ->where('kd_pengguna', $pelanggans->kd_pelanggan)
        ->first();
        $transaksis = Transaksi::join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
        ->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
        ->select('transaksis.*', 'outlets.nama as nama_outlet', 'users.name as nama_pegawai')
        ->where('kd_pelanggan', $pelanggans->kd_pelanggan)
        ->first();
        $check_kilo = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        $check_satu = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        if($check_kilo != null){
            $checkout_kilos = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
            ->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.harga_paket as harga_paket_satuan')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->get();
            $checkout_kiloan = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
            ->select('checkout_kilos.*', 'paket_kilos.nama_paket', 'paket_kilos.harga_paket as harga_paket_satuan', 'paket_kilos.antar_jemput_paket')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->first();
            $checkout_satuan = "";
            $checkout_satus = "";
            $harga_total = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
            ->sum('harga_paket');
        }elseif($check_satu != null){
            $checkout_satus = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
            ->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->get();
            $checkout_satuan = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
            ->select('checkout_satus.*', 'paket_satus.nama_barang', 'paket_satus.ket_barang', 'paket_satus.harga_barang as harga_barang_satuan')
            ->where('kd_invoice', $transaksis->kd_invoice)
            ->first();
            $checkout_kiloan = "";
            $checkout_kilos = "";
            $harga_total = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
            ->sum('harga_barang');
        }
        return view('halaman_pelanggan.detail_pelanggan_non_member', compact('id', 'pelanggans', 'akun_pelanggans', 'transaksis', 'checkout_satus', 'checkout_kilos', 'harga_total', 'checkout_satuan', 'checkout_kiloan'));
    }

    // Membuka PDF Pelanggan
    public function pdfPelanggan($id)
    {
        $transaksis = Transaksi::join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
        ->join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
        ->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
        ->select('transaksis.*', 'outlets.nama as nama_outlet', 'outlets.alamat as alamat_outlet', 'outlets.hotline', 'outlets.email as email_outlet', 'pelanggans.nama_pelanggan', 'pelanggans.jk_pelanggan', 'pelanggans.email_pelanggan', 'no_hp_pelanggan', 'pelanggans.password as password_pelanggan', 'pelanggans.cek_member', 'users.name as nama_pegawai')
        ->where('transaksis.id', $id)
        ->first();
        $pelanggans = User::select('users.*')
        ->where('kd_pengguna', $transaksis->kd_pelanggan)
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

        $pdf = PDF::loadview('halaman_pelanggan.pdf_pelanggan', [
            'transaksis' => $transaksis,
            'pelanggans' => $pelanggans,
            'checkout_kilos' => $checkout_kilos,
            'checkout_satus' => $checkout_satus,
            'checkout_kilo' => $checkout_kilo,
            'checkout_satu' => $checkout_satu,
            'harga_paket' => $harga_paket,
            'struks' => $struks
        ]);
        return $pdf->stream();
    }

    // Membuka Halaman Layanan Member
    public function halamanLayananMember($id)
    {
        $outlets = Outlet::all();
        $pelanggans = Pelanggan::find($id);
        $akun_pelanggans = User::select('users.*')
        ->where('kd_pengguna', $pelanggans->kd_pelanggan)
        ->first();
        if($pelanggans->cek_member == 'member')
        {
            return view('halaman_pelanggan.halaman_layanan_member', compact('id', 'outlets', 'pelanggans', 'akun_pelanggans'));
        }else{
            return redirect()->back();
        }
    }

    // Membuka Halaman Transaksi
    public function halamanTransaksi()
    {
        $transaksis = Transaksi::join('pelanggans', 'pelanggans.kd_pelanggan', '=', 'transaksis.kd_pelanggan')
        ->join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
        ->select('transaksis.*', 'pelanggans.nama_pelanggan', 'pelanggans.cek_member', 'outlets.nama as nama_outlet')
        ->get();
        return view('halaman_transaksi.halaman_transaksi', compact('transaksis'));
    }

    // Sortir Outlet Tabel Kiloan
    public function sortOutletTabelKiloan($id)
    {
        $paket_kilos = Paket_kilo::select('paket_kilos.*')
        ->where('paket_kilos.id_outlet', $id)
        ->get();
        return view('halaman_pelanggan.sort_outlet_tabel_kiloan', compact('paket_kilos'));
    }

    // Sortir Outlet Tabel Satuan
    public function sortOutletTabelSatuan($id)
    {
        $paket_satus = Paket_satu::select('paket_satus.*')
        ->where('paket_satus.id_outlet', $id)
        ->get();
        return view('halaman_pelanggan.sort_outlet_tabel_satuan', compact('paket_satus'));
    }

    // Lihat Paket Kiloan Member
    public function lihatPaketKiloMember($id)
    {
        $transaksis = Transaksi::join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
        ->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
        ->select('transaksis.*', 'outlets.nama as nama_outlet', 'users.name as nama_pegawai')
        ->where('transaksis.id', $id)
        ->first();
        $checkout_kilos = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
        ->select('checkout_kilos.id', 'checkout_kilos.kd_invoice', 'checkout_kilos.kd_paket', 'checkout_kilos.berat_barang', 'checkout_kilos.metode_pembayaran', 'checkout_kilos.harga_paket as harga_paket_total', 'checkout_kilos.harga_antar', 'checkout_kilos.harga_total', 'paket_kilos.nama_paket', 'paket_kilos.harga_paket as harga_paket_satuan')
        ->where('kd_invoice', $transaksis->kd_invoice)
        ->get();
        $checkout_kilo = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
        ->select('checkout_kilos.id', 'checkout_kilos.kd_invoice', 'checkout_kilos.kd_paket', 'checkout_kilos.berat_barang', 'checkout_kilos.metode_pembayaran', 'checkout_kilos.harga_paket as harga_paket_total', 'checkout_kilos.harga_antar', 'checkout_kilos.harga_total', 'paket_kilos.nama_paket', 'paket_kilos.antar_jemput_paket')
        ->where('kd_invoice', $transaksis->kd_invoice)
        ->first();
        $paket_kilo_total = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
        ->sum('checkout_kilos.harga_paket');
        return response()->json([
            'transaksis' => $transaksis,
            'checkout_kilos' => $checkout_kilos,
            'checkout_kilo' => $checkout_kilo,
            'paket_kilo_total' => $paket_kilo_total
        ]);
    }

    // Lihat Paket Satuan Member
    public function lihatPaketSatuMember($id)
    {
        $transaksis = Transaksi::join('outlets', 'outlets.id', '=', 'transaksis.id_outlet')
        ->join('users', 'users.kd_pengguna', '=', 'transaksis.kd_pegawai')
        ->select('transaksis.*', 'outlets.nama as nama_outlet', 'users.name as nama_pegawai')
        ->where('transaksis.id', $id)
        ->first();
        $checkout_satus = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
        ->select('checkout_satus.id', 'checkout_satus.kd_invoice', 'checkout_satus.kd_barang', 'checkout_satus.jumlah_barang', 'checkout_satus.metode_pembayaran', 'checkout_satus.harga_barang as harga_barang_total', 'checkout_satus.harga_antar', 'checkout_satus.harga_total', 'paket_satus.nama_barang', 'paket_satus.harga_barang as harga_barang_satuan', 'paket_satus.ket_barang')
        ->where('kd_invoice', $transaksis->kd_invoice)
        ->get();
        $checkout_satu = Checkout_satu::join('paket_satus', 'paket_satus.kd_barang', '=', 'checkout_satus.kd_barang')
        ->select('checkout_satus.id', 'checkout_satus.kd_invoice', 'checkout_satus.kd_barang', 'checkout_satus.jumlah_barang', 'checkout_satus.metode_pembayaran', 'checkout_satus.harga_barang as harga_barang_total', 'checkout_satus.harga_antar', 'checkout_satus.harga_total', 'paket_satus.nama_barang', 'paket_satus.harga_barang as harga_barang_satuan', 'paket_satus.ket_barang')
        ->where('kd_invoice', $transaksis->kd_invoice)
        ->first();
        $paket_satu_total = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
        ->sum('checkout_satus.harga_barang');
        return response()->json([
            'transaksis' => $transaksis,
            'checkout_satus' => $checkout_satus,
            'checkout_satu' => $checkout_satu,
            'paket_satu_total' => $paket_satu_total
        ]);
    }

    // Update Status Transaksi
    public function updateStatusTransaksi($id, $status)
    {
        $transaksis = Transaksi::find($id);
        if($transaksis->status != $status)
        {
            $hari_ini = Carbon\Carbon::now();
            $hari_ini2 = $hari_ini->isoFormat('Y-M-D');
            if ($status == 'selesai')
            {
                $transaksis->tgl_selesai = $hari_ini2;
                $transaksis->status = $status;
                // $check_kilo = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
                // ->count();
                // $check_satu = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
                // ->count();
                // if($check_kilo == 1){
                //     $checkout_kilos = Checkout_kilo::join('paket_kilos', 'paket_kilos.kd_paket', '=', 'checkout_kilos.kd_paket')
                //     ->select('checkout_kilos.*', 'paket_kilos.antar_jemput_paket')
                //     ->where('checkout_kilos.kd_invoice', $transaksis->kd_invoice)
                //     ->first();
                //     if(($checkout_kilos->antar_jemput_paket == 1 && $transaksis->tgl_bayar != null) || ($checkout_kilos->harga_antar != 0 && $transaksis->tgl_bayar != null))
                //     {
                //         $transaksis->status = 'diantar';
                //     }else{
                //         $transaksis->status = $status;
                //     }
                // }elseif ($check_satu != 0){
                //     $checkout_satus = Checkout_satu::select('checkout_satus.*')
                //     ->where('kd_invoice', $transaksis->kd_invoice)
                //     ->first();
                //     if($checkout_satus->harga_antar != 0 && $transaksis->tgl_bayar != null){
                //         $transaksis->status = 'diantar';
                //     }else{
                //         $transaksis->status = $status;
                //     }
                // }
            }elseif ($status != 'selesai' && $transaksis->tgl_selesai != ''){
                $transaksis->tgl_selesai = $transaksis->tgl_selesai;
                $transaksis->status = $status;
            }else {
                $transaksis->tgl_selesai = null;
                $transaksis->status = $status;
            }
            $transaksis->save();
            Session::flash('terubah_status', 'Status transaksi berhasil diubah');
            echo $status;
        }
    }

    // Menghapus Pesanan Kiloan
    public function hapusPesananKilo($id)
    {
        $transaksis = Transaksi::find($id);
        $checkout_kilos = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
        ->delete();
        $check_struk = Struk::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        if($check_struk != 0){
            $struks = Struk::where('kd_invoice', $transaksis->kd_invoice)
            ->delete();
        }
        $transaksis->delete();
        Session::flash('batal_pesan', 'Pesanan berhasil dibatalkan');
    }

    // Menghapus Pesanan Satuan
    public function hapusPesananSatu($id)
    {
        $transaksis = Transaksi::find($id);
        $checkout_satus = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
        ->delete();
        $check_struk = Struk::where('kd_invoice', $transaksis->kd_invoice)
        ->count();
        if($check_struk != 0){
            $struks = Struk::where('kd_invoice', $transaksis->kd_invoice)
            ->delete();
        }
        $transaksis->delete();
        Session::flash('batal_pesan', 'Pesanan berhasil dibatalkan');
    }

    // Menghapus Pelanggan
    public function hapusPelanggan($id)
    {
        $pelanggans = Pelanggan::find($id);
        $check_transaksi = Transaksi::where('kd_pelanggan', $pelanggans->kd_pelanggan)
        ->count();
        if($check_transaksi > 1){
            $transaksis = Transaksi::select('transaksis.*')
            ->where('kd_pelanggan', $pelanggans->kd_pelanggan)
            ->get();
            foreach ($transaksis as $transaksi) {
                $check_kilo = Checkout_kilo::where('kd_invoice', $transaksi->kd_invoice)
                ->count();
                $check_satu = Checkout_satu::where('kd_invoice', $transaksi->kd_invoice)
                ->count();
                $check_struk = Struk::where('kd_invoice', $transaksi->kd_invoice)
                ->count();
                if($check_kilo != 0){
                    $checkout_kilos = Checkout_kilo::where('kd_invoice', $transaksi->kd_invoice)
                    ->delete();
                }
                if($check_satu != 0){
                    $checkout_satus = Checkout_satu::where('kd_invoice', $transaksi->kd_invoice)
                    ->delete();
                }
                if($check_struk != 0){
                    $struks = Struk::where('kd_invoice', $transaksi->kd_invoice)
                    ->delete();
                }
            }
        }elseif($check_transaksi == 1){
            $transaksis = Transaksi::select('transaksis.*')
            ->where('kd_pelanggan', $pelanggans->kd_pelanggan)
            ->first();
            $check_kilo = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
            ->count();
            $check_satu = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
            ->count();
            $check_struk = Struk::where('kd_invoice', $transaksis->kd_invoice)
            ->count();
            if($check_kilo != 0){
                $checkout_kilos = Checkout_kilo::where('kd_invoice', $transaksis->kd_invoice)
                ->delete();
            }
            if($check_satu != 0){
                $checkout_satus = Checkout_satu::where('kd_invoice', $transaksis->kd_invoice)
                ->delete();    
            }
            if($check_struk != 0){
                $struks = Struk::where('kd_invoice', $transaksis->kd_invoice)
                ->delete();
            }
        }
        $transaksi_delete = Transaksi::where('kd_pelanggan', $pelanggans->kd_pelanggan)
        ->delete();
        $akun_pelanggans = User::where('kd_pengguna', $pelanggans->kd_pelanggan)
        ->delete();
        $pelanggans->delete();
        Session::flash('terhapus', 'Pelanggan berhasil dihapus');
        return redirect('/kelola_pelanggan');
    }

    // Menyimpan Pesanan Member
    public function simpanPesanan(Request $req)
    {
        $max_transaksi = Transaksi::max('kd_invoice');
        $check_max_transkasi = Transaksi::select('transaksis.kd_invoice')
        ->count();
        if($check_max_transkasi == null){
            $max_code_transaksi = "I0001";
        }else{
            $max_code_transaksi = $max_transaksi[1].$max_transaksi[2].$max_transaksi[3].$max_transaksi[4];
            $max_code_transaksi++;
            if($max_code_transaksi <= 9){
                $max_code_transaksi = "I000".$max_code_transaksi;
            }elseif ($max_code_transaksi <= 99) {
                $max_code_transaksi = "I00".$max_code_transaksi;
            }elseif ($max_code_transaksi <= 999) {
                $max_code_transaksi = "I0".$max_code_transaksi;
            }elseif ($max_code_transaksi <= 9999) {
                $max_code_transaksi = "I".$max_code_transaksi;
            }
        }

        $hari_ini = Carbon\Carbon::now();
        $hari_ini2 = $hari_ini->isoFormat('Y-M-D');
        $hari_ini3 = Carbon\Carbon::create($hari_ini2);

        if($req->bayar_bayar_kilo != null)
        {
            $struks = new Struk;
            $struks->kd_invoice = $max_code_transaksi;
            $struks->harga_total = $req->total_bayar_kilo_2;
            $struks->harga_bayar = $req->bayar_bayar_kilo;
            $struks->harga_kembali = $req->kembali_bayar_kilo_2;
            $struks->save();
        }

        if($req->bayar_bayar_satu != null)
        {
            $struks = new Struk;
            $struks->kd_invoice = $max_code_transaksi;
            $struks->harga_total = $req->total_bayar_satu_2;
            $struks->harga_bayar = $req->bayar_bayar_satu;
            $struks->harga_kembali = $req->kembali_bayar_satu_2;
            $struks->save();
        }

        if($req->jenis_laundry == 'kiloan')
        {
            $haris = Paket_kilo::select('paket_kilos.*')
            ->where('kd_paket', $req->jenis_paket)
            ->first();
            $hari_kedepan = $hari_ini3->addDays($haris->hari_paket)->isoFormat('Y-M-D');
            $transaksis = new Transaksi;
            $transaksis->id_outlet = $req->pilih_outlet;
            $transaksis->kd_invoice = $max_code_transaksi;
            $transaksis->kd_pelanggan = $req->kd_pelanggan;
            $transaksis->tgl_pemberian = $hari_ini2;
            $transaksis->tgl_selesai = $hari_kedepan;
            $transaksis->status = "baru";
            if($req->bayar_bayar_kilo != null)
            {
                $transaksis->tgl_bayar = $hari_ini2;
                $transaksis->diskon = $req->diskon_bayar_kilo;
                $transaksis->pajak = $req->pajak_bayar_kilo;
                $transaksis->ket_bayar = "dibayar";
            }else{
                $transaksis->ket_bayar = "belum_dibayar";
            }
            $transaksis->kd_pegawai = $req->user()->kd_pengguna;
            $transaksis->save();

            $checkout_kilos = new Checkout_kilo;
            $checkout_kilos->kd_invoice = $max_code_transaksi;
            $checkout_kilos->kd_paket = $req->jenis_paket;
            $checkout_kilos->berat_barang = $req->berat_barang;
            $checkout_kilos->metode_pembayaran = $req->metode_pembayaran_kilo;
            $checkout_kilos->harga_paket = $req->harga_paket_kiloan;
            if($req->antar_harga_kiloan != '')
            {
                $checkout_kilos->harga_antar = $req->antar_harga_kiloan;
            }else{
                $checkout_kilos->harga_antar = 0;
            }
            $checkout_kilos->harga_total = $req->total_kiloan_rp;
            $checkout_kilos->save();
        }elseif($req->jenis_laundry == 'satuan'){
            $transaksis = new Transaksi;
            $transaksis->id_outlet = $req->pilih_outlet;
            $transaksis->kd_invoice = $max_code_transaksi;
            $transaksis->kd_pelanggan = $req->kd_pelanggan;
            $transaksis->tgl_pemberian = $hari_ini2;
            $transaksis->status = "baru";
            if($req->bayar_bayar_satu != null)
            {
                $transaksis->tgl_bayar = $hari_ini2;
                $transaksis->diskon = $req->diskon_bayar_satu;
                $transaksis->pajak = $req->pajak_bayar_satu;
                $transaksis->ket_bayar = "dibayar";
            }else{
                $transaksis->ket_bayar = "belum_dibayar";
            }
            $transaksis->kd_pegawai = $req->user()->kd_pengguna;
            $transaksis->save();

            $jml_barang = count($req->kd_barang);
            for ($i=0; $i < $jml_barang; $i++) { 
                if($req->jumlah_barang[$i] != 0)
                {
                    $checkout_satus = new Checkout_satu;
                    $checkout_satus->kd_invoice = $max_code_transaksi;
                    $checkout_satus->kd_barang = $req->kd_barang[$i];
                    $checkout_satus->jumlah_barang = $req->jumlah_barang[$i];
                    $checkout_satus->metode_pembayaran = $req->metode_pembayaran_satu;
                    $checkout_satus->harga_barang = $req->subtotal[$i];
                    if($req->antar_harga_satuan != '')
                    {
                        $checkout_satus->harga_antar = $req->antar_harga_satuan;
                    }else{
                        $checkout_satus->harga_antar = 0;
                    }
                    $checkout_satus->harga_total = $req->total_satuan_rp;
                    $checkout_satus->save();
                }
            }
        }
        Session::flash('tersimpan', 'Pesanan baru berhasil dibuat');
        echo "sukses";
    }

    // Menyimpan Pelanggan Baru
    public function simpanPelanggan(Request $req)
    {
        $cek_username = User::where('username', '=', $req->username)
        ->count();
        if($cek_username == 1)
        {
            echo "gagal";
        }else{
            $max_pelanggan = Pelanggan::max('kd_pelanggan');
            $max_transaksi = Transaksi::max('kd_invoice');
            $check_max_pelanggan = Pelanggan::select('pelanggans.kd_pelanggan')
            ->count();
            $check_max_transkasi = Transaksi::select('transaksis.kd_invoice')
            ->count();
            if($check_max_transkasi == null){
                $max_code_transaksi = "I0001";
            }else{
                $max_code_transaksi = $max_transaksi[1].$max_transaksi[2].$max_transaksi[3].$max_transaksi[4];
                $max_code_transaksi++;
                if($max_code_transaksi <= 9){
                    $max_code_transaksi = "I000".$max_code_transaksi;
                }elseif ($max_code_transaksi <= 99) {
                    $max_code_transaksi = "I00".$max_code_transaksi;
                }elseif ($max_code_transaksi <= 999) {
                    $max_code_transaksi = "I0".$max_code_transaksi;
                }elseif ($max_code_transaksi <= 9999) {
                    $max_code_transaksi = "I".$max_code_transaksi;
                }
            }
            if($check_max_pelanggan == null){
                $max_code_pelanggan = "K0001";
            }else{
                $max_code_pelanggan = $max_pelanggan[1].$max_pelanggan[2].$max_pelanggan[3].$max_pelanggan[4];
                $max_code_pelanggan++;
                if($max_code_pelanggan <= 9){
                    $max_code_pelanggan = "K000".$max_code_pelanggan;
                }elseif ($max_code_pelanggan <= 99) {
                    $max_code_pelanggan = "K00".$max_code_pelanggan;
                }elseif ($max_code_pelanggan <= 999) {
                    $max_code_pelanggan = "K0".$max_code_pelanggan;
                }elseif ($max_code_pelanggan <= 9999) {
                    $max_code_pelanggan = "K".$max_code_pelanggan;
                }
            }

            $hari_ini = Carbon\Carbon::now();
            $hari_ini2 = $hari_ini->isoFormat('Y-M-D');
            $hari_ini3 = Carbon\Carbon::create($hari_ini2);

            if($req->bayar_bayar_kilo != null)
            {
                $struks = new Struk;
                $struks->kd_invoice = $max_code_transaksi;
                $struks->harga_total = $req->total_bayar_kilo_2;
                $struks->harga_bayar = $req->bayar_bayar_kilo;
                $struks->harga_kembali = $req->kembali_bayar_kilo_2;
                $struks->save();
            }

            if($req->bayar_bayar_satu != null)
            {
                $struks = new Struk;
                $struks->kd_invoice = $max_code_transaksi;
                $struks->harga_total = $req->total_bayar_satu_2;
                $struks->harga_bayar = $req->bayar_bayar_satu;
                $struks->harga_kembali = $req->kembali_bayar_satu_2;
                $struks->save();
            }

            if($req->jenis_laundry == 'kiloan')
            {
                $haris = Paket_kilo::select('paket_kilos.*')
                ->where('kd_paket', $req->jenis_paket)
                ->first();
                $hari_kedepan = $hari_ini3->addDays($haris->hari_paket)->isoFormat('Y-M-D');
                $transaksis = new Transaksi;
                $transaksis->id_outlet = $req->pilih_outlet;
                $transaksis->kd_invoice = $max_code_transaksi;
                $transaksis->kd_pelanggan = $max_code_pelanggan;
                $transaksis->tgl_pemberian = $hari_ini2;
                $transaksis->tgl_selesai = $hari_kedepan;
                $transaksis->status = "baru";
                if($req->bayar_bayar_kilo != null)
                {
                    $transaksis->tgl_bayar = $hari_ini2;
                    $transaksis->diskon = $req->diskon_bayar_kilo;
                    $transaksis->pajak = $req->pajak_bayar_kilo;
                    $transaksis->ket_bayar = "dibayar";
                }else{
                    $transaksis->ket_bayar = "belum_dibayar";
                }
                $transaksis->kd_pegawai = $req->user()->kd_pengguna;
                $transaksis->save();

                $checkout_kilos = new Checkout_kilo;
                $checkout_kilos->kd_invoice = $max_code_transaksi;
                $checkout_kilos->kd_paket = $req->jenis_paket;
                $checkout_kilos->berat_barang = $req->berat_barang;
                $checkout_kilos->metode_pembayaran = $req->metode_pembayaran_kilo;
                $checkout_kilos->harga_paket = $req->harga_paket_kiloan;
                if($req->antar_harga_kiloan != '')
                {
                    $checkout_kilos->harga_antar = $req->antar_harga_kiloan;
                }else{
                    $checkout_kilos->harga_antar = 0;
                }
                $checkout_kilos->harga_total = $req->total_kiloan_rp;
                $checkout_kilos->save();
            }
            elseif($req->jenis_laundry == 'satuan')
            {
                $transaksis = new Transaksi;
                $transaksis->id_outlet = $req->pilih_outlet;
                $transaksis->kd_invoice = $max_code_transaksi;
                $transaksis->kd_pelanggan = $max_code_pelanggan;
                $transaksis->tgl_pemberian = $hari_ini2;
                $transaksis->status = "baru";
                if($req->bayar_bayar_satu != null)
                {
                    $transaksis->tgl_bayar = $hari_ini2;
                    $transaksis->diskon = $req->diskon_bayar_satu;
                    $transaksis->pajak = $req->pajak_bayar_satu;
                    $transaksis->ket_bayar = "dibayar";
                }else{
                    $transaksis->ket_bayar = "belum_dibayar";
                }
                $transaksis->kd_pegawai = $req->user()->kd_pengguna;
                $transaksis->save();

                $jml_barang = count($req->kd_barang);
                for ($i=0; $i < $jml_barang; $i++) { 
                    if($req->jumlah_barang[$i] != 0)
                    {
                        $checkout_satus = new Checkout_satu;
                        $checkout_satus->kd_invoice = $max_code_transaksi;
                        $checkout_satus->kd_barang = $req->kd_barang[$i];
                        $checkout_satus->jumlah_barang = $req->jumlah_barang[$i];
                        $checkout_satus->metode_pembayaran = $req->metode_pembayaran_satu;
                        $checkout_satus->harga_barang = $req->subtotal[$i];
                        if($req->antar_harga_satuan != '')
                        {
                            $checkout_satus->harga_antar = $req->antar_harga_satuan;
                        }else{
                            $checkout_satus->harga_antar = 0;
                        }
                        $checkout_satus->harga_total = $req->total_satuan_rp;
                        $checkout_satus->save();
                    }
                }
            }

            $pelanggans = new Pelanggan;
            $pelanggans->kd_pelanggan = $max_code_pelanggan;
            $pelanggans->nama_pelanggan = $req->nama_pelanggan;
            $pelanggans->jk_pelanggan = $req->jk_pelanggan;
            $pelanggans->email_pelanggan = $req->email_pelanggan;
            $pelanggans->no_hp_pelanggan = $req->no_hp_pelanggan;
            $pelanggans->alamat_pelanggan = $req->alamat_pelanggan;
            if($req->cek_member == 1)
            {
                $pelanggans->cek_member = "member";
            }else{
                $pelanggans->cek_member = "non_member";
            }
            $pelanggans->password = $req->password;
            $pelanggans->save();

            $penggunas = new User;
            $penggunas->kd_pengguna = $max_code_pelanggan;
            $penggunas->name = $req->nama_pelanggan;
            if($req->cek_member == 1)
            {
                $penggunas->role = "member";
            }else{
                $penggunas->role = "non_member";
            }
            $penggunas->avatar = 'default.png';
            $penggunas->username = $req->username;
            $penggunas->password = Hash::make($req->password);
            $penggunas->remember_token = Str::random(60);
            $penggunas->save();

            Session::flash('tersimpan', 'Pelanggan baru berhasil ditambahkan');
            echo "sukses";
        }
        
    }

    public function cekFungsi()
    {
        // $mytime = Carbon\Carbon::now();
        // $today = $mytime->isoFormat('Y-M-D');
        // $forward = Carbon\Carbon::create($today);
        // $forward_days = $forward->addDays(4)->isoFormat('Y-M-D');
        // echo $today . '<br>' . $forward_days;

        // $array = [0, 1, 2, 3, 4];
        // echo count($array);
    }
}
