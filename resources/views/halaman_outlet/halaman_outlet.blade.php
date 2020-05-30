@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
<style type="text/css">
.video-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px;
    height: 0;
    overflow: hidden;
}
.video-container iframe,  .video-container object,  .video-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
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
            <li class="breadcrumb-item active"><a href="{{ url('/kelola_outlet') }}">Kelola Outlet</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="modal fade" id="lihatModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Keterangan Outlet</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="val-nama">Nama Outlet</label>
                            <div class="col-md-9">
                                <input type="text" readonly="readonly" class="form-control nama_outlet">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="val-nama">Hotline</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" class="form-control hotline_outlet" readonly="readonly">
                                    <div class="input-group-append">
                                        <button class="btn btn-info panggil_hotline" style="color: #fff;" type="button"><i class="icon-phone"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="val-nama">Email</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" class="form-control email_outlet" readonly="readonly">
                                    <div class="input-group-append">
                                        <button class="btn btn-info pesan_email" style="color: #fff;" type="button"><i class="icon-envelope"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="val-nama">Alamat</label>
                            <div class="col-md-9">
                                <textarea class="form-control h-150px alamat_outlet" rows="4" id="comment" readonly="readonly"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="media video-container available_map" hidden="">

                        </div>
                        <div class="row not_available_map" hidden="">
                            <div class="col-md-11 text-center font-weight-bold" style="height: 200px; margin: 20px; background-color: #fff; color: #fe6383; vertical-align: middle; line-height: 200px; border: 2px solid #7571f9;">
                                Tidak Ada Map
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
                    	<h4 class="card-title">Daftar Outlet</h4>
                    	<a href="{{ url('/tambah_outlet') }}" class="btn mb-1 font-weight-bold btn-sm btn-primary">Tambah Outlet <span class="btn-icon-right"><i class="fa fa-plus"></i></span></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Outlet</th>
                                    <th>Hotline</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($outlets as $outlet)
                            	<tr>
                                 <th class="align-middle text-center">{{ $loop->iteration }}</th>
                                 <th class="align-middle">{{ $outlet->nama }}</th>
                                 <td>{{ $outlet->hotline }}</td>
                                 <td>{{ $outlet->email }}</td>
                                 <td>{{ $outlet->alamat }}</td>
                                 <td style="text-align: center;">
                                        <div class="dropdown custom-dropdown">
                                            <div data-toggle="dropdown" style="padding: 5px;"><i class="fa fa-ellipsis-v c-primary" style="font-size: 16px;"></i>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item lihat_btn" href="#" role="button" data-toggle="modal" data-target="#lihatModal" data-lihat="{{ $outlet->id }}">Lihat</a> <a class="dropdown-item" href="{{ url('/edit_outlet/'.$outlet->id) }}">Edit</a>
                                            </div>
                                        </div>&nbsp;&nbsp;&nbsp;
                                        <a href="{{ url('/hapus_outlet/'.$outlet->id) }}" style="color: grey;"><i class="fa fa-trash c-primary" style="font-size: 16px;"></i></a>
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
@endsection
@section('script')
<script src="{{ asset('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/js/sweetalert.min.js') }}"></script>
<script type="text/javascript">
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

$(document).on('click', '.lihat_btn', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-lihat');
    $.ajax({
        url: "{{ url('lihat_outlet') }}/" + id,
        method: "GET",
        success:function(response){
            $('.nama_outlet').val(response.nama);
            $('.hotline_outlet').val(response.hotline);
            $('.email_outlet').val(response.email);
            $('.alamat_outlet').val(response.alamat);
            if(response.iframe_script == null)
            {
                $('.not_available_map').attr('hidden', false);
                $('.available_map').attr('hidden', true);
            }else{
                $('.not_available_map').attr('hidden', true);
                $('.available_map').attr('hidden', false);
                $('.available_map').html(response.iframe_script);
            }
        }
    });
});

$(document).on('click', '.panggil_hotline', function(){
    var no_hotline = $('.hotline_outlet').val();
    window.open('tel:'+no_hotline+'', '_self');
});

$(document).on('click', '.pesan_email', function(){
    var alamat_email = $('.email_outlet').val();
    window.open('mailto:'+alamat_email+'?Subject=Hallo', '_self');
});
</script>
@endsection