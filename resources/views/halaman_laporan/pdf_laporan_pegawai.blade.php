<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pegawai</title>
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
		.badge {
		    border-radius: 8px;
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
		.badge-info{
			background-color: #4d7cff;
		}
		.badge-warning{
			background-color: #f29d56;
		}
		.badge-danger{
			background-color: #ff5e5e;
		}
		.badge-success{
			background-color: #6fd96f;
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
				<td class="text-right" style="padding-top: 50px; padding-right: 50px;">Pratama Laundry<br>Jasa Laundry Terbaik di Indonesia</td>
			</tr>
			<tr>
				<td style="padding-left: 50px; color: #454545; font-weight: bold;">PEGAWAI</td>
				<td style="font-size: 28px; color: #313131; padding-top: 15px; padding-right: 50px;" class="text-right">Invoice</td>
			</tr>
			<tr>
				<td style="padding-left: 50px; vertical-align: top;"><b>Kode: </b>{{ $users->kd_pengguna }}</td>
				<td class="text-right" style="padding-right: 50px;">
					@if($tanggal != '')
					{{ $tanggal }}
					@else
					{{ date('d M Y', strtotime($start_date2)) . ' - ' . date('d M Y', strtotime($end_date2)) }}
					@endif
				</td>
			</tr>
			<tr>
				<td style="padding-left: 50px; padding-top: -5px;"><b>Posisi: </b>{{ $users->role }}</td>
			</tr>
			<tr>
				<td style="padding-left: 50px; padding-top: -5px;"><b>Nama: </b>{{ $users->name }}</td>
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
				<th>TGL PEMBERIAN</th>
				<th>KET BAYAR</th>
				<th>STATUS</th>
			</tr>
			@foreach($riwayats as $riwayat)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $riwayat->nama_outlet }}</td>
				<td>{{ $riwayat->kd_invoice }}</td>
				<td>{{ $riwayat->nama_pelanggan }}</td>
				<td>{{ date('d M Y', strtotime($riwayat->tgl_pemberian)) }}</td>
				<td>{{ $riwayat->ket_bayar }}</td>
				<td>
					@if($riwayat->status == 'baru')
			      	<span class="badge badge-info">{{ $riwayat->status }}</span>
			      	@elseif($riwayat->status == 'proses')
			      	<span class="badge badge-warning">{{ $riwayat->status }}</span>
			      	@elseif($riwayat->status == 'selesai')
			      	<span class="badge badge-success">{{ $riwayat->status }}</span>
			      	@elseif($riwayat->status == 'diantar')
			      	<span class="badge badge-danger">{{ $riwayat->status }}</span>
	                @elseif($riwayat->status == 'diambil')
	                <span class="badge badge-primary">{{ $riwayat->status }}</span>
			      	@endif
			     </td>
			</tr>
			@endforeach
			<tr>
				<th colspan="5" style="border-bottom: 0px; padding-top: 10px; padding-bottom: 10px;"></th>
				<th style="padding-top: 10px; padding-bottom: 10px; text-align: left; color: #454545;">JUMLAH</th>
				<th style="padding-top: 10px; padding-bottom: 10px; text-align: right; color: #7572f7;">{{ $riwayats->count() }}</th>
			</tr>
		</table>
	</div>
</body>
</html>