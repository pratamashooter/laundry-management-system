@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
<style type="text/css">
	.proses-gif{
		object-fit: cover;
		width: 18rem;
		height: 18rem;
	}
	.selesai-gif{
		object-fit: cover;
		width: 17rem;
		height: 17rem;
	}
	.diantar-gif{
		object-fit: cover;
		width: 15rem;
		height: 15rem;
	}
	.diambil-gif{
		object-fit: cover;
		width: 20rem;
		height: 20rem;	
	}
	.line-total{
	    width: 100%;
	    border-top: 2px solid #dfdfdf;
	}
	.table-total tr th, .table-total tr td, .table-pembayaran tr th, .table-pembayaran tr td{
	    padding: 3px;
	}
	.table_ket_transaksi tr th, .table_ket_transaksi tr td{
		padding: 5px;
	}
</style>
@endsection
@section('konten')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pesanan</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/pesanan_saya') }}">Pesanan Saya</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
	<div class="row ket_pesanan" hidden="">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="d-flex justify-content-between">
								<h4>Keterangan Pesanan</h4>
								<button class="btn btn-primary btn-sm font-weight-bold cetak_struk_btn" hidden="">Cetak Struk</button>
							</div>
							<hr>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 text-center">
									<img src="{{ asset('gif/laundry-cat.gif') }}" class="proses-gif">
									<img src="{{ asset('gif/selesai.gif') }}" class="selesai-gif" hidden="">
									<img src="{{ asset('gif/scooter-running.gif') }}" class="diantar-gif" hidden="">
									<img src="{{ asset('gif/completed.gif') }}" class="diambil-gif" hidden="">
								</div>
								<div class="col-md-12">
									<div class="alert alert-warning font-weight-bold text-center ket-proses">Pesanan Sedang Dicuci</div>
									<div class="alert alert-success font-weight-bold text-center ket-selesai" hidden="">Pesanan Selesai Dicuci</div>
									<div class="alert alert-danger font-weight-bold text-center ket-diantar" hidden="">Pesanan Sedang Diantar</div>
									<div class="alert alert-dark font-weight-bold text-center ket-diambil" hidden="">Pesanan Sudah Diterima</div>
								</div>
								<div class="col-md-12">
									<table style="width: 100%;" class="table_ket_transaksi">
										<tr hidden="">
											<td><input type="text" name="id_transaksi" class="id_transaksi"></td>
										</tr>
										<tr>
											<th>Tanggal Pemberian</th>
											<td>:</td>
											<td class="tgl_pemberian_proses"></td>
										</tr>
										<tr class="tgl_selesai_proses_ket">
											<th>Tanggal Selesai</th>
											<td>:</td>
											<td class="tgl_selesai_proses"></td>
										</tr>
										<tr class="tgl_bayar_proses_ket">
											<th>Tanggal Bayar</th>
											<td>:</td>
											<td class="tgl_bayar_proses"></td>
										</tr>
										<tr>
											<th>Metode Pembayaran</th>
											<td>:</td>
											<td class="met_bayar"></td>
										</tr>
										<tr>
											<th>Keterangan</th>
											<td>:</td>
											<td class="ket_bayar"></td>
										</tr>
										<tr class="ket-diterima" hidden="">
											<td colspan="3">
												<button class="btn btn-block btn-danger font-weight-bold diterima-btn">Pesanan Diterima</button>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12">
									<table style="width: 100%;" class="table table_kiloan">
										<thead class="text-center">
											<tr>
												<th>No</th>
												<th>Paket</th>
												<th>Berat Barang</th>
												<th>Harga</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody class="isi_tabel_kiloan">
										</tbody>
									</table>
									<table style="width: 100%;" class="table table_satuan" hidden="">
										<thead class="text-center">
											<tr>
												<th>No</th>
												<th>Barang</th>
												<th>Keterangan</th>
												<th>Jumlah</th>
												<th>Harga</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody class="isi_tabel_satuan">
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5 offset-md-7">
                                    <table style="width: 100%;" class="table-total">
                                        <tr>
                                            <th>Total Paket</th>
                                            <td class="text-right total_paket_proses"></td>
                                        </tr>
                                        <tr class="ket_biaya_antar_proses">
                                            <th>Biaya Antar</th>
                                            <td class="text-right harga_antar_proses"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="line-total"></td>
                                        </tr>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td class="text-right subtotal_proses"></td>
                                        </tr>
                                        <tr class="ket_struk">
                                        	<th>Diskon</th>
                                        	<td class="text-right diskon_proses"></td>
                                        </tr>
                                        <tr class="ket_struk">
                                        	<th>Pajak</th>
                                        	<td class="text-right pajak_proses"></td>
                                        </tr>
                                        <tr class="ket_struk">
                                        	<td colspan="2" class="line-total"></td>
                                        </tr>
                                        <tr class="ket_struk">
                                        	<th>Total</th>
                                        	<td class="text-right total_proses"></td>
                                        </tr>
                                        <tr class="ket_struk">
                                        	<th>Bayar</th>
                                        	<th class="text-right bayar_proses text-success"></th>
                                        </tr>
                                        <tr class="ket_struk">
                                        	<th>Kembali</th>
                                        	<th class="text-right kembali_proses"></th>
                                        </tr>
                                    </table>
                                </div>
							</div>
						</div>
					</div>
				</div>
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
                        <button class="btn btn-flat btn-primary" id="proses-btn">Proses</button>
                        <button class="btn btn-flat btn-outline-primary ml-2" id="selesai-btn">Selesai</button>
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
					<div class="table-responsive" id="table_proses">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Outlet</th>
                                    <th>Kode Invoice</th>
                                    <th>Tgl Pemberian</th>
                                    <th>Pegawai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $number1 = 1; ?>
                            	@foreach($transaksis as $transaksi)
                            	@if($transaksi->status == 'proses')
                            	<tr>
                            		<th class="text-center">{{ $number1 }}</th>
                            		<th>{{ $transaksi->nama_outlet }}</th>
                            		<td class="text-center">{{ $transaksi->kd_invoice }}</td>
                            		<td class="text-center">{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
                            		<td>{{ $transaksi->nama_pegawai }}</td>
                            		<td class="text-center"><button class="btn btn-sm btn-primary font-weight-bold btn-lihat" data-id="{{ $transaksi->id }}">Lihat</button></td>
                            	</tr>
                            	<?php $number1++; ?>
                            	@endif
                            	@endforeach
                            </tbody>
                        </table>
                    </div>
					<div class="table-responsive" id="table_selesai" hidden="">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Outlet</th>
                                    <th>Kode Invoice</th>
                                    <th>Tgl Pemberian</th>
                                    <th>Tgl Selesai</th>
                                    <th>Pegawai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $number2 = 1; ?>
                            	@foreach($transaksis as $transaksi)
                            	@if($transaksi->status == 'selesai')
                            	<tr>
                            		<th class="text-center">{{ $number2 }}</th>
                            		<th>{{ $transaksi->nama_outlet }}</th>
                            		<td class="text-center">{{ $transaksi->kd_invoice }}</td>
                            		<td class="text-center">{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
                            		<td class="text-center">{{ date('d M Y', strtotime($transaksi->tgl_selesai)) }}</td>
                            		<td>{{ $transaksi->nama_pegawai }}</td>
                            		<td class="text-center"><button class="btn btn-sm btn-primary font-weight-bold btn-lihat" data-id="{{ $transaksi->id }}">Lihat</button></td>
                            	</tr>
                            	<?php $number2++; ?>
                            	@endif
                            	@endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" id="table_diantar" hidden="">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Outlet</th>
                                    <th>Kode Invoice</th>
                                    <th>Tgl Pemberian</th>
                                    <th>Tgl Selesai</th>
                                    <th>Pegawai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $number3 = 1; ?>
                            	@foreach($transaksis as $transaksi)
                            	@if($transaksi->status == 'diantar')
                            	<tr>
                            		<th class="text-center">{{ $number3 }}</th>
                            		<th>{{ $transaksi->nama_outlet }}</th>
                            		<td class="text-center">{{ $transaksi->kd_invoice }}</td>
                            		<td class="text-center">{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
                            		<td class="text-center">{{ date('d M Y', strtotime($transaksi->tgl_selesai)) }}</td>
                            		<td>{{ $transaksi->nama_pegawai }}</td>
                            		<td class="text-center"><button class="btn btn-sm btn-primary font-weight-bold btn-lihat" data-id="{{ $transaksi->id }}">Lihat</button></td>
                            	</tr>
                            	<?php $number3++; ?>
                            	@endif
                            	@endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" id="table_diambil" hidden="">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Outlet</th>
                                    <th>Kode Invoice</th>
                                    <th>Tgl Pemberian</th>
                                    <th>Tgl Selesai</th>
                                    <th>Pegawai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $number4 = 1; ?>
                            	@foreach($transaksis as $transaksi)
                            	@if($transaksi->status == 'diambil')
                            	<tr>
                            		<th class="text-center">{{ $number4 }}</th>
                            		<th>{{ $transaksi->nama_outlet }}</th>
                            		<td class="text-center">{{ $transaksi->kd_invoice }}</td>
                            		<td class="text-center">{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
                            		<td class="text-center">{{ date('d M Y', strtotime($transaksi->tgl_selesai)) }}</td>
                            		<td>{{ $transaksi->nama_pegawai }}</td>
                            		<td class="text-center"><button class="btn btn-sm btn-primary font-weight-bold btn-lihat" data-id="{{ $transaksi->id }}">Lihat</button></td>
                            	</tr>
                            	<?php $number4++; ?>
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
	$(document).on('click', '.diterima-btn', function(e){
		e.preventDefault();
		var id = $('.id_transaksi').val();
		$.ajax({
			url: "{{ url('/ubah_status_transaksi/diambil') }}/" + id,
			method: "GET",
			success:function(data){
				if(data == 'sukses'){
					swal({
	                    title: "Berhasil!",
	                    text: "Pesanan telah diterima",
	                    type: "success"
	                }, function(){
	                    window.open("{{ url('/pesanan_saya') }}", "_self");
	                });
				}
			}
		});
	});

    $(document).on('click', '.cetak_struk_btn', function(e){
        e.preventDefault();
        var id = $('.id_transaksi').val();
        window.open("{{ url('/pdf_transaksi') }}/" + id, '_blank');
    });

	$(document).on('click', '.btn-lihat', function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		$.ajax({
			url: "{{ url('/lihat_pesanan_pelanggan') }}/" + id,
			method: "GET",
			success:function(response){
				$('.ket_pesanan').prop('hidden', false);
				$('.id_transaksi').val(response.transaksis.id);
				$('.tgl_pemberian_proses').html(moment(response.transaksis.tgl_pemberian).format('DD MMMM YYYY'));
				if(response.transaksis.tgl_selesai != null)
				{
					$('.tgl_selesai_proses_ket').prop('hidden', false);
					$('.tgl_selesai_proses').html(moment(response.transaksis.tgl_selesai).format('DD MMMM YYYY'));
				}else{
					$('.tgl_selesai_proses_ket').prop('hidden', true);
				}
				if(response.transaksis.tgl_bayar != null)
				{
					$('.tgl_bayar_proses_ket').prop('hidden', false);
					$('.tgl_bayar_proses').html(moment(response.transaksis.tgl_bayar).format('DD MMMM YYYY'));
				}else{
					$('.tgl_bayar_proses_ket').prop('hidden', true);	
				}
				$('.ket_bayar').html(response.transaksis.ket_bayar);
				if(response.checkout_kilos != '')
				{
					$('.table_kiloan').prop('hidden', false);
                    $('.table_satuan').prop('hidden', true);
                    $('.met_bayar').html('Bayar di ' + response.checkout_kilo.metode_pembayaran);
                    var isi_tabel_kiloan = "";
                    for(var i = 0; i < response.checkout_kilos.length; i++){
                        var no = i + 1;
                        isi_tabel_kiloan += '<tr><th class="text-center">'+no+'</th><td>'+response.checkout_kilos[i].nama_paket+'</td><td class="text-center">'+response.checkout_kilos[i].berat_barang+'</td><td>Rp. '+parseInt(response.checkout_kilos[i].harga_paket_satuan).toLocaleString()+'</td><td>Rp. '+parseInt(response.checkout_kilos[i].harga_paket).toLocaleString()+'</td></tr>';
                    }
                    $('.isi_tabel_kiloan').html(isi_tabel_kiloan);
                    $('.total_paket_proses').html('Rp. ' + parseInt(response.harga_paket).toLocaleString());
                    if(response.checkout_kilo.antar_jemput_paket == 1 || response.checkout_kilo.harga_antar != 0){
                        $('.ket_biaya_antar_proses').prop('hidden', false);
                        $('.harga_antar_proses').html('Rp. ' + parseInt(response.checkout_kilo.harga_antar).toLocaleString());
                    }else{
                        $('.ket_biaya_antar_proses').prop('hidden', true);
                        $('.harga_antar_proses').html('');
                    }
                    $('.subtotal_proses').html('Rp. ' + parseInt(response.checkout_kilo.harga_total).toLocaleString());
                    if(response.struks != '')
                    {
                    	$('.ket_struk').each(function(){
                    		$(this).prop('hidden', false);
                    	});
                    	$('.diskon_proses').html(response.transaksis.diskon + ' %');
                    	$('.pajak_proses').html(response.transaksis.pajak + ' %');
                    	$('.total_proses').html('Rp. ' + parseInt(response.struks.harga_total).toLocaleString());
                    	$('.bayar_proses').html('Rp. ' + parseInt(response.struks.harga_bayar).toLocaleString());
                    	$('.kembali_proses').html('Rp. ' + parseInt(response.struks.harga_kembali).toLocaleString());
                    }else{
                    	$('.ket_struk').each(function(){
                    		$(this).prop('hidden', true);
                    	});
                    }
				}else{
					$('.table_kiloan').prop('hidden', true);
                    $('.table_satuan').prop('hidden', false);
                    $('.met_bayar').html('Bayar di ' + response.checkout_satu.metode_pembayaran);
                    var isi_tabel_satuan = "";
                    for(var i = 0; i < response.checkout_satus.length; i++){
                        var no = i + 1;
                        var ket_barang = "";
                        if(response.checkout_satus[i].ket_barang == null)
                        {
                            ket_barang = '-';
                        }else{
                            ket_barang = response.checkout_satus[i].ket_barang;
                        }
                        isi_tabel_satuan += '<tr><th class="text-center">'+no+'</th><td>'+response.checkout_satus[i].nama_barang+'</td><td>'+ket_barang+'</td><td class="text-center">'+response.checkout_satus[i].jumlah_barang+'</td><td>Rp. '+parseInt(response.checkout_satus[i].harga_barang_satuan).toLocaleString()+'</td><td>Rp. '+parseInt(response.checkout_satus[i].harga_barang).toLocaleString()+'</td></tr>';
                    }
                    $('.isi_tabel_satuan').html(isi_tabel_satuan);
                    $('.total_paket_proses').html('Rp. ' + parseInt(response.harga_paket).toLocaleString());
                    if(response.checkout_satu.harga_antar != 0){
                        $('.ket_biaya_antar_proses').prop('hidden', false);
                        $('.harga_antar_proses').html('Rp. ' + parseInt(response.checkout_satu.harga_antar).toLocaleString());
                    }else{
                        $('.ket_biaya_antar_proses').prop('hidden', true);
                        $('.harga_antar_proses').html('');
                    }
                    $('.subtotal_proses').html('Rp. ' + parseInt(response.checkout_satu.harga_total).toLocaleString());
                    if(response.struks != '')
                    {
                    	$('.ket_struk').each(function(){
                    		$(this).prop('hidden', false);
                    	});
                    	$('.diskon_proses').html(response.transaksis.diskon + ' %');
                    	$('.pajak_proses').html(response.transaksis.pajak + ' %');
                    	$('.total_proses').html('Rp. ' + parseInt(response.struks.harga_total).toLocaleString());
                    	$('.bayar_proses').html('Rp. ' + parseInt(response.struks.harga_bayar).toLocaleString());
                    	$('.kembali_proses').html('Rp. ' + parseInt(response.struks.harga_kembali).toLocaleString());
                    }else{
                    	$('.ket_struk').each(function(){
                    		$(this).prop('hidden', true);
                    	});
                    }
				}

			}
		});
	});

	$(document).on('click', '#proses-btn', function(e){
		e.preventDefault();
		$(this).removeClass('btn-outline-primary');
		$(this).addClass('btn-primary');
		$('.ket_pesanan').prop('hidden', true);
		$('#selesai-btn').removeClass('btn-primary');
		$('#selesai-btn').addClass('btn-outline-primary');
		$('#diantar-btn').removeClass('btn-primary');
		$('#diantar-btn').addClass('btn-outline-primary');
		$('#diambil-btn').removeClass('btn-primary');
		$('#diambil-btn').addClass('btn-outline-primary');
		$('.proses-gif').prop('hidden', false);
		$('.selesai-gif').prop('hidden', true);
		$('.diantar-gif').prop('hidden', true);
		$('.diambil-gif').prop('hidden', true);
		$('.ket-proses').prop('hidden', false);
		$('.ket-selesai').prop('hidden', true);
		$('.ket-diantar').prop('hidden', true);
		$('.ket-diambil').prop('hidden', true);
		$('#table_proses').prop('hidden', false);
		$('#table_selesai').prop('hidden', true);
		$('#table_diantar').prop('hidden', true);
		$('#table_diambil').prop('hidden', true);
		$('.ket-diterima').prop('hidden', true);
		$('.cetak_struk_btn').prop('hidden', true);
	});

	$(document).on('click', '#selesai-btn', function(e){
		e.preventDefault();
		$(this).removeClass('btn-outline-primary');
		$(this).addClass('btn-primary');
		$('.ket_pesanan').prop('hidden', true);
		$('#proses-btn').removeClass('btn-primary');
		$('#proses-btn').addClass('btn-outline-primary');
		$('#diantar-btn').removeClass('btn-primary');
		$('#diantar-btn').addClass('btn-outline-primary');
		$('#diambil-btn').removeClass('btn-primary');
		$('#diambil-btn').addClass('btn-outline-primary');
		$('.proses-gif').prop('hidden', true);
		$('.selesai-gif').prop('hidden', false);
		$('.diantar-gif').prop('hidden', true);
		$('.diambil-gif').prop('hidden', true);
		$('.ket-proses').prop('hidden', true);
		$('.ket-selesai').prop('hidden', false);
		$('.ket-diantar').prop('hidden', true);
		$('.ket-diambil').prop('hidden', true);
		$('#table_proses').prop('hidden', true);
		$('#table_selesai').prop('hidden', false);
		$('#table_diantar').prop('hidden', true);
		$('#table_diambil').prop('hidden', true);
		$('.ket-diterima').prop('hidden', true);
		$('.cetak_struk_btn').prop('hidden', true);
	});

	$(document).on('click', '#diantar-btn', function(e){
		e.preventDefault();
		$(this).removeClass('btn-outline-primary');
		$(this).addClass('btn-primary');
		$('.ket_pesanan').prop('hidden', true);
		$('#selesai-btn').removeClass('btn-primary');
		$('#selesai-btn').addClass('btn-outline-primary');
		$('#proses-btn').removeClass('btn-primary');
		$('#proses-btn').addClass('btn-outline-primary');
		$('#diambil-btn').removeClass('btn-primary');
		$('#diambil-btn').addClass('btn-outline-primary');
		$('.proses-gif').prop('hidden', true);
		$('.selesai-gif').prop('hidden', true);
		$('.diantar-gif').prop('hidden', false);
		$('.diambil-gif').prop('hidden', true);
		$('.ket-proses').prop('hidden', true);
		$('.ket-selesai').prop('hidden', true);
		$('.ket-diantar').prop('hidden', false);
		$('.ket-diambil').prop('hidden', true);
		$('#table_proses').prop('hidden', true);
		$('#table_selesai').prop('hidden', true);
		$('#table_diantar').prop('hidden', false);
		$('#table_diambil').prop('hidden', true);
		$('.ket-diterima').prop('hidden', false);
		$('.cetak_struk_btn').prop('hidden', false);
	});

	$(document).on('click', '#diambil-btn', function(e){
		e.preventDefault();
		$(this).removeClass('btn-outline-primary');
		$(this).addClass('btn-primary');
		$('.ket_pesanan').prop('hidden', true);
		$('#selesai-btn').removeClass('btn-primary');
		$('#selesai-btn').addClass('btn-outline-primary');
		$('#diantar-btn').removeClass('btn-primary');
		$('#diantar-btn').addClass('btn-outline-primary');
		$('#proses-btn').removeClass('btn-primary');
		$('#proses-btn').addClass('btn-outline-primary');
		$('.proses-gif').prop('hidden', true);
		$('.selesai-gif').prop('hidden', true);
		$('.diantar-gif').prop('hidden', true);
		$('.diambil-gif').prop('hidden', false);
		$('.ket-proses').prop('hidden', true);
		$('.ket-selesai').prop('hidden', true);
		$('.ket-diantar').prop('hidden', true);
		$('.ket-diambil').prop('hidden', false);
		$('#table_proses').prop('hidden', true);
		$('#table_selesai').prop('hidden', true);
		$('#table_diantar').prop('hidden', true);
		$('#table_diambil').prop('hidden', false);
		$('.ket-diterima').prop('hidden', true);
		$('.cetak_struk_btn').prop('hidden', false);
	});
</script>
@endsection