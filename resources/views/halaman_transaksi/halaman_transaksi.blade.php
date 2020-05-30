@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
<style type="text/css">
.btn-member-pelanggan{
	background-color: #fff;
	border-radius: 5px;
	width: 200px;
	overflow: hidden;
}
.btn-member{
	float: left;
	text-align: center;
	text-decoration: none;
	background-color: #fff;
	font-weight: bold;
	padding: 10px;
	border-radius: 0px;
}
.btn-member-border{
	border-bottom: 2px solid #7571f9;
}
.table_modal tr td, .table_modal tr th{
    padding: 5px;
    font-size: 12px;
}
.table_paket{
    font-size: 12px;
}
.table-total{
    font-size: 12px;
}
.table-pembayaran{
    font-size: 14px;
}
.line-total{
    width: 100%;
    border-top: 2px solid #dfdfdf;
}
.line-pembayaran{
    width: 100%;
    border-top: 1px solid #dfdfdf;
}
.table-total tr th, .table-total tr td, .table-pembayaran tr th, .table-pembayaran tr td{
    padding: 3px;
}
.gif-antar{
    object-fit: cover;
    width: 10rem;
    height: 10rem;
}
.gif-ambil{
    object-fit: cover;
    width: 13rem;
    height: 13rem;
    margin-top: -10px;
    margin-bottom: -10px;
}
</style>
@endsection
@section('konten')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Layanan Laundry</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/kelola_transaksi') }}">Transaksi</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" hidden="">
            <input type="text" name="id_pdf" class="id_pdf">
        </div>
        <div class="col-md-12">
            <div class="modal fade" id="lihatTransaksiDiambil">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Keterangan</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="default-tab">
                                        <ul class="nav nav-tabs mb-3">
                                            <li class="nav-item"><a href="#identitas-tab-diambil" class="nav-link identitas-btn-diambil active" data-toggle="tab" aria-expanded="false">Identitas</a>
                                            </li>
                                            <li class="nav-item"><a href="#paket-tab-diambil" class="nav-link paket-btn-diambil" data-toggle="tab" aria-expanded="false">Paket</a>
                                            </li>
                                            <li class="nav-item"><a href="#pembayaran-tab-diambil" class="nav-link pembayaran-btn-diambil" data-toggle="tab" aria-expanded="true">Pembayaran</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content br-n pn">
                                            <div id="identitas-tab-diambil" class="tab-pane active">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <h4>Pesanan telah diterima</h4>
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <img src="{{ asset('gif/completed.gif') }}" class="gif-ambil">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table border="0" class="table_modal">
                                                            <tr>
                                                                <th class="align-top">Nama</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_nama_ambil align-top"></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="align-top">Gender</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_jk_ambil align-top"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table border="0" class="table_modal">
                                                            <tr>
                                                                <th class="align-top">Email</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_email_ambil align-top"></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="align-top">No Hp</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_no_hp_ambil align-top"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="paket-tab-diambil" class="tab-pane">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table border="0" class="table_modal">
                                                            <tr>
                                                                <th class="align-top">Tanggal pemberian</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_tgl_pemberian_ambil align-top"></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="align-top">Tanggal selesai</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_tgl_selesai_ambil align-top"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table border="0" class="table_modal">
                                                            <tr>
                                                                <th class="align-top">Tanggal bayar</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_tgl_bayar_ambil align-top"></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="align-top">Pegawai</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_pegawai_ambil align-top"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table header-border table_paket table_kiloan_ambil" width="100">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">No</th>
                                                                        <th scope="col">Paket</th>
                                                                        <th scope="col">Berat Barang</th>
                                                                        <th scope="col">Harga</th>
                                                                        <th scope="col">Subtotal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="isi_paket_kilo_ambil">
                                                                </tbody>
                                                            </table>
                                                            <table class="table header-border table_paket table_satuan_ambil" width="100" hidden="">
                                                                <thead class="text-center">
                                                                    <tr>
                                                                        <th scope="col">No</th>
                                                                        <th scope="col">Barang</th>
                                                                        <th scope="col">Keterangan</th>
                                                                        <th scope="col">Jumlah</th>
                                                                        <th scope="col">Harga</th>
                                                                        <th scope="col">Subtotal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="isi_paket_satu_ambil">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 offset-md-6">
                                                        <table style="width: 100%;" class="table-total">
                                                            <tr>
                                                                <td colspan="2" class="line-total"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total Paket</th>
                                                                <td class="modal_ambil_total_paket font-weight-bold"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="pembayaran-tab-diambil" class="tab-pane">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="modal_ambil_subtotal_paket"></li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="modal_ambil_biaya_antar"></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-12 line-pembayaran-diambil" style="margin-top: -15px;">
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-6 offset-md-6">
                                                        <table style="width: 100%;" class="table-pembayaran text-left">
                                                            <tr>
                                                                <td>Subtotal</td>
                                                                <td class="text-right modal_ambil_subtotal"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Diskon</td>
                                                                <td class="text-right modal_ambil_diskon"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pajak</td>
                                                                <td class="text-right modal_ambil_pajak"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="line-pembayaran"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total</th>
                                                                <td class="text-right modal_ambil_total"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Bayar</th>
                                                                <th class="text-success text-right modal_ambil_bayar"></th>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="line-pembayaran"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kembali</th>
                                                                <th class="text-right modal_ambil_kembali"></th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button type="button" class="btn btn-primary btn-block btn-flat font-weight-bold pdf-btn"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Cetak PDF</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="modal fade" id="lihatTransaksiDiantar">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Keterangan</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="default-tab">
                                        <ul class="nav nav-tabs mb-3">
                                            <li class="nav-item"><a href="#identitas-tab-diantar" class="nav-link identitas-btn-diantar active" data-toggle="tab" aria-expanded="false">Identitas</a>
                                            </li>
                                            <li class="nav-item"><a href="#paket-tab-diantar" class="nav-link paket-btn-diantar" data-toggle="tab" aria-expanded="false">Paket</a>
                                            </li>
                                            <li class="nav-item"><a href="#pembayaran-tab-diantar" class="nav-link pembayaran-btn-diantar" data-toggle="tab" aria-expanded="true">Pembayaran</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content br-n pn">
                                            <div id="identitas-tab-diantar" class="tab-pane active">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <h4>Pesanan sedang diantar</h4>
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <img src="{{ asset('gif/scooter-running.gif') }}" class="gif-antar">
                                                    </div>
                                                    <div class="col-md-12 text-center" style="max-width: 500px;">
                                                        <p class="lokasi_alamat_antar"></p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table border="0" class="table_modal">
                                                            <tr>
                                                                <th class="align-top">Nama</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_nama_antar align-top"></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="align-top">Gender</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_jk_antar align-top"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table border="0" class="table_modal">
                                                            <tr>
                                                                <th class="align-top">Email</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_email_antar align-top"></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="align-top">No Hp</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_no_hp_antar align-top"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="paket-tab-diantar" class="tab-pane">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table border="0" class="table_modal">
                                                            <tr>
                                                                <th class="align-top">Tanggal pemberian</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_tgl_pemberian_antar align-top"></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="align-top">Tanggal selesai</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_tgl_selesai_antar align-top"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table border="0" class="table_modal">
                                                            <tr>
                                                                <th class="align-top">Tanggal bayar</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_tgl_bayar_antar align-top"></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="align-top">Pegawai</th>
                                                                <td class="align-top">:</td>
                                                                <td class="modal_pegawai_antar align-top"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table header-border table_paket table_kiloan_antar" width="100">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">No</th>
                                                                        <th scope="col">Paket</th>
                                                                        <th scope="col">Berat Barang</th>
                                                                        <th scope="col">Harga</th>
                                                                        <th scope="col">Subtotal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="isi_paket_kilo_antar">
                                                                </tbody>
                                                            </table>
                                                            <table class="table header-border table_paket table_satuan_antar" width="100" hidden="">
                                                                <thead class="text-center">
                                                                    <tr>
                                                                        <th scope="col">No</th>
                                                                        <th scope="col">Barang</th>
                                                                        <th scope="col">Keterangan</th>
                                                                        <th scope="col">Jumlah</th>
                                                                        <th scope="col">Harga</th>
                                                                        <th scope="col">Subtotal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="isi_paket_satu_antar">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 offset-md-6">
                                                        <table style="width: 100%;" class="table-total">
                                                            <tr>
                                                                <td colspan="2" class="line-total"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total Paket</th>
                                                                <td class="modal_antar_total_paket font-weight-bold"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="pembayaran-tab-diantar" class="tab-pane">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="modal_antar_subtotal_paket"></li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="modal_antar_biaya_antar"></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-12 line-pembayaran-diantar" style="margin-top: -15px;">
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-6 offset-md-6">
                                                        <table style="width: 100%;" class="table-pembayaran text-left">
                                                            <tr>
                                                                <td>Subtotal</td>
                                                                <td class="text-right modal_antar_subtotal"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Diskon</td>
                                                                <td class="text-right modal_antar_diskon"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pajak</td>
                                                                <td class="text-right modal_antar_pajak"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="line-pembayaran"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total</th>
                                                                <td class="text-right modal_antar_total"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Bayar</th>
                                                                <th class="text-success text-right modal_antar_bayar"></th>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="line-pembayaran"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kembali</th>
                                                                <th class="text-right modal_antar_kembali"></th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button type="button" class="btn btn-primary btn-block btn-flat font-weight-bold pdf-btn"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Cetak PDF</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="modal fade" id="lihatTransaksiSelesai">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Keterangan</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table border="0" class="table_modal">
                                        <tr>
                                            <th class="align-top">Kode Pelanggan</th>
                                            <td class="align-top">:</td>
                                            <td class="modal_kd_pelanggan align-top"></td>
                                        </tr>
                                        <tr>
                                            <th class="align-top">Nama</th>
                                            <td class="align-top">:</td>
                                            <td class="modal_nama_pelanggan align-top"></td>
                                        </tr>
                                        <tr>
                                            <th class="align-top">Gender</th>
                                            <td class="align-top">:</td>
                                            <td class="modal_jk_pelanggan align-top"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table border="0" class="table_modal">
                                        <tr>
                                            <th class="align-top">Email</th>
                                            <td class="align-top">:</td>
                                            <td class="modal_email_pelanggan align-top"></td>
                                        </tr>
                                        <tr>
                                            <th class="align-top">No Hp</th>
                                            <td class="align-top">:</td>
                                            <td class="modal_no_hp_pelanggan align-top"></td>
                                        </tr>
                                        <tr>
                                            <th class="align-top">Alamat</th>
                                            <td class="align-top">:</td>
                                            <td class="modal_alamat_pelanggan align-top"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table header-border table_paket table_kiloan" width="100">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Paket</th>
                                                    <th scope="col">Berat Barang</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="isi_paket_kilo">
                                            </tbody>
                                        </table>
                                        <table class="table header-border table_paket table_satuan" width="100" hidden="">
                                            <thead class="text-center">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Barang</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="isi_paket_satu">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-6">
                                    <table style="width: 100%;" class="table-total">
                                        <tr>
                                            <th>Total Paket</th>
                                            <td class="modal_total_paket"></td>
                                        </tr>
                                        <tr class="ket_biaya_antar">
                                            <th>Biaya Antar</th>
                                            <td class="modal_harga_antar"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="line-total"></td>
                                        </tr>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td class="modal_total"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <form class="bayar_form" method="POST">
                                        @csrf
                                        <div class="row" hidden="">
                                            <div class="col-md-12">
                                                <input type="text" name="id_transaksi_input" class="id_transaksi_input">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Subtotal</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input type="text" readonly="readonly" name="sub_total_bayar" class="form-control sub_total_bayar">
                                                    <input type="text" readonly="readonly" name="sub_total_bayar_2" class="form-control sub_total_bayar_2" hidden="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Diskon</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="number" min="0" max="100" name="diskon_bayar" class="form-control diskon_bayar">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Pajak</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="number" min="0" max="100" name="pajak_bayar" class="form-control pajak_bayar">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Total</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input type="text" readonly="readonly" name="total_bayar" class="form-control total_bayar">
                                                    <input type="text" readonly="readonly" name="total_bayar_2" class="form-control total_bayar_2" hidden="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Bayar</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input type="text" name="bayar_bayar" class="form-control bayar_bayar number_input">
                                                </div>
                                                <div class="bayar_bayar_error"></div>
                                                <div class="kurang_bayar_error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Kembali</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input type="text" readonly="readonly" name="kembali_bayar" class="form-control kembali_bayar">
                                                    <input type="text" readonly="readonly" name="kembali_bayar_2" class="form-control kembali_bayar_2" hidden="">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <button class="btn btn-primary btn-block bayar_btn font-weight-bold" type="button">Bayar</button>
                                        <button class="btn btn-primary btn-block diantar_btn font-weight-bold" type="button" hidden="">Antar Barang</button>
                                        <button class="btn btn-primary btn-block diambil_btn font-weight-bold" type="button" hidden="">Barang Diambil</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-md-4">
    		<div class="btn-member-pelanggan d-flex justify-content-center">
    			<button class="btn btn-member member-btn btn-member-border">Member</button>
    			<button class="btn btn-member non_member-btn">Non Member</button>
    		</div>
    	</div>
	</div>
	<div class="row m-4">
		<div class="col-md-12">
			<div class="row">
                <div class="col-md-3 text-left">
                    <h4>Daftar Pesanan</h4>
                </div>
                <div class="col-md-9" style="margin-top: -10px;">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-flat btn-primary" id="selesai-btn">Selesai</button>
                        <button class="btn btn-flat btn-outline-primary ml-2" id="diantar-btn">Diantar</button>
                        <button class="btn btn-flat btn-outline-primary ml-2" id="diambil-btn">Diambil</button>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<div class="row" style="margin-top: -15px;">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive" id="member_table_selesai">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Outlet</th>
                                    <th>Kode Invoice</th>
                                    <th>Nama</th>
                                    <th>Tgl Pemberian</th>
                                    <th>Tgl Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $number1 = 1 ?>
                            	@foreach($transaksis as $transaksi)
                            	@if($transaksi->cek_member == 'member' && $transaksi->status == 'selesai')
                            	<tr>
                            		<th class="align-middle text-center">{{ $number1 }}</th>
                            		<th>{{ $transaksi->nama_outlet }}</th>
                            		<td>{{ $transaksi->kd_invoice }}</td>
                            		<td>{{ $transaksi->nama_pelanggan }}</td>
                            		<td>{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
                            		<td>{{ date('d M Y', strtotime($transaksi->tgl_selesai)) }}</td>
                            		<td class="text-center">
                            			<span class="label label-pill label-success">{{ $transaksi->status }}</span>
                            		</td>
                            		<td style="font-size: 16px;" class="text-center">
                            			<button data-toggle="modal" data-target="#lihatTransaksiSelesai" data-lihat="{{ $transaksi->id }}" class="btn btn-sm btn-primary font-weight-bold lihat_selesai">Lihat</button>
                                    </td>
                            	</tr>
                            	<?php $number1++ ?>
                            	@endif
                            	@endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" id="member_table_diantar" hidden="">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Outlet</th>
                                    <th>Kode Invoice</th>
                                    <th>Nama</th>
                                    <th>Tgl Pemberian</th>
                                    <th>Tgl Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number2 = 1 ?>
                                @foreach($transaksis as $transaksi)
                                @if($transaksi->cek_member == 'member' && $transaksi->status == 'diantar')
                                <tr>
                                    <th class="align-middle text-center">{{ $number2 }}</th>
                                    <th>{{ $transaksi->nama_outlet }}</th>
                                    <td>{{ $transaksi->kd_invoice }}</td>
                                    <td>{{ $transaksi->nama_pelanggan }}</td>
                                    <td>{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
                                    <td>{{ date('d M Y', strtotime($transaksi->tgl_selesai)) }}</td>
                                    <td class="text-center">
                                        <span class="label label-pill label-danger">{{ $transaksi->status }}</span>
                                    </td>
                                    <td style="font-size: 16px;" class="text-center">
                                        <button data-toggle="modal" data-target="#lihatTransaksiDiantar" data-lihat="{{ $transaksi->id }}" class="btn btn-sm btn-primary font-weight-bold lihat_diantar">Lihat</button>
                                    </td>
                                </tr>
                                <?php $number2++ ?>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" id="member_table_diambil" hidden="">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Outlet</th>
                                    <th>Kode Invoice</th>
                                    <th>Nama</th>
                                    <th>Tgl Pemberian</th>
                                    <th>Tgl Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number3 = 1 ?>
                                @foreach($transaksis as $transaksi)
                                @if($transaksi->cek_member == 'member' && $transaksi->status == 'diambil')
                                <tr>
                                    <th class="align-middle text-center">{{ $number3 }}</th>
                                    <th>{{ $transaksi->nama_outlet }}</th>
                                    <td>{{ $transaksi->kd_invoice }}</td>
                                    <td>{{ $transaksi->nama_pelanggan }}</td>
                                    <td>{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
                                    <td>{{ date('d M Y', strtotime($transaksi->tgl_selesai)) }}</td>
                                    <td class="text-center">
                                        <span class="label label-pill label-primary">{{ $transaksi->status }}</span>
                                    </td>
                                    <td style="font-size: 16px;" class="text-center">
                                        <button data-toggle="modal" data-target="#lihatTransaksiDiambil" data-lihat="{{ $transaksi->id }}" class="btn btn-sm btn-primary font-weight-bold lihat_diambil">Lihat</button>
                                    </td>
                                </tr>
                                <?php $number3++ ?>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" id="non_member_table_selesai" hidden="">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Outlet</th>
                                    <th>Kode Invoice</th>
                                    <th>Nama</th>
                                    <th>Tgl Pemberian</th>
                                    <th>Tgl Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $number4 = 1 ?>
                            	@foreach($transaksis as $transaksi)
                            	@if($transaksi->cek_member == 'non_member' && $transaksi->status == 'selesai')
                            	<tr>
                            		<th class="align-middle text-center">{{ $number4 }}</th>
                            		<th>{{ $transaksi->nama_outlet }}</th>
                            		<td>{{ $transaksi->kd_invoice }}</td>
                            		<td>{{ $transaksi->nama_pelanggan }}</td>
                            		<td>{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
                            		<td>{{ date('d M Y', strtotime($transaksi->tgl_selesai)) }}</td>
                            		<td class="text-center">
                            			<span class="label label-pill label-success">{{ $transaksi->status }}</span>
                            		</td>
                            		<td style="font-size: 16px;" class="text-center">
                            			<button data-toggle="modal" data-target="#lihatTransaksiSelesai" data-lihat="{{ $transaksi->id }}" class="btn btn-sm btn-primary font-weight-bold lihat_selesai">Lihat</button>
                                    </td>
                            	</tr>
                            	<?php $number4++ ?>
                            	@endif
                            	@endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" id="non_member_table_diantar" hidden="">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Outlet</th>
                                    <th>Kode Invoice</th>
                                    <th>Nama</th>
                                    <th>Tgl Pemberian</th>
                                    <th>Tgl Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number5 = 1 ?>
                                @foreach($transaksis as $transaksi)
                                @if($transaksi->cek_member == 'non_member' && $transaksi->status == 'diantar')
                                <tr>
                                    <th class="align-middle text-center">{{ $number5 }}</th>
                                    <th>{{ $transaksi->nama_outlet }}</th>
                                    <td>{{ $transaksi->kd_invoice }}</td>
                                    <td>{{ $transaksi->nama_pelanggan }}</td>
                                    <td>{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
                                    <td>{{ date('d M Y', strtotime($transaksi->tgl_selesai)) }}</td>
                                    <td class="text-center">
                                        <span class="label label-pill label-light">{{ $transaksi->status }}</span>
                                    </td>
                                    <td style="font-size: 16px;" class="text-center">
                                        <button data-toggle="modal" data-target="#lihatTransaksiDiantar" data-lihat="{{ $transaksi->id }}" class="btn btn-sm btn-primary font-weight-bold lihat_diantar">Lihat</button>
                                    </td>
                                </tr>
                                <?php $number5++ ?>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" id="non_member_table_diambil" hidden="">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Outlet</th>
                                    <th>Kode Invoice</th>
                                    <th>Nama</th>
                                    <th>Tgl Pemberian</th>
                                    <th>Tgl Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number6 = 1 ?>
                                @foreach($transaksis as $transaksi)
                                @if($transaksi->cek_member == 'non_member' && $transaksi->status == 'diambil')
                                <tr>
                                    <th class="align-middle text-center">{{ $number6 }}</th>
                                    <th>{{ $transaksi->nama_outlet }}</th>
                                    <td>{{ $transaksi->kd_invoice }}</td>
                                    <td>{{ $transaksi->nama_pelanggan }}</td>
                                    <td>{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
                                    <td>{{ date('d M Y', strtotime($transaksi->tgl_selesai)) }}</td>
                                    <td class="text-center">
                                        <span class="label label-pill label-primary">{{ $transaksi->status }}</span>
                                    </td>
                                    <td style="font-size: 16px;" class="text-center">
                                        <button data-toggle="modal" data-target="#lihatTransaksiDiambil" data-lihat="{{ $transaksi->id }}" class="btn btn-sm btn-primary font-weight-bold lihat_diambil">Lihat</button>
                                    </td>
                                </tr>
                                <?php $number6++ ?>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/js/sweetalert.min.js') }}"></script>
<script type="text/javascript">
    @if ($message = Session::get('dibayar'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
    @endif

    @if ($message = Session::get('diantar'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
    @endif

    @if ($message = Session::get('diambil'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
    @endif

    $(document).on('click', '.pdf-btn', function(e){
        e.preventDefault();
        var id = $('.id_pdf').val();
        window.open("{{ url('/pdf_transaksi') }}/" + id, '_blank');
    });

    (function($) {
      $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          } else {
            this.value = "";
          }
        });
      };
    }(jQuery));

    $(".number_input").inputFilter(function(value) {
      return /^-?\d*$/.test(value); });

    $(document).on('click', '.lihat_diambil', function(e){
        e.preventDefault();
        var id = $(this).attr('data-lihat');
        $.ajax({
            url: "{{ url('/lihat_transaksi_diambil') }}/" + id,
            method: "GET",
            success:function(response){
                $('.id_pdf').val(response.transaksis.id);
                $('.identitas-btn-diambil').addClass('active show');
                $('#identitas-tab-diambil').addClass('active show');
                $('.paket-btn-diambil').removeClass('active show');
                $('#paket-tab-diambil').removeClass('active show');
                $('.pembayaran-btn-diambil').removeClass('active show');
                $('#pembayaran-tab-diambil').removeClass('active show');
                $('.modal_nama_ambil').html(response.pelanggans.nama_pelanggan);
                if(response.pelanggans.jk_pelanggan == 'L'){
                    $('.modal_jk_ambil').html('Laki-laki');
                }else{
                    $('.modal_jk_ambil').html('Perempuan');
                }
                $('.modal_email_ambil').html(response.pelanggans.email_pelanggan);
                $('.modal_no_hp_ambil').html(response.pelanggans.no_hp_pelanggan);
                $('.modal_tgl_pemberian_ambil').html(moment(response.transaksis.tgl_pemberian).format('DD MMMM YYYY'));
                $('.modal_tgl_selesai_ambil').html(moment(response.transaksis.tgl_selesai).format('DD MMMM YYYY'));
                $('.modal_tgl_bayar_ambil').html(moment(response.transaksis.tgl_bayar).format('DD MMMM YYYY'));
                $('.modal_pegawai_ambil').html(response.pegawai);
                if(response.checkout_kilos != ''){
                    $('.table_kiloan_ambil').prop('hidden', false);
                    $('.table_satuan_ambil').prop('hidden', true);
                    var isi_paket_kilo = "";
                    for(var i = 0; i < response.checkout_kilos.length; i++){
                        var no = i + 1;
                        isi_paket_kilo += '<tr><th>'+no+'</th><td>'+response.checkout_kilos[i].nama_paket+'</td><td>'+response.checkout_kilos[i].berat_barang+'</td><td>Rp. '+parseInt(response.checkout_kilos[i].harga_paket_satuan).toLocaleString()+'</td><td class="text-success">Rp. '+parseInt(response.checkout_kilos[i].harga_paket).toLocaleString()+'</td></tr>';
                    }
                    $('.isi_paket_kilo_ambil').html(isi_paket_kilo);
                    $('.modal_ambil_total_paket').html('Rp. ' + parseInt(response.kiloan_total).toLocaleString());
                    $('#modal_ambil_subtotal_paket').html('Harga Paket <span>Rp. '+parseInt(response.kiloan_total).toLocaleString()+'</span>');
                    if(response.checkout_kilo.antar_jemput_paket == 1 || response.checkout_kilo.harga_antar != 0){
                        $('.line-pembayaran-diambil').prop('hidden', false);
                        $('#modal_ambil_biaya_antar').prop('hidden', false);
                        $('#modal_ambil_biaya_antar').html('Biaya Antar <span>Rp. '+ parseInt(response.checkout_kilo.harga_antar).toLocaleString()+'</span>');
                    }else{
                        $('.line-pembayaran-diambil').prop('hidden', true);
                        $('#modal_ambil_biaya_antar').prop('hidden', true);
                        $('#modal_ambil_biaya_antar').html('');
                    }
                    $('.modal_ambil_subtotal').html('Rp. ' + parseInt(response.checkout_kilo.harga_total).toLocaleString());
                }else{
                    $('.table_kiloan_ambil').prop('hidden', true);
                    $('.table_satuan_ambil').prop('hidden', false);
                    var isi_paket_satu = "";
                    for(var i = 0; i < response.checkout_satus.length; i++){
                        var no = i + 1;
                        var ket_barang = "";
                        if(response.checkout_satus[i].ket_barang == null)
                        {
                            ket_barang = '-';
                        }else{
                            ket_barang = response.checkout_satus[i].ket_barang;
                        }
                        isi_paket_satu += '<tr><th>'+no+'</th><td>'+response.checkout_satus[i].nama_barang+'</td><td>'+ket_barang+'</td><td class="text-center">'+response.checkout_satus[i].jumlah_barang+'</td><td>Rp. '+parseInt(response.checkout_satus[i].harga_barang_satuan).toLocaleString()+'</td><td class="text-success">Rp. '+parseInt(response.checkout_satus[i].harga_barang).toLocaleString()+'</td></tr>';
                    }
                    $('.isi_paket_satu_ambil').html(isi_paket_satu);
                    $('.modal_ambil_total_paket').html('Rp. ' + parseInt(response.satuan_total).toLocaleString());
                    $('#modal_ambil_subtotal_paket').html('Harga Paket - Barang('+response.checkout_satus.length+') <span>Rp. '+parseInt(response.satuan_total).toLocaleString()+'</span>');
                    if(response.checkout_satu.harga_antar != 0){
                        $('.line-pembayaran-diambil').prop('hidden', false);
                        $('#modal_ambil_biaya_antar').prop('hidden', false);
                        $('#modal_ambil_biaya_antar').html('Biaya Antar <span>Rp. '+ parseInt(response.checkout_satu.harga_antar).toLocaleString()+'</span>');
                    }else{
                        $('.line-pembayaran-diambil').prop('hidden', true);
                        $('#modal_ambil_biaya_antar').prop('hidden', true);
                        $('#modal_ambil_biaya_antar').html('');
                    }
                    $('.modal_ambil_subtotal').html('Rp. ' + parseInt(response.checkout_satu.harga_total).toLocaleString());
                }
                $('.modal_ambil_diskon').html(response.transaksis.diskon + ' %');
                $('.modal_ambil_pajak').html(response.transaksis.pajak + ' %');
                $('.modal_ambil_total').html('Rp. ' + parseInt(response.struks.harga_total).toLocaleString());
                $('.modal_ambil_bayar').html('Rp. ' + parseInt(response.struks.harga_bayar).toLocaleString());
                $('.modal_ambil_kembali').html('Rp. ' + parseInt(response.struks.harga_kembali).toLocaleString());
            }
        });
    });

    $(document).on('click', '.lihat_diantar', function(e){
        e.preventDefault();
        var id = $(this).attr('data-lihat');
        $.ajax({
            url: "{{ url('/lihat_transaksi_diantar') }}/" + id,
            method: "GET",
            success:function(response){
                $('.id_pdf').val(response.transaksis.id);
                $('.identitas-btn-diantar').addClass('active show');
                $('#identitas-tab-diantar').addClass('active show');
                $('.paket-btn-diantar').removeClass('active show');
                $('#paket-tab-diantar').removeClass('active show');
                $('.pembayaran-btn-diantar').removeClass('active show');
                $('#pembayaran-tab-diantar').removeClass('active show');
                $('.lokasi_alamat_antar').html('<i class="fa fa-map-marker text-danger" style="font-size: 18px;"></i> '+response.pelanggans.alamat_pelanggan+'');
                $('.modal_nama_antar').html(response.pelanggans.nama_pelanggan);
                if(response.pelanggans.jk_pelanggan == 'L'){
                    $('.modal_jk_antar').html('Laki-laki');
                }else{
                    $('.modal_jk_antar').html('Perempuan');
                }
                $('.modal_email_antar').html(response.pelanggans.email_pelanggan);
                $('.modal_no_hp_antar').html(response.pelanggans.no_hp_pelanggan);
                $('.modal_tgl_pemberian_antar').html(moment(response.transaksis.tgl_pemberian).format('DD MMMM YYYY'));
                $('.modal_tgl_selesai_antar').html(moment(response.transaksis.tgl_selesai).format('DD MMMM YYYY'));
                $('.modal_tgl_bayar_antar').html(moment(response.transaksis.tgl_bayar).format('DD MMMM YYYY'));
                $('.modal_pegawai_antar').html(response.pegawai);
                if(response.checkout_kilos != ''){
                    $('.table_kiloan_antar').prop('hidden', false);
                    $('.table_satuan_antar').prop('hidden', true);
                    var isi_paket_kilo = "";
                    for(var i = 0; i < response.checkout_kilos.length; i++){
                        var no = i + 1;
                        isi_paket_kilo += '<tr><th>'+no+'</th><td>'+response.checkout_kilos[i].nama_paket+'</td><td>'+response.checkout_kilos[i].berat_barang+'</td><td>Rp. '+parseInt(response.checkout_kilos[i].harga_paket_satuan).toLocaleString()+'</td><td class="text-success">Rp. '+parseInt(response.checkout_kilos[i].harga_paket).toLocaleString()+'</td></tr>';
                    }
                    $('.isi_paket_kilo_antar').html(isi_paket_kilo);
                    $('.modal_antar_total_paket').html('Rp. ' + parseInt(response.kiloan_total).toLocaleString());
                    $('#modal_antar_subtotal_paket').html('Harga Paket <span>Rp. '+parseInt(response.kiloan_total).toLocaleString()+'</span>');
                    if(response.checkout_kilo.antar_jemput_paket == 1 || response.checkout_kilo.harga_antar != 0){
                        $('.line-pembayaran-diantar').prop('hidden', false);
                        $('#modal_antar_biaya_antar').prop('hidden', false);
                        $('#modal_antar_biaya_antar').html('Biaya Antar <span>Rp. '+ parseInt(response.checkout_kilo.harga_antar).toLocaleString()+'</span>');
                    }else{
                        $('.line-pembayaran-diantar').prop('hidden', true);
                        $('#modal_antar_biaya_antar').prop('hidden', true);
                        $('#modal_antar_biaya_antar').html('');
                    }
                    $('.modal_antar_subtotal').html('Rp. ' + parseInt(response.checkout_kilo.harga_total).toLocaleString());
                }else{
                    $('.table_kiloan_antar').prop('hidden', true);
                    $('.table_satuan_antar').prop('hidden', false);
                    var isi_paket_satu = "";
                    for(var i = 0; i < response.checkout_satus.length; i++){
                        var no = i + 1;
                        var ket_barang = "";
                        if(response.checkout_satus[i].ket_barang == null)
                        {
                            ket_barang = '-';
                        }else{
                            ket_barang = response.checkout_satus[i].ket_barang;
                        }
                        isi_paket_satu += '<tr><th>'+no+'</th><td>'+response.checkout_satus[i].nama_barang+'</td><td>'+ket_barang+'</td><td class="text-center">'+response.checkout_satus[i].jumlah_barang+'</td><td>Rp. '+parseInt(response.checkout_satus[i].harga_barang_satuan).toLocaleString()+'</td><td class="text-success">Rp. '+parseInt(response.checkout_satus[i].harga_barang).toLocaleString()+'</td></tr>';
                    }
                    $('.isi_paket_satu_antar').html(isi_paket_satu);
                    $('.modal_antar_total_paket').html('Rp. ' + parseInt(response.satuan_total).toLocaleString());
                    $('#modal_antar_subtotal_paket').html('Harga Paket - Barang('+response.checkout_satus.length+') <span>Rp. '+parseInt(response.satuan_total).toLocaleString()+'</span>');
                    if(response.checkout_satu.harga_antar != 0){
                        $('.line-pembayaran-diantar').prop('hidden', false);
                        $('#modal_antar_biaya_antar').prop('hidden', false);
                        $('#modal_antar_biaya_antar').html('Biaya Antar <span>Rp. '+ parseInt(response.checkout_satu.harga_antar).toLocaleString()+'</span>');
                    }else{
                        $('.line-pembayaran-diantar').prop('hidden', true);
                        $('#modal_antar_biaya_antar').prop('hidden', true);
                        $('#modal_antar_biaya_antar').html('');
                    }
                    $('.modal_antar_subtotal').html('Rp. ' + parseInt(response.checkout_satu.harga_total).toLocaleString());
                }
                $('.modal_antar_diskon').html(response.transaksis.diskon + ' %');
                $('.modal_antar_pajak').html(response.transaksis.pajak + ' %');
                $('.modal_antar_total').html('Rp. ' + parseInt(response.struks.harga_total).toLocaleString());
                $('.modal_antar_bayar').html('Rp. ' + parseInt(response.struks.harga_bayar).toLocaleString());
                $('.modal_antar_kembali').html('Rp. ' + parseInt(response.struks.harga_kembali).toLocaleString());
            }
        });
    });

    $(document).on('click', '.lihat_selesai', function(e){
        e.preventDefault();
        var id = $(this).attr('data-lihat');
        $.ajax({
            url: "{{ url('/lihat_transaksi_selesai') }}/" + id,
            method: "GET",
            success:function(response){
                $('.id_transaksi_input').val(response.transaksis.id);
                $('.modal_kd_pelanggan').html(response.pelanggans.kd_pelanggan);
                $('.modal_nama_pelanggan').html(response.pelanggans.nama_pelanggan);
                if(response.pelanggans.jk_pelanggan == 'L'){
                    $('.modal_jk_pelanggan').html('Laki-laki');
                }else{
                    $('.modal_jk_pelanggan').html('Perempuan');
                }
                $('.modal_email_pelanggan').html(response.pelanggans.email_pelanggan);
                $('.modal_no_hp_pelanggan').html(response.pelanggans.no_hp_pelanggan);
                $('.modal_alamat_pelanggan').html(response.pelanggans.alamat_pelanggan);
                if(response.transaksis.diskon != null && response.transaksis.pajak != null){
                    $('.diskon_bayar').prop('readonly', true);
                    $('.pajak_bayar').prop('readonly', true);
                    $('.diskon_bayar').val(response.transaksis.diskon);
                    $('.pajak_bayar').val(response.transaksis.pajak);
                }else{
                    $('.diskon_bayar').prop('readonly', false);
                    $('.pajak_bayar').prop('readonly', false);
                    $('.diskon_bayar').val('0');
                    $('.pajak_bayar').val('0');
                }
                if(response.checkout_kilos != ''){
                    $('.table_kiloan').prop('hidden', false);
                    $('.table_satuan').prop('hidden', true);
                    var isi_paket_kilo = "";
                    for(var i = 0; i < response.checkout_kilos.length; i++){
                        var no = i + 1;
                        isi_paket_kilo += '<tr><th>'+no+'</th><td>'+response.checkout_kilos[i].nama_paket+'</td><td>'+response.checkout_kilos[i].berat_barang+'</td><td>Rp. '+parseInt(response.checkout_kilos[i].harga_paket_satuan).toLocaleString()+'</td><td>Rp. '+parseInt(response.checkout_kilos[i].harga_paket).toLocaleString()+'</td></tr>';
                    }
                    $('.isi_paket_kilo').html(isi_paket_kilo);
                    $('.sub_total_bayar').val(parseInt(response.checkout_kilo.harga_total).toLocaleString());
                    $('.sub_total_bayar_2').val(response.checkout_kilo.harga_total);
                    $('.modal_total_paket').html('Rp. ' + parseInt(response.kiloan_total).toLocaleString());
                    if(response.checkout_kilo.antar_jemput_paket == 1 || response.checkout_kilo.harga_antar != 0){
                        $('.ket_biaya_antar').prop('hidden', false);
                        $('.modal_harga_antar').html('Rp. ' + parseInt(response.checkout_kilo.harga_antar).toLocaleString());
                    }else{
                        $('.ket_biaya_antar').prop('hidden', true);
                        $('.modal_harga_antar').html('');
                    }
                    $('.modal_total').html('Rp. ' + parseInt(response.checkout_kilo.harga_total).toLocaleString());
                }else{
                    $('.table_kiloan').prop('hidden', true);
                    $('.table_satuan').prop('hidden', false);
                    var isi_paket_satu = "";
                    for(var i = 0; i < response.checkout_satus.length; i++){
                        var no = i + 1;
                        var ket_barang = "";
                        if(response.checkout_satus[i].ket_barang == null)
                        {
                            ket_barang = '-';
                        }else{
                            ket_barang = response.checkout_satus[i].ket_barang;
                        }
                        isi_paket_satu += '<tr><th>'+no+'</th><td>'+response.checkout_satus[i].nama_barang+'</td><td>'+ket_barang+'</td><td class="text-center">'+response.checkout_satus[i].jumlah_barang+'</td><td>Rp. '+parseInt(response.checkout_satus[i].harga_barang_satuan).toLocaleString()+'</td><td>Rp. '+parseInt(response.checkout_satus[i].harga_barang).toLocaleString()+'</td></tr>';
                    }
                    $('.isi_paket_satu').html(isi_paket_satu);
                    $('.sub_total_bayar').val(parseInt(response.checkout_satu.harga_total).toLocaleString());
                    $('.sub_total_bayar_2').val(response.checkout_satu.harga_total);
                    $('.modal_total_paket').html('Rp. ' + parseInt(response.satuan_total).toLocaleString());
                    if(response.checkout_satu.harga_antar != 0){
                        $('.ket_biaya_antar').prop('hidden', false);
                        $('.modal_harga_antar').html('Rp. ' + parseInt(response.checkout_satu.harga_antar).toLocaleString());
                    }else{
                        $('.ket_biaya_antar').prop('hidden', true);
                        $('.modal_harga_antar').html('');
                    }
                    $('.modal_total').html('Rp. ' + parseInt(response.checkout_satu.harga_total).toLocaleString());
                }
                if(response.struks != '')
                {
                    $('.bayar_btn').prop('hidden', true);
                    if(response.checkout_kilos != ''){
                        if(response.checkout_kilo.antar_jemput_paket == 1 || response.checkout_kilo.harga_antar != 0){
                            $('.diantar_btn').prop('hidden', false);
                            $('.diambil_btn').prop('hidden', true);
                        }else{
                            $('.diantar_btn').prop('hidden', true);
                            $('.diambil_btn').prop('hidden', false);
                        }
                    }else{
                        if(response.checkout_satu.harga_antar != 0){
                            $('.diantar_btn').prop('hidden', false);
                            $('.diambil_btn').prop('hidden', true);
                        }else{
                            $('.diantar_btn').prop('hidden', true);
                            $('.diambil_btn').prop('hidden', false);   
                        }
                    }
                    $('.total_bayar').val(parseInt(response.struks.harga_total).toLocaleString());
                    $('.total_bayar_2').val(response.struks.harga_total);
                    $('.bayar_bayar').prop('readonly', true);
                    $('.bayar_bayar').val(parseInt(response.struks.harga_bayar).toLocaleString());
                    $('.kembali_bayar').val(parseInt(response.struks.harga_kembali).toLocaleString());
                    $('.kembali_bayar_2').val(response.struks.harga_kembali);
                }else{
                    if(response.checkout_kilos != '')
                    {
                        $('.total_bayar').val(parseInt(response.checkout_kilo.harga_total).toLocaleString());
                        $('.total_bayar_2').val(response.checkout_kilo.harga_total);
                    }else{
                        $('.total_bayar').val(parseInt(response.checkout_satu.harga_total).toLocaleString());
                        $('.total_bayar_2').val(response.checkout_satu.harga_total);
                    }
                    $('.bayar_btn').prop('hidden', false);
                    $('.diambil_btn').prop('hidden', true);
                    $('.bayar_bayar').prop('readonly', false);
                    $('.bayar_bayar').val('');
                    $('.kembali_bayar').val('');
                    $('.kembali_bayar_2').val('');
                }
            }
        });
    });

    $(document).on('keydown', '.diskon_bayar', function(e){
        var key = e.keyCode || e.charCode;
          if (key == 8 || key == 46) {
              e.preventDefault();
              e.stopPropagation();
          }
    });

    $(document).on('keydown', '.pajak_bayar', function(e){
        var key = e.keyCode || e.charCode;
          if (key == 8 || key == 46) {
              e.preventDefault();
              e.stopPropagation();
          }
    });


    $(document).on('input', '.diskon_bayar', function(e){
        var sub_total = $('.sub_total_bayar_2').val();
        var persen_diskon = $(this).val();
        var diskon = sub_total * (persen_diskon / 100);
        var persen_pajak = $('.pajak_bayar').val();
        var pajak = sub_total * (persen_pajak / 100);
        var total = (sub_total - diskon) + pajak;
        $('.total_bayar').val(parseInt(total).toLocaleString());
        $('.total_bayar_2').val(total);
        if($('.bayar_bayar').val() != '')
        {
            var bayar = $('.bayar_bayar').val();
            var kembali = bayar - total;
            $('.kembali_bayar').val(parseInt(kembali).toLocaleString());
            $('.kembali_bayar_2').val(kembali);
        }
    });

    $(document).on('input', '.pajak_bayar', function(){
        var sub_total = $('.sub_total_bayar_2').val();
        var persen_pajak = $(this).val();
        var pajak = sub_total * (persen_pajak / 100);
        var persen_diskon = $('.diskon_bayar').val();
        var diskon = sub_total * (persen_diskon / 100);
        var total = (sub_total - diskon) + pajak;
        $('.total_bayar').val(parseInt(total).toLocaleString());
        $('.total_bayar_2').val(total);
        if($('.bayar_bayar').val() != '')
        {
            var bayar = $('.bayar_bayar').val();
            var kembali = bayar - total;
            $('.kembali_bayar').val(parseInt(kembali).toLocaleString());
            $('.kembali_bayar_2').val(kembali);
        }
    });

    $(document).on('input', '.bayar_bayar', function(){
        var total = $('.total_bayar_2').val();
        var bayar = $(this).val();
        var kembali = bayar - total;
        $('.kembali_bayar').val(parseInt(kembali).toLocaleString());
        $('.kembali_bayar_2').val(kembali);
        $('.kurang_bayar_error').html('');
    });

    $(document).on('click', '.bayar_btn', function(){
        var bayar_input = parseInt($('.bayar_bayar').val());
        var total_input = parseInt($('.total_bayar_2').val());
        if($('.bayar_bayar').val() == ''){
            $('.kurang_bayar_error').html('<span style="color: red;">Silakan masukkan nominal</span>');
        }else if(bayar_input < total_input){
            $('.kurang_bayar_error').html('<span style="color: red;">Nominal kurang</span>');
        }else if(bayar_input >= total_input){
            $('.kurang_bayar_error').html('');
            $('.bayar_form').submit();
        }
    });

    $(document).on('submit', '.bayar_form', function(e){
        e.preventDefault();
        var request = new FormData(this);
        $.ajax({
            url: "{{ url('/bayar_pesanan') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == 'sukses')
                {
                    window.open("{{ url('/kelola_transaksi') }}","_self");
                }
            }
        });
    });

    $(document).on('click', '.diantar_btn', function(e){
        e.preventDefault();
        var id = $('.id_transaksi_input').val();
        $.ajax({
            url: "{{ url('/ubah_status_transaksi/diantar') }}/" + id,
            method: "GET",
            success:function(data){
                if(data == 'sukses'){
                    window.open("{{ url('/kelola_transaksi') }}","_self");
                }
            }
        });
    });

    $(document).on('click', '.diambil_btn', function(e){
        e.preventDefault();
        var id = $('.id_transaksi_input').val();
        $.ajax({
            url: "{{ url('/ubah_status_transaksi/diambil') }}/" + id,
            method: "GET",
            success:function(data){
                if(data == 'sukses'){
                    window.open("{{ url('/kelola_transaksi') }}","_self");
                }
            }
        });
    });

    $("[type='number']").keypress(function (evt) {
        evt.preventDefault();
    });

    var member_check = 1;
    var non_member_check = 0;    
    var selesai_check = 1;
    var diantar_check = 0;
    var diambil_check = 0;
	$(document).on('click', '.member-btn', function() {
        member_check = 1;
        non_member_check = 0;
		$(this).addClass('btn-member-border');
    	$('.non_member-btn').removeClass('btn-member-border');
        checkTable();
	});

	$(document).on('click', '.non_member-btn', function() {
        member_check = 0;
        non_member_check = 1;
		$(this).addClass('btn-member-border');
    	$('.member-btn').removeClass('btn-member-border');
        checkTable();
	});

    $(document).on('click', '#selesai-btn', function() {
        selesai_check = 1;
        diantar_check = 0;
        diambil_check = 0;
        $(this).addClass('btn-primary');
        $(this).removeClass('btn-outline-primary');
        $('#diantar-btn').addClass('btn-outline-primary');
        $('#diantar-btn').removeClass('btn-primary');
        $('#diambil-btn').addClass('btn-outline-primary');
        $('#diambil-btn').removeClass('btn-primary');
        checkTable();
    });

    $(document).on('click', '#diantar-btn', function() {
        selesai_check = 0;
        diantar_check = 1;
        diambil_check = 0;
        $(this).addClass('btn-primary');
        $(this).removeClass('btn-outline-primary');
        $('#selesai-btn').addClass('btn-outline-primary');
        $('#selesai-btn').removeClass('btn-primary');
        $('#diambil-btn').addClass('btn-outline-primary');
        $('#diambil-btn').removeClass('btn-primary');
        checkTable();
    });

    $(document).on('click', '#diambil-btn', function() {
        selesai_check = 0;
        diantar_check = 0;
        diambil_check = 1;
        $(this).addClass('btn-primary');
        $(this).removeClass('btn-outline-primary');
        $('#diantar-btn').addClass('btn-outline-primary');
        $('#diantar-btn').removeClass('btn-primary');
        $('#selesai-btn').addClass('btn-outline-primary');
        $('#selesai-btn').removeClass('btn-primary');
        checkTable();
    });

    function checkTable(){
        if(member_check == 1 && selesai_check == 1)
        {
            $('#member_table_selesai').prop('hidden', false);
            $('#member_table_diantar').prop('hidden', true);
            $('#member_table_diambil').prop('hidden', true);
            $('#non_member_table_selesai').prop('hidden', true);
            $('#non_member_table_diantar').prop('hidden', true);
            $('#non_member_table_diambil').prop('hidden', true);
        }else if(member_check == 1 && diantar_check == 1){
            $('#member_table_selesai').prop('hidden', true);
            $('#member_table_diantar').prop('hidden', false);
            $('#member_table_diambil').prop('hidden', true);
            $('#non_member_table_selesai').prop('hidden', true);
            $('#non_member_table_diantar').prop('hidden', true);
            $('#non_member_table_diambil').prop('hidden', true);
        }else if(member_check == 1 && diambil_check == 1){
            $('#member_table_selesai').prop('hidden', true);
            $('#member_table_diantar').prop('hidden', true);
            $('#member_table_diambil').prop('hidden', false);
            $('#non_member_table_selesai').prop('hidden', true);
            $('#non_member_table_diantar').prop('hidden', true);
            $('#non_member_table_diambil').prop('hidden', true);
        }else if(non_member_check == 1 && selesai_check == 1){
            $('#member_table_selesai').prop('hidden', true);
            $('#member_table_diantar').prop('hidden', true);
            $('#member_table_diambil').prop('hidden', true);
            $('#non_member_table_selesai').prop('hidden', false);
            $('#non_member_table_diantar').prop('hidden', true);
            $('#non_member_table_diambil').prop('hidden', true);
        }else if(non_member_check == 1 && diantar_check == 1){
            $('#member_table_selesai').prop('hidden', true);
            $('#member_table_diantar').prop('hidden', true);
            $('#member_table_diambil').prop('hidden', true);
            $('#non_member_table_selesai').prop('hidden', true);
            $('#non_member_table_diantar').prop('hidden', false);
            $('#non_member_table_diambil').prop('hidden', true);
        }else if(non_member_check == 1 && diambil_check == 1){
            $('#member_table_selesai').prop('hidden', true);
            $('#member_table_diantar').prop('hidden', true);
            $('#member_table_diambil').prop('hidden', true);
            $('#non_member_table_selesai').prop('hidden', true);
            $('#non_member_table_diantar').prop('hidden', true);
            $('#non_member_table_diambil').prop('hidden', false);
        }
    }
</script>
@endsection