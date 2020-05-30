@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style type="text/css">
	.fotouser{
	    object-fit: cover;
	    width: 3rem;
	    height: 3rem;
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
            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/laporan_pegawai') }}">Laporan Pegawai</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        	<div class="card">
                <div class="card-body">
                	<div class="row">
		                <div class="col-3">
		                    <div class="card card-widget">
		                        <div class="card-body gradient-7">
		                            <div class="media">
		                                <div class="media-body">
		                                    <h2 class="card-widget__title">Baru</h2>
		                                    <h5 class="card-widget__subtitle">Jumlah: {{ $baru }}</h5>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <div class="col-3">
		                    <div class="card card-widget">
		                        <div class="card-body gradient-3">
		                            <div class="media">
		                                <div class="media-body">
		                                    <h2 class="card-widget__title">Proses</h2>
		                                    <h5 class="card-widget__subtitle">Jumlah: {{ $proses }}</h5>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <div class="col-3">
		                    <div class="card card-widget">
		                        <div class="card-body gradient-9">
		                            <div class="media">
		                                <div class="media-body">
		                                    <h2 class="card-widget__title">Selesai</h2>
		                                    <h5 class="card-widget__subtitle">Jumlah: {{ $selesai }}</h5>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <div class="col-3">
		                    <div class="card card-widget">
		                        <div class="card-body gradient-1">
		                            <div class="media">
		                                <div class="media-body">
		                                    <h2 class="card-widget__title">Diambil</h2>
		                                    <h5 class="card-widget__subtitle">Jumlah: {{ $diambil }}</h5>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
                    <div class="row">
                    	<div class="col-md-12">
                    		<h4 class="card-title">Daftar Pegawai</h4>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
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
		                            	@foreach($users as $user)
		                                @if($user->role == 'admin' || $user->role == 'kasir')
		                                <tr>
		                                    <th class="align-middle text-center">{{ $number }}</th>
		                                    <th><img src="{{ asset('/pictures/'.$user->avatar) }}" class="rounded-circle mr-3 fotouser" alt="">{{ $user->name }}</th>
		                                    <td class="text-center">{{ $user->kd_pengguna }}</td>
		                                    <td>
	                                        @if($user->role == 'admin')
	                                        <i class="fa fa-circle-o text-success mr-2"></i>
	                                        @else
	                                        <i class="fa fa-circle-o text-primary mr-2"></i>
	                                        @endif
	                                        &nbsp;{{ $user->role }}</td>
		                                    <td>{{ $user->username }}</td>
		                                    <td style="text-align: center;"><a href="{{ url('/laporan_pegawai_riwayat/'.$user->id) }}" class="btn btn-primary font-weight-bold btn-sm">Lihat</a></td>
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
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
@endsection