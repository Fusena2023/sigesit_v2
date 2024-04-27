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
				<li class="active">Tiket Layanan Jasa</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pengaduan</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Tiket Pengaduan</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="tbl_pengaduan" width="100%">
									<thead class="table-primary">
										<tr>
											<th>No</th>
											<th>Nama Pengguna</th>
											<th>Nama Instansi</th>
											<th>Email</th>
											<th>No Hp</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<?php $no = 1; ?>
									@foreach($data as $key => $val)
	
									<tr>
										<td>
											<center>{{$no++}}</center>
										</td>
										<td>
											<center>{{$val->nama_pengguna}}</center>
										</td>
										<td>
											<center>{{$val->nama_instansi}}</center>
										</td>
										<td>
											<center>{{$val->email}}</center>
										</td>
										<td>
											<center>{{$val->no_hp}}</center>
										</td>
										<td>
											<center>
											<?php
											if ($val->status == 1) {
												echo 'ada tanggapan';
											} else {
												echo '';
											}
											
											?>
	
											</center>
										</td>
										<td>
											<button type="button" data-item="{{json_encode($val)}}" onclick="editpengaduan(this)" class="btn btn-sm btn-primary"><i class="fa fa-comment"></i></button>
										</td>
									</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- /.panel-->

				<!-- modal edit data -->
				<div class="modal fade" id="modal_update_pengaduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Edit Peserta Registrasi</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<form id="editjasilUjiKompt" method="post" action="{{route('admin.update_pengaduan')}}" class="" enctype="multipart/form-data">
									{{ csrf_field() }}

									<input type="hidden" class="form-control" id="id_data" name="id_data">

									<div class="form-group">
										<label for="">Nama Pengguna</label>
										<input id="nama_pengguna" name="nama_pengguna" type="text" class="form-control" disabled />
									</div>
									<div class="form-group">
										<label for="">Instansi</label>
										<input id="nama_instansi" name="nama_instansi" type="text" class="form-control" disabled />
									</div>
									<div class="form-group">
										<label for="">Email</label>
										<input id="email" name="email" type="text" class="form-control" disabled />
									</div>
									<div class="form-group">
										<label for="">No Handphone</label>
										<input id="no_hp" name="no_hp" type="number" class="form-control" disabled />
									</div>
									<div class="form-group">
										<label for="">Pengaduan</label>
										<textarea name="isi_pengaduan" id="isi_pengaduan" cols="30" rows="10" class="form-control" placeholder="Tulis isi laporan disini..." disabled></textarea>
									</div>
									<div class="form-group">
										<input type="file" name="upload_dokumen" accept="image/*" class="form-control" disabled />
									</div>
									<div class="form-group">
										<label for="">Tanggapan</label>
										<textarea name="tanggapan_admin" id="tanggapan_admin" cols="30" rows="10" class="form-control" placeholder="Tanggapi Disini"></textarea>
									</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<p class="back-link">Badan <a href="https://sigesit.big.go.id/">Informasi</a> Geospasial</p>
			</div>
		</div>
		<!--/.main-->

		@include('template.adminfooter')
		<script type="text/javascript">
			$(document).ready(function() {
				$('#tbl_pengaduan').DataTable({
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
			function editpengaduan(obj) {
				var item = $(obj).data('item');
				console.log(item)

				console.log(item)
				$('#id_data').val(item.id);
				$('#nama_pengguna').val(item.nama_pengguna);
				$('#nama_instansi').val(item.nama_instansi);
				$('#email').val(item.email);
				$('#no_hp').val(item.no_hp);
				$('#isi_pengaduan').val(item.isi_pengaduan);
				$('#modal_update_pengaduan').modal('show');
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