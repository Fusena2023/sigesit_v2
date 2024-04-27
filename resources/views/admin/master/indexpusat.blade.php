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
				<li class="active">Master Pusat</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Master Pusat</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List Pusat</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="users-table" width="100%">
									<thead class="table-primary">
										<tr>
											<th>ID</th>
											<th>Nama Pusat</th>
											<th>Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.panel-->


				<div class="panel panel-default">
					<div class="panel-heading">Tambah Pusat</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form method="POST" name="formsubmitmjl" action="{{ route('admin.simpanpusat') }}" enctype="multipart/form-data" role="form">
								@csrf
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Nama Pusat</label>
									</div>
									<div class="col-md-7">
										<input name="nama_pusat" id="nama_pusat" class="form-control" placeholder="Nama Pusat" required>
									</div>
								</div>
								{{-- <div class="form-group">
									<label>Nama Pusat</label>
									<input name="nama_pusat" id="nama_pusat" class="form-control" placeholder="Nama Pusat" required>
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
					ajax: "{{ route('admin.datatables.getdatapusat') }}",
					columns: [{
							data: 'id',
							name: 'id'
						},
						{
							data: 'nama_pusat',
							name: 'nama_pusat'
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
			function show(id, status, nama_pusat) {
				var html2 = '<center>' + nama_pusat + ' Ingin di ' + status + '</center><form method="POST" name="formshowmjl" action="{{ route("admin.showpusat") }}" role="form">@csrf<input name="id" type="hidden" value="' + id + '"></form>';
				Swal.fire({
					type: 'question',
					title: status + ' Pusat',
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

			function edit(id, nama_pusat) {
				var html = '<form method="POST" id="formeditmjl" action="{{ route("admin.editpusat") }}" enctype="multipart/form-data" role="form">' +
					'@csrf' +
					'<div class="form-group">' +
					'<label>Nama Pusat</label>' +
					'<input name="nama_pusat" class="form-control" value="' + nama_pusat + '" required>' +
					'<input name="id" type="hidden" class="form-control" value="' + id + '" required>' +
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

			function submitmjlform() {
				var cekinput = $('#nama_pusat').val();
				if (cekinput == '') {
					Swal.fire({
						type: 'warning',
						text: 'Pastikan Semua data sudah di isi!'
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