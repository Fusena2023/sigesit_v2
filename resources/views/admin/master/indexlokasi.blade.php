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
				<li class="active">Lokasi & Informasi</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Lokasi & Informasi</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Lokasi BIG dan Lokasi Tatap Muka</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="users-table" width="100%">
									<thead class="table-primary">
										<tr>
											<th>ID</th>
											<th>Lokasi BIG</th>
											<th>Lokasi Tatap Muka</th>
											<th>Email</th>
											<th>Telpon</th>
											<th>Website</th>
											<th>Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.panel-->
				
			</div>
			<div class="col-sm-12">
				<p class="back-link">Badan <a href="https://sigesit.big.go.id/">Informasi</a> Geospasial</p>
			</div>
	</div>	<!--/.main-->
	
	@include('template.adminfooter')
	<script type="text/javascript">
		$(document).ready(function() {

			//ini diganti tiap form
			$("#master").addClass("active");

			$("#dashboard").removeClass("active");

		});
	</script>
	<script>
		$(function() {
		    $('#users-table').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: "{{ route('admin.datatables.getdatalokasi') }}",
		        columns: [
		            { data: 'id', name: 'id' },
		            { data: 'lokasi_big', name: 'lokasi_big' },
		            { data: 'lokasi_tatapmuka', name: 'lokasi_tatapmuka' },
		            { data: 'email', name: 'email' },
		            { data: 'telpon', name: 'telpon' },
		            { data: 'website', name: 'website' },
		            { data: 'action', name: 'action', width: '10%', orderable: false, searchable: false}
		        ],
				language: {
					'paginate': {
						'previous': '<span><</span>',
						'next': '<span>></span>'
					}
				}
		    });
		});
	</script>
	<script type="text/javascript">
		function show(id,status,lokasi_big,lokasi_tatapmuka,email,telpon,website){
			var html2 = '<center><font color="red">"'+lokasi_big+'"</font><br><br><font color="red">"'+lokasi_tatapmuka+'"</font><br><br><font color="red">"'+email+'"</font><br><br><font color="red">"'+telpon+'"</font><br><br><font color="red">"'+website+'"</font><br><br>Ingin di '+status+'</center><form method="POST" name="formshowlokasi" action="{{ route("admin.showlokasi") }}" role="form">@csrf<input name="id" type="hidden" value="'+id+'"></form>';
			Swal.fire({
			  type: 'question',
			  title: status +' Lokasi & Informasi',
			  html: html2,
			}).then(function(result) {
		        if (result.value) {
		            document.formshowlokasi.submit();
		        } else if (result.value === 0) {
		            Swal.fire({
		                type: 'error',
		                text: "Batal Simpan"
		            });

		        } else {
		            console.log(`modal was dismissed by ${result.dismiss}`)
		        }
		    })
		}
		function edit(id,lokasi_big,lokasi_tatapmuka,email,telpon,website){
			var html = '<form method="POST" id="formeditlokasi" action="{{ route("admin.editlokasi") }}" enctype="multipart/form-data" role="form">'+
                  				'@csrf'+
								'<div class="form-group">'+
									'<label>Lokasi BIG</label>'+
									'<textarea name="lokasi_big" class="form-control" rows="3" required>'+lokasi_big+'</textarea>'+
									'<input name="id" type="hidden" class="form-control" value="'+id+'" required>'+
								'</div>'+
								'<div class="form-group">'+
									'<label>Lokasi Tatap Muka</label>'+
									'<textarea name="lokasi_tatapmuka" class="form-control" rows="3" required>'+lokasi_tatapmuka+'</textarea>'+
								'</div>'+
								'<div class="form-group">'+
									'<label>Email</label>'+
									'<input type="email" name="email" class="form-control" value="'+email+'" required>'+
								'</div>'+
								'<div class="form-group">'+
									'<label>Telpon</label>'+
									'<input name="telpon" class="form-control" value="'+telpon+'" required>'+
								'</div>'+
								'<div class="form-group">'+
									'<label>Website</label>'+
									'<input name="website" class="form-control" value="'+website+'" required>'+
								'</div>'+
							'</form>';

			Swal.fire({
		        title: 'Edit Data<br><hr>',
		        type: 'question',
		        html: html,
		        showCancelButton: true,
		        cancelButtonText: "Batal",
		        confirmButtonText: "Simpan",
		        width: '30%'
		    }).then(function(result) {
		        if (result.value) {
		        	document.getElementById("formeditlokasi").submit();
		        }else if (result.value === 0) {
		            Swal.fire({
		                type: 'error',
		                text: "Batal Memperbaharui"
		            });

		        } else {
		            console.log(`modal was dismissed by ${result.dismiss}`)
		        }
		    })
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
          @endif
		
</body>
</html>