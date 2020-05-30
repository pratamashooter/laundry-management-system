<?php $number = 1; ?>
@foreach($transaksis as $transaksi)
<tr>
	<th>{{ $number }}</th>
	<th>{{ $transaksi->nama_outlet }}</th>
	<td>{{ $transaksi->kd_invoice }}</td>
	<td>{{ $transaksi->nama_pelanggan }}</td>
	<td>{{ date('d M Y', strtotime($transaksi->tgl_bayar)) }}</td>
	<td class="text-success font-weight-bold">Rp. {{ number_format($transaksi->harga_bayar,2,',','.') }}</td>
	<td>{{ $transaksi->nama_pegawai }}</td>
</tr>
<?php $number++; ?>
@endforeach