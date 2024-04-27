<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!DOCTYPE html>
<html>
	
@include('template.adminheader')

<!--hide arrows for type number-->
<style>
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
	}
	/* Firefox */
	input[type=number] {
	-moz-appearance: textfield;
	}
</style>

<body>
	@include('template.adminnavbar')

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"> 
						<em class="fa fa-clone"></em>
					</a></li>
				<li class="active">Master Layanan Kas Negara</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Master Layanan Kas Negara</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List Master Layanan Kas Negara</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="users-table" width="100%">
									<thead class="table-primary">
										<tr>
											<th>No.</th>
											<th>Nama Layanan</th>
											<th>Kode Akun</th>
											<th>Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.panel-->


				<div class="panel panel-default" >
					<div class="panel-heading">Tambah Master Layanan Kas Negara</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form method="POST" name="formsubmitmjl" action="{{ route('admin.master.simpan_kasnegara') }}" enctype="multipart/form-data" role="form">
								@csrf
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Nama Layanan</label>
									</div>
									<div class="col-md-6">
										<input type="text" name="layanan" id="layanan" class="form-control" placeholder="Nama Layanan" required>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-md-3">
										<label>Kode Akun</label>
									</div>
									<div class="col-md-6">
										<select name="kode_akun" id="kode_akun" class="form-control" required>
											<option value="">--Pilih Kode Akun--</option>
											@foreach($kode_akun as $val)
											<option value="{{ $val->id }}">{{ $val->kode_akun }}</option>
											@endforeach
										</select>
									</div>
								</div>
								{{-- <div class="form-group">
									<label>Nama Layanan</label>
									<input type="text" name="layanan" id="layanan" class="form-control" placeholder="Nama Layanan" required>
								</div>
								<div class="form-group">
									<label>Kode Akun</label>
									<select name="kode_akun" id="kode_akun" class="form-control" placeholder="Kode Akun" required>
										<option value="" style="display:none">--Pilih Kode Akun--</option>
                                        @foreach($kode_akun as $val)
										<option value="{{ $val->kode_akun }}">{{ $val->kode_akun }}</option>
								@endforeach
								</select>
								<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
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
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			//ini diganti tiap form
			$("#kode_akun").select2();
			$("#master").addClass("active");

			$("#dashboard").removeClass("active");
           
		});
	</script>
	<script>
		$(function() {
			$('#users-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('admin.master.get_kasnegara') }}",
				columns: [{
						data: 'DT_RowIndex',
						name: 'DT_RowIndex'
					},
					{
						data: 'nama_layanan',
						name: 'nama_layanan'
					},
					{
						data: 'kode',
						name: 'kode'
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
		function lihat(nama_layanan, kode_akun) {

			var html = '<table width="85%" style="font-size:15px;">' +
				'<tr>' +
				'<td>Nama Layanan</td>' +
				'<td>:</td>' +
				'<td>' + nama_layanan + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Kode Akun</td>' +
				'<td>:</td>' +
				'<td>' + kode_akun + '</td>' +
				'</tr>' +
				'</table>';
			Swal.fire({
				html: html,
				animation: true,
				width: 500
			})
		}

		function show(id, status) {
			var html2 = '<center> Apakah Anda yakin ?</center><form method="POST" name="formshowmjl" action="{{ route("admin.showkasnegara") }}" role="form">@csrf<input name="id" type="hidden" value="' + id + '"></form>';
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

		function edit(id, nama_layanan, id_kode_akun) {
			var html = '';

			html += '<form method="POST" id="formeditmjl" action="{{ route("admin.master.edit_kasnegara") }}" enctype="multipart/form-data" role="form">';
			html += '@csrf';
			html += '<div class="form-group">';
			html += '<label>Nama Layanan</label>';
			html += '<input name="id" type="hidden" class="form-control" value="' + id + '" required>';
			html += '<input name="layanan" class="form-control" value="' + nama_layanan + '" required>';
			html += '</div>';
			html += '<div class="form-group">';
			html += '<label>Kode Layanan</label>';
			html += '<select name="kode_akun" id="kode_akun" class="form-control">';
			@foreach($kode_akun as $val)
			var kode = '{{ $val->id }}';
			var selec = (kode == id_kode_akun) ? 'selected' : '';
			html += '<option value="{{ $val->id }}" ' + selec + '>{{ $val->kode_akun }}</option>';
			@endforeach
			html += '</select>';
			html += '</div>';
			html += '</form>';

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

		function destroy(id){
			var token = $('meta[name="csrf-token"]').attr('content');

			Swal.fire({
				type: 'question',
				title: 'Hapus data',
				text: 'Apakah anda yakin menghapus data ini?',
				type: 'error',
				showCancelButton: true
			}).then(function(result) {
				if (result.value) {
					$.get("{{route('admin.master.delete_kasnegara')}}",{ id:id,_token:token},function(data){
						location.reload();
					})
				} else {
					return false;
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