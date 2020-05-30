@foreach($paket_satus as $paket_satu)
<li class="list-group-item d-flex justify-content-between">
	<div class="nama_barang">
		<p class="font-weight-bold">{{ $paket_satu->nama_barang . ' - ' . $paket_satu->ket_barang }}</p>
	</div>
	<div class="harga_barang">
		<p class="text-dark font-weight-bold">Rp. {{ number_format($paket_satu->harga_barang,2,',','.') }}</p>
	</div>
</li>
@endforeach