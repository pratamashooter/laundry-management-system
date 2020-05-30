<!DOCTYPE html>
<html>
<head>
	<title>Struk Pemesanan</title>
	<style type="text/css">
		html{
			margin: 0;
			padding: 0;
			font-family: "Nunito", sans-serif;
		}
		.header{
			width: 100%;
			height: auto;
			background-color: #f7f7f7f7;
			padding-bottom: 50px;
		}
		.logo-laundry{
		    object-fit: cover;
		    width: 4rem;
		    height: 4rem;
		}
		.text-right{
			text-align: right;
		}
		.text-center{
			text-align: center;
		}
		.table-header tr td{
			padding: 5px;
			color: #999999;
			font-size: 12px;
		}
		.table-content tr th{
			padding: 8px;
			font-size: 11px;
			color: #999999;
			border-bottom: 1px solid #ddd;
		}
		.table-content tr td{
			padding: 8px;
			font-size: 11px;
			color: #454545;
			border-bottom: 1px solid #ddd;
		}
		.body-content{
			margin-top: 50px;
		}
		.badge {
		    border-radius: 2px;
		    color: #fff;
		    display: inline-block;
		    line-height: 1;
		    min-width: 10px;
		    font-size: 10px;
		    font-weight: bold;
		    padding: 3px 7px;
		    text-align: center;
		    vertical-align: middle;
		    white-space: nowrap;
		}
		.badge-primary{
			background-color: #7571f9;
		}
	</style>
</head>
<body>
	<div class="header">
		<table style="width: 100%;" class="table-header">
			<tr>
				<td style="padding-top: 50px; padding-left: 50px;"><img src="{{ asset('icons/pratama_icon.png') }}" class="logo-laundry"></td>
				<td class="text-right" style="padding-top: 50px; padding-left: 300px; padding-right: 50px;">{{ $transaksis->nama_outlet }}<br>{{ $transaksis->alamat_outlet }}</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right; padding-right: 50px; padding-top: -5px; color: #7571f9;">{{ $transaksis->email_outlet }}<br>{{ $transaksis->hotline }}</td>
			</tr>
			<tr>
				<td style="padding-left: 50px; text-align: left; color: #454545; font-weight: bold;">PELANGGAN &nbsp;&nbsp;<span class="badge badge-primary">{{ $transaksis->cek_member }}</span></td>
				<td style="font-size: 28px; color: #313131; padding-top: 10px; padding-right: 50px;" class="text-right">Invoice</td>
			</tr>
			<tr>
				<td style="padding-left: 50px; line-height: 1.3; text-align: left; vertical-align: top;" rowspan="2">{{ $transaksis->kd_pelanggan . ', ' . $transaksis->nama_pelanggan }}<br>{{ $transaksis->email_pelanggan }}<br>{{ $transaksis->no_hp_pelanggan }}<br>{{ $transaksis->alamat_pelanggan }}</td>
				<td style="padding-right: 50px; text-align: right;"><b style="color: #454545;">KODE INVOICE</b><br>{{ $transaksis->kd_invoice }}</td>
			</tr>
			<tr>
				<td style="padding-right: 50px; text-align: right;"><b style="color: #454545;">TGL BAYAR</b><br>{{ date('d M Y', strtotime($transaksis->tgl_bayar)) }}</td>
			</tr>
		</table>
	</div>
	<div class="body-content">
		@if($checkout_kilos != '')
		<table style="width: 100%; border-collapse: collapse; padding-right: 50px; padding-left: 50px;" class="table-content">
			<tr>
				<th>NO</th>
				<th>PAKET</th>
				<th>BERAT BARANG</th>
				<th>HARGA</th>
				<th>SUBTOTAL</th>
			</tr>
			@foreach($checkout_kilos as $checkout_kilo)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				<td style="padding-left: 40px;">{{ $checkout_kilo->nama_paket }}</td>
				<td class="text-center">{{ $checkout_kilo->berat_barang }}</td>
				<td style="padding-left: 40px;">Rp. {{ number_format($checkout_kilo->harga_paket_satuan,2,',','.') }}</td>
				<td style="padding-left: 40px;">Rp. {{ number_format($checkout_kilo->harga_paket,2,',','.') }}</td>
			</tr>
			@endforeach
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<th style="padding-top: 10px; padding-bottom: 10px; text-align: left;">TOTAL PAKET</th>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right;">Rp. {{ number_format($harga_paket,2,',','.') }}</td>
			</tr>
			@if($checkout_kilo->harga_antar != 0 || $checkout_kilo->antar_jemput_paket == 1)
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<th style="padding-top: 10px; padding-bottom: 10px; text-align: left;">BIAYA ANTAR</th>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right;">Rp. {{ number_format($checkout_kilo->harga_antar,2,',','.') }}</td>
			</tr>
			@endif
			@if($struks != '')
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: left; font-weight: bold;">TOTAL + DISKON({{ $transaksis->diskon }}%) + PAJAK({{ $transaksis->pajak }}%)</td>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right; font-weight: bold;">Rp. {{ number_format($struks->harga_total,2,',','.') }}</td>
			</tr>
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: left; font-weight: bold;">BAYAR</td>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right; color: #7571f9; font-weight: bold;">Rp. {{ number_format($struks->harga_bayar,2,',','.') }}</td>
			</tr>
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: left; font-weight: bold;">KEMBALIAN</td>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right; color: #454545; font-weight: bold;">Rp. {{ number_format($struks->harga_kembali,2,',','.') }}</td>
			</tr>
			@else
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: left; font-weight: bold;">TOTAL</td>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right; color: #7571f9; font-weight: bold;">Rp. {{ number_format($checkout_kilo->harga_total,2,',','.') }}</td>
			</tr>
			@endif
		</table>
		@endif
		@if($checkout_satus != '')
		<table style="width: 100%; border-collapse: collapse; padding-right: 50px; padding-left: 50px;" class="table-content">
			<tr>
				<th>NO</th>
				<th>BARANG</th>
				<th>KETERANGAN</th>
				<th>JUMLAH</th>
				<th>HARGA</th>
				<th>SUBTOTAL</th>
			</tr>
			@foreach($checkout_satus as $checkout_satu)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				<td style="padding-left: 40px;">{{ $checkout_satu->nama_barang }}</td>
				<td style="padding-left: 40px;">{{ $checkout_satu->ket_barang }}</td>
				<td class="text-center">{{ $checkout_satu->jumlah_barang }}</td>
				<td style="padding-left: 40px;">Rp. {{ number_format($checkout_satu->harga_barang_satuan,2,',','.') }}</td>
				<td style="padding-left: 40px;">Rp. {{ number_format($checkout_satu->harga_barang,2,',','.') }}</td>
			</tr>
			@endforeach
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<th colspan="2" style="padding-top: 10px; padding-bottom: 10px; text-align: left;">TOTAL PAKET</th>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right;">Rp. {{ number_format($harga_paket,2,',','.') }}</td>
			</tr>
			@if($checkout_satu->harga_antar != 0)
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<th colspan="2" style="padding-top: 10px; padding-bottom: 10px; text-align: left;">BIAYA ANTAR</th>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right;">Rp. {{ number_format($checkout_satu->harga_antar,2,',','.') }}</td>
			</tr>
			@endif
			@if($struks != '')
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<td colspan="2" style="padding-top: 10px; padding-bottom: 10px; text-align: left; font-weight: bold;">TOTAL + DISKON({{ $transaksis->diskon }}%) + PAJAK({{ $transaksis->pajak }}%)</td>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right; font-weight: bold;">Rp. {{ number_format($struks->harga_total,2,',','.') }}</td>
			</tr>
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<td colspan="2" style="padding-top: 10px; padding-bottom: 10px; text-align: left; font-weight: bold;">BAYAR</td>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right; color: #7571f9; font-weight: bold;">Rp. {{ number_format($struks->harga_bayar,2,',','.') }}</td>
			</tr>
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<td colspan="2" style="padding-top: 10px; padding-bottom: 10px; text-align: left; font-weight: bold;">KEMBALIAN</td>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right; color: #454545; font-weight: bold;">Rp. {{ number_format($struks->harga_kembali,2,',','.') }}</td>
			</tr>
			@else
			<tr>
				<th colspan="3" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: left; font-weight: bold;">TOTAL</td>
				<td style="padding-top: 10px; padding-bottom: 10px; text-align: right; color: #7571f9; font-weight: bold;">Rp. {{ number_format($checkout_satu->harga_total,2,',','.') }}</td>
			</tr>
			@endif
		</table>
		@endif
	</div>
	<div class="footer-content" style="margin-top: 50px;">
		<p class="text-center" style="font-size: 12px; font-weight: bold; color: #454545; text-transform: uppercase;">Terima Kasih Telah Menggunakan Jasa Kami</p>
	</div>
</body>