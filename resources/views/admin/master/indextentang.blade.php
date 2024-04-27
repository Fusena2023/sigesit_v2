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
				<li class="active">Tentang Kami</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Tentang Kami</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Deskripsi Tentang Kami</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="users-table" width="100%">
									<thead class="table-primary">
										<tr>
											<th>ID</th>
											<th>Deskripsi</th>
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
		        ajax: "{{ route('admin.datatables.getdatatentang') }}",
		        columns: [
		            { data: 'id', name: 'id' },
		            { data: 'deskripsi', name: 'deskripsi' },
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
		function show(id,status,desc){
			var deskripsi = atob(desc);
			var html2 = '<center><font color="red">'+deskripsi+' </font><br><br>Ingin di '+status+'</center><form method="POST" name="formshowtentang" action="{{ route("admin.showtentang") }}" role="form">@csrf<input name="id" type="hidden" value="'+id+'"></form>';
			Swal.fire({
			  type: 'question',
			  title: status +' Tentang Kami',
			  html: html2,
			}).then(function(result) {
		        if (result.value) {
		            document.formshowtentang.submit();
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
		function edit(id,desc){
			var deskripsi = atob(desc);
			var html = '<form method="POST" id="formedittentang" action="{{ route("admin.edittentang") }}" enctype="multipart/form-data" role="form">'+
                  				'@csrf'+
								'<div class="form-group">'+
									'<label>Deskripsi</label>'+
									'<textarea name="deskripsi" class="form-control" rows="9" required>'+deskripsi+'</textarea>'+
									'<input name="id" type="hidden" class="form-control" value="'+id+'" required>'+
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
		        	document.getElementById("formedittentang").submit();
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