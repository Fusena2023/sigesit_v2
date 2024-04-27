<!DOCTYPE html>
<html>
@include('template.adminheader')

<body>
	@include('template.adminnavbar')

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
						<em class="fa fa-ticket"></em>
					</a></li>
				<li class="active">Tiket Layanan Diklat</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Layanan Diklat</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Tiket Layanan Diklat</div>
					<div class="panel-body">
						<div class="col-md-12">
							<table class="table table-bordered table-striped" id="users-table-diklat">
								<thead class="table-primary">
									<tr>
										<th>No</th>
										<th>Nama Diklat</th>
										<th>No.Tiket</th>
										<th>Instansi</th>
										<th>Kode Transaksi</th>
										<th>NPWP / NTPN</th>
										<th>Nominal</th>
									</tr>
								</thead>
							</table>
							<br>
							<br>
						</div>
					</div>
				</div><!-- /.panel-->
				@if(Auth::guard('internal')->user()->status != 1)
				<div class="panel panel-default" style="">
					<div class="panel-heading">Tambah Tiket Diklat </div>
					<div class="panel-body">
						<div class="col-md-6">
							<form method="POST" name="formsubmitmjl" action="{{ url('admin/simpan-layanan-diklat') }}" enctype="multipart/form-data" role="form">
								@csrf
								<div class="form-group">
									<label>No Tiket</label>
									<input type="text" name="nomer_tiket" id="nomer_tiket" class="form-control" value="{{$end}}" readonly>
								</div>
								<div class="form-group">
									<label>Kode Transaksi</label>
									<select name="kode_transaksi" id="kode_transaksi" class="form-control" placeholder="Kode Biling" required>
										<option value="" style="display:none">--Pilih Kode Biling--</option>
										@foreach($get_diklat as $val)
										<option value="{{ $val->id }}">{{ $val->kode_transaksi }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>Nama Diklat :</label>
									<label for="" id="nama_diklat"></label>
								</div>
								<div class="form-group">
									<label>Instansi :</label>
									<label for="" id="instansi"></label>
								</div>

								<div class="form-group">
									<label>Nominal :</label>
									<label for="" id="nominal"></label>
								</div>

								<div class="form-group">
									<label>NPWP/NTPN :</label>
									<label for="" id="npwp"></label>
								</div>
								<a onclick="submitmjlform()" type="submit" class="btn btn-primary">Simpan</a>
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
				@endif
			</div>
			<div class="col-sm-12">
				<p class="back-link">Badan <a href="https://sigesit.big.go.id/">Informasi</a> Geospasial</p>
			</div>
		</div>
		<!--/.main-->

		@include('template.adminfooter')
		<script>
			function play(no_tiket) {

				var x = document.getElementById(no_tiket);
				x.play();

			}
		</script>
		<script type="text/javascript">
			$(document).ready(function() {

				//ini diganti tiap form
				$("#tiket").addClass("active");

				$("#dashboard").removeClass("active");

				$('#kode_transaksi').change(function() {
					var kode_transaksi = $(this).val();
					$.ajax({
						type: "GET",
						dataType: "JSON",
						url: "{{ url('admin/get-detail-biling').'/' }}" + kode_transaksi,
						success: function(res) {
							$('#nama_diklat').text(res.nama_diklat)
							$('#instansi').text(res.instansi)
							$('#nominal').text(res.nominal)
							$('#npwp').text(res.npwp)
						}
					});
				});

			});

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
		</script>
		<script>
			$(function() {
				$('#users-table-diklat').DataTable({
					processing: true,
					serverSide: true,
					ajax: "{{ route('admin.datatables.getdatatiketlayanandiklat') }}",
					columns: [{
							data: 'DT_RowIndex',
							name: 'DT_RowIndex'
						},
						{
							data: 'nama_diklat',
							name: 'nama_diklat'
						},
						{
							data: 'no_tiket',
							name: 'no_tiket'
						},
						{
							data: 'instansi',
							name: 'instansi'
						},
						{
							data: 'kode_bayar',
							name: 'kode_bayar'
						},
						{
							data: 'ntpn',
							name: 'ntpn'
						},
						{
							data: 'total_bayar',
							name: 'total_bayar'
						},
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