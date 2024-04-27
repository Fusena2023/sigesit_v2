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
				<li class="active">Master Layanan Daring</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Master Layanan Daring</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List Layanan Daring</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="users-table" width="100%">
									<thead class="table-primary">
										<tr>
											<th>ID</th>
											<th>Nama Layanan</th>
											<th>Deskripsi</th>
											<th>Website</th>
											<th>Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.panel-->


				<div class="panel panel-default">
					<div class="panel-heading">Tambah Layanan Daring</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form method="POST" name="formsubmitmjl" action="{{ route('admin.simpanlayanandigital') }}" enctype="multipart/form-data" role="form">
								@csrf
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Nama Layanan</label>
									</div>
									<div class="col-md-7">
										<input name="nama_layanan" id="nama_layanan" class="form-control" placeholder="Nama Layanan" required>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Deskripsi</label>
									</div>
									<div class="col-md-7">
										<textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required></textarea>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Website</label>
									</div>
									<div class="col-md-7">
										<input name="url" id="url" class="form-control" placeholder="Website/URL" required>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Gambar/Icon</label>
									</div>
									<div class="col-md-7">
										<input type="file" name="icon" id="icon" required onchange="return validasiFile()">
										<p class="help-block">file diwajibkan .png/.jpeg (rekomendasi 400x400)</p>
									</div>
								</div>
								{{-- <div class="form-group">
									<label>Nama Layanan</label>
									<input name="nama_layanan" id="nama_layanan" class="form-control" placeholder="Nama Layanan" required>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required></textarea>
								</div>
								<div class="form-group">
									<label>Website</label>
									<input name="url" id="url" class="form-control" placeholder="Website/URL" required>
								</div>
								<div class="form-group">
									<label>Gambar/Icon</label>
									<input type="file" name="icon" id="icon" required onchange="return fileValidasi('icon')">
									<p class="help-block">file diwajibkan .png/.jpeg (rekomendasi 400x400)</p>
								</div> --}}
								<a onclick="submitmjlform()" type="submit" style="float: right" class="btn btn-primary">Simpan</a>
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div>
			<div class="col-sm-12">
				<p class="back-link">Badan <a href="https://sigesit.big.go.id/">Informasi</a> Geospasial</p>
			</div>
		</div>
		<!--/.main-->

		@include('template.adminfooter')

		<script type="text/javascript">
			$(document).ready(function() {

				//ini diganti tiap form
				$("#dashboard").removeClass("active");

				$("#master").addClass("active");
			});
		</script>
		<script>
			$(function() {
				$('#users-table').DataTable({
					processing: true,
					serverSide: true,
					ajax: "{{ route('admin.datatables.getdatalayanandigital') }}",
					columns: [{
							data: 'id',
							name: 'id',
							width: '10%',
						},
						{
							data: 'nama_layanan',
							name: 'nama_layanan',
							width: '15%'
						},
						{
							data: 'deskripsi',
							name: 'deskripsi',
							width: '55%'
						},
						{
							data: 'url',
							name: 'url',
							width: '5%'
						},
						{
							data: 'action',
							name: 'action',
							width: '15%',
							orderable: false,
							searchable: false
						}
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
			function lihat(nama_layanan, deskripsi, icon) {
				var ico = '{{ Storage::url("public/") }}' + icon;
				Swal.fire({
					title: nama_layanan,
					text: deskripsi,
					imageUrl: ico,
					imageWidth: 300,
					imageHeight: 300,
					imageAlt: 'Custom image',
					animation: true
				})
			}

			function show(id, status, nama_layanan) {
				var html2 = '<center>' + nama_layanan + ' Ingin di ' + status + '</center><form method="POST" name="formshowmjl" action="{{ route("admin.showlayanandigital") }}" role="form">@csrf<input name="id" type="hidden" value="' + id + '"></form>';
				Swal.fire({
					type: 'question',
					title: status + ' Layanan',
					html: html2,
				}).then(function(result) {
					if (result.value) {
						document.formshowmjl.submit();
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

			function edit(id, nama_layanan, deskripsi, icon, url) {
				var html = '<form method="POST" id="formeditmjl" action="{{ route("admin.editlayanandigital") }}" enctype="multipart/form-data" role="form">' +
					'@csrf' +
					'<div class="form-group">' +
					'<label>Nama Layanan</label>' +
					'<input name="nama_layanan" class="form-control" value="' + nama_layanan + '" required>' +
					'<input name="id" type="hidden" class="form-control" value="' + id + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Deskripsi</label>' +
					'<input name="deskripsi" class="form-control" value="' + deskripsi + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Website/URL</label>' +
					'<input name="url" class="form-control" value="' + url + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Gambar/Icon</label>' +
					'<center><input type="file" name="icon"></center>' +
					'<p class="help-block">file diwajibkan .png/.jpeg (max 400x400)</p>' +
					'</div>' +
					'</form>';

				Swal.fire({
					title: 'Edit Data<br><hr>',
					// type: 'question',
					html: html,
					showCancelButton: true,
					cancelButtonText: "Batal",
					confirmButtonText: "Simpan",
					width: '30%'
				}).then(function(result) {
					if (result.value) {
						document.getElementById("formeditmjl").submit();
					} else if (result.value === 0) {
						Swal.fire({
							type: 'error',
							text: "Batal Memperbaharui"
						});

					} else {
						console.log(`modal was dismissed by ${result.dismiss}`)
					}
				})
			}


			function validasiFile() {
				var inputFile = document.getElementById('icon');
				var pathFile = inputFile.value;
				var ekstensiOk = /(\.jpg|\.jpeg|\.png)$/i;
				if (!ekstensiOk.exec(pathFile)) {
					Swal.fire('Gagal', 'Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png', 'error');
					inputFile.value = '';
					return false;
				} else {}
				var maxSize = '2048'; //2mb
				if (inputFile.files && inputFile.files[0]) {
					var fsize = inputFile.files[0].size / 1024;
					if (fsize > maxSize) {
						Swal.fire('Gagal', 'Maximum file size exceed, This file size is: ' + fsize + " KB", 'error');
						inputFile.value = '';
						return false;
					} else {}
				}
			}

			function submitmjlform() {
				var cekfile = $('#icon').val();
				var nama_layanan = $('#nama_layanan').val();
				var deskripsi = $('#deskripsi').val();
				var url = $('#url').val();
				// console.log(cekfile);
				if (cekfile == '' || nama_layanan == '' || deskripsi == '' || url == '') {
					Swal.fire({
						type: 'warning',
						text: 'Pastikan semua data sudah di isi!'
					})

				} else {
					Swal.fire({
						type: 'question',
						title: 'Simpan data',
						text: 'Data sudah Benar'
					}).then(function(result) {
						if (result.value) {
							document.formsubmitmjl.submit();
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