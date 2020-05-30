@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
<style type="text/css">
.fotouser{
    object-fit: cover;
    width: 3rem;
    height: 3rem;
}
.c-primary{
    color: #7571f9;
}
.foto_pengguna{
    object-fit: cover;
    width: 8rem;
    height: 8rem;
}
.tabel-riwayat thead tr th, .tabel-riwayat tbody tr th, .tabel-riwayat tbody tr td{
    font-size: 11px;
}
</style>
@endsection
@section('konten')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Kelola Data</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/kelola_pengguna') }}">Kelola Pengguna</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="modal fade" id="lihatModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Pengguna</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row text-center">
                                <div class="col-md-12 mt-1">
                                    <img src="" class="foto_pengguna rounded-circle">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <h3 class="nama_pengguna"></h3>
                                </div>
                                <div class="col-md-12 mt-1">
                                    <div class="btn btn-primary btn-sm role_pengguna font-weight-bold"></div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 mb-2">
                                    <h4 class="text-left text-primary ml-2">Riwayat Kerja</h4>
                                </div>
                                <div class="col-md-12">
                                    <table style="width: 100%;" class="table tabel-riwayat">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Outlet</th>
                                                <th>Kd Invoice</th>
                                                <th>Pelanggan</th>
                                                <th>Tgl Pemberian</th>
                                            </tr>
                                        </thead>
                                        <tbody class="isi_riwayat">
                                        </tbody>
                                        <tfoot class="text-center">
                                            <tr>
                                                <th colspan="6" style="font-size: 12px;"><a href="" class="semua_riwayat_btn">Semua Riwayat <i class="fa fa-angle-down" aria-hidden="true"></i></a></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                    	<h4 class="card-title">Daftar Pengguna</h4>
                    	<button type="button" data-count="{{ $outlets }}" class="btn font-weight-bold btn-sm mb-1 btn-primary tambah_pengguna_btn">Tambah Pengguna <span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kode Pengguna</th>
                                    <th>Posisi</th>
                                    <th>Username</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number = 1 ?>
                            	@foreach($penggunas as $pengguna)
                                @if($pengguna->role == 'admin' || $pengguna->role == 'kasir')
                                <tr>
                                    <th class="align-middle text-center">{{ $number }}</th>
                                    <th><img src="{{ asset('/pictures/'.$pengguna->avatar) }}" class="rounded-circle mr-3 fotouser" alt="">{{ $pengguna->name }}</th>
                                    <td class="text-center">{{ $pengguna->kd_pengguna }}</td>
                                    <td>
                                        @if($pengguna->role == 'admin')
                                        <i class="fa fa-circle-o text-success mr-2"></i>
                                        @else
                                        <i class="fa fa-circle-o text-primary mr-2"></i>
                                        @endif
                                        &nbsp;{{ $pengguna->role }}</td>
                                    <td>{{ $pengguna->username }}</td>
                                    <td style="text-align: center;">
                                    	<div class="dropdown custom-dropdown">
                                            <div data-toggle="dropdown" style="padding: 5px;"><i class="fa fa-ellipsis-v c-primary" style="font-size: 16px;"></i>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right"><a role="button" data-toggle="modal" data-target="#lihatModal" data-lihat="{{ $pengguna->id }}" class="dropdown-item lihat_pengguna_btn" href="#">Lihat</a> <a class="dropdown-item" href="{{ url('/edit_pengguna/'.$pengguna->id) }}">Edit</a>
                                            </div>
                                        </div>&nbsp;&nbsp;&nbsp;
                                        <a href="{{ url('/hapus_pengguna/'.$pengguna->id) }}" style="color: grey;"><i class="fa fa-trash c-primary" style="font-size: 16px;"></i></a>
                                    </td>
                                </tr>
                                <?php $number++ ?>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
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
$(document).on('click', '.lihat_pengguna_btn', function(e){
    e.preventDefault();
    var id = $(this).attr('data-lihat');
    $.ajax({
        url: "{{ url('/lihat_pengguna') }}/" + id,
        method: "GET",
        success:function(response){
            $('.foto_pengguna').attr('src', "{{ asset('/pictures') }}/" + response.penggunas.avatar);
            $('.nama_pengguna').html(response.penggunas.name);
            $('.role_pengguna').html(response.penggunas.role);
            var isi_riwayat = "";
            for(var i = 0; i < response.transaksis.length; i++){
                var no = i + 1;
                isi_riwayat += '<tr><th>'+no+'</th><th>'+response.transaksis[i].nama_outlet+'</th><td>'+response.transaksis[i].kd_invoice+'</td><td>'+response.transaksis[i].nama_pelanggan+'</td><td>'+moment(response.transaksis[i].tgl_pemberian).format('DD MMMM YYYY')+'</td></tr>';
            }
            $('.isi_riwayat').html(isi_riwayat);
            $('.semua_riwayat_btn').attr('href', "{{ url('/laporan_pegawai_riwayat') }}/" + response.penggunas.id);
        }
    });
});

$(document).on('click', '.tambah_pengguna_btn', function(e){
    e.preventDefault();
    var cek_count = $(this).attr('data-count');
    if(parseInt(cek_count) != 0)
    {
        window.open("{{ url('/tambah_pengguna') }}","_self");
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
    });
}

@if ($message = Session::get('tersimpan'))
swal(
    "Berhasil!",
    "{{ $message }}",
    "success"
);
@endif

@if ($message = Session::get('terhapus'))
swal(
    "Berhasil!",
    "{{ $message }}",
    "success"
);
@endif

@if ($message = Session::get('terubah'))
swal(
    "Berhasil!",
    "{{ $message }}",
    "success"
);
@endif
</script>
@endsection