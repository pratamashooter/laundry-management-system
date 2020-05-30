@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
<style type="text/css">
.c-primary{
    color: #7571f9;
}
</style>
@endsection
@section('konten')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Kelola Data</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/kelola_paket') }}">Kelola Paket</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="modal fade" id="lihatModalKiloan">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Keterangan Paket</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Kode Paket</label>
                            <div class="col-md-9">
                                <input type="text" readonly="readonly" class="form-control kd_paket">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nama Paket</label>
                            <div class="col-md-9">
                                <input type="text" readonly="readonly" class="form-control nama_paket">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Harga Paket</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="text" readonly="readonly" class="form-control harga_paket">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Lama Hari</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" readonly="readonly" class="form-control lama_hari_paket">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Hari</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Minimal Berat</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" readonly="readonly" class="form-control min_berat_paket">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Outlet</label>
                            <div class="col-md-9">
                                <input type="text" readonly="readonly" class="form-control outlet_paket">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3 gratis_antar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="lihatModalSatuan">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Keterangan Barang</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Kode Barang</label>
                            <div class="col-md-9">
                                <input type="text" readonly="readonly" class="form-control kd_barang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nama Barang</label>
                            <div class="col-md-9">
                                <input type="text" readonly="readonly" class="form-control nama_barang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Keterangan</label>
                            <div class="col-md-9">
                                <input type="text" readonly="readonly" class="form-control ket_barang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Harga Barang</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="text" readonly="readonly" class="form-control harga_barang">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Outlet</label>
                            <div class="col-md-9">
                                <input type="text" readonly="readonly" class="form-control outlet_barang">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kelola Paket</h4>
                    <!-- Nav tabs -->
                    <div class="default-tab">
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            <li class="nav-item"><a class="nav-link paket_kiloan_tab active" data-toggle="tab" href="#paket_kiloan">Paket Kiloan</a>
                            </li>
                            <li class="nav-item"><a class="nav-link paket_satuan_tab" data-toggle="tab" href="#paket_satuan">Paket Satuan</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="paket_kiloan" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card" style="background-color: #f4f3f9;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <h4>Daftar Paket Kiloan</h4>
                                                    <button type="button" class="btn mb-1 btn-primary font-weight-bold btn-sm tambah_kiloan_btn" data-count="{{ $outlets }}">Tambah Paket <span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered zero-configuration">
                                                        <thead style="text-align: center;">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Kode Paket</th>
                                                                <th>Nama Paket</th>
                                                                <th>Harga</th>
                                                                <th>Lama Cuci</th>
                                                                <th>Minimal Berat</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($paket_kilos as $paket_kilo)
                                                            <tr>
                                                                <th class="align-middle text-center">{{ $loop->iteration }}</th>
                                                                <th class="align-middle text-center">{{ $paket_kilo->kd_paket }}</th>
                                                                <td>{{ $paket_kilo->nama_paket }}</td>
                                                                <td>Rp. {{ number_format($paket_kilo->harga_paket,2,',','.') }}</td>
                                                                <td>{{ $paket_kilo->hari_paket }} Hari</td>
                                                                <td>{{ $paket_kilo->min_berat_paket }} Kg</td>
                                                                <td style="text-align: center;">
                                                                    <div class="dropdown custom-dropdown">
                                                                        <div data-toggle="dropdown" style="padding: 5px;"><i class="fa fa-ellipsis-v c-primary" style="font-size: 16px;"></i>
                                                                        </div>
                                                                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item lihat_btn_kilo" href="#" role="button" data-lihat="{{ $paket_kilo->id }}" data-toggle="modal" data-target="#lihatModalKiloan">Lihat</a> <a class="dropdown-item" href="{{ url('/edit_paket_kiloan/'.$paket_kilo->id) }}">Edit</a>
                                                                        </div>
                                                                    </div>&nbsp;&nbsp;
                                                                    <a href="{{ url('/hapus_paket_kiloan/'.$paket_kilo->id) }}" style="color: grey;"><i class="fa fa-trash c-primary" style="font-size: 16px;"></i></a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="paket_satuan">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card" style="background-color: #f4f3f9;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <h4>Daftar Paket Satuan</h4>
                                                    <button type="button" class="btn mb-1 btn-primary font-weight-bold btn-sm tambah_satuan_btn" data-count="{{ $outlets }}">Tambah Paket <span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered zero-configuration">
                                                        <thead style="text-align: center;">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Kode Barang</th>
                                                                <th>Nama Barang</th>
                                                                <th>Keterangan Barang</th>
                                                                <th>Harga</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($paket_satus as $paket_satu)
                                                            <tr>
                                                                <th class="align-middle text-center">{{ $loop->iteration }}</th>
                                                                <th class="align-middle text-center">{{ $paket_satu->kd_barang }}</th>
                                                                <td>{{ $paket_satu->nama_barang }}</td>
                                                                <td>{{ $paket_satu->ket_barang }}</td>
                                                                <td>Rp. {{ number_format($paket_satu->harga_barang,2,',','.') }}</td>
                                                                <td style="text-align: center;">
                                                                    <div class="dropdown custom-dropdown">
                                                                        <div data-toggle="dropdown" style="padding: 5px;"><i class="fa fa-ellipsis-v c-primary" style="font-size: 16px;"></i>
                                                                        </div>
                                                                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item lihat_btn_satu" href="#" role="button" data-lihat="{{ $paket_satu->id }}" data-toggle="modal" data-target="#lihatModalSatuan">Lihat</a> <a class="dropdown-item" href="{{ url('/edit_paket_satuan/'.$paket_satu->id) }}">Edit</a>
                                                                        </div>
                                                                    </div>&nbsp;&nbsp;
                                                                    <a href="{{ url('/hapus_paket_satuan/'.$paket_satu->id) }}" style="color: grey;"><i class="fa fa-trash c-primary" style="font-size: 16px;"></i></a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
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
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
<script type="text/javascript">
$(document).on('click', '.lihat_btn_kilo', function(e){
    e.preventDefault();
    var id = $(this).attr('data-lihat');
    $.ajax({
        url: "{{ url('/lihat_paket_kiloan') }}/" + id,
        method: "GET",
        success:function(response){
            $('.kd_paket').val(response.kd_paket);
            $('.nama_paket').val(response.nama_paket);
            $('.harga_paket').val(parseInt(response.harga_paket).toLocaleString());
            $('.lama_hari_paket').val(response.hari_paket);
            $('.min_berat_paket').val(response.min_berat_paket);
            $('.outlet_paket').val(response.nama_outlet);
            if(response.antar_jemput_paket == 1)
            {
                $('.gratis_antar').html('<p style="margin-bottom: -5px;"><i class="icon-check text-success"></i> Gratis pengantaran</p>');
            }else{
                $('.gratis_antar').html('');
            }
        }
    });
});

$(document).on('click', '.lihat_btn_satu', function(e){
    e.preventDefault();
    var id = $(this).attr('data-lihat');
    $.ajax({
        url: "{{ url('/lihat_paket_satuan') }}/" + id,
        method: "GET",
        success:function(response){
            $('.kd_barang').val(response.kd_barang);
            $('.nama_barang').val(response.nama_barang);
            $('.ket_barang').val(response.ket_barang);
            $('.harga_barang').val(parseInt(response.harga_barang).toLocaleString());
            $('.outlet_barang').val(response.nama_outlet);
        }
    });
});

$(document).on('click', '.tambah_kiloan_btn', function(e){
    e.preventDefault();
    var cek_count = $(this).attr('data-count');
    if(parseInt(cek_count) != 0)
    {
        window.open("{{ url('/tambah_paket_kiloan') }}","_self");
    }else{
        outlet_kosong();
    }
});

$(document).on('click', '.tambah_satuan_btn', function(e){
    e.preventDefault();
    var cek_count = $(this).attr('data-count');
    if(parseInt(cek_count) != 0)
    {
        window.open("{{ url('/tambah_paket_satuan') }}","_self");
    }else{
        outlet_kosong();
    }
});

function outlet_kosong(){
    toastr.warning("Silakan buat outlet terlebih dahulu","Peringatan !", {
        timeOut:5e3,
        closeButton:!0,
        debug:!1,
        newestOnTop:!0,
        progressBar:!0,
        positionClass:"toast-bottom-right",
        preventDuplicates:!0,
        onclick:null,
        showDuration:"300",
        hideDuration:"1000",
        extendedTimeOut:"1000",
        showEasing:"swing",
        hideEasing:"linear",
        showMethod:"fadeIn",
        hideMethod:"fadeOut",
        tapToDismiss:!1
    })
}

@if ($message = Session::get('tersimpan'))
var simpan = "{{ $message }}";
if(simpan == "kiloan")
{
    swal(
        "Berhasil!",
        "Paket kiloan baru berhasil ditambahkan",
        "success"
    );
}
else if(simpan == "satuan")
{
    swal(
        "Berhasil!",
        "Paket satuan baru berhasil ditambahkan",
        "success"
    );
    $('.paket_satuan_tab').click();
}
@endif

@if ($message = Session::get('terhapus'))
var hapus = "{{ $message }}";
if(hapus == "kiloan")
{
    swal(
        "Berhasil!",
        "Paket kiloan berhasil dihapus",
        "success"
    );
}
else if(hapus == "satuan")
{
    swal(
        "Berhasil!",
        "Paket satuan berhasil dihapus",
        "success"
    );
    $('.paket_satuan_tab').click();
}
@endif

@if ($message = Session::get('terubah'))
var ubah = "{{ $message }}";
if(ubah == "kiloan")
{
    swal(
        "Berhasil!",
        "Paket kiloan berhasil diubah",
        "success"
    );
}
else if(ubah == "satuan")
{
    swal(
        "Berhasil!",
        "Paket satuan berhasil diubah",
        "success"
    );
    $('.paket_satuan_tab').click();
}
@endif
</script>
@endsection