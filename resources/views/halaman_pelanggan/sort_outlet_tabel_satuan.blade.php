<table style="width: 100%;">
    @foreach($paket_satus as $paket_satu)
    <tr>
        <td style="width: 50px; border-left: 1px solid #aaa;" class="item-satuan">
            <div class="numbering">{{ $loop->iteration }}</div>
        </td>
        <td style="width: 600px; font-weight: bold;" class="text-left item-satuan">
            {{ $paket_satu->nama_barang . ' ' . $paket_satu->ket_barang }}
            <input type="text" name="kd_barang[]" value="{{ $paket_satu->kd_barang }}" hidden="">
        </td>
        <td style="text-align: center;" class="item-satuan">
            <div class="d-flex justify-content-around">
                <button type="button" class="btn-xs btn-ammount text-info btn-min"><i class="fa fa-minus"></i></button>
                <input type="text" class="form-control-xs input-ammount" name="jumlah_barang[]" value="0" readonly="readonly" style="width: 15px; border: 0;">
                <button type="button" class="btn-xs btn-ammount text-info btn-plus"><i class="fa fa-plus"></i></button>
            </div>
        </td>
        <td style="font-weight: bold; width: 200px; border-right: 1px solid #aaa;" class="item-satuan">
            Rp. {{ number_format($paket_satu->harga_barang,2,',','.') }}
            <input type="text" hidden="" name="harga_satuan" class="harga_satuan" value="{{ $paket_satu->harga_barang }}">
            <input type="text" hidden="" name="subtotal[]" class="subtotal">
        </td>
    </tr>
    @endforeach
</table>