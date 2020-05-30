@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
<style type="text/css">
.table_transaksi tr td, .table_transaksi tr th{
	padding: 5px;
	font-size: 12px;
}
.tabel-identitas tr td, .tabel-identitas tr th{
    max-width: 120px;
}
.table-paket{
    font-size: 14px;
}
.line-total{
    width: 100%;
    border-top: 2px solid #aaa;
}
.table-total tr th, .table-total tr td{
    padding: 3px;
}
</style>
@endsection
@section('konten')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Layanan Laundry</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/kelola_pelanggan') }}">Kelola Pelanggan</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/detail_pelanggan_non_member/' . $id) }}">Detail Pelanggan</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <input type="text" name="id_pdf" class="id_pdf" value="{{ $transaksis->id }}" hidden="">
        </div>
    </div>
	<div class="row">
		<div class="col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center mb-4">
                        <img class="mr-3 rounded-circle" src="{{ asset('/pictures/'.$akun_pelanggans->avatar) }}" width="80" height="80" alt="">
                        <div class="media-body">
                            <h3 class="mb-0">{{ $pelanggans->kd_pelanggan }}</h3>
                            <p class="text-muted mb-0">{{ $pelanggans->nama_pelanggan }}</p>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                    		<table style="width: 100%; margin-left: -10px;" class="tabel-identitas">
                    			<tr>
                    				<th style="padding: 5px;" class="text-dark text-left align-top">Gender</th>
                    				<td style="padding: 5px;" class="align-top">:</td>
                    				<td style="padding: 5px;">
                    					@if($pelanggans->jk_pelanggan == 'L')
                    					Laki-laki
                    					@else
                    					Perempuan
                    					@endif
                    				</td>
                    			</tr>
                    			<tr>
                    				<th style="padding: 5px;" class="text-dark text-left align-top">No HP</th>
                    				<td style="padding: 5px;" class="align-top">:</td>
                    				<td style="padding: 5px;" class="align-top">{{ $pelanggans->no_hp_pelanggan }}</td>
                    			</tr>
                    			<tr>
                    				<th style="padding: 5px;" class="text-dark text-left align-top">Email</th>
                    				<td style="padding: 5px;" class="align-top">:</td>
                    				<td style="padding: 5px;" class="align-top">{{ $pelanggans->email_pelanggan }}</td>
                    			</tr>
                    			<tr>
                    				<th style="padding: 5px;" class="text-dark text-left align-top">Alamat</th>
                    				<td style="padding: 5px;" class="align-top">:</td>
                    			</tr>
                    			<tr>
                    				<td colspan="3" style="padding: 5px;" class="align-top">{{ $pelanggans->alamat_pelanggan }}</td>
                    			</tr>
                    		</table>
                    	</div>
                    </div>
                    <div class="row mt-3 mb-1">
                        <div class="col">
                            <div class="card card-profile text-center">
                                <span class="mb-1 text-primary"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                <table style="width: 100%; margin: 5px;" class="text-left tabel-identitas">
                                	<tr>
                                		<th style="padding: 5px;" class="align-top">Username : </th>
                                	</tr>
                                	<tr>
                                		<td colspan="2" style="padding: 5px;" class="align-top">{{ $akun_pelanggans->username }}</td>
                                	</tr>
                                	<tr>
                                		<th style="padding: 5px;" class="align-top">Password : </th>
                                	</tr>
                                	<tr>
                                		<td colspan="2" style="padding: 5px;" class="align-top">{{ $pelanggans->password }}</td>
                                	</tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-body">
					<h4 class="card-title">Keterangan Pesanan</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <table border="0" class="table_transaksi">
                                <tr>
                                    <th>Outlet</th>
                                    <td>:</td>
                                    <td>{{ $transaksis->nama_outlet }}</td>
                                </tr>
                                <tr>
                                    <th>Kode Invoice</th>
                                    <td>:</td>
                                    <td>{{ $transaksis->kd_invoice }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pemberian</th>
                                    <td>:</td>
                                    <td>{{ date('d M Y', strtotime($transaksis->tgl_pemberian)) }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Selesai</th>
                                    <td>:</td>
                                    <td>
                                        @if($transaksis->tgl_selesai == null)
                                        -
                                        @else
                                        {{ date('d M Y', strtotime($transaksis->tgl_selesai)) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Bayar</th>
                                    <td>:</td>
                                    <td>
                                        @if($transaksis->tgl_bayar == null)
                                        -
                                        @else
                                        {{ date('d M Y', strtotime($transaksis->tgl_bayar)) }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table border="0" class="table_transaksi">
                                <tr>
                                    <th>Diskon</th>
                                    <td>:</td>
                                    <td>
                                        @if($transaksis->diskon == '')
                                        -
                                        @else
                                        {{ $transaksis->diskon }} %
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pajak</th>
                                    <td>:</td>
                                    <td>
                                        @if($transaksis->pajak == '')
                                        -
                                        @else
                                        {{ $transaksis->pajak }} %
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Keterangan Bayar</th>
                                    <td>:</td>
                                    <td>{{ $transaksis->ket_bayar }}</td>
                                </tr>
                                <tr>
                                    <th>Pegawai</th>
                                    <td>:</td>
                                    <td>{{ $transaksis->nama_pegawai }}</td>
                                </tr>
                                <tr>
                                    <th>Metode Pembayaran</th>
                                    <td>:</td>
                                    <td>
                                        @if($checkout_kilos != "")
                                        {{ $checkout_kiloan->metode_pembayaran }}
                                        @else
                                        {{ $checkout_satuan->metode_pembayaran }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                        @if($transaksis->status != 'diantar' && $transaksis->status != 'diambil')
                            @if($checkout_kilos != "")
                            <select class="form-control status_select status-select-kilo" name="status">
                                <option value="baru">Baru</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            @else
                            <select class="form-control status_select status-select-satu" name="status">
                                <option value="baru">Baru</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            @endif
                        @else
                            @if($transaksis->status == 'diantar')
                            <div class="alert alert-danger font-weight-bold text-center ket-proses">Pesanan Sedang Diantar</div>
                            @else
                            <div class="alert alert-dark font-weight-bold text-center ket-proses">Pesanan Telah Diterima</div>
                            @endif
                        @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        @if($checkout_kilos != "")
                        <div class="col-md-12 table-responsive" id="table_kiloan">
                            <table class="table table-paket">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Paket</th>
                                        <th>Berat Barang</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-light">
                                        @foreach($checkout_kilos as $checkout_kilo)
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $checkout_kilo->nama_paket }}</th>
                                        <td>{{ $checkout_kilo->berat_barang }}</td>
                                        <td>Rp. {{ number_format($checkout_kilo->harga_paket_satuan,2,',','.') }}</td>
                                        <td>Rp. {{ number_format($checkout_kilo->harga_paket,2,',','.') }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="col-md-12 table-responsive" id="table_satuan">
                            <table class="table table-paket">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Barang</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($checkout_satus as $checkout_satu)
                                    <tr class="table-light">
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $checkout_satu->nama_barang }}</th>
                                        <td>
                                            @if($checkout_satu->ket_barang == null)
                                            -
                                            @else
                                            {{ $checkout_satu->ket_barang }}
                                            @endif
                                        </td>
                                        <td>{{ $checkout_satu->jumlah_barang }}</td>
                                        <td>Rp. {{ number_format($checkout_satu->harga_barang_satuan,2,',','.') }}</td>
                                        <td>Rp. {{ number_format($checkout_satu->harga_barang,2,',','.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-8">
                            <table style="width: 100%;" class="table-total">
                                <tr>
                                    <th>Total Paket</th>
                                    <td class="text-success">Rp. {{ number_format($harga_total,2,',','.') }}</td>
                                </tr>
                                @if($checkout_kilos != "")
                                @if($checkout_kiloan->antar_jemput_paket == 1 || $checkout_kiloan->harga_antar != 0)
                                <tr>
                                    <th>Biaya Antar</th>
                                    <td>
                                        Rp. {{ number_format($checkout_kiloan->harga_antar,2,',','.') }}
                                    </td>
                                </tr>
                                @endif
                                @else
                                @if($checkout_satuan->harga_antar != 0)
                                <tr>
                                    <th>Biaya Antar</th>
                                    <td>
                                        Rp. {{ number_format($checkout_satuan->harga_antar,2,',','.') }}
                                    </td>
                                </tr>
                                @endif
                                @endif
                                <tr>
                                    <td colspan="2" class="line-total"></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td class="font-weight-bold">
                                        @if($checkout_kilos != "")
                                        Rp. {{ number_format($checkout_kiloan->harga_total,2,',','.') }}
                                        @else
                                        Rp. {{ number_format($checkout_satuan->harga_total,2,',','.') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="font-size: 12px;">(Belum termasuk diskon dan pajak)</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            @if($transaksis->status != 'diantar' && $transaksis->status != 'diambil')
                            <a href="{{ url('/hapus_pelanggan/'.$id) }}" class="btn btn-danger btn-block btn-flat font-weight-bold"><i class="fa fa-ban"></i>&nbsp;&nbsp;Batalkan Pesanan</a>
                            @endif
                            <button type="button" class="btn btn-primary btn-block btn-flat font-weight-bold pdf-btn"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Cetak PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/sweetalert/js/sweetalert.min.js') }}"></script>
<script type="text/javascript">
    @if ($message = Session::get('terubah_status'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
    @endif

    $(document).on('click', '.pdf-btn', function(e){
        e.preventDefault();
        var id = $('.id_pdf').val();
        window.open("{{ url('/pdf_pelanggan') }}/" + id, '_blank');
    });

    $(document).ready(function(){
        var status = "{{ $transaksis->status }}";
        $('.status_select').val(status).changed();
    });

    $('.status-select-kilo').change(function() {
        var id = "{{ $transaksis->id }}";
        var status = $(this).val();
        $.ajax({
            url: "{{ url('/update_status_transaksi') }}/" + id + "/" + status,
            method: "GET",
            success:function(data){
                if(data == "selesai"){
                    window.open("{{ url('/kelola_pelanggan') }}", "_self");
                }else{
                    window.open("{{ url('/detail_pelanggan_non_member/' . $id) }}", "_self");
                }
            }
        });
    });

    $('.status-select-satu').change(function() {
        var id = "{{ $transaksis->id }}";
        var status = $(this).val();
        $.ajax({
            url: "{{ url('/update_status_transaksi') }}/" + id + "/" + status,
            method: "GET",
            success:function(data){
                if(data == "selesai"){
                    window.open("{{ url('/kelola_pelanggan') }}", "_self");
                }else{
                    window.open("{{ url('/detail_pelanggan_non_member/' . $id) }}", "_self");
                }
            }
        });
    });
</script>
@endsection