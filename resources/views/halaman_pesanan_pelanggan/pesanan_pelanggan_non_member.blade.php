@extends('halaman_template')
@section('css')
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
	<div class="row ket_pesanan">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="d-flex justify-content-between">
								<h4>Keterangan Pesanan</h4>
								@if($transaksis->status == 'diantar' || $transaksis->status == 'diambil')
								<button class="btn btn-primary btn-sm font-weight-bold cetak_struk_btn">Cetak Struk</button>
								@endif
							</div>
							<hr>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12 text-center">
									@if($transaksis->status == 'proses')
									<img src="{{ asset('gif/laundry-cat.gif') }}" class="proses-gif">
									@elseif($transaksis->status == 'selesai')
									<img src="{{ asset('gif/selesai.gif') }}" class="selesai-gif">
									@elseif($transaksis->status == 'diantar')
									<img src="{{ asset('gif/scooter-running.gif') }}" class="diantar-gif">
									@elseif($transaksis->status == 'diambil')
									<img src="{{ asset('gif/completed.gif') }}" class="diambil-gif">
									@endif
								</div>
								<div class="col-md-12">
									@if($transaksis->status == 'proses')
									<div class="alert alert-warning font-weight-bold text-center ket-proses">Pesanan Sedang Dicuci</div>
									@elseif($transaksis->status == 'selesai')
									<div class="alert alert-success font-weight-bold text-center ket-selesai">Pesanan Selesai Dicuci</div>
									@elseif($transaksis->status == 'diantar')
									<div class="alert alert-danger font-weight-bold text-center ket-diantar">Pesanan Sedang Diantar</div>
									@elseif($transaksis->status == 'diambil')
									<div class="alert alert-dark font-weight-bold text-center ket-diambil">Pesanan Sudah Diterima</div>
									@endif
								</div>
								<div class="col-md-12">
									<table style="width: 100%;" class="table_ket_transaksi">
										<tr hidden="">
											<td><input type="text" name="id_transaksi" class="id_transaksi" value="{{ $transaksis->id }}"></td>
										</tr>
										<tr>
											<th>Tanggal Pemberian</th>
											<td>:</td>
											<td class="tgl_pemberian_proses">{{ date('d M Y', strtotime($transaksis->tgl_pemberian)) }}</td>
										</tr>
										@if($transaksis->tgl_selesai != '')
										<tr class="tgl_selesai_proses_ket">
											<th>Tanggal Selesai</th>
											<td>:</td>
											<td class="tgl_selesai_proses">{{ date('d M Y', strtotime($transaksis->tgl_selesai)) }}</td>
										</tr>
										@endif
										@if($transaksis->tgl_bayar != '')
										<tr class="tgl_bayar_proses_ket">
											<th>Tanggal Bayar</th>
											<td>:</td>
											<td class="tgl_bayar_proses">{{ date('d M Y', strtotime($transaksis->tgl_bayar)) }}</td>
										</tr>
										@endif
										<tr>
											<th>Metode Pembayaran</th>
											<td>:</td>
											<td class="met_bayar">
												@if($checkout_kilo != '')
												{{ 'Bayar di ' . $checkout_kilo->metode_pembayaran }}
												@else
												{{ 'Bayar di ' . $checkout_satu->metode_pembayaran }}
												@endif
											</td>
										</tr>
										<tr>
											<th>Keterangan</th>
											<td>:</td>
											<td class="ket_bayar">{{ $transaksis->ket_bayar }}</td>
										</tr>
										@if($transaksis->status == 'diantar')
										<tr class="ket-diterima">
											<td colspan="3">
												<button class="btn btn-block btn-danger font-weight-bold diterima-btn">Pesanan Diterima</button>
											</td>
										</tr>
										@endif
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12">
									@if($checkout_kilos != '')
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
											@foreach($checkout_kilos as $checkout)
											<tr>
												<th class="text-center">{{ $loop->iteration }}</th>
												<th>{{ $checkout->nama_paket }}</th>
												<td class="text-center">{{ $checkout->berat_barang }}</td>
												<td>Rp. {{ number_format($checkout->harga_paket_satuan,2,',','.') }}</td>
												<td>Rp. {{ number_format($checkout->harga_paket,2,',','.') }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									@else
									<table style="width: 100%;" class="table table_satuan">
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
											@foreach($checkout_satus as $checkout)
											<tr>
												<th class="text-center">{{ $loop->iteration }}</th>
												<th>{{ $checkout->nama_barang }}</th>
												<td>{{ $checkout->ket_barang }}</td>
												<td class="text-center">{{ $checkout->jumlah_barang }}</td>
												<td>{{ number_format($checkout->harga_barang_satuan,2,',','.') }}</td>
												<td>{{ number_format($checkout->harga_barang,2,',','.') }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-5 offset-md-7">
                                    <table style="width: 100%;" class="table-total">
                                        <tr>
                                            <th>Total Paket</th>
                                            <td class="text-right total_paket_proses">Rp. {{ number_format($harga_paket,2,',','.') }}</td>
                                        </tr>
                                        <tr class="ket_biaya_antar_proses">
                                            <th>Biaya Antar</th>
                                            <td class="text-right harga_antar_proses">
                                            	@if($checkout_kilo != '')
                                            	Rp. {{ number_format($checkout_kilo->harga_antar,2,',','.') }}
                                            	@else
                                            	Rp. {{ number_format($checkout_satu->harga_antar,2,',','.') }}
                                            	@endif
                                        	</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="line-total"></td>
                                        </tr>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td class="text-right subtotal_proses">
                                            	@if($checkout_kilo != '')
                                            	Rp. {{ number_format($checkout_kilo->harga_total,2,',','.') }}
                                            	@else
                                            	Rp. {{ number_format($checkout_satu->harga_antar,2,',','.') }}
                                            	@endif
                                            </td>
                                        </tr>
                                        @if($struks != '')
                                        <tr class="ket_struk">
                                        	<th>Diskon</th>
                                        	<td class="text-right diskon_proses">{{ $transaksis->diskon }} %</td>
                                        </tr>
                                        <tr class="ket_struk">
                                        	<th>Pajak</th>
                                        	<td class="text-right pajak_proses">{{ $transaksis->pajak }} %</td>
                                        </tr>
                                        <tr class="ket_struk">
                                        	<td colspan="2" class="line-total"></td>
                                        </tr>
                                        <tr class="ket_struk">
                                        	<th>Total</th>
                                        	<td class="text-right total_proses">Rp. {{ number_format($struks->harga_total,2,',','.') }}</td>
                                        </tr>
                                        <tr class="ket_struk">
                                        	<th>Bayar</th>
                                        	<th class="text-right bayar_proses text-success">Rp. {{ number_format($struks->harga_bayar,2,',','.') }}</th>
                                        </tr>
                                        <tr class="ket_struk">
                                        	<th>Kembali</th>
                                        	<th class="text-right kembali_proses">Rp. {{ number_format($struks->harga_kembali,2,',','.') }}</th>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
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
</script>
@endsection