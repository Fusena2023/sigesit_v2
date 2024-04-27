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
				<li class="active">Master Berita</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Master Berita</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List Berita</div>
					<div class="panel-body">
						<div class="col-md-12">
							<table class="table table-bordered" id="users-table">
						        <thead>
						            <tr>
						                <th>ID</th>
						                <th>Judul</th>
						                <th>Deskripsi</th>
						                <th>Tanggal Dibuat</th>
						                <th>Tanggal Diubah</th>
						                <th>Aksi</th>
						            </tr>
						        </thead>
						    </table>
							<br>
							<br>
						</div>
					</div>
				</div><!-- /.panel-->
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Tambah Berita</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form method="POST" name="formsubmitberita" action="{{ route('admin.simpanberita') }}" enctype="multipart/form-data" role="form">
                  				@csrf
								<div class="form-group">
									<label>Judul</label>
									<input name="judul" id="judul" class="form-control" placeholder="Judul" required>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea name="deskripsi" id="deskripsi" class="form-control" rows="9" required></textarea>
								</div>
								<div class="form-group">
									<label>Gambar</label>
									<input type="file" name="gambar" id="gambar" required onchange="return validasiFile()">
									<p class="help-block">file diwajibkan .png/.jpeg</p>
								</div>
								<a onclick="submitberitaform()" type="submit" class="btn btn-primary">Simpan</a>
							</form>
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
		        ajax: "{{ route('admin.datatables.getdataberita') }}",
		        columns: [
		            { data: 'id', name: 'id' },
		            { data: 'judul', name: 'judul' },
		            { data: 'deskripsi', name: 'deskripsi' },
		            { data: 'created_at', name: 'created_at' },
		            { data: 'updated_at', name: 'updated_at' },
		            { data: 'action', name: 'action', orderable: false, searchable: false}
		        ]
		    });
		});
	</script>
	<script type="text/javascript">
		function lihat(id,judul,deskripsi,gambar,created_at,updated_at){
			var ico = '{{ Storage::url("public/") }}' + gambar;
			Swal.fire({
			  title: '<h3><br><b>' + judul + '</b></h3>',
			  html: '<div style="text-align:left;"><br><font size="2">' + deskripsi + '</font></div><br><hr>',
			  imageUrl: ico,
			  imageAlt: 'Custom image',
			  animation: true,
			  width: '60%'
			})
		}
		function show(id,status,judul){
			var html2 = '<center><font color="red">"'+judul+'"</font><br> Ingin di '+status+'</center><form method="POST" name="formshowberita" action="{{ route("admin.showberita") }}" role="form">@csrf<input name="id" type="hidden" value="'+id+'"></form>';
			Swal.fire({
			  type: 'question',
			  title: status +' Berita',
			  html: html2,
			}).then(function(result) {
		        if (result.value) {
		            document.formshowberita.submit();
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
		function edit(id,judul,deskripsi,gambar,created_at,updated_at){
			var html = '<form method="POST" id="formeditberita" action="{{ route("admin.editberita") }}" enctype="multipart/form-data" role="form">'+
                  				'@csrf'+
								'<div class="form-group">'+
									'<label>Judul</label>'+
									'<input name="judul" class="form-control" value="'+judul+'" required>'+
									'<input name="id" type="hidden" class="form-control" value="'+id+'" required>'+
								'</div>'+
								'<div class="form-group">'+
									'<label>Deskripsi</label>'+
									'<textarea name="deskripsi" class="form-control" rows="8" required>'+deskripsi+'</textarea>'+
								'</div>'+
								'<div class="form-group">'+
									'<label>Gambar</label>'+
									'<center><input type="file" name="gambar"></center>'+
									'<p class="help-block">file diwajibkan .png/.jpeg</p>'+
								'</div>'+
							'</form>';

			Swal.fire({
		        title: 'Edit Data<br><hr>',
		        type: 'question',
		        html: html,
		        showCancelButton: true,
		        cancelButtonText: "Batal",
		        confirmButtonText: "Simpan",
		        width: '70%'
		    }).then(function(result) {
		        if (result.value) {
		        	document.getElementById("formeditberita").submit();
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
		function hapus(id,status,judul){
			var html3 = '<center><font color="red">"'+judul+'"</font><br><br>Berita yang sudah dihapus tidak akan tampil kembali dan tidak dapat dilihat oleh pengguna<br><h5><b> Ingin di '+status+'</b></h5></center><form method="POST" name="formhapusberita" action="{{ route("admin.hapusberita") }}" role="form">@csrf<input name="id" type="hidden" value="'+id+'"></form>';
			Swal.fire({
			  type: 'question',
			  title: status +' Berita',
			  html: html3,
			  showCancelButton: true,
			  cancelButtonText:'Batal',
			}).then(function(result) {
		        if (result.value) {
		            document.formhapusberita.submit();
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


		function validasiFile(){
	        var inputFile = document.getElementById('gambar');
	        var pathFile = inputFile.value;
	        var ekstensiOk = /(\.jpg|\.jpeg|\.png)$/i;
	        if(!ekstensiOk.exec(pathFile)){
	            Swal.fire('Gagal','Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png','error');
	            inputFile.value = '';
	            return false;
	        }else {
	        }
	        var maxSize = '8192';//8mb
	           if (inputFile.files && inputFile.files[0]) {
	                        var fsize = inputFile.files[0].size/1024;
	                        if(fsize > maxSize) {
	                           Swal.fire('Gagal','Maximum file size exceed, This file size is: ' + fsize + " KB",'error');
	                           inputFile.value = '';
	                           return false;
	                        } else {
	                        }
	             }
	    }
	    function submitberitaform(){
	      	Swal.fire({
			  type: 'question',
			  title: 'Simpan data',
			  text: 'Data sudah Benar'
			}).then(function(result) {
		        if (result.value) {
		            document.formsubmitberita.submit();
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

	</script>

	<!-- Buat wyswyg -->
	<script src="//cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'deskripsi' );
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