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
				<li class="active">Pesan Percakapan</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pesan Percakapan Tanpa Tiket</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Pesan Percakapan Tanpa Tiket</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="users-table-jasa" width="100%">
									<thead class="table-primary">
										<tr>
											<th>Kode Percakapan</th>
											<th>Nama Pengguna</th>
											<th>Tanggal</th>
											<th>Perihal</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.panel-->
				
			</div>
			<div class="col-sm-12">
				<p class="back-link">Badan <a href="https://sigesit.big.go.id/">Informasi</a> Geospasial</p>
			</div>
	</div>	<!--/.main-->
	
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
			$("#pesanxtiket").addClass("active");

			$("#dashboard").removeClass("active");

		});
	</script>
	<script>
		$(function() {
			$('#users-table-jasa').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('admin.datatables.getdatapesanxtiket') }}",
				columns: [
					{ data: 'kode', name: 'kode' },
					{ data: 'nama_pengguna', name: 'nama_pengguna' },
					{ data: 'tanggal', name: 'tanggal', width: '15%' },
					{ data: 'perihal', name: 'perihal' },
					{ data: 'Status', name: 'Status' },
					{ data: 'action', name: 'action', width: '15%', orderable: false, searchable: false}
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
		function lihat(no_tiket,tanggal,mulai,selesai,nama,nama_layanan_jasa,created_at,updated_at){
			var ico = '{{url("assets/digilab/images/ico.png")}}';
			Swal.fire({
			  title: 'BADAN INFORMASI <br> GEOSPASIAL',
			  html: '<div style="text-align:left;">'+
			  			'<br><font size="2">'+
			  				  '<div class="col-md-12">'+
			                    '<table>'+
			                        '<tbody>'+
			                            '<col width="100">'+
			                            '<col width="20">'+
			                            '<col width="100">'+
			                            '<col width="100">'+
			                            '<tr>'+
			                                '<td>Hari/Tanggal</td>'+
			                                '<td>:</td>'+
			                                '<td colspan="2">'+ tanggal +'</td>'+
			                            '</tr>'+
			                            '<tr>'+
			                                '<td>Nama</td>'+
			                                '<td>:</td>'+
			                                '<td colspan="2">'+ nama +'</td>'+
			                            '</tr>'+
			                        '</tbody>'+
			                    '</table>'+
			                    '<hr>'+
			                    '<table style="width: 100%; border: 1px solid black; ">'+
			                        '<tbody>'+
			                            '<tr rowspan="2">'+
			                                '<th colspan="2" style="width:50%;border-right: 1px solid black;"><center>Kode :<br>'+ no_tiket +'</center></th>'+
			                                '<th colspan="2"><center>Perihal : <br>'+ nama_layanan_jasa +'</center></th>'+
			                            '</tr>'+
			                        '</tbody>'+
			                    '</table>'+
			                    '<br>'+
			                    '<br>'+
			                    '<table style="width: 100%;">'+
			                        '<tbody>'+
			                            '<tr>'+
			                                '<th colspan="3"></th>'+
			                                '<th><center>Waktu Dibuat :<br>'+ created_at +'<br><br><br>Waktu Selesai :<br>'+ updated_at +'</center></th>'+
			                            '</tr>'+
			                        '</tbody>'+
			                    '</table><hr>'+
			                '</div>'+
			  			'</font>'+
			  		'</div>',
			  imageUrl: ico,
			  imageWidth: 80,
			  imageHeight: 80,
			  imageAlt: 'Custom image',
			  animation: true,
			  width : 450,
			  imageAlt: 'Tidak Ada Gambar'
			})
		}

		function tutup(id,no_tiket,tanggal,mulai,selesai,nama,nama_layanan_diklat,created_at,updated_at){
			var ico = '{{url("assets/digilab/images/ico.png")}}';
			Swal.fire({
			  title: '<font style="color:orange">Tutup Tiket '+ no_tiket +'</font>',
			  html: '<div style="text-align:left;">'+
			  			'<br><font size="2">'+
			  				  '<div class="col-md-12">'+
			                    '<table>'+
			                        '<tbody>'+
			                            '<col width="100">'+
			                            '<col width="20">'+
			                            '<col width="100">'+
			                            '<col width="100">'+
			                            '<tr>'+
			                                '<td>Hari/Tanggal</td>'+
			                                '<td>:</td>'+
			                                '<td colspan="2">'+ tanggal +'</td>'+
			                            '</tr>'+
			                            '<tr>'+
			                                '<td>Nama</td>'+
			                                '<td>:</td>'+
			                                '<td colspan="2">'+ nama +'</td>'+
			                            '</tr>'+
			                        '</tbody>'+
			                    '</table>'+
			                    '<hr>'+
			                    '<table style="width: 100%; border: 1px solid black; ">'+
			                        '<tbody>'+
			                            '<tr rowspan="2">'+
			                                '<th colspan="2" style="width:50%;border-right: 1px solid black;"><center>Kode :<br>'+ no_tiket +'</center></th>'+
			                                '<th colspan="2"><center>Perihal : <br>'+ nama_layanan_diklat +'</center></th>'+
			                            '</tr>'+
			                        '</tbody>'+
			                    '</table>'+
			                    '<br>'+
			                    '<br>'+
			                    '<table style="width: 100%;">'+
			                        '<tbody>'+
			                            '<tr>'+
			                                '<th colspan="3"></th>'+
			                                '<th><center>Waktu Dibuat :<br>'+ created_at +'<br><br><br>Waktu Selesai :<br>'+ updated_at +'</center></th>'+
			                            '</tr>'+
			                        '</tbody>'+
			                    '</table><hr><center><font style="color:orange">Apakah Anda Yakin Selesaikan TIket ?</font></center>'+
			                    '<form method="POST" name="formcloselayananjasa" action="{{ route("admin.tutuppesanxtiket") }}" role="form">@csrf<input name="id" type="hidden" value="'+id+'"></form>'+
			                '</div>'+
			  			'</font>'+
			  		'</div>',
			  imageUrl: ico,
			  imageWidth: 80,
			  imageHeight: 80,
			  imageAlt: 'Custom image',
			  animation: true,
			  width : 450,
			  imageAlt: 'Tidak Ada Gambar',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Tutup Tiket',
			  cancelButtonText: 'Batal'
			}).then(function(result) {
		        if (result.value) {
		            document.formcloselayananjasa.submit();
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
