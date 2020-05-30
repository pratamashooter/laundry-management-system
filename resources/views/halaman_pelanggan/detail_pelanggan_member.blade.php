@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
<style type="text/css">
.btn-pesanan{
	background-color: #fff;
	font-weight: bold;
	border-radius: 0px;
}
.btn_active{
	border-bottom: 2px solid #7571f9;
}
.table_modal tr td, .table_modal tr th{
	padding: 5px;
	font-size: 12px;
}
.table-total{
    font-size: 12px;
}
.line-total{
	width: 100%;
	border-top: 2px solid #aaa;
}
.table-total tr th, .table-total tr td{
	padding: 3px;
}
.tabel-identitas tr td, .tabel-identitas tr th{
    max-width: 120px;
}
#table-paket-kiloan{
    font-size: 12px;
}
#table-paket-satuan{
    font-size: 12px;
}
.tabel_satuan{
    font-size: 12px;
}
.tabel_kiloan{
    font-size: 12px;
}
</style>
@endsection
@section('konten')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Layanan Laundry</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/kelola_pelanggan') }}">Kelola Pelanggan</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/detail_pelanggan_member/' . $id) }}">Detail Pelanggan</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row" hidden="">
        <div class="col-md-12">
            <input type="text" name="id_pdf" class="id_pdf">
        </div>
    </div>
	<div class="row">
		<div class="modal fade" id="paketKiloModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    	<div class="row">
                    		<div class="col-md-6">
                    			<table border="0" class="table_modal">
                    				<tr hidden="">
                    					<td><input type="text" name="id_invoice_kilo" class="id_invoice_kilo"></td>
                    				</tr>
                    				<tr>
 	                 					<th>Outlet</th>
                    					<td>:</td>
                    					<td class="modal_outlet"></td>
                    				</tr>
                    				<tr>
                    					<th>Kode Invoice</th>
                    					<td>:</td>
                    					<td class="modal_kd_invoice"></td>
                    				</tr>
                    				<tr>
                    					<th>Tgl Pemberian</th>
                    					<td>:</td>
                    					<td class="modal_tgl_pemberian"></td>
                    				</tr>
                    				<tr>
                    					<th>Tgl Selesai</th>
                    					<td>:</td>
                    					<td class="modal_tgl_selesai"></td>
                    				</tr>
                    				<tr>
                    					<th>Tgl Bayar</th>
                    					<td>:</td>
                    					<td class="modal_tgl_bayar"></td>
                    				</tr>
                    			</table>
                    		</div>
                    		<div class="col-md-6">
                    			<table border="0" class="table_modal">
                    				<tr>
                    					<th>Diskon</th>
                    					<td>:</td>
                    					<td class="modal_diskon"></td>
                    				</tr>
                    				<tr>
                    					<th>Pajak</th>
                    					<td>:</td>
                    					<td class="modal_pajak"></td>
                    				</tr>
                    				<tr>
                    					<th>Ket Bayar</th>
                    					<td>:</td>
                    					<td class="modal_ket_bayar"></td>
                    				</tr>
                    				<tr>
                    					<th>Pegawai</th>
                    					<td>:</td>
                    					<td class="modal_pegawai"></td>
                    				</tr>
                    				<tr>
                    					<th>Met Pembayaran</th>
                    					<td>:</td>
                    					<td class="modal_metode_pembayaran"></td>
                    				</tr>
                    			</table>
                    		</div>
                    	</div>
                    	<div class="row mt-2 mb-2">
                    		<div class="col-md-12">
                    			<select class="form-control status-select-kilo">
                    				<option value="baru">Baru</option>
                    				<option value="proses">Proses</option>
                    				<option value="selesai">Selesai</option>
                    			</select>
                    		</div>
                    	</div>
                    	<hr>
                    	<div class="row">
                    		<div class="col-md-12">
                    			<table style="width: 100%;" class="text-center table tabel_kiloan">
                    				<thead>
                    					<tr>
	                    					<th>No</th>
	                    					<th>Paket</th>
	                    					<th>Berat Barang</th>
	                    					<th>Harga</th>
	                    					<th>Subtotal</th>
	                    				</tr>
                    				</thead>
                    				<tbody class="isi_paket_kilo">
                    					
                    				</tbody>
                    			</table>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-6 offset-md-6">
                    			<table style="width: 100%;" class="table-total">
                    				<tr>
                    					<th>Total Paket</th>
                    					<td class="modal_total_paket text-success"></td>
                    				</tr>
                    				<tr class="ket_antar">
                    					<th>Biaya Antar</th>
                    					<td class="modal_harga_antar"></td>
                    				</tr>
                    				<tr>
                    					<td colspan="2" class="line-total"></td>
                    				</tr>
                    				<tr>
                    					<th>Total</th>
                    					<td class="modal_total font-weight-bold"></td>
                    				</tr>
                                    <tr>
                                        <td colspan="2" style="font-size: 12px;">(Belum termasuk diskon dan pajak)</td>
                                    </tr>
                    			</table>
                    		</div>
                    	</div>
                    	<hr>
	                    <div class="row">
	                    	<div class="col-md-12">
	                    		<button type="button" class="btn btn-danger btn-flat font-weight-bold btn-block batal-btn-kilo"><i class="fa fa-ban"></i>&nbsp;&nbsp;Batalkan Pesanan</button>
	                    		<button type="button" class="pdf-btn btn btn-primary btn-flat font-weight-bold btn-block"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Cetak PDF</button>
	                    	</div>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="paketSatuModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    	<div class="row">
                    		<div class="col-md-6">
                    			<table border="0" class="table_modal">
                    				<tr hidden="">
                    					<td><input type="text" name="id_invoice_satu" class="id_invoice_satu"></td>
                    				</tr>
                    				<tr>
 	                 					<th>Outlet</th>
                    					<td>:</td>
                    					<td class="modal_outlet"></td>
                    				</tr>
                    				<tr>
                    					<th>Kode Invoice</th>
                    					<td>:</td>
                    					<td class="modal_kd_invoice"></td>
                    				</tr>
                    				<tr>
                    					<th>Tgl Pemberian</th>
                    					<td>:</td>
                    					<td class="modal_tgl_pemberian"></td>
                    				</tr>
                    				<tr>
                    					<th>Tgl Selesai</th>
                    					<td>:</td>
                    					<td class="modal_tgl_selesai"></td>
                    				</tr>
                    				<tr>
                    					<th>Tgl Bayar</th>
                    					<td>:</td>
                    					<td class="modal_tgl_bayar"></td>
                    				</tr>
                    			</table>
                    		</div>
                    		<div class="col-md-6">
                    			<table border="0" class="table_modal">
                    				<tr>
                    					<th>Diskon</th>
                    					<td>:</td>
                    					<td class="modal_diskon"></td>
                    				</tr>
                    				<tr>
                    					<th>Pajak</th>
                    					<td>:</td>
                    					<td class="modal_pajak"></td>
                    				</tr>
                    				<tr>
                    					<th>Ket Bayar</th>
                    					<td>:</td>
                    					<td class="modal_ket_bayar"></td>
                    				</tr>
                    				<tr>
                    					<th>Pegawai</th>
                    					<td>:</td>
                    					<td class="modal_pegawai"></td>
                    				</tr>
                    				<tr>
                    					<th>Met Pembayaran</th>
                    					<td>:</td>
                    					<td class="modal_metode_pembayaran"></td>
                    				</tr>
                    			</table>
                    		</div>
                    	</div>
                    	<div class="row mt-2 mb-2">
                    		<div class="col-md-12">
                    			<select class="form-control status-select-satu">
                    				<option value="baru">Baru</option>
                    				<option value="proses">Proses</option>
                    				<option value="selesai">Selesai</option>
                    			</select>
                    		</div>
                    	</div>
                    	<hr>
                    	<div class="row">
                    		<div class="col-md-12">
                    			<table style="width: 100%;" class="text-center table tabel_satuan">
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
                    				<tbody class="isi_paket_satu">
                    					
                    				</tbody>
                    			</table>
                    		</div>
                    	</div>
                    	<div class="row">
                    		<div class="col-md-6 offset-md-6">
                    			<table style="width: 100%;" class="table-total">
                    				<tr>
                    					<th>Total Paket</th>
                    					<td class="modal_total_paket text-success"></td>
                    				</tr>
                    				<tr class="ket_antar">
                    					<th>Biaya Antar</th>
                    					<td class="modal_harga_antar"></td>
                    				</tr>
                    				<tr>
                    					<td colspan="2" class="line-total"></td>
                    				</tr>
                    				<tr>
                    					<th>Total</th>
                    					<td class="modal_total font-weight-bold"></td>
                    				</tr>
                                    <tr>
                                        <th colspan="2" style="font-size: 12px;">(Belum termasuk diskon dan pajak)</th>
                                    </tr>
                    			</table>
                    		</div>
                    	</div>
                    	<hr>
	                    <div class="row">
	                    	<div class="col-md-12">
	                    		<button type="button" class="btn btn-danger btn-flat font-weight-bold btn-block batal-btn-satu"><i class="fa fa-ban"></i>&nbsp;&nbsp;Batalkan Pesanan</button>
	                    		<button type="button" class="pdf-btn btn btn-primary btn-flat font-weight-bold btn-block"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Cetak PDF</button>
	                    	</div>
	                    </div>
                    </div>
                </div>
            </div>
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
                    				<td style="padding: 5px;" class="align-top">
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
                        <div class="col-12 text-center">
                            <a href="{{ url('/hapus_pelanggan/'.$id) }}" class="btn btn-flat btn-danger font-weight-bold"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;Hapus Pelanggan</a>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<div class="d-flex justify-content-start">
								<button class="btn btn-pesanan kiloan_btn btn_active">Pesanan Kiloan</button>
								<button class="btn btn-pesanan satuan_btn ">Pesanan Satuan</button>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-md-12 d-flex justify-content-between">
							<h4>Daftar Pesanan</h4>
							<div class="align-items-center">
								<div class="btn-group dropleft mb-1" id="filterStatusKilo">
	                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle font-weight-bold" style="height: 35px;" data-toggle="dropdown">Filter Status</button>
	                                <div class="dropdown-menu"><a class="dropdown-item filter-status-kilo-btn" data-status="">Semua</a> <a class="dropdown-item filter-status-kilo-btn" data-status="baru">Baru</a> <a class="dropdown-item filter-status-kilo-btn" data-status="proses">Proses</a> <a class="dropdown-item filter-status-kilo-btn" data-status="selesai">Selesai</a> <a class="dropdown-item filter-status-kilo-btn" data-status="diantar">Diantar</a> <a class="dropdown-item filter-status-kilo-btn" data-status="diambil">Diambil</a>
	                                </div>
	                            </div>
                                <div class="btn-group dropleft mb-1" id="filterStatusSatu" hidden="">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle font-weight-bold" style="height: 35px;" data-toggle="dropdown">Filter Status</button>
                                    <div class="dropdown-menu"><a class="dropdown-item filter-status-satu-btn" data-status="">Semua</a> <a class="dropdown-item filter-status-satu-btn" data-status="baru">Baru</a> <a class="dropdown-item filter-status-satu-btn" data-status="proses">Proses</a> <a class="dropdown-item filter-status-satu-btn" data-status="selesai">Selesai</a> <a class="dropdown-item filter-status-satu-btn" data-status="diantar">Diantar</a> <a class="dropdown-item filter-status-satu-btn" data-status="diambil">Diambil</a>
                                    </div>
                                </div>
	                            <select id="maxRowsKilo" class="form-control-sm ml-2" style="width: 100px;">
	                    			<option value="9999">Semua</option>
	                    			<option value="5">5</option>
	                    			<option value="10">10</option>
	                    			<option value="25">25</option>
	                    		</select>
	                    		<select id="maxRowsSatu" class="form-control-sm ml-2" style="width: 100px;" hidden="">
	                    			<option value="9999">Semua</option>
	                    			<option value="5">5</option>
	                    			<option value="10">10</option>
	                    			<option value="25">25</option>
	                    		</select>
							</div>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-md-12">
							<table class="table" id="table-paket-kiloan">
							  <thead class="text-center">
							    <tr>
							      <th scope="col">Outlet</th>
							      <th scope="col">Kode Invoice</th>
							      <th scope="col">Tgl Pemberian</th>
							      <th scope="col">Tgl Selesai</th>
							      <th scope="col">Status</th>
							      <th scope="col">Aksi</th>
							    </tr>
							  </thead>
							  <tbody class="body-table-kilo">
							  	@foreach($transaksis as $transaksi)
							  	@php
							  	$checkout_kilos = \App\Checkout_kilo::select('checkout_kilos.*')
							  	->where('kd_invoice', $transaksi->kd_invoice)
							  	->count();
							  	@endphp
							  	@if($checkout_kilos != 0)
							    <tr class="table-light">
							      <th>{{ $transaksi->nama_outlet }}</th>
							      <td class="text-center">{{ $transaksi->kd_invoice }}</td>
							      <td class="text-center">{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
							      <td class="text-center">{{ date('d M Y', strtotime($transaksi->tgl_selesai)) }}</td>
							      <td>
							      	@if($transaksi->status == 'baru')
                                    <span class="label label-pill label-info text-white">{{ $transaksi->status }}</span>
                                    @elseif($transaksi->status == 'proses')
                                    <span class="label label-pill label-warning text-white">{{ $transaksi->status }}</span>
                                    @elseif($transaksi->status == 'selesai')
                                    <span class="label label-pill label-success text-white">{{ $transaksi->status }}</span>
                                    @elseif($transaksi->status == 'diantar')
                                    <span class="label label-pill label-danger text-white">{{ $transaksi->status }}</span>
                                    @elseif($transaksi->status == 'diambil')
                                    <span class="label label-pill label-primary text-white">{{ $transaksi->status }}</span>
                                    @endif
							      </td>
							      <td><button class="btn btn-outline-primary font-weight-bold btn-sm btn-lihat-kilo" data-transaksi="{{ $transaksi->id }}" type="button" data-toggle="modal" data-target="#paketKiloModal">Lihat</button></td>
							    </tr>
							    @endif
							    @endforeach
							  </tbody>
							</table>
							<table class="table" id="table-paket-satuan" hidden="">
							  <thead class="text-center">
							    <tr>
							      <th scope="col">Outlet</th>
							      <th scope="col">Kode Invoice</th>
							      <th scope="col">Tgl Pemberian</th>
							      <th scope="col">Tgl Selesai</th>
							      <th scope="col">Status</th>
							      <th scope="col">Aksi</th>
							    </tr>
							  </thead>
							  <tbody class="body-table-satu">
							  	@foreach($transaksis as $transaksi)
							  	@php
							  	$checkout_satus = \App\Checkout_satu::select('checkout_satus.*')
							  	->where('kd_invoice', $transaksi->kd_invoice)
							  	->count();
							  	@endphp
							  	@if($checkout_satus != 0)
							    <tr class="table-light">
							      <th>{{ $transaksi->nama_outlet }}</th>
							      <td class="text-center">{{ $transaksi->kd_invoice }}</td>
							      <td class="text-center">{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
							      <td class="text-center">
                                    @if($transaksi->tgl_selesai == null)
                                    -
                                    @else
                                    {{ date('d M Y', strtotime($transaksi->tgl_selesai)) }}
                                    @endif
                                  </td>
							      <td>
							      	@if($transaksi->status == 'baru')
							      	<span class="label label-pill label-info text-white">{{ $transaksi->status }}</span>
							      	@elseif($transaksi->status == 'proses')
							      	<span class="label label-pill label-warning text-white">{{ $transaksi->status }}</span>
							      	@elseif($transaksi->status == 'selesai')
							      	<span class="label label-pill label-success text-white">{{ $transaksi->status }}</span>
							      	@elseif($transaksi->status == 'diantar')
							      	<span class="label label-pill label-danger text-white">{{ $transaksi->status }}</span>
                                    @elseif($transaksi->status == 'diambil')
                                    <span class="label label-pill label-primary text-white">{{ $transaksi->status }}</span>
							      	@endif
							      </td>
							      <td><button class="btn btn-outline-primary font-weight-bold btn-sm btn-lihat-satu" data-transaksi="{{ $transaksi->id }}" type="button" data-toggle="modal" data-target="#paketSatuModal">Lihat</button></td>
							    </tr>
							    @endif
							    @endforeach
							  </tbody>
							</table>
						</div>
						<div class="col-md-12">
							<div class="pagination-container pagination-kilo">
								<nav>
									<ul class="pagination_kilo">
										
									</ul>
								</nav>
							</div>
							<div class="pagination-container pagination-satu">
								<nav>
									<ul class="pagination_satu">
										
									</ul>
								</nav>
							</div>
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
    @if ($message = Session::get('batal_pesan'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    )
    @endif    

	@if ($message = Session::get('tersimpan'))
	swal(
	    "Berhasil!",
	    "{{ $message }}",
	    "success"
	)
	@endif

	@if ($message = Session::get('terubah_status'))
	swal(
	    "Berhasil!",
	    "{{ $message }}",
	    "success"
	)
	@endif

    $(document).on('click', '.pdf-btn', function(e){
        e.preventDefault();
        var id = $('.id_pdf').val();
        window.open("{{ url('/pdf_pelanggan') }}/" + id, '_blank');
    });

    $(document).on('click', '.filter-status-kilo-btn', function(e){
        e.preventDefault();
        var searchTerm = $(this).attr('data-status').toLowerCase();
        $(".body-table-kilo tr").each(function(){
          var lineStr = $(this).text().toLowerCase();
          if(lineStr.indexOf(searchTerm) == -1){
            $(this).hide();
          }else{
            $(this).show();
          }
        });
    });

    $(document).on('click', '.filter-status-satu-btn', function(e){
        e.preventDefault();
        var searchTerm = $(this).attr('data-status').toLowerCase();
        $(".body-table-satu tr").each(function(){
          var lineStr = $(this).text().toLowerCase();
          if(lineStr.indexOf(searchTerm) == -1){
            $(this).hide();
          }else{
            $(this).show();
          }
        });
    });

	$('.status-select-kilo').change(function() {
		var id = $('.id_invoice_kilo').val();
		var status = $(this).val();
		$.ajax({
			url: "{{ url('/update_status_transaksi') }}/" + id + "/" + status,
			method: "GET",
			success:function(data){
				if(data != ''){
                    window.open("{{ url('/detail_pelanggan_member/' . $id) }}", "_self");
                }
			}
		});
	});

	$('.status-select-satu').change(function() {
		var id = $('.id_invoice_satu').val();
		var status = $(this).val();
		$.ajax({
			url: "{{ url('/update_status_transaksi') }}/" + id + "/" + status,
			method: "GET",
			success:function(data){
				if(data != ''){
                    window.open("{{ url('/detail_pelanggan_member/' . $id) }}", "_self");
                }
			}
		});
	});

	$(document).on('click', '.btn-lihat-kilo', function(e){
		e.preventDefault();
		var id = $(this).attr('data-transaksi');
		$.ajax({
			url: "{{ url('/lihat_paket_kilo_member') }}/" + id,
			method: "GET",
			success:function(response){
                $('.id_pdf').val(response.transaksis.id);
				$('.id_invoice_kilo').val(response.transaksis.id);
				$('.modal_outlet').html(response.transaksis.nama_outlet);
				$('.modal_kd_invoice').html(response.transaksis.kd_invoice);
				$('.modal_tgl_pemberian').html(moment(response.transaksis.tgl_pemberian).format('DD MMMM YYYY'));
				$('.modal_tgl_selesai').html(moment(response.transaksis.tgl_selesai).format('DD MMMM YYYY'));
				if(response.transaksis.tgl_bayar != null){
					$('.modal_tgl_bayar').html(moment(response.transaksis.tgl_bayar).format('DD MMMM YYYY'));
				}else{
					$('.modal_tgl_bayar').html('-');
				}
				if(response.transaksis.diskon != null){
					$('.modal_diskon').html(response.transaksis.diskon + ' %');
				}else{
					$('.modal_diskon').html('-');
				}
				if(response.transaksis.pajak != null){
					$('.modal_pajak').html(response.transaksis.pajak + ' %');
				}else{
					$('.modal_pajak').html('-');
				}
				$('.modal_ket_bayar').html(response.transaksis.ket_bayar);
				$('.modal_pegawai').html(response.transaksis.nama_pegawai);
				if(response.transaksis.status != 'diambil' && response.transaksis.status != 'diantar')
                {
                    $('.batal-btn-kilo').prop('hidden', false);
                    $('.status-select-kilo').prop('hidden', false);
                    $('.status-select-kilo').val(response.transaksis.status).change();
                }else{
                    $('.batal-btn-kilo').prop('hidden', true);
                    $('.status-select-kilo').prop('hidden', true);
                }
				var isi_paket_kilo = "";
				for(var i = 0; i < response.checkout_kilos.length; i++){
	            	var no = i + 1;
	            	isi_paket_kilo += '<tr><th>'+no+'</th><th>'+response.checkout_kilos[i].nama_paket+'</th><td>'+response.checkout_kilos[i].berat_barang+'</td><td>Rp. '+parseInt(response.checkout_kilos[i].harga_paket_satuan).toLocaleString()+'</td><td>Rp. '+parseInt(response.checkout_kilos[i].harga_paket_total).toLocaleString()+'</td></tr>';
	            }
	            $('.isi_paket_kilo').html(isi_paket_kilo);
	            $('.modal_total_paket').html('Rp. ' + parseInt(response.paket_kilo_total).toLocaleString());
                if(response.checkout_kilo.antar_jemput_paket == 1 || response.checkout_kilo.harga_antar != 0){
                    $('.ket_antar').prop('hidden', false);
                    $('.modal_harga_antar').html('Rp. ' + parseInt(response.checkout_kilo.harga_antar).toLocaleString());
                }else{
                    $('.ket_antar').prop('hidden', true);
                    $('.modal_harga_antar').html('');
                }
	            $('.modal_total').html('Rp. ' + parseInt(response.checkout_kilo.harga_total).toLocaleString());
	            $('.modal_metode_pembayaran').html(response.checkout_kilo.metode_pembayaran);
			}
		});
	});

	$(document).on('click', '.btn-lihat-satu', function(e){
		e.preventDefault();
		var id = $(this).attr('data-transaksi');
		$.ajax({
			url: "{{ url('/lihat_paket_satu_member') }}/" + id,
			method: "GET",
			success:function(response){
                $('.id_pdf').val(response.transaksis.id);
				$('.id_invoice_satu').val(response.transaksis.id);
				$('.modal_outlet').html(response.transaksis.nama_outlet);
				$('.modal_kd_invoice').html(response.transaksis.kd_invoice);
				$('.modal_tgl_pemberian').html(moment(response.transaksis.tgl_pemberian).format('DD MMMM YYYY'));
                if(response.transaksis.tgl_selesai != null){
                    $('.modal_tgl_selesai').html(moment(response.transaksis.tgl_selesai).format('DD MMMM YYYY'));
                }else{
                    $('.modal_tgl_selesai').html('-');
                }
				if(response.transaksis.tgl_bayar != null){
					$('.modal_tgl_bayar').html(moment(response.transaksis.tgl_bayar).format('DD MMMM YYYY'));
				}else{
					$('.modal_tgl_bayar').html('-');
				}
				if(response.transaksis.diskon != null){
					$('.modal_diskon').html(response.transaksis.diskon + ' %');
				}else{
					$('.modal_diskon').html('-');
				}
				if(response.transaksis.pajak != null){
					$('.modal_pajak').html(response.transaksis.pajak + ' %');
				}else{
					$('.modal_pajak').html('-');
				}
				$('.modal_ket_bayar').html(response.transaksis.ket_bayar);
				$('.modal_pegawai').html(response.transaksis.nama_pegawai);
                if(response.transaksis.status != 'diambil' && response.transaksis.status != 'diantar')
                {
                    $('.batal-btn-satu').prop('hidden', false);
                    $('.status-select-satu').prop('hidden', false);
                    $('.status-select-satu').val(response.transaksis.status).change();
                }else{
                    $('.batal-btn-satu').prop('hidden', true);
                    $('.status-select-satu').prop('hidden', true);
                }
				var isi_paket_satu = "";
				for(var i = 0; i < response.checkout_satus.length; i++){
	            	var no = i + 1;
                    var ket_barang = "";
                    if(response.checkout_satus[i].ket_barang == null)
                    {
                        ket_barang = "-";
                    }else{
                        ket_barang = response.checkout_satus[i].ket_barang;
                    }
	            	isi_paket_satu += '<tr><th>'+no+'</th><th>'+response.checkout_satus[i].nama_barang+'</th><td>'+ket_barang+'</td><td>'+response.checkout_satus[i].jumlah_barang+'</td><td>Rp. '+parseInt(response.checkout_satus[i].harga_barang_satuan).toLocaleString()+'</td><td>Rp. '+parseInt(response.checkout_satus[i].harga_barang_total).toLocaleString()+'</td></tr>';
	            }
	            $('.isi_paket_satu').html(isi_paket_satu);
	            $('.modal_total_paket').html('Rp. ' + parseInt(response.paket_satu_total).toLocaleString());
                if(response.checkout_satu.harga_antar != 0){
                    $('.ket_antar').prop('hidden', false);
                    $('.modal_harga_antar').html('Rp. ' + parseInt(response.checkout_satu.harga_antar).toLocaleString());
                }else{
                    $('.ket_antar').prop('hidden', true);
                    $('.modal_harga_antar').html('');
                }
	            $('.modal_total').html('Rp. ' + parseInt(response.checkout_satu.harga_total).toLocaleString());
	            $('.modal_metode_pembayaran').html(response.checkout_satu.metode_pembayaran);
			}
		});
	});

	$(document).on('click', '.kiloan_btn', function() {
		$(this).addClass('btn_active');
        $('#filterStatusSatu').prop('hidden', true);
        $('#filterStatusKilo').prop('hidden', false);
		$('#maxRowsSatu').val(9999).change();
		$('#maxRowsSatu').prop('hidden', true);
		$('#maxRowsKilo').prop('hidden', false);
    	$('.satuan_btn').removeClass('btn_active');
    	$('#table-paket-kiloan').prop('hidden', false);
    	$('#table-paket-satuan').prop('hidden', true);
    	$('.pagination-kilo').prop('hidden', false);
    	$('.pagination-satu').prop('hidden', true);
	});

	$(document).on('click', '.satuan_btn', function() {
		$(this).addClass('btn_active');
        $('#filterStatusSatu').prop('hidden', false);
        $('#filterStatusKilo').prop('hidden', true);
		$('#maxRowsKilo').val(9999).change();
		$('#maxRowsKilo').prop('hidden', true);
		$('#maxRowsSatu').prop('hidden', false);
    	$('.kiloan_btn').removeClass('btn_active');
    	$('#table-paket-kiloan').prop('hidden', true);
    	$('#table-paket-satuan').prop('hidden', false);
    	$('.pagination-kilo').prop('hidden', true);
    	$('.pagination-satu').prop('hidden', false);
	});

    $(document).on('click', '.batal-btn-kilo', function(e){
        e.preventDefault();
        var id = $('.id_invoice_kilo').val();
        $.ajax({
            url: "{{ url('/hapus_pesanan_kilo') }}/" + id,
            method: "GET",
            success:function(data){
                window.open("{{ url('/detail_pelanggan_member/' . $id) }}", "_self");
            }
        });
    });

    $(document).on('click', '.batal-btn-satu', function(e){
        e.preventDefault();
        var id = $('.id_invoice_satu').val();
        $.ajax({
            url: "{{ url('/hapus_pesanan_satu') }}/" + id,
            method: "GET",
            success:function(data){
                window.open("{{ url('/detail_pelanggan_member/' . $id) }}", "_self");
            }
        });
    });

	var table1 = "#table-paket-kiloan";
	var table2 = "#table-paket-satuan";
	$('#maxRowsKilo').on('change', function(){
		$('.pagination_kilo').html('');
		var trnum = 0;
		var maxRows = parseInt($(this).val());
		var totalRows = $(table1+' tbody tr').length;
		$(table1+' tr:gt(0)').each(function(){
			trnum++;
			if(trnum > maxRows){
				$(this).hide();
			}
			if(trnum <= maxRows){
				$(this).show();
			}
		});
		if(totalRows > maxRows){
			var pagenum = Math.ceil(totalRows/maxRows);
			for(var i = 1; i <= pagenum;){
				$('.pagination_kilo').append('<li class="page-item" data-page="'+i+'">\<span class="page-link">'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show();
			}
			$('.pagination_kilo').addClass('pagination');
		}else{
			$('.pagination_kilo').removeClass('pagination');
		}
		$('.pagination_kilo li:first-child').addClass('active');
		$('.pagination_kilo li').on('click', function(){
			var pageNum = $(this).attr('data-page');
			var trIndex = 0;
			$('.pagination_kilo li').removeClass('active');
			$(this).addClass('active');
			$(table1+' tr:gt(0)').each(function(){
				trIndex++;
				if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows))
				{
					$(this).hide();
				}else{
					$(this).show();
				}
			});
		});
	});

	$('#maxRowsSatu').on('change', function(){
		$('.pagination_satu').html('');
		var trnum = 0;
		var maxRows = parseInt($(this).val());
		var totalRows = $(table2+' tbody tr').length;
		$(table2+' tr:gt(0)').each(function(){
			trnum++;
			if(trnum > maxRows){
				$(this).hide();
			}
			if(trnum <= maxRows){
				$(this).show();
			}
		});
		if(totalRows > maxRows){
			var pagenum = Math.ceil(totalRows/maxRows);
			for(var i = 1; i <= pagenum;){
				$('.pagination_satu').append('<li class="page-item" data-page="'+i+'">\<span class="page-link">'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show();
			}
			$('.pagination_satu').addClass('pagination');
		}else{
			$('.pagination_satu').removeClass('pagination');
		}
		$('.pagination_satu li:first-child').addClass('active');
		$('.pagination_satu li').on('click', function(){
			var pageNum = $(this).attr('data-page');
			var trIndex = 0;
			$('.pagination_satu li').removeClass('active');
			$(this).addClass('active');
			$(table2+' tr:gt(0)').each(function(){
				trIndex++;
				if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows))
				{
					$(this).hide();
				}else{
					$(this).show();
				}
			});
		});
	});

	$(function(){
		$('#table-paket-kiloan tr:eq(0)').prepend('<th>No</th>');
		$('#table-paket-satuan tr:eq(0)').prepend('<th>No</th>');
		var id1 = 0;
		var id2 = 0;
		$('#table-paket-kiloan tr:gt(0)').each(function(){
			id1++;
			$(this).prepend('<th>'+id1+'</th>');
		});
		$('#table-paket-satuan tr:gt(0)').each(function(){
			id2++;
			$(this).prepend('<th>'+id2+'</th>');
		});
	});
</script>
@endsection