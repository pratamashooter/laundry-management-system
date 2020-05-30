@foreach($riwayats as $riwayat)
<tr>
    <th>{{ $loop->iteration }}</th>
	<th>{{ $riwayat->nama_outlet }}</th>
	<td>{{ $riwayat->kd_invoice }}</td>
	<td>{{ $riwayat->nama_pelanggan }}</td>
	<td>{{ date('d M Y', strtotime($riwayat->tgl_pemberian)) }}</td>
	<td>{{ $riwayat->ket_bayar }}</td>
	<td>
		@if($riwayat->status == 'baru')
        <span class="label label-pill label-info text-white">{{ $riwayat->status }}</span>
        @elseif($riwayat->status == 'proses')
        <span class="label label-pill label-warning text-white">{{ $riwayat->status }}</span>
        @elseif($riwayat->status == 'selesai')
        <span class="label label-pill label-success text-white">{{ $riwayat->status }}</span>
        @elseif($riwayat->status == 'diantar')
        <span class="label label-pill label-danger text-white">{{ $riwayat->status }}</span>
        @elseif($riwayat->status == 'diambil')
        <span class="label label-pill label-primary text-white">{{ $riwayat->status }}</span>
        @endif
    </td>
</tr>
@endforeach