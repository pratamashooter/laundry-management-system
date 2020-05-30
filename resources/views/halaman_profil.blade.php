@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
<style type="text/css">
	.foto-profile{
		object-fit: cover;
	    width: 7rem;
	    height: 7rem;
	}
	.role-primary{
		color: #7571f9;
		border: 1px solid #7571f9;
	}
	.role-success{
		color: #6fd96f;
		border: 1px solid #6fd96f;
	}
	.foto{
		position: relative;
	}
	.upload-btn-wrapper button{
	  position: absolute;
	  background-color: #7571f9;
	  color: #fff;
	  top: 0%;
	  left: 100%;
	  transform: translate(-50%, -50%);
	  border: 0px;
	  border-radius: 50%;
	  padding: 6px 0px;
	  line-height: 1.42857;
	  width: 25px;
	  height: 25px;
	  font-size: 10px;
	}
	.ubah_foto_input{
	  font-size: 100px;
	  position: absolute;
	  left: 0;
	  top: 0;
	  opacity: 0;
	}
	.form-control-xs {
	    height: calc(1em + .375rem + 2px) !important;
	    padding: .125rem .25rem !important;
	    font-size: .75rem !important;
	    line-height: 1.5;
	}
	#tabel_riwayat_kerja tr th, #tabel_riwayat_kerja tr td{
		font-size: 12px;
	}
</style>
@endsection
@section('konten')
<div class="container-fluid mt-3">
    <div class="row">
    	<div class="col-lg-12">
        	<div class="card">
                <div class="card-body">
                	<form method="POST" enctype="multipart/form-data" class="form_edit_identitas">
                		@csrf
	                	<div class="row">
	                		<div class="col-md-4 d-flex justify-content-start">
	                			<div class="foto">
	                				<img src="{{ asset('/pictures/' . auth()->user()->avatar) }}" class="foto-profile rounded">
	                				<div class="upload-btn-wrapper ubah_foto_file" hidden="">
		                				<button type="button" class="ubah_foto_btn btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
		                				<input type="file" name="ubah_foto_input" class="ubah_foto_input" hidden="">
		                			</div>
	                			</div>
	                			<div class="identitas ml-4">
	                				<p class="text-dark font-weight-bold ubah_nama_text" style="font-size: 18px;">{{ auth()->user()->name }}</p>
	                				<input type="text" name="ubah_nama_input" class="ubah_nama_input mb-3" value="{{ auth()->user()->name }}" hidden="">
	                				<p class="text-dark font-weight-bold" style="font-size: 12px; margin-top: -5px;">Kode pengguna, {{ auth()->user()->kd_pengguna }}</p>
	                				@if(auth()->user()->id_outlet != 0)
	                				<p class="text-dark font-weight-bold" style="font-size: 12px; margin-top: -15px;">Outlet, {{ auth()->user()->kd_pengguna }}</p>
	                				@endif
	                				@if(auth()->user()->role == 'admin')
	                				<div class="btn btn-sm font-weight-bold role-success" style="margin-top: -10px;">{{ auth()->user()->role }}</div>
	                				@else
	                				<div class="btn btn-sm font-weight-bold role-primary" style="margin-top: -10px;">{{ auth()->user()->role }}</div>
	                				@endif
	                			</div>
	                		</div>
	                		<div class="col-md-8">
	                			<div class="text-right position-static">
	                				<button type="button" style="border: 0px; background-color: #fff;" class="btn text-primary edit_identitas_btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>
	                				<button type="submit" style="border: 0px; background-color: #fff;" class="btn text-primary update_identitas_btn" hidden=""><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
	                			</div>
	                		</div>
	                	</div>
                	</form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-4">
    		<div class="card">
    			<div class="card-body">
    				<h4 class="card-title">Ubah Password</h4>
    				<hr>
    				<form method="POST" class="ubah_password_form">
    					@csrf
    					<div class="form-row">
    						<div class="form-group col-12">
	    						<input type="password" name="old_password" class="form-control form-control-xs" placeholder="Password lama">
	    					</div>
	    					<div class="form-group col-12">
	    						<input type="password" name="new_password" class="form-control form-control-xs" placeholder="Password baru">
	    					</div>
	    					<div class="form-group col-12">
	    						<button class="btn btn-primary font-weight-bold btn-flat btn-block" type="submit" style="font-size: 12px;">Ubah Password</button>
	    					</div>
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-8">
    		<div class="card">
    			<div class="card-body">
    				<h4 class="card-title">Riwayat Kerja</h4>
    				<hr>
    				<div class="row">
    					<div class="col-md-12 d-flex justify-content-start mb-2">
    						<select id="maxRows" class="form-control-sm ml-2" style="width: 100px;">
                    			<option value="9999">Semua</option>
                    			<option value="5">5</option>
                    			<option value="10">10</option>
                    			<option value="25">25</option>
                    		</select>
    						<input type="text" name="cari_input" placeholder="Cari" class="form-control cari_input form-control-xs ml-4">
    					</div>
    					<div class="col-md-12">
    						<table class="table" id="tabel_riwayat_kerja">
							  <thead class="text-center">
							    <tr>
									<th scope="col">No</th>
									<th scope="col">Outlet</th>
									<th scope="col">Kd Invoice</th>
									<th scope="col">Pelanggan</th>
									<th scope="col">Tgl Pemberian</th>
									<th scope="col">Ket Bayar</th>
									<th scope="col">Status</th>
							    </tr>
							  </thead>
							  <tbody class="isi_tabel">
							  	@foreach($transaksis as $transaksi)
							  	<tr>
							  		<th>{{ $loop->iteration }}</th>
							  		<th>{{ $transaksi->nama_outlet }}</th>
							  		<td>{{ $transaksi->kd_invoice }}</td>
							  		<td>{{ $transaksi->nama_pelanggan }}</td>
							  		<td>{{ date('d M Y', strtotime($transaksi->tgl_pemberian)) }}</td>
							  		<td>{{ $transaksi->ket_bayar }}</td>
							  		<td>@if($transaksi->status == 'baru')
	                                    <span class="label label-pill label-info text-white">{{ $transaksi->status }}</span>
	                                    @elseif($transaksi->status == 'proses')
	                                    <span class="label label-pill label-warning text-white">{{ $transaksi->status }}</span>
	                                    @elseif($transaksi->status == 'selesai')
	                                    <span class="label label-pill label-success text-white">{{ $transaksi->status }}</span>
	                                    @elseif($transaksi->status == 'diantar')
	                                    <span class="label label-pill label-danger text-white">{{ $transaksi->status }}</span>
	                                    @elseif($transaksi->status == 'diambil')
	                                    <span class="label label-pill label-primary text-white">{{ $transaksi->status }}</span>
	                                    @endif
	                                </td>
							  	</tr>
							  	@endforeach
							  </tbody>
							</table>
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
<script src="{{ asset('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
<script src="{{ asset('js/jquery.form-validator.min.js') }}"></script>
<script type="text/javascript">
@if ($message = Session::get('terubah'))
swal(
    "Berhasil!",
    "{{ $message }}",
    "success"
);
@endif

$('.ubah_password_form').submit(function(e){
	e.preventDefault();
	var request = new FormData(this);
	$.ajax({
		url: "{{ url('/ubah_password/' . auth()->user()->id) }}",
		method: "POST",
		data: request,
		contentType: false,
		cache: false,
		processData: false,
		success:function(data){
			if(data == 'sukses'){
				swal({
					title: "Berhasil!",
				    text: "Password berhasil diubah",
				    type: "success"
				}, function(){
					window.open("{{ url('/kelola_profil') }}", "_self");
				});
			}else{
				gagalPassword();
			}
		}
	});
});

function gagalPassword(){
	toastr.warning("Password lama tidak sesuai","Peringatan !", {
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

$(document).ready(function(){
	$('#maxRows').val(5).change();
  	$('.cari_input').on('keyup', function(){
	  	$('#maxRows').val(9999).change();
	    var searchTerm = $(this).val().toLowerCase();
	    $(".isi_tabel tr").each(function(){
	      var lineStr = $(this).text().toLowerCase();
	      if(lineStr.indexOf(searchTerm) == -1){
	        $(this).hide();
	      }else{
	        $(this).show();
	      }
    });
		if($(this).val() == ''){
			$('#maxRows').val(5).change();
		}
  });
});

var table2 = "#tabel_riwayat_kerja";
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

$('.form_edit_identitas').submit(function(e){
	e.preventDefault();
	var request = new FormData(this);
	$.ajax({
		url: "{{ url('/update_profil') }}",
		method: "POST",
		data: request,
		contentType: false,
		cache: false,
		processData: false,
		success:function(data){
			if(data == "sukses"){
				swal({
					title: "Berhasil!",
				    text: "Profil berhasil diubah",
				    type: "success"
				}, function(){
					window.open("{{ url('/kelola_profil') }}", "_self");
				});
			}else{
				$('.ubah_foto_file').prop('hidden', true);
				$('.ubah_nama_input').prop('hidden', true);
				$('.ubah_nama_text').prop('hidden', false);
				$('.update_identitas_btn').prop('hidden', true);
				$('.edit_identitas_btn').prop('hidden', false);
			}
		}
	});
});

$(document).on('click', '.edit_identitas_btn', function(e){
	e.preventDefault();
	$('.ubah_foto_file').prop('hidden', false);
	$('.ubah_nama_input').prop('hidden', false);
	$('.ubah_nama_text').prop('hidden', true);
	$('.update_identitas_btn').prop('hidden', false);
	$(this).prop('hidden', true);
});

$(document).on('click', '.ubah_foto_btn', function(e){
	e.preventDefault();
	$('.ubah_foto_input').click();
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.foto-profile').attr('src', e.target.result);
    }   
    reader.readAsDataURL(input.files[0]);
  }
}

$(".ubah_foto_input").change(function() {
  readURL(this);
});
</script>
@endsection