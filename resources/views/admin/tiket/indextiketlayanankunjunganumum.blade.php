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
				<li class="active">Tiket Layanan Kunjungan Umum</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Layanan Kunjungan Umum</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Tiket Layanan Kunjungan Umum</div>
					<div class="panel-body">
						<div class="col-md-12">
							<table class="table table-bordered" id="users-table-jasa">
			                    <thead>
			                        <tr>
			                            <th>No.Tiket</th>
			                            <th>Tanggal</th>
			                            <th>Pengguna</th>
			                            <th>Aksi</th>
			                        </tr>
			                    </thead>
			                </table>
							<br>
							<br>
						</div>
					</div>
				</div><!-- /.panel-->
				
			</div>
			<div class="col-sm-12">
				<p class="back-link">Badan <a href="https://sigesit.big.go.id/">Informasi</a> Geospasial</p>
			</div>
	</div>	<!--/.main-->
	
	@include('template.adminfooter')
	<script type="text/javascript">
		$(document).ready(function() {

			//ini diganti tiap form
			$("#tiket").addClass("active");

			$("#dashboard").removeClass("active");

		});
	</script>
	<script>
		$(function() {
	          $('#users-table-jasa').DataTable({
	              processing: true,
	              serverSide: true,
	              ajax: "{{ route('admin.datatables.getdatatiketlayanankunjunganumum') }}",
	              columns: [
	                  { data: 'no_tiket', name: 'no_tiket', orderable: false },
	                  { data: 'tanggal', name: 'tanggal' },
	                  { data: 'nama', name: 'nama' },
	                  { data: 'action', name: 'action', orderable: false, searchable: false}
	              ]
	          });
	      });
	</script>
	<script type="text/javascript">
		function lihat(id,no_tiket,tanggal,nama,created_at,updated_at){

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
			                            '<tr>'+
			                                '<td>No.Tiket</td>'+
			                                '<td>:</td>'+
			                                '<td colspan="2"><strong>'+ no_tiket +'</strong></td>'+
			                            '</tr>'+
			                        '</tbody>'+
			                    '</table>'+
			                    '<hr>'+
			                    '<div id="detail">'+
			                    '</div>'+
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
			  width : 600,
			  imageAlt: 'Tidak Ada Gambar'
			})


				$.ajax({
			        type: "GET",
			        url: "{{ url('admindetailkunjunganumumget').'/' }}"+id,             
			        dataType: "html",          
			        success: function(response){                    
			            $("#detail").html(response); 
			        }

			    });


		}

		function tutup(id,no_tiket,tanggal,nama,created_at,updated_at){
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
			                            '<tr>'+
			                                '<td>No.Tiket</td>'+
			                                '<td>:</td>'+
			                                '<td colspan="2"><strong>'+ no_tiket +'</strong></td>'+
			                            '</tr>'+
			                        '</tbody>'+
			                    '</table>'+
			                    '<hr>'+
			                    '<div id="detail2">'+
			                    '</div>'+
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
			                    '<form method="POST" name="formcloselayananjasa" action="{{ route("admin.tutuptiketlayanankunjunganumum") }}" role="form">@csrf<input name="id" type="hidden" value="'+id+'"></form>'+
			                '</div>'+
			  			'</font>'+
			  		'</div>',
			  imageUrl: ico,
			  imageWidth: 80,
			  imageHeight: 80,
			  imageAlt: 'Custom image',
			  animation: true,
			  width : 600,
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

		    	$.ajax({
			        type: "GET",
			        url: "{{ url('admindetailkunjunganumumget').'/' }}"+id,             
			        dataType: "html",          
			        success: function(response){                    
			            $("#detail2").html(response); 
			        }

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