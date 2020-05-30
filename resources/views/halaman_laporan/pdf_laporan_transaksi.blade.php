<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi</title>
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
			text-align: right;
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
	</style>
</head>
<body>
	<div class="header">
		<table style="width: 100%;" class="table-header">
			<tr>
				<td style="padding-top: 50px; padding-left: 50px;"><img src="{{ asset('icons/pratama_icon.png') }}" class="logo-laundry"></td>
				<td class="text-right" style="padding-top: 50px; padding-right: 50px;">Pratama Laundry<br>Jasa Laundry Terbaik di Indonesia</td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 28px; color: #313131; padding-top: 15px; padding-right: 50px;" class="text-right">Invoice</td>
			</tr>
			<tr>
				<td colspan="2" class="text-right" style="padding-right: 50px;">
					@if($tanggal != '')
					{{ $tanggal }}
					@else
					{{ date('d M Y', strtotime($start_date2)) . ' - ' . date('d M Y', strtotime($end_date2)) }}
					@endif
				</td>
			</tr>
		</table>
	</div>
	<div class="body-content">
		<table style="width: 100%; border-collapse: collapse; padding-right: 50px; padding-left: 50px;" class="table-content">
			<tr>
				<th>NO</th>
				<th>OUTLET</th>
				<th>KD INVOICE</th>
				<th>PELANGGAN</th>
				<th>TGL BAYAR</th>
				<th>TOTAL BAYAR</th>
				<th>PEGAWAI</th>
			</tr>
			@foreach($transaksis as $transaksi)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $transaksi->nama_outlet }}</td>
				<td>{{ $transaksi->kd_invoice }}</td>
				<td>{{ $transaksi->nama_pelanggan }}</td>
				<td>{{ date('d M Y', strtotime($transaksi->tgl_bayar)) }}</td>
				<td>Rp. {{ number_format($transaksi->harga_bayar,2,',','.') }}</td>
				<td>{{ $transaksi->nama_pegawai }}</td>
			</tr>
			@endforeach
			<tr>
				<th colspan="4" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<th style="padding-top: 10px; padding-bottom: 10px; color: #454545; text-align: left;">TOTAL PEMASUKKAN</th>
				<th style="padding-top: 10px; padding-bottom: 10px;"></th>
				<th style="padding-top: 10px; padding-bottom: 10px; text-align: right; color: #7572f7;">Rp. {{ number_format($pemasukan,2,',','.') }}</th>
			</tr>
		</table>
	</div>
</body>
</html>