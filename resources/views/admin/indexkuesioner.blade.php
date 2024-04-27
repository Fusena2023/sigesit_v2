<!DOCTYPE html>
<html>
@include('template.adminheader')


<body>
	@include('template.adminnavbar')
	<style>
		button {
			border-radius: 50% !important;
		}
	</style>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
						<em class="fa fa-database"></em>
					</a></li>
				<li class="active">Kuesioner</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Kuesioner</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List Kuesioner</div>
					<div class="panel-body">
						<p style="color:#110674;"><b>Jumlah Tiket : {{$count_tiket}}</b></p>
						<p style="color:#110674;"><b>Jumlah Tidak Mengisi Kuesioner : {{$count_yang_belum_kuesioner}}</b></p>
						<p style="color:#110674;"><b>Jumlah Sudah Mengisi Kuesioner : {{$count_yang_sudah_kuesioner}}</b></p>
						<table class="table table-bordered" style="background: none; width:100%">
							<tr>
								<th>Tingkat Kepuasan</th>
								<th>Tingkat Kepentingan</th>
							</tr>
							<tr>
								<td>
									1 : SANGAT TIDAK PUAS (STP)<br>
									2 : TIDAK PUAS (TP)<br>
									3 : PUAS (P)<br>
									4 : SANGAT PUAS (SP)<br>
								</td>
								<td>
									1 : SANGAT TIDAK PENTING (STP)<br>
									2 : TIDAK PENTING (TP)<br>
									3 : PENTING (P)<br>
									4 : SANGAT PENTING (SP)<br>
								</td>
							</tr>
						</table>
						<table class="table table-bordered" width="100%">
							<thead class="table-primary">
								<tr>
									<th rowspan="2">No.</th>
									<th rowspan="2">PERNYATAAN</th>
									<th colspan="4">TINGKAT KEPUASAN</th>
									<th colspan="4">TINGKAT KEPENTINGAN</th>
								</tr>
								<tr>
									<th>1</th>
									<th>2</th>
									<th>3</th>
									<th>4</th>
									<th>1</th>
									<th>2</th>
									<th>3</th>
									<th>4</th>
								</tr>
							</thead>
							@foreach($pertanyaan as $key => $val)
							<?php
							$jawab_puas1 = DB::table('kuesioner')->where('tingkat_kepuasan', 1)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_puas2 = DB::table('kuesioner')->where('tingkat_kepuasan', 2)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_puas3 = DB::table('kuesioner')->where('tingkat_kepuasan', 3)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_puas4 = DB::table('kuesioner')->where('tingkat_kepuasan', 4)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_penting1 = DB::table('kuesioner')->where('tingkat_kepentingan', 1)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_penting2 = DB::table('kuesioner')->where('tingkat_kepentingan', 2)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_penting3 = DB::table('kuesioner')->where('tingkat_kepentingan', 3)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_penting4 = DB::table('kuesioner')->where('tingkat_kepentingan', 4)->where('id_master_pertanyaan', $val->id)->count();
							?>
							<tr>
								<td>{{$no++}}</td>
								<td>{{$val->pertanyaan}} <input type="hidden" name="id_pertanyaan[{{$val->urutan}}]" value="{{$val->id}}"> <span style="color:red;">{{$val->required}}</span></td>
								<td><button class="btn btn-sm btn-danger">{{ $jawab_puas1 }}</button></td>
								<td><button class="btn btn-sm btn-warning">{{ $jawab_puas2 }}</button></td>
								<td><button class="btn btn-sm btn-info">{{ $jawab_puas3}}</button></td>
								<td><button class="btn btn-sm btn-success">{{ $jawab_puas4 }}</button></td>
								<td><button class="btn btn-sm btn-danger">{{ $jawab_penting1 }}</button></td>
								<td><button class="btn btn-sm btn-warning">{{ $jawab_penting2 }}</button></td>
								<td><button class="btn btn-sm btn-info">{{ $jawab_penting3 }}</button></td>
								<td><button class="btn btn-sm btn-success">{{ $jawab_penting4 }}</button></td>

								{{-- <td><span class="label label-danger">{{ $jawab_puas1 }}</span></td>
								<td><span class="label label-warning">{{ $jawab_puas2 }}</span></td>
								<td><span class="label label-info">{{ $jawab_puas3 }}</span></td>
								<td><span class="label label-success">{{ $jawab_puas4 }}</span></td>
								<td><span class="label label-danger">{{ $jawab_penting1 }}</span></td>
								<td><span class="label label-warning">{{ $jawab_penting2 }}</span></td>
								<td><span class="label label-info">{{ $jawab_penting3 }}</span></td>
								<td><span class="label label-success">{{ $jawab_penting4 }}</span></td> --}}
							</tr>
							@endforeach
							<tr>
								<th colspan="10">Khusus yang pernah menyampaikan pengaduan terhadap layanan BIG</th>
							</tr>
							@foreach($pertanyaan_khusus as $key => $val)
							<?php
							$jawab_puas_khusus1 = DB::table('kuesioner')->where('tingkat_kepuasan', 1)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_puas_khusus2 = DB::table('kuesioner')->where('tingkat_kepuasan', 2)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_puas_khusus3 = DB::table('kuesioner')->where('tingkat_kepuasan', 3)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_puas_khusus4 = DB::table('kuesioner')->where('tingkat_kepuasan', 4)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_penting_khusus1 = DB::table('kuesioner')->where('tingkat_kepentingan', 1)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_penting_khusus2 = DB::table('kuesioner')->where('tingkat_kepentingan', 2)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_penting_khusus3 = DB::table('kuesioner')->where('tingkat_kepentingan', 3)->where('id_master_pertanyaan', $val->id)->count();
							$jawab_penting_khusus4 = DB::table('kuesioner')->where('tingkat_kepentingan', 4)->where('id_master_pertanyaan', $val->id)->count();
							?>
							<tr>
								<td>{{$no++}}</td>
								<td>{{$val->pertanyaan}} <input type="hidden" name="id_pertanyaan[{{$val->urutan}}]" value="{{$val->id}}"> <span style="color:red;">{{$val->required}}</span></td>
								<td><button class="btn btn-sm btn-danger">{{ $jawab_puas_khusus1 }}</button></td>
								<td><button class="btn btn-sm btn-warning">{{ $jawab_puas_khusus2 }}</button></td>
								<td><button class="btn btn-sm btn-info">{{ $jawab_puas_khusus3 }}</button></td>
								<td><button class="btn btn-sm btn-success">{{ $jawab_puas_khusus4 }}</button></td>
								<td><button class="btn btn-sm btn-danger">{{ $jawab_penting_khusus1 }}</button></td>
								<td><button class="btn btn-sm btn-warning">{{ $jawab_penting_khusus2 }}</button></td>
								<td><button class="btn btn-sm btn-info">{{ $jawab_penting_khusus3 }}</button></td>
								<td><button class="btn btn-sm btn-success">{{ $jawab_penting_khusus4 }}</button></td>

								{{-- <td><span class="label label-danger">{{ $jawab_puas_khusus1 }}</span></td>
								<td><span class="label label-warning">{{ $jawab_puas_khusus2 }}</span></td>
								<td><span class="label label-info">{{ $jawab_puas_khusus3 }}</span></td>
								<td><span class="label label-success">{{ $jawab_puas_khusus4 }}</span></td>
								<td><span class="label label-danger">{{ $jawab_penting_khusus1 }}</span></td>
								<td><span class="label label-warning">{{ $jawab_penting_khusus2 }}</span></td>
								<td><span class="label label-info">{{ $jawab_penting_khusus3 }}</span></td>
								<td><span class="label label-success">{{ $jawab_penting_khusus4 }}</span></td> --}}
							</tr>
							@endforeach
						</table>
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
	<script>
		$(document).ready(function() {
			$("#kuesioner").addClass("active");
			$("#dashboard").removeClass("active");
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