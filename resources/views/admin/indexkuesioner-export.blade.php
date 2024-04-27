<!DOCTYPE html>
<html>
@include('template.adminheader')
<body>
	@include('template.adminnavbar')
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-database"></em>
				</a></li>
				<li class="active">Export Kuesioner</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Export Kuesioner</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Export Kuesioner</div>
					<div class="panel-body">
							<form method="POST" id="formfilter" action="{{route('admin.exportexcel.kuesioner')}}" enctype="multipart/form-data" role="form">
                  				@csrf
						        <div class="col-md-4">
                                    <div class="form-group">
										<label>Periode Tiket</label>
                                        <input type="text" name="tanggal_range" id="tanggal_range" class="form-control" placeholder="Tanggal" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" onclick="konfirmExport()" class="btn btn-success">Export</button>
                                    </div>
                                </div>
								<div class="col-md-4">
                                    <div class="form-group">
										<label>Kategori</label>
                                        <select class="form-control" name="kategori" id="kategori">
											<option value="" style="display:none;">Pilih Kategori Tiket</option>
											<option value="online">Online</option>
											<option value="offline">Offline</option>
										</select>
                                    </div>
                                </div>
							</form>
					</div>
				</div><!-- /.panel-->
        </div>
			<div class="col-sm-12">
				<p class="back-link">Badan <a href="https://sigesit.big.go.id/">Informasi</a> Geospasial</p>
			</div>
	</div>	<!--/.main-->
	
	@include('template.adminfooter')
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script type="text/javascript">
	
      flatpickr("#tanggal_range", {
        mode: "range",
		dateFormat: "Y-m-d"
      });

      function konfirmExport(){
          var tanggal_range = $('#tanggal_range').val();
          
          if(tanggal_range == ''){
            Swal.fire({
                type: 'error',
                text: "Periode Tidak Boleh Kosong",
            });
          }else{
            document.getElementById("formfilter").submit();
          }
      }

	</script>
	 	  @if(Session::has('success'))
              <script type="text/javascript">
                  	Swal.fire({
		                type: 'success',
		                text: '{{Session::get("success")}}',
		                showConfirmButton: false,
		                timer: 1500
		            });
              </script>
              <?php
                  Session::forget('success');
              ?>
		  @elseif(Session::has('error'))
		  <script type="text/javascript">
                  	Swal.fire({
		                type: 'error',
		                text: '{{Session::get("error")}}',
		                showConfirmButton: false,
		                timer: 1500
		            });
              </script>
              <?php
				  Session::forget('error');
              ?>
          @endif
		
</body>
</html>