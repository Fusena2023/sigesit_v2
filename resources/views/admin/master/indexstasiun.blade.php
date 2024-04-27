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
                <li class="active">Stasiun</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Stasiun</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">List Stasiun</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="users-table" width="100%">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Stasiun</th>
                                            <th>Nama Stasiun</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-->


                <div class="panel panel-default">
                    <div class="panel-heading">Tambah Stasiun</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form method="POST" name="formsubmitfaq" action="{{ route('admin.simpan.stasiun') }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Kode Stasiun</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input name="kode_stasiun" id="kode_stasiun" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Nama Stasiun</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input name="nama_stasiun" id="nama_stasiun" class="form-control" required>
                                    </div>
                                </div>
                                <button type="submit" style="float: right" class="btn btn-primary">Simpan</button>
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
                    ajax: "{{ route('admin.datatables.getdata.stasiun') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'kode_stasiun',
                            name: 'kode_stasiun'
                        },
                        {
                            data: 'nama_stasiun',
                            name: 'nama_stasiun'
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
            function hapus(id, kode_stasiun, nama_stasiun) {
                var html3 = '<center><font color="red">"' + nama_stasiun + '"</font><br><br>Akan di hapus</center><form method="POST" name="formhapusberita" action="{{ route("admin.hapus.stasiun") }}" role="form">@csrf<input name="id" type="hidden" value="' + id + '"></form>';
                Swal.fire({
                    type: 'question',   
                    html: html3,
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                }).then(function(result) {
                    if (result.value) {
                        document.formhapusberita.submit();
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

            function show(id, status) {
                var html2 = '<center> Data ini akan di edit</center><form method="POST" name="formshowmjl" action="{{ route("admin.update_status.stasiun") }}" role="form">@csrf<input name="id" type="hidden" value="' + id + '"></form>';
                Swal.fire({
                    type: 'question',
                    title: status + ' Stasiun',
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

            function edit(id, kode_stasiun, nama_stasiun) {
                var html = '<form method="POST" id="formeditstasiun" action="{{ route("admin.edit.stasiun") }}" enctype="multipart/form-data" role="form">' +
                    '@csrf' +
                    '<div class="form-group">' +
                    '<label>Kode Stasiun</label>' +
                    '<input name="kode_stasiun" class="form-control" value="' + kode_stasiun + '" required>' +
                    '<input name="id" type="hidden" class="form-control" value="' + id + '" required>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Nama Stasiun</label>' +
                    '<input name="nama_stasiun" class="form-control" value="' + nama_stasiun + '" required>' +
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
                        document.getElementById("formeditstasiun").submit();
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
        </script>
        <!-- Buat wyswyg -->

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