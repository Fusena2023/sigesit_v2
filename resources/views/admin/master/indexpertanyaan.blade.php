<!DOCTYPE html>
<html>
@include('template.adminheader')

<body>
	@include('template.adminnavbar')

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
						<em class="fa fa-clone"></em>
					</a></li>
				<li class="active">Pertanyaan</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pertanyaan</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List Pertanyaan</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="users-table" width="100%">
									<thead class="table-primary">
										<tr>
											<th>No.</th>
											<th>Pertanyaan</th>
											<th>Required</th>
											<th>Khusus</th>
											<th>Kategori</th>
											<th>Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.panel-->


				<div class="panel panel-default">
					<div class="panel-heading">Tambah Pertanyaan</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form method="POST" name="formsubmitmjl" action="{{ route('admin.simpanpertanyaan') }}" enctype="multipart/form-data" role="form">
								@csrf
								<input type="hidden" name="urutan_last" value="{{$urutan_last->urutan}}">
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Pertanyaan</label>
									</div>
									<div class="col-md-7">
										<input name="pertanyaan" id="pertanyaan" class="form-control" placeholder="Pertanyaan" required>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Required</label>
									</div>
									<div class="col-md-7">
										<select name="required" id="required" class="form-control" placeholder="Required" required>
											<option value="0" style="display:none">--Pilih Required--</option>
											<option value="*">WAJIB</option>
											<option value="">TIDAK WAJIB</option>
										</select>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Khusus</label>
									</div>
									<div class="col-md-7">
										<select name="khusus" id="khusus" class="form-control" placeholder="Khusus" required>
											<option value="0" style="display:none">--Pilih Khusus--</option>
											<option value="true">KHUSUS</option>
											<option value="">TIDAK KHUSUS</option>
										</select>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Kategori</label>
									</div>
									<div class="col-md-7">
										<select name="kategori" id="kategori" class="form-control" placeholder="Kategori" required>
											<option value="" style="display:none">--Pilih Kategori--</option>
											<option value="online">Online</option>
											<option value="offline">Offline</option>
										</select>
									</div>
								</div>

								{{-- <div class="form-group">
									<label>Pertanyaan</label>
									<input name="pertanyaan" id="pertanyaan" class="form-control" placeholder="Pertanyaan" required>
								</div>
								<div class="form-group">
									<label>Required</label>
									<select name="required" id="required" class="form-control" placeholder="Required" required>
										<option value="" style="display:none">--Pilih Required--</option>
										<option value="*">WAJIB</option>
										<option value="wajib">TIDAK WAJIB</option>
									</select>
								</div>
								<div class="form-group">
									<label>Khusus</label>
									<select name="khusus" id="khusus" class="form-control" placeholder="Khusus" required>
										<option value="" style="display:none">--Pilih Khusus--</option>
										<option value="true">KHUSUS</option>
										<option value="wajib">TIDAK KHUSUS</option>
									</select>
								</div>
								<div class="form-group">
									<label>Kategori</label>
									<select name="kategori" id="kategori" class="form-control" placeholder="Kategori" required>
										<option value="" style="display:none">--Pilih Kategori--</option>
										<option value="online">Online</option>
										<option value="offline">Offline</option>
									</select>
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
				$("#master").addClass("active");

				$("#dashboard").removeClass("active");

			});
		</script>
		<script>
			$(function() {
				$('#users-table').DataTable({
					processing: true,
					serverSide: true,
					ajax: "{{ route('admin.datatables.getPertanyaan') }}",
					columns: [{
							data: 'DT_RowIndex',
							name: 'DT_RowIndex'
						},
						{
							data: 'pertanyaan',
							name: 'pertanyaan'
						},
						{
							data: 'required',
							name: 'required'
						},
						{
							data: 'khusus',
							name: 'khusus'
						},
						{
							data: 'kategori',
							name: 'kategori'
						},
						{
							data: 'action',
							name: 'action',
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
			$(document).ready(function() {
				$("#master").addClass("active");
				$("#dashboard").removeClass("active");
			});

			function lihat(pertanyaan, required, khusus) {
				if (required == '*') {
					var req = 'WAJIB';
				} else {
					var req = 'TIDAK WAJIB';
				}
				if (khusus == true) {
					var khu = 'KHUSUS';
				} else {
					var khu = 'TIDAK KHUSUS';
				}
				var html = '<table width="100%" style="font-size:15px;">' +
					'<tr>' +
					'<td>' + pertanyaan + '</td>' +
					'</tr>' +
					'<tr><td>&nbsp;</td></tr>' +
					'<tr>' +
					'<td>' + req + '</td>' +
					'</tr>' +
					'<tr>' +
					'<td>' + khu + '</td>' +
					'</tr>' +
					'</table>';
				Swal.fire({
					html: html,
					animation: true,
					width: 500
				})
			}

			function edit(id, pertanyaan, required, khusus, kategori) {
				if (required == '*') {
					var select1 = 'selected';
				} else {
					var select2 = 'selected';
				}
				if (khusus == true) {
					var select3 = 'selected';
				} else {
					var select4 = 'selected';
				}
				if (kategori == 'online') {
					var select5 = 'selected';
				} else {
					var select6 = 'selected';
				}
				var html = '<form method="POST" id="formeditmjl" action="{{ route("admin.editpertanyaan") }}" role="form">' +
					'@csrf' +
					'<div class="form-group">' +
					'<label>Pertanyaan</label>' +
					'<input name="pertanyaan" class="form-control" value="' + pertanyaan + '" required>' +
					'<input name="id" type="hidden" class="form-control" value="' + id + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Required</label>' +
					'<select name="required" class="form-control">' +
					'<option value="*" ' + select1 + '>WAJIB</option>' +
					'<option value="" ' + select2 + '>TIDAK WAJIB</option>' +
					'</select>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Khusus</label>' +
					'<select name="khusus" class="form-control">' +
					'<option value="true" ' + select3 + '>KHUSUS</option>' +
					'<option value="" ' + select4 + '>TIDAK KHUSUS</option>' +
					'</select>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Kategori</label>' +
					'<select name="kategori" class="form-control">' +
					'<option value="online" ' + select5 + '>Online</option>' +
					'<option value="offline" ' + select6 + '>Offline</option>' +
					'</select>' +
					'</div>' +
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

			function show(id, hideShow) {
				if (hideShow == 'hide') {
					var title = 'Sembunyikan Data?';
				} else {
					var title = 'Tampilkan Data?';
				}
				var html = '<form id="formDelete" role="form" method="post" action="{{ route("admin.deletedpertanyaan") }}">' +
					'@csrf' +
					'<input type="hidden" name="id" value="' + id + '">' +
					'<input type="hidden" name="hideShow" value="' + hideShow + '">' +
					'</form>';

				Swal.fire({
					title: title + '<br><hr>',
					type: 'question',
					html: html,
					showCancelButton: true,
					cancelButtonText: "Batal",
					confirmButtonText: "Simpan",
					width: '30%'
				}).then(function(result) {
					if (result.value) {
						document.getElementById("formDelete").submit();
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

			function submitmjlform() {
				var pertanyaan = $('#pertanyaan').val();
				var required = $('#required').val();
				var khusus = $('#khusus').val();
				var kategori = $('#kategori').val();
				// console.log(pertanyaan+required+khusus+kategori)
				if (pertanyaan == '' || required == '0' ||khusus == '0'||kategori == '') {
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