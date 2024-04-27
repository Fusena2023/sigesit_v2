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
				<li class="active">Survey</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Survey</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List Survey</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="users-table" width="100%">
									<thead class="table-primary">
										<tr>
											<th>No.</th>
											<th>Tahun</th>
											<th>Triwulan</th>
											<th>Nilai</th>
											<th>Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.panel-->


				<div class="panel panel-default">
					<div class="panel-heading">Tambah Survey</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form method="POST" name="formsubmitmjl" action="{{ route('admin.simpansurvey') }}" enctype="multipart/form-data" role="form">
								@csrf
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Tahun</label>
									</div>
									<div class="col-md-7">
										<input name="tahun" id="tahun" class="form-control" placeholder="Tahun Survey" required>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Triwulan</label>
									</div>
									<div class="col-md-7">
										<select name="triwulan" id="triwulan" class="form-control" placeholder="Triwulan Survey" required>
											<option value="" style="display:none">--Pilih Triwulan--</option>
											<option value="1">I</option>
											<option value="2">II</option>
											<option value="3">III</option>
											<option value="4">IV</option>
										</select>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Nilai</label>
									</div>
									<div class="col-md-7">
										<input type="text" name="nilai" id="nilai" class="form-control numeric" placeholder="Nilai Survey" required></input>
									</div>
								</div>

								{{-- <div class="form-group">
									<label>Tahun</label>
									<input name="tahun" id="tahun" class="form-control" placeholder="Tahun Survey" required>
								</div>
								<div class="form-group">
									<label>Triwulan</label>
									<select name="triwulan" id="triwulan" class="form-control" placeholder="Triwulan Survey" required>
										<option value="" style="display:none">--Pilih Triwulan--</option>
										<option value="1">I</option>
										<option value="2">II</option>
										<option value="3">III</option>
										<option value="4">IV</option>
									</select>
								</div>
								<div class="form-group">
									<label>Nilai</label>
									<input type="text" name="nilai" id="nilai" class="form-control numeric" placeholder="Nilai Survey" required></input>
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
		<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {

				//ini diganti tiap form
				$("#survey").addClass("active");

				$("#dashboard").removeClass("active");
				inputmask();

			});
		</script>
		<script>
			$(function() {
				$('#users-table').DataTable({
					processing: true,
					serverSide: true,
					ajax: "{{ route('admin.datatables.getdatasurvey') }}",
					columns: [{
							data: 'DT_RowIndex',
							name: 'DT_RowIndex'
						},
						{
							data: 'tahun',
							name: 'tahun'
						},
						{
							data: 'triwulan',
							name: 'triwulan'
						},
						{
							data: 'nilai',
							name: 'nilai'
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
			function lihat(tahun, triwulan, nilai) {
				var convert_nilai = nilai.replace('.', ',');

				var html = '<table width="85%" style="font-size:15px;">' +
					'<tr>' +
					'<td>Tahun</td>' +
					'<td>:</td>' +
					'<td>' + tahun + '</td>' +
					'</tr>' +
					'<tr>' +
					'<td>Triwulan</td>' +
					'<td>:</td>' +
					'<td>' + triwulan + '</td>' +
					'</tr>' +
					'<tr>' +
					'<td>Nilai</td>' +
					'<td>:</td>' +
					'<td>' + convert_nilai + '</td>' +
					'</tr>' +
					'</table>';
				Swal.fire({
					html: html,
					animation: true,
					width: 500
				})
			}

			function edit(id, tahun, triwulan, nilai) {
				var convert_nilai = nilai.replace('.', ',');

				if (triwulan == 1) {
					var select1 = 'selected';
				} else if (triwulan == 2) {
					var select2 = 'selected';
				} else if (triwulan == 3) {
					var select3 = 'selected';
				} else {
					var select4 = 'selected';
				}
				var html = '<form method="POST" id="formeditmjl" action="{{ route("admin.editsurvey") }}" enctype="multipart/form-data" role="form">' +
					'@csrf' +
					'<div class="form-group">' +
					'<label>Tahun</label>' +
					'<input name="tahun" class="form-control" value="' + tahun + '" required>' +
					'<input name="id" type="hidden" class="form-control" value="' + id + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Triwulan</label>' +
					'<select name="triwulan" class="form-control">' +
					'<option value="1" ' + select1 + '>I</option>' +
					'<option value="2" ' + select2 + '>II</option>' +
					'<option value="3" ' + select3 + '>III</option>' +
					'<option value="4" ' + select4 + '>IV</option>' +
					'</select>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Nilai</label>' +
					'<input type="text" name="nilai" class="form-control numeric" value="' + convert_nilai + '" required>' +
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
				inputmask();
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
				var tahun = $('#tahun').val();
				var triwulan = $('#triwulan').val();
				var nilai = $('#nilai').val();
				if (triwulan == '' || tahun == '' || nilai == '') {
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


			function inputmask() {
				$('.numeric').inputmask({
					alias: "decimal",
					digits: 2,
					repeat: 36,
					digitsOptional: false,
					decimalProtect: true,
					groupSeparator: ".",
					placeholder: '0',
					radixPoint: ",",
					radixFocus: true,
					autoGroup: true,
					autoUnmask: false,
					onBeforeMask: function(value, opts) {
						return value;
					},
					removeMaskOnSubmit: true
				});
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