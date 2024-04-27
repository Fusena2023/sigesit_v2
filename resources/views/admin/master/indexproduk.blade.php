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
                <li class="active">Produk</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Produk</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">List Produk</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{route('admin.export_produk')}}" class="btn btn-success">Export</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="users-table" width="100%">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Produk</th>
                                            <th>Satuan</th>
                                            <th>Tarif</th>
                                            <th>Stok Awal</th>
                                            <th>Stok Baik</th>
                                            <th>Stok Rusak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-->


                <div class="panel panel-default">
                    <div class="panel-heading">Tambah Kas Negara</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form method="POST" name="formsubmitfaq" action="{{ route('admin.simpan.produk') }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Nama Produk</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input name="nama_produk" id="nama_produk" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Satuan</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="satuan" id="satuan" class="form-control" required>
                                            <option value="">--- Pilih Satuan ---</option>
                                            @foreach($master_satuan as $val)
                                            <option value="{{$val->id}}">{{$val->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Tarif (Rp)</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="tarif" id="tarif" class="form-control rupiah" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Stok Awal</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" name="stok_awal" id="stok_awal" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Stok Baik</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" name="stok_baik" id="stok_baik" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Stok Rusak</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" name="stok_rusak" id="stok_rusak" class="form-control" required>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                //ini diganti tiap form
                $("#master").addClass("active");

                $("#dashboard").removeClass("active");
                $( '.rupiah' ).mask('000.000.000.000.000.000.000', {reverse: true});

            });
        </script>

        <script>
            $(function() {
                // $('#tarif').mask('000.000.000.000.000,00', {reverse: true});

                $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.datatables.getdata.produk') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nama_produk',
                            name: 'nama_produk'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'tarif',
                            name: 'tarif'
                        },
                        {
                            data: 'stok_awal',
                            name: 'stok_awal'
                        },
                        {
                            data: 'stok_baik',
                            name: 'stok_baik'
                        },
                        {
                            data: 'stok_rusak',
                            name: 'stok_rusak'
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
            function hapus(id_produk, nama_produk) {
                var html3 = '<center><font color="red">"' + nama_produk + '"</font><br><br>Akan di hapus</center><form method="POST" name="formhapusberita" action="{{ route("admin.hapus.produk") }}" role="form">@csrf<input name="id" type="hidden" value="' + id_produk + '"></form>';
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
                var html2 = '<center> Data ini akan di edit</center><form method="POST" name="formshowmjl" action="{{ route("admin.update_status.produk") }}" role="form">@csrf<input name="id" type="hidden" value="' + id + '"></form>';
                Swal.fire({
                    type: 'question',
                    title: status + ' Produk',
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


            function edit(id_produk, nama_produk, id, tarif, stok_awal, stok_baik, stok_rusak) {
                var html = '';
                html += '<form method="POST" id="formeditstasiun" action="{{ route("admin.edit.produk") }}" enctype="multipart/form-data" role="form">';
                html += '@csrf';
                html += '<div class="form-group">';
                html += '<label>Nama Produk</label>';
                html += '<input name="id" type="hidden" class="form-control" value="' + id_produk + '" required>';
                html += '<input name="nama_produk" class="form-control" value="' + nama_produk + '" required>';
                html += '</div>';
                html += '<div class="form-group">';
                html += '<label>Satuan</label>';
                html += '<select name="satuan" class="form-control">';
                @foreach($master_satuan as $val)
                var kode = '{{ $val->id }}';
                var selec = (kode == satuan) ? 'selected' : '';
                html += '<option value="{{ $val->id }}" ' + selec + '>{{ $val->nama }}</option>';
                @endforeach
                html += '</select>';
                html += '</div>';
                html += '<div class="form-group">';
                html += '<label>Tarif (Rp)</label>';
                html += '<input name="tarif" type="text" class="form-control rupiah" value="' + tarif + '" required>';
                html += '</div>';
                html += '<div class="form-group">';
                html += '<label>Stok Awal</label>';
                html += '<input name="stok_awal" type="number" class="form-control" value="' + stok_awal + '" required>';
                html += '</div>';
                html += '<div class="form-group">';
                html += '<label>Stok Baik</label>';
                html += '<input name="stok_baik" type="number" class="form-control" value="' + stok_baik + '" required>';
                html += '</div>';
                html += '<div class="form-group">';
                html += '<label>Stok Rusak</label>';
                html += '<input name="stok_rusak" type="number" class="form-control" value="' + stok_rusak + '" required>';
                html += '</div>';
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