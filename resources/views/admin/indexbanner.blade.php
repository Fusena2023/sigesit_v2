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
				<li class="active">Master Banner</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Master Banner</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List Master Banner</div>
					<div class="panel-body">
						<div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="users-table" width="100%">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Gambar</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($master_banner as $mb)
                                        <tr>
                                            <td>{{$mb->id}}</td>
                                            <td>{{$mb->judul}}</td>
                                            <td>{{$mb->deskripsi}}</td>
                                            <td>{{$mb->gambar}}</td>
                                            @if($mb->show == 1)
                                            <td>Aktif</td>
                                            @else
                                            <td>Tidak Aktif</td>
                                            @endif
                                            <td>
                                                <button type="button" class="btn btn-warning" data-item="{{json_encode($mb)}}" onclick="return edit(this)"
                                                data-toggle="tooltip" data-placement="bottom" tittle="Edit"><i class="fa fa-pencil-square-o"></i></button>
    
                                                <button type="button" class="btn btn-danger" data-item="{{json_encode($mb)}}" onclick="return del(this)"
                                                data-toggle="tooltip" data-placement="bottom" tittle="Delete">
                                                <i class="fa fa-trash"></i></button></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
						</div>
					</div>
				</div><!-- /.panel-->
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Tambah Banner</div>
					<div class="panel-body">
							<form method="POST" name="formsubmitbanner" action="{{ route('admin.simpanbanner') }}" enctype="multipart/form-data" role="form">
                  				@csrf
                                <div class="col-md-12">
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <label>Judul</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input name="judul" id="judul" class="form-control" placeholder="Judul" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <label>Deskripsi</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <label>Gambar</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="file" name="gambar" id="gambar" class="form-control" placeholder="Gambar" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <label>Status</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select class="form-control" name="status" id="status">
                                                <option selected="selected">--Pilih Status--</option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a onclick="submitBanner()" type="submit" class="btn btn-primary">Simpan</a>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Judul</label>
                                        <input name="judul" id="judul" class="form-control" placeholder="Judul" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <input name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" required>
                                    </div>
                                    <div class="form-group">
                                        <a onclick="submitBanner()" type="submit" class="btn btn-primary">Simpan</a>
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <input type="file" name="gambar" id="gambar" class="form-control" placeholder="Gambar" onchange="return fileValidasi('gambar')" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status" id="status">
											<option selected="selected">--Pilih Status--</option>
											<option value="1">Aktif</option>
											<option value="0">Tidak Aktif</option>
										</select>
                                    </div>
                                </div> --}}
							</form>
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
            $('#users-table').DataTable({
                language: {
                    'paginate': {
                        'previous': '<span><</span>',
                        'next': '<span>></span>'
                    }
                }
            });
        });
    </script>
	<script>

    function submitBanner()
    {
        Swal.fire({
			  type: 'question',
			  title: 'Simpan data',
			  text: 'Data sudah Benar',
				showCancelButton: true,
				cancelButtonText: "Batal",
				confirmButtonText: "Simpan",
        }).then(function(result) {
            if (result.value) {
                document.formsubmitbanner.submit();
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

    function edit(obj)
    {
        var item = $(obj).data('item');
        var aktif = '';
        var tidak_aktif = '';
        (item.show == 1)?aktif='selected':tidak_aktif='selected';
            var html = '<form method="POST" id="formeditbanner" action="{{ route("admin.editbanner") }}" enctype="multipart/form-data" role="form">'+
                            '@csrf'+
                            '<div class="form-group">'+
                                '<label>Judul</label>'+
                                '<input name="judul_edit" class="form-control" value="'+item.judul+'" required>'+
                                '<input name="id_edit" type="hidden" class="form-control" value="'+item.id+'" required>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Deskripsi</label>'+
                                '<input name="deskripsi_edit" class="form-control" value="'+item.deskripsi+'" required>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Gambar</label>'+
                                '<input type="file" name="gambar_edit" class="form-control" required>'+
                                '<a href="../upload/'+item.gambar+'" style="background-color: #e0e0e0;" target="_blank" class="form-control">Document</a>'+
                                '<input name="gambar_get" type="hidden" class="form-control" value="'+item.gambar+'" required>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Status</label>'+
                                '<select class="form-control" name="status_edit" required>'+
                                    '<option value="1" '+aktif+'>Aktif</option>'+
                                    '<option value="0" '+tidak_aktif+'>Tidak Aktif</option>'+
                                '</select>'
                            '</div>'+
                        '</form>';

			Swal.fire({
		        title: 'Edit Banner<br><hr>',
		        // type: 'question',
		        html: html,
		        showCancelButton: true,
		        cancelButtonText: "Batal",
		        confirmButtonText: "Simpan",
		        width: '30%'
		    }).then(function(result) {
		        if (result.value) {
		        	document.getElementById("formeditbanner").submit();
		        }else if (result.value === 0) {
		            Swal.fire({
		                type: 'error',
		                text: "Batal Edit"
		            });

		        } else {
		            console.log(`modal was dismissed by ${result.dismiss}`)
		        }
		    })
    }

    function del(obj)
    {
        var item = $(obj).data('item');
        (item.show == 1)?aktif='selected':tidak_aktif='selected';
            var html = '<form method="POST" id="formdeletebanner" action="{{ route("admin.deletebanner") }}" enctype="multipart/form-data" role="form">'+
                            '@csrf'+
                                '<input name="id" type="hidden" class="form-control" value="'+item.id+'" required>'+
                                '<input name="gambar_edit" type="hidden" class="form-control" value="'+item.gambar+'" required>'+
                        '</form>';

			Swal.fire({
		        title: 'Delete Banner<br><hr>',
		        type: 'question',
		        html: html,
		        showCancelButton: true,
		        cancelButtonText: "Batal",
		        confirmButtonText: "Delete",
		        width: '30%'
		    }).then(function(result) {
		        if (result.value) {
		        	document.getElementById("formdeletebanner").submit();
		        }else if (result.value === 0) {
		            Swal.fire({
		                type: 'error',
		                text: "Batal Edit"
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
