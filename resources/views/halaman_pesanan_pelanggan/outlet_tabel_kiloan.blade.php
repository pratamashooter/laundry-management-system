@foreach($paket_kilos as $paket_kilo)
<div class="list-group-item flex-column align-items-start">
    <div class="d-flex w-100 justify-content-start">
        <h5 class="mb-2">{{ $paket_kilo->nama_paket }}</h5>
    </div>
    <div class="row">
        <div class="col-md-6">
            <table style="width: 100%;" class="tabel-paket">
                <tr>
                    <td>Harga Paket</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($paket_kilo->harga_paket,2,',','.') }}</td>
                </tr>
                <tr>
                    <td>Lama Cuci</td>
                    <td>:</td>
                    <td>{{ $paket_kilo->hari_paket }} Hari</td>
                </tr>
                <tr>
                    <td>Minimal Berat</td>
                    <td>:</td>
                    <td>{{ $paket_kilo->min_berat_paket }} Kg</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
        	@if($paket_kilo->antar_jemput_paket == 1)
            <div style="background-color: #fff; border: 1px solid #7571f9; height: 70px; line-height: 70px; border-radius: 7px;">
                <div class="text-center text-dark font-weight-bold">
                    <p style="font-size: 16px;"><i class="icon-check text-success"></i> Gratis Pengantaran</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endforeach