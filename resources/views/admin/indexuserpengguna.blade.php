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
				<li class="active">User Pengguna</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">User Pengguna</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Rekap Pengguna</div>
					<div class="panel-body">
						<form method="POST" name="formfilter" action="{{route('admin.exportexcel')}}" enctype="multipart/form-data" role="form">
							@csrf
							<div class="col-md-4">
								<div class="form-group">
									<label>Tanggal</label>
									<input type="text" name="tanggal_range" id="tanggal_range" class="form-control filter_data" placeholder="Tanggal">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-success">Export</button>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Jenis Instansi</label>
									<select class="form-control filter_data" name="jenisinstansi" id="jenisinstansi" >
										<option value="">Pilih Jenis Instansi</option>
										<option value="Kementerian">Kementerian/Lembaga</option>
										<option value="Pendidikan">Institusi Pendidikan</option>
										<option value="Pemda">Pemda</option>
										<option value="Lainnya">Lainnya</option>
									</select>
								</div>
							</div>
						</form>
					</div>
				</div><!-- /.panel-->


				<div class="panel panel-default">
					<div class="panel-heading">List User Pengguna</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="users-table" width="100%">
									<thead class="table-primary">
										<tr>
											<th>ID</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Alamat</th>
											<th>Telepon</th>
											<th>Jenis Pengguna</th>
											<th>Alamat Instansi</th>
											<th>Jenis Instansi</th>
											<th>Instansi</th>
											<th>Direktorat</th>
											<th>NPWP</th>
											<th>Login Terakhir</th>
											<th>Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.panel-->


				<div class="panel panel-default">
					<div class="panel-heading">Tambah User Pengguna</div>
					<div class="panel-body">
						<form method="POST" name="formsubmitusers" action="{{ route('admin.simpanuserspengguna') }}" enctype="multipart/form-data" role="form">
							@csrf
							<div class="col-md-6">
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Nama</label>
									</div>
									<div class="col-md-7">
										<input name="nama" id="nama" class="form-control" placeholder="Nama" required>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Email</label>
									</div>
									<div class="col-md-7">
										<input name="email" id="email" class="form-control" placeholder="Email" required>
										<span class="" id="validasiEmail" style="color: red; display:none;">*email sudah di gunakan</span>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Alamat</label>
									</div>
									<div class="col-md-7">
										<input name="alamat" id="alamat" class="form-control" placeholder="Alamat" required>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Telepon</label>
									</div>
									<div class="col-md-7">
										<input name="telepon" id="telepon" class="form-control" placeholder="No. Handphone" required>
									</div>
								</div>
								<div class="row mb-4 instansinih" hidden>
									<div class="col-md-3">
										<label>Alamat Instansi</label>
									</div>
									<div class="col-md-7">
										<input name="alamatinstansi" id="alamatinstansi" class="form-control" placeholder="Alamat Instansi" required>
									</div>
								</div>

								{{-- <div class="form-group">
                                        <label>Nama</label>
                                        <input name="nama" id="nama" class="form-control" placeholder="Nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" id="email" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input name="alamat" id="alamat" class="form-control" placeholder="Alamat" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input name="telepon" id="telepon" class="form-control" placeholder="No. Handphone" required>
                                    </div>
                                    <div class="form-group instansinih" hidden>
                                        <label>Alamat Instansi</label>
                                        <input name="alamatinstansi" id="alamatinstansi" class="form-control" placeholder="Alamat Instansi" required>
                                    </div> --}}
								<div class="form-group">
									<a onclick="submitUsers()" type="submit" class="btn btn-primary">Simpan</a>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row mb-4 instansinih" hidden>
									<div class="col-md-3">
										<label>Jenis Instansi</label>
									</div>
									<div class="col-md-7">
										<!-- <input name="jenisinstansi" id="jenisinstansi" class="form-control" placeholder="Jenis Instansi" required> -->
										<select name="jenisinstansi" id="jenisinstansi" class="form-control" required>
											<option value="">---Pilih Data---</option>
											<option value="Kementerian">Kementerian/Lembaga</option>
											<option value="Pendidikan">Institusi Pendidikan</option>
											<option value="Pemda">Pemda</option>
											<option value="Lainnya">Lainnya</option>
										</select>
									</div>
								</div>
								<div class="row mb-4 instansinih" hidden>
									<div class="col-md-3">
										<label>Instansi</label>
									</div>
									<div class="col-md-7">
										<input name="instansi" id="instansi" class="form-control" placeholder="Instansi" required>
									</div>
								</div>
								<div class="row mb-4 instansinih" hidden>
									<div class="col-md-3">
										<label>Direktorat</label>
									</div>
									<div class="col-md-7">
										<input name="direktorat" id="direktorat" class="form-control" placeholder="Direktorat" required>
									</div>
								</div>
								<div class="row mb-4 instansinih" hidden>
									<div class="col-md-3">
										<label>NPWP</label>
									</div>
									<div class="col-md-7">
										<input name="npwp" id="npwp" class="form-control" placeholder="NPWP" required>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Jenis Pengguna</label>
									</div>
									<div class="col-md-7">
										<select class="form-control" name="jp" id="jp" onchange="Detailinstansi();">
											<option value="" selected="selected">--Pilih Jenis Pengguna--</option>
											<option value="1">Perorangan</option>
											<option value="2">Instansi</option>
										</select>
									</div>
								</div>

								{{-- <div class="form-group instansinih" hidden>
                                        <label>Jenis Instansi</label>
                                        <input name="jenisinstansi" id="jenisinstansi" class="form-control" placeholder="Jenis Instansi" required>
                                    </div>
									<div class="form-group instansinih" hidden>
                                        <label>Instansi</label>
                                        <input name="instansi" id="instansi" class="form-control" placeholder="Instansi" required>
                                    </div>
                                    <div class="form-group instansinih" hidden>
                                        <label>Direktorat</label>
                                        <input name="direktorat" id="direktorat" class="form-control" placeholder="Direktorat" required>
                                    </div>
                                    <div class="form-group instansinih" hidden>
                                        <label>NPWP</label>
                                        <input name="npwp" id="npwp" class="form-control" placeholder="NPWP" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Pengguna</label>
										<select class="form-control" name="jp" id="jp" onchange="Detailinstansi();">
											<option selected="selected">--Pilih Jenis Pengguna--</option>
											<option value="1">Perorangan</option>
											<option value="2">Instansi</option>
										</select>
                                    </div> --}}
							</div>
						</form>
					</div>
				</div><!-- /.panel-->
			</div>
			<div class="col-sm-12">
				<p class="back-link">Badan <a href="https://sigesit.big.go.id/">Informasi</a> Geospasial</p>
			</div>
		</div>
		<!--/.main-->

		@include('template.adminfooter')
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<script type="text/javascript">
			$(document).ready(function() {

				//ini diganti tiap form
				$("#userpengguna").addClass("active");

				$("#dashboard").removeClass("active");

			});
		</script>
		<script type="text/javascript">
			flatpickr("#tanggal_range", {
				mode: "range",
				dateFormat: "Y-m-d"
			});

			$(function() {
				$('#users-table').DataTable({
					processing: true,
					serverSide: true,
					dom: 'Bfrtip',
					buttons: [{
							extend: 'copyHtml5',
							exportOptions: {
								columns: [1, 2, 3, 4, 5, 8, 11]
							}
						},
						{
							extend: 'csvHtml5',
							exportOptions: {
								columns: [1, 2, 3, 4, 5, 8, 11]
							}
						},
						{
							extend: 'pdfHtml5',
							exportOptions: {
								columns: [1, 2, 3, 4, 5, 8, 11]
							}
						},
						{
							extend: 'excelHtml5',
							exportOptions: {
								columns: [1, 2, 3, 4, 5, 8, 11]
							}
						},
					],
					"columnDefs": [{
						"targets": [0, 6, 7, 9, 10],
						"visible": false
					}],
					ajax: {
                        url: "{{ route('admin.datatables.getdatauserspengguna') }}",
                        data: function(data) {
                            data.tanggal_range = $('#tanggal_range').val();
                            data.jenis_instansi = $('#jenisinstansi').val();
							// console.log(data);
                        }

					},
					columns: [{
							data: 'id',
							name: 'id'
						},
						{
							data: 'nama',
							name: 'nama'
						},
						{
							data: 'email',
							name: 'email'
						},
						{
							data: 'alamat',
							name: 'alamat'
						},
						{
							data: 'no_telp',
							name: 'no_telp'
						},
						{
							data: 'jenis_pengguna_fix',
							name: 'jenis_pengguna_fix'
						},
						{
							data: 'alamat_instansi',
							name: 'alamat_instansi'
						},
						{
							data: 'jenis_instansi',
							name: 'jenis_instansi'
						},
						{
							data: 'instansi',
							name: 'instansi'
						},
						{
							data: 'direktorat',
							name: 'direktorat'
						},
						{
							data: 'npwp',
							name: 'npwp'
						},
						{
							data: 'login_last',
							name: 'login_last'
						},
						{
							data: 'action',
							name: 'action',
							width: '11%',
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

			$('.filter_data').on("change", function() {
                    var tanggal = $('#tanggal_range').val();
                    console.log(tanggal);
                    if (tanggal.includes('to') || tanggal == '') {
                        $('#users-table').DataTable().ajax.reload();
                    }
                });

			function Detailinstansi() {
				var valinstansi = document.getElementById("jp").value;
				if (valinstansi == 2) {
					$('.instansinih').show();
				} else {
					$('.instansinih').hide();
				}
			}

			function submitUsers() {
				var nama = $('#nama').val();
				var email = $('#email').val();
				var alamat = $('#alamat').val();
				var telepon = $('#telepon').val();
				var jp = $('#jp').val();
				if (nama == '' || email == '' || alamat == '' || telepon == '' || jp == '') {
					Swal.fire({
						type: 'warning',
						text: 'Pastikan semua data sudah di isi!'
					})

				} else {
					Swal.fire({
						type: 'question',
						title: 'Simpan data',
						text: 'Data sudah Benar',
						showCancelButton: true,
						cancelButtonText: "Batal",
						confirmButtonText: "Simpan",
					}).then(function(result) {
						if (result.value) {
							document.formsubmitusers.submit();
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

			function edit(id, nama, email, alamat, no_telp, jp, ai, ji, i, direktorat, npwp) {
				var perorangan = '';
				var instansi = '';
				(jp == 1) ? perorangan = 'selected': instansi = 'selected';
				var html = '<form method="POST" id="formedituser" action="{{ route("admin.edituserspengguna") }}" enctype="multipart/form-data" role="form">' +
					'@csrf' +
					'<div class="row">' +
					'<div class="col-md-6">' +
					'<div class="form-group">' +
					'<label>Nama</label>' +
					'<input name="nama" class="form-control" value="' + nama + '" required>' +
					'<input name="id" type="hidden" class="form-control" value="' + id + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Email</label>' +
					'<input name="email" class="form-control" value="' + email + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Alamat</label>' +
					'<input name="alamat" class="form-control" value="' + alamat + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Telepon</label>' +
					'<input name="telpon" class="form-control" value="' + no_telp + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Alamat Instansi</label>' +
					'<input name="ai" class="form-control" value="' + ai + '" required>' +
					'</div>' +
					'</div>' +
					'<div class="col-md-6">' +
					'<div class="form-group">' +
					'<label>Jenis Instansi</label>' +
					'<input name="ji" class="form-control" value="' + ji + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Instansi</label>' +
					'<input name="instansi" class="form-control" value="' + i + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Direktorat</label>' +
					'<input name="direktorat" class="form-control" value="' + direktorat + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>NPWP</label>' +
					'<input name="npwp" class="form-control" value="' + npwp + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Jenis Pengguna</label>' +
					'<select class="form-control" name="jenis_pengguna" required>' +
					'<option value="1" ' + perorangan + '>Perorangan</option>' +
					'<option value="2" ' + instansi + '>Instansi</option>' +
					'</select>'
				'</div>' +
				'</div>' +
				'</div>' +
				'</form>';

				Swal.fire({
					title: 'Edit Data<br><hr>',
					type: 'question',
					html: html,
					showCancelButton: true,
					cancelButtonText: "Batal",
					confirmButtonText: "Simpan",
					width: '50%'
				}).then(function(result) {
					if (result.value) {
						document.getElementById("formedituser").submit();
					} else if (result.value === 0) {
						Swal.fire({
							type: 'error',
							text: "Batal Edit"
						});

					} else {
						console.log(`modal was dismissed by ${result.dismiss}`)
					}
				})
			}

			function view(id, nama, email, alamat, no_telp, jp, ai, ji, i, direktorat, npwp, login_last) {
				var perorangan = '';
				var instansi = '';
				(jp == 1) ? perorangan = 'selected': instansi = 'selected';
				var html = '<form method="POST" id="formedituser" enctype="multipart/form-data" role="form">' +
					'@csrf' +
					'<div class="row">' +
					'<div class="col-md-6">' +
					'<div class="form-group">' +
					'<label>Nama</label>' +
					'<input name="nama" class="form-control" value="' + nama + '" readonly>' +
					'<input name="id" type="hidden" class="form-control" value="' + id + '" required>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Email</label>' +
					'<input name="email" class="form-control" value="' + email + '" readonly>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Alamat</label>' +
					'<input name="alamat" class="form-control" value="' + alamat + '" readonly>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Telepon</label>' +
					'<input name="telpon" class="form-control" value="' + no_telp + '" readonly>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Alamat Instansi</label>' +
					'<input name="ai" class="form-control" value="' + ai + '" readonly>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Jenis Instansi</label>' +
					'<input name="ji" class="form-control" value="' + ji + '" readonly>' +
					'</div>' +
					'</div>' +
					'<div class="col-md-6">' +
					'<div class="form-group">' +
					'<label>Instansi</label>' +
					'<input name="instansi" class="form-control" value="' + i + '" readonly>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Direktorat</label>' +
					'<input name="direktorat" class="form-control" value="' + direktorat + '" readonly>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>NPWP</label>' +
					'<input name="npwp" class="form-control" value="' + npwp + '" readonly>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Login Terakhir</label>' +
					'<input name="created" class="form-control" value="' + login_last + '" readonly>' +
					'</div>' +
					'<div class="form-group">' +
					'<label>Jenis Pengguna</label>' +
					'<select class="form-control" name="jenis_pengguna" readonly>' +
					'<option value="1" ' + perorangan + '>Perorangan</option>' +
					'<option value="2" ' + instansi + '>Instansi</option>' +
					'</select>'
				'</div>' +
				'</div>' +
				'</div>' +
				'</form>';
				Swal.fire({
					title: 'View Data<br><hr>',
					html: html,
					width: '50%'
				})
			}

			function del(id) {
				var html = '<form method="POST" id="formdeleteuser" action="{{ route("admin.deleteuserspengguna") }}" enctype="multipart/form-data" role="form">' +
					'@csrf' +
					'<input name="id_edit" type="hidden" class="form-control" value="' + id + '" required>' +
					'</form>';

				Swal.fire({
					title: 'Delete Data<br><hr>',
					type: 'question',
					html: html,
					showCancelButton: true,
					cancelButtonText: "Batal",
					confirmButtonText: "Delete",
					width: '40%'
				}).then(function(result) {
					if (result.value) {
						document.getElementById("formdeleteuser").submit();
					} else if (result.value === 0) {
						Swal.fire({
							type: 'error',
							text: "Batal Delete"
						});

					} else {
						console.log(`modal was dismissed by ${result.dismiss}`)
					}
				})
			}

			$('#email').change(function() {
				var email = $('#email').val();
				$.ajax({
					type: "GET",
					dataType: "JSON",
					url: "{{ url('admin/validasi-email').'/' }}" + email,
					success: function(res) {

						console.log(res);
						if (res == 0) {
							$('#validasiEmail').hide();

						} else {
							$('#validasiEmail').show();
						}
					}
				});
			});
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