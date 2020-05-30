@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/clockpicker/dist/jquery-clockpicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/jquery-asColorPicker-master/css/asColorPicker.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<style type="text/css">
	.fotouser{
	    object-fit: cover;
	    width: 6rem;
	    height: 6rem;
	}
	.c-primary{
	    color: #7571f9;
	}
	.identitas-table tr th, .identitas-table tr td{
		padding: 5px;
		font-size: 12px;
	}
	.table-riwayat tr th, .table-riwayat tr td{
		font-size: 12px;
	}
	.form-control-xs {
	    height: calc(1em + .375rem + 2px) !important;
	    padding: .125rem .25rem !important;
	    font-size: .75rem !important;
	    line-height: 1.5;
	    border-radius: .2rem;
	}
</style>
@endsection
@section('konten')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/laporan_pegawai') }}">Laporan Pegawai</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/laporan_pegawai_riwayat/' . $id) }}">Riwayat Kerja Pegawai</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid mt-3">
	<div class="row">
		<div class="col-lg-3">
	        <div class="card">
	            <div class="card-body border-top pt-4">
	            	<h3 class="card-title">Profil</h3>
	            	<div class="row">
	            		<div class="col-md-12 text-center mt-2 mb-2">
	            			<img src="{{ asset('/pictures/'.$users->avatar) }}" class="rounded-circle mr-3 fotouser" alt="">
	            			<hr>
	            		</div>
	            		<div class="col-md-12">
	            			<table style="width: 100%;" class="identitas-table">
	            				<tr>
	            					<th class="align-top">Nama</th>
	            					<td class="align-top">:</td>
	            					<td class="align-top">{{ $users->name }}</td>
	            				</tr>
	            				<tr>
	            					<th class="align-top">Posisi</th>
	            					<td class="align-top">:</td>
	            					<td class="align-top">{{ $users->role }}</td>
	            				</tr>
	            				<tr>
	            					<th class="align-top">Kd Pengguna</th>
	            					<td class="align-top">:</td>
	            					<td class="align-top">{{ $users->kd_pengguna }}</td>
	            				</tr>
	            			</table>
	            		</div>
	            	</div>
	            </div>
	        </div>
	    </div>
	    <div class="col-lg-9">
	    	<div class="card">
	    		<div class="card-body border-top pt-4">
	    			<h3 class="card-title">Daftar Kerja</h3>
	    			<div class="row mt-4">
	    				<div class="col-md-12">
	    					<form class="filter_form" target="_blank" action="{{ url('/pdf_laporan_pegawai/' . $id) }}" method="POST">
                    			@csrf
                    			<input type="text" name="check_button" class="check_button" hidden="">
                    			<div class="form-row align-items-center">
                    				<div class="col-md-8">
                    					<div class="input-group">
                    						<div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input id="semua_check" name="check_semua" type="checkbox" checked="" value="1">
                                                    <label for="semua_check" class="form-check-label">&nbsp;Semua</label>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control datepicker-autoclose" name="start_date" placeholder="mm/dd/yyyy" disabled="" autocomplete="off">
                                            <input type="text" class="form-control datepicker-autoclose" name="end_date" placeholder="mm/dd/yyyy" disabled="" autocomplete="off">
                    					</div>
                    				</div>
                    				<div class="col-md-2">
                    					<button type="button" class="btn mb-1 btn-light btn-block btn-flat font-weight-bold filter_laporan_btn"><i class="fa fa-filter"></i>&nbsp;&nbsp;Filter</button>
                    				</div>
                    				<div class="col-md-2">
                    					<button type="button" class="btn mb-1 btn-primary btn-block btn-flat font-weight-bold pdf_laporan_btn"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;PDF</button>
                    				</div>
                    			</div>
                    		</form>
	    				</div>
	    			</div>
	    			<div class="row mt-3 align-items-center">
	    				<div class="col-md-2">
                    		<select id="maxRows" class="form-control-sm ml-2" style="width: 100px;">
                    			<option value="9999">Semua</option>
                    			<option value="5">5</option>
                    			<option value="10">10</option>
                    			<option value="25">25</option>
                    		</select>
						</div>
	    				<div class="col-md-10">
	    					<input type="text" class="form-control form-control-xs input-cari" placeholder="Cari" name="cari">
	    				</div>
	    			</div>
	    			<div class="row mt-3">
	    				<div class="col-md-12">
	    					<div class="table-responsive">
		                        <table class="table table-riwayat" id="tabel-riwayat-kerja">
		                            <thead style="text-align: center;">
		                                <tr>
		                                	<th>No</th>
		                                    <th>Outlet</th>
		                                    <th>Kd Invoice</th>
		                                    <th>Pelanggan</th>
		                                    <th>Tgl Pemberian</th>
		                                    <th>Ket Bayar</th>
		                                    <th>Status</th>
		                                </tr>
		                            </thead>
		                            <tbody class="isi_tabel">
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
		                            </tbody>
		                        </table>
		                    </div>
	    				</div>
	    				<div class="col-md-12">
							<div class="pagination-container">
								<nav>
									<ul class="pagination_riwayat">
										
									</ul>
								</nav>
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
<script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('plugins/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-asColorPicker-master/libs/jquery-asColor.js') }}"></script>
<script src="{{ asset('plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js') }}"></script>
<script src="{{ asset('plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/plugins-init/form-pickers-init.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
	  $('.input-cari').on('keyup', function(){
	  	$('#maxRows').val('9999').change();
	    var searchTerm = $(this).val().toLowerCase();
	    $(".isi_tabel tr").each(function(){
	      var lineStr = $(this).text().toLowerCase();
	      if(lineStr.indexOf(searchTerm) == -1){
	        $(this).hide();
	      }else{
	        $(this).show();
	      }
	    });
	  });
	});

	$(document).on('click', '#semua_check', function(){
		if(this.checked == true){
	        $(this).val('1');
	        $('.datepicker-autoclose').prop('disabled', true);
	        $('.datepicker-autoclose').val('');
	        $('.check_button').val('filter');
	        $('.filter_form').submit();
	        $('#maxRows').val('9999').change();
	    }else{
	        $(this).val('0');
	        $('.datepicker-autoclose').prop('disabled', false);
	        $('#maxRows').val('9999').change();
	    }
	});

	$(document).on('click', '.filter_laporan_btn', function(){
		var start_date = $('input[name=start_date]').val();
		var end_date = $('input[name=end_date]').val();
		if((start_date != '' && end_date != '') || $('#semua_check').val() == '1'){
			$('.check_button').val('filter');
			$('.filter_form').submit();
			$('#maxRows').val('9999').change();
		}else if(start_date == '' && end_date == ''){
			tanggalKosong("Tanggal awal dan akhir tidak boleh kosong");
		}else if(start_date == ''){
			tanggalKosong("Tanggal awal tidak boleh kosong");
		}else{
			tanggalKosong("Tanggal akhir tidak boleh kosong");
		}
	});

	$(document).on('click', '.pdf_laporan_btn', function(){
		var start_date = $('input[name=start_date]').val();
		var end_date = $('input[name=end_date]').val();
		if((start_date != '' && end_date != '') || $('#semua_check').val() == '1'){
			$('.check_button').val('cetak_pdf');
			$('.filter_form').submit();
		}else if(start_date == '' && end_date == ''){
			tanggalKosong("Tanggal awal dan akhir tidak boleh kosong");
		}else if(start_date == ''){
			tanggalKosong("Tanggal awal tidak boleh kosong");
		}else{
			tanggalKosong("Tanggal akhir tidak boleh kosong");
		}
	});

	function tanggalKosong(keterangan){
		toastr.warning(keterangan, "Peringatan!", {
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

	$('.filter_form').submit(function(e){
		var check_button = $('.check_button').val();
		if(check_button == 'filter'){
			e.preventDefault();
			var request = new FormData(this);
			$.ajax({
				url: "{{ url('/filter_laporan_pegawai/'.$id) }}",
				method: "POST",
				data: request,
				contentType: false,
				processData: false,
				success:function(data){
					$('.isi_tabel').html(data);
				}
			});
		}
	});

	var table2 = "#tabel-riwayat-kerja";
	$('#maxRows').on('change', function(){
		$('.pagination_riwayat').html('');
		var trnum = 0;
		var maxRows = parseInt($(this).val());
		var totalRows = $(table2+' tbody tr').length;
		$(table2+' tr:gt(0)').each(function(){
			trnum++;
			if(trnum > maxRows){
				$(this).hide();
			}
			if(trnum <= maxRows){
				$(this).show();
			}
		});
		if(totalRows > maxRows){
			var pagenum = Math.ceil(totalRows/maxRows);
			for(var i = 1; i <= pagenum;){
				$('.pagination_riwayat').append('<li class="page-item" data-page="'+i+'">\<span class="page-link">'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show();
			}
			$('.pagination_riwayat').addClass('pagination');
		}else{
			$('.pagination_riwayat').removeClass('pagination');
		}
		$('.pagination_riwayat li:first-child').addClass('active');
		$('.pagination_riwayat li').on('click', function(){
			var pageNum = $(this).attr('data-page');
			var trIndex = 0;
			$('.pagination_riwayat li').removeClass('active');
			$(this).addClass('active');
			$(table2+' tr:gt(0)').each(function(){
				trIndex++;
				if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows))
				{
					$(this).hide();
				}else{
					$(this).show();
				}
			});
		});
	});
</script>
@endsection