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
                <li class="active">Kategori Layanan Jasa</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Kategori Layanan Jasa</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">List Kategori</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="users-table" width="100%">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Layanan Jasa</th>
                                            <th>Kode Layanan</th>
                                            <th>Deskripsi</th>
                                            <th>Pusat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-->


                <div class="panel panel-default" style="display: none;">
                    <div class="panel-heading">Tambah Kategori Layanan Jasa</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form method="POST" name="formsubmitmjl" action="{{ route('admin.simpankatlayananjasa') }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Nama Layanan Jasa</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input name="nama_layanan_jasa" id="nama_layanan_jasa" class="form-control" placeholder="Nama Layanan Jasa" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Kode Layanan</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="kode" id="kode" class="form-control" placeholder="Kode Layanan Jasa" required></input>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Deskripsi</label>
                                    </div>
                                    <div class="col-md-7">
                                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Pusat</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="id_pusat" id="id_pusat" class="form-control" required>
                                            <option value="-">Pilih Pusat</option>
                                            @foreach($masterpusat as $mp)
                                            <option value="{{ $mp->id }}">{{ $mp->nama_pusat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Gambar/Icon</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="file" name="icon" id="icon" onchange="return validasiFile()" accept=".jpg, .jpeg, .png" required>
                                        <p class="help-block">file diwajibkan .png/.jpg/.jpeg (rekomendasi 400x400)</p>
                                    </div>
                                </div>

                                {{-- <div class="form-group">
									<label>Nama Layanan Jasa</label>
									<input name="nama_layanan_jasa" id="nama_layanan_jasa" class="form-control" placeholder="Nama Layanan Jasa" required>
								</div>
								<div class="form-group">
									<label>Kode Layanan</label>
									<input type="text" name="kode" id="kode" class="form-control" placeholder="Kode Layanan Jasa" required></input>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required></textarea>
								</div>
								<div class="form-group">
									<label>Pusat</label>
									<select name="id_pusat" id="id_pusat" class="form-control" required>
										<option value="-">Pilih Pusat</option>
										@foreach($masterpusat as $mp)
										<option value="{{ $mp->id }}">{{ $mp->nama_pusat }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Gambar/Icon</label>
                            <input type="file" name="icon" id="icon" onchange="return validasiFile()" accept=".jpg, .jpeg, .png" required>
                            <p class="help-block">file diwajibkan .png/.jpg/.jpeg (rekomendasi 400x400)</p>
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
            $("#katlayananjasa").addClass("active");

            $("#dashboard").removeClass("active");

        });
    </script>
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.datatables.getdatanolrupiah') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_layanan_jasa',
                        name: 'nama_layanan_jasa'
                    },
                    {
                        data: 'kode_layanan',
                        name: 'kode_layanan'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
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
        function lihat(nama_layanan_jasa, deskripsi, gambar, nama_pusat, kode_layanan) {
            var ico = '{{ url("upload/jasa/") }}/' + gambar;
            Swal.fire({
                title: nama_layanan_jasa,
                html: kode_layanan + '<br><br>' + deskripsi,
                imageUrl: ico,
                imageWidth: 300,
                imageHeight: 300,
                imageAlt: 'Custom image',
                animation: true,
                footer: nama_pusat,
                width: 500
            })
        }

        function show(id, status) {
            var html2 = '<center> Apakah Anda yakin ?</center><form method="POST" name="formshowmjl" action="{{ route("admin.showkatlayananjasa") }}" role="form">@csrf<input name="id" type="hidden" value="' + id + '"></form>';
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

        function edit(id, nama_layanan_jasa, deskripsi, gambar, nama_pusat, id_pusat, kode_layanan) {
            var html = '<form method="POST" id="formeditmjl" action="{{ route("admin.editkatlayananjasa") }}" enctype="multipart/form-data" role="form">' +
                '@csrf' +
                '<div class="form-group">' +
                '<label>Nama Layanan Jasa</label>' +
                '<input name="nama_layanan_jasa" class="form-control" value="' + nama_layanan_jasa + '" required>' +
                '<input name="id" type="hidden" class="form-control" value="' + id + '" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label>Kode Layanan</label>' +
                '<input name="kode" class="form-control" value="' + kode_layanan + '" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label>Deskripsi</label>' +
                '<textarea name="deskripsi" class="form-control" required rows="5">' + deskripsi + '</textarea>' +
                '</div>' +
                '<div class="form-group">' +
                '<label>Pusat</label>' +
                '<select name="id_pusat" id="id_pusat" class="form-control" required>' +
                '<option value="' + id_pusat + '">-' + nama_pusat + '-</option>' +
                @foreach($masterpusat as $mp)
            '<option value="{{ $mp->id }}">{{ $mp->nama_pusat }}</option>' +
            @endforeach
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label>Gambar/Icon</label>' +
                '<center><input type="file" name="icon"></center>' +
                '<p class="help-block">file diwajibkan .png/.jpeg (max 400x400)</p>' +
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
            var nama_layanan = $('#nama_layanan_jasa').val();
            var kode_layanan = $('#kode').val();
            var desk = $('#deskripsi').val();
            var pusat = $('#id_pusat').val();
            var gambar = $('#icon').val();
            console.log(nama_layanan)

            if (nama_layanan == '' || kode_layanan == '' || desk == '' || pusat == '' || gambar == '') {
                swal.fire({
                    title: "Data belum lengkap",
                    text: "Silahkan Lengkapi data",
                    type: "warning"
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