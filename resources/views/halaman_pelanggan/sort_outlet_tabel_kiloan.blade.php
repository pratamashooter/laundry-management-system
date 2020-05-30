@foreach($paket_kilos as $paket_kilo)
<div class="col-md-3">
    <div class="form-group">
        <label>
            <input type="radio" name="jenis_paket" class="card-input-element jenis_paket" data-berat="{{ $paket_kilo->min_berat_paket }}" data-nama="{{ $paket_kilo->nama_paket }}" data-harga="{{ $paket_kilo->harga_paket }}" data-antar="{{ $paket_kilo->antar_jemput_paket }}" value="{{ $paket_kilo->kd_paket }}">
            <div class="card card-line card-input">
              <div class="card-body">
                <h5>{{ $paket_kilo->nama_paket }}</h5>
                <p>- Harga paket : Rp. {{ number_format($paket_kilo->harga_paket,0,',','.') }}</p>
                <p style="margin-top: -15px;">- Lama Cuci : {{ $paket_kilo->hari_paket . ' hari' }}</p>
                <p style="margin-top: -15px;">- Minimal Berat : {{ $paket_kilo->min_berat_paket }} kg</p>
                @if($paket_kilo->antar_jemput_paket == 1)
                <hr>
                <p style="margin-bottom: -5px;"><i class="icon-check text-success"></i> Gratis pengantaran</p>
                @endif
              </div>
            </div>
        </label>
    </div>
</div>
@endforeach