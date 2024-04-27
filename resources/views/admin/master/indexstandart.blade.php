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
                <li class="active">Standard Pelayanan</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Standard Pelayanan</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">List Standard Pelayanan</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="users-table" width="100%">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No.</th>
                                            <th>Teks</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-->


                <div class="panel panel-default">
                    <div class="panel-heading">Tambah Standard Pelayanan</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form method="POST" name="formsubmitfaq" action="{{ route('admin.simpan.standart') }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Teks</label>
                                    </div>
                                    <div class="col-md-7">
                                        <textarea name="text" id="text" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Gambar</label>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="col-md-7">
                                            <input type="file" name="icon" id="icon" required onchange="">
                                            <p class="help-block">file diwajibkan .png/.jpeg (rekomendasi 600x600)</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
									<label>Pertanyaan</label>
									<textarea name="pertanyaan" id="pertanyaan" class="form-control" rows="3" required></textarea>
								</div>
								<div class="form-group">
									<label>Jawaban</label>
									<textarea name="jawaban" id="jawaban" class="form-control" rows="3" required></textarea>
								</div> --}}
                                <a onclick="submitfaqform()" type="submit" style="float: right" class="btn btn-primary">Simpan</a>
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
                    ajax: "{{ route('admin.datatables.getdata.standart') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'text',
                            name: 'text'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            width: '10%',
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
            function submitfaqform() {
                var cekfile = $('#icon').val();
                if (cekfile == '') {
                    Swal.fire({
                        type: 'warning',
                        text: 'Pastikan File sudah di isi!'
                    })

                } else {
                    Swal.fire({
                        type: 'question',
                        title: 'Simpan data',
                        text: 'Data sudah Benar'
                    }).then(function(result) {
                        if (result.value) {
                            document.formsubmitfaq.submit();
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

            function edit(id, text) {
                var html = '<form method="POST" id="formeditfaq" action="{{ route("admin.edit.standart") }}" enctype="multipart/form-data" role="form">' +
                    '@csrf' +
                    '<div class="form-group">' +
                    '<label>Teks</label>' +
                    '<textarea name="text" class="form-control" rows="3" required>' + text + '</textarea>' +
                    '<input name="id" type="hidden" class="form-control" value="' + id + '" required>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Dokumen</label>' +
                    '<input name="gambar" type="file" class="form-control">' +
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
                        document.getElementById("formeditfaq").submit();
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

            function show(id, status, text) {
                var html2 = '<center>' + text + ' Ingin di ' + status + '</center><form method="POST" name="formshowmjl" action="{{ route("admin.show.standart") }}" role="form">@csrf<input name="id" type="hidden" value="' + id + '"></form>';
                Swal.fire({
                    type: 'question',
                    title: status + ' Standard',
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
        </script>
        <!-- Buat wyswyg -->
        <script src="//cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('jawaban');
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