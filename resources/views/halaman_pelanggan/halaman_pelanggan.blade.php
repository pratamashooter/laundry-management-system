@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
<style type="text/css">
.btn-member-pelanggan{
	background-color: #fff;
	border-radius: 5px;
	width: 200px;
	overflow: hidden;
}
.btn-member{
	float: left;
	text-align: center;
	text-decoration: none;
	background-color: #fff;
	font-weight: bold;
	padding: 10px;
	border-radius: 0px;
}
.c-primary{
	color: #7571f9;
}
.btn-member-border{
	border-bottom: 2px solid #7571f9;
}
.fotouser{
    object-fit: cover;
    width: 3rem;
    height: 3rem;
}
.btn-purple{
	background-color: #6e5cc2;
	color: #fff;
}
.btn-purple:hover{
	color: #fff;
	background-color: #58499b;
}
</style>
@endsection
@section('konten')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Layanan Laundry</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/kelola_pelanggan') }}">Kelola Pelanggan</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
    		<div class="btn-member-pelanggan d-flex justify-content-center">
    			<button class="btn btn-member member-btn btn-member-border">Member</button>
    			<button class="btn btn-member non_member-btn">Non Member</button>
    		</div>
    	</div>
	</div>
	<div class="row m-4">
		<div class="col-md-12 text-left">
			<h4>Daftar Pelanggan</h4>
		</div>
	</div>
    <div class="row" style="margin-top: -15px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                	<div class="table-responsive member_table">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kode Pelanggan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No HP</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number1 = 1; ?>
                            	@foreach($pelanggans as $pelanggan)
                            	@if($pelanggan->cek_member == 'member')
                            	<tr>
                            		<th class="align-middle text-center">{{ $number1 }}</th>
                            		@php
                            		$users = \App\User::select('users.*')
                            		->where('kd_pengguna', $pelanggan->kd_pelanggan)
                            		->first();
                            		@endphp
                            		<th><img src="{{ asset('/pictures/'.$users->avatar) }}" class="rounded-circle mr-3 fotouser" alt=""> {{ $pelanggan->nama_pelanggan }}</th>
                            		<td>{{ $pelanggan->kd_pelanggan }}</td>
                            		<td>
                            			@if($pelanggan->jk_pelanggan == 'L')
                            			Laki-laki
                            			@else
                            			Perempuan
                            			@endif
                            		</td>
                            		<td>{{ $pelanggan->no_hp_pelanggan }}</td>
                            		<td style="font-size: 16px;" class="text-center">
                            			<a href="{{ url('/detail_pelanggan_member/' . $pelanggan->id) }}" class="btn btn-sm btn-outline-primary btn-flat font-weight-bold">Lihat</a>&nbsp;&nbsp;<a href="{{ url('/layanan_member/' . $pelanggan->id) }}" class="btn btn-sm btn-primary btn-flat font-weight-bold">Layanan</a></td>
                            	</tr>
                                <?php $number1++; ?>
                            	@endif
                            	@endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive non_member_table" hidden="">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kode Pelanggan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No HP</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number2 = 1; ?>
                            	@foreach($pelanggans as $pelanggan)
                            	@if($pelanggan->cek_member == 'non_member')
                            	<tr>
                            		<th class="align-middle text-center">{{ $number2 }}</th>
                            		@php
                            		$users = \App\User::select('users.*')
                            		->where('kd_pengguna', $pelanggan->kd_pelanggan)
                            		->first();
                            		@endphp
                            		<th><img src="{{ asset('/pictures/'.$users->avatar) }}" class="rounded-circle mr-3 fotouser" alt=""> {{ $pelanggan->nama_pelanggan }}</th>
                            		<td>{{ $pelanggan->kd_pelanggan }}</td>
                            		<td>
                            			@if($pelanggan->jk_pelanggan == 'L')
                            			Laki-laki
                            			@else
                            			Perempuan
                            			@endif
                            		</td>
                            		<td>{{ $pelanggan->no_hp_pelanggan }}</td>
                            		<td style="font-size: 16px;" class="text-center">
                            			<a href="{{ url('/detail_pelanggan_non_member/' . $pelanggan->id) }}" class="btn btn-sm btn-outline-primary btn-flat font-weight-bold">Lihat</a></td>
                            	</tr>
                                <?php $number2++; ?>
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
<script type="text/javascript">
    @if ($message = Session::get('terubah_status'))
    $(function(){
        $('.non_member-btn').click();
        function notif(){
            swal(
                "Berhasil!",
                "{{ $message }}",
                "success"
            )
        };
        notif();
    });
    @endif

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

	$(document).on('click', '.member-btn', function() {
		$(this).addClass('btn-member-border');
    	$('.non_member-btn').removeClass('btn-member-border');
    	$('.member_table').prop('hidden', false);
    	$('.non_member_table').prop('hidden', true);
	});

	$(document).on('click', '.non_member-btn', function() {
		$(this).addClass('btn-member-border');
    	$('.member-btn').removeClass('btn-member-border');
    	$('.member_table').prop('hidden', true);
    	$('.non_member_table').prop('hidden', false);
	});
</script>
@endsection