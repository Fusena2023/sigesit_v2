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
                <li class="active">Layanan Kas Negara</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Layanan Kas Negara</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">List Layanan Kas Negara</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="users-table" width="100%">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No.</th>
                                            <th>No.Tiket</th>
                                            <th>Jenis Setoran</th>
                                            <th>Kode Akun</th>
                                            <th>Keterangan</th>
                                            <th>Nominal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-->


                <div class="panel panel-default" style="">
                    <div class="panel-heading">Tambah Tiket Layanan Kas </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form method="POST" name="formsubmitmjl" action="{{ route('admin.simpan.layanan_kas') }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="row mb-4">
									<div class="col-md-3">
										<label>No Tiket</label>
									</div>
									<div class="col-md-7">
                                        <input type="text" name="nomer_tiket" id="nomer_tiket" class="form-control" value="{{$end}}" readonly>
									</div>
								</div>
                                <div class="row mb-4">
									<div class="col-md-3">
										<label>Jenis Setoran</label>
									</div>
									<div class="col-md-7">
                                        <select name="layanan_jasa" id="layanan_jasa" class="form-control" placeholder="Layanan Kas" required>
                                            <option value="" style="display:none">--Pilih Jenis Layanan--</option>
                                            @foreach($master_kas as $val)
                                            <option value="{{ $val->id_layanan_jasa }}_{{ $val->idnya_kode_akun }}">{{ $val->nama_layanan }}</option>
                                            @endforeach
                                        </select>									
                                    </div>
								</div>
                                <div class="row mb-4">
									<div class="col-md-3">
										<label>Kode Akun</label>
									</div>
									<div class="col-md-7">
                                        <input type="text" name="kode_akun" id="kode_akun" class="form-control" placeholder="Kode Akun" disabled>
									</div>
								</div>
                                <div class="row mb-4">
									<div class="col-md-3">
										<label>Keterangan</label>
									</div>
									<div class="col-md-7">
                                        <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control" placeholder="Keterangan" required></textarea>
									</div>
								</div>
                                <div class="row mb-4">
									<div class="col-md-3">
										<label>Nominal (Rp)</label>
									</div>
									<div class="col-md-7">
                                        <input type="text" id="nominal" name="nominal" class="form-control rupiah" placeholder="Nominal" required>
									</div>
								</div>

                                <a onclick="submitmjlform()" type="submit" style="float: right" class="btn btn-primary">Simpan</a>
                            </form>
                        </div>
                    </div>
                </div><!-- /.panel-->
            </div>
            <div class="col-sm-12">
                <p class="back-link">Lumino Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
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

                $('#layanan_jasa').change(function() {
                    var layanan_jasa = $(this).val();

                    var get_id = layanan_jasa.split("_");
                    console.log(get_id);
                    $.ajax({
                        type: "GET",
                        dataType: "html",
                        url: "{{ url('admin/getdata/kode-akun').'/' }}" + get_id[1],
                        success: function(res) {
                            console.log(res)
                            $('#kode_akun').val(res)
                        }
                    });
                });

                $( '.rupiah' ).mask('000.000.000.000.000.000.000', {reverse: true});

            });
        </script>
        <script>
            $(function() {
                $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.datatables.getdatatiketlayanankasnegara') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nomer_tiket',
                            name: 'nomer_tiket'
                        },
                        {
                            data: 'nama_layanan',
                            name: 'nama_layanan'
                        },
                        {
                            data: 'kode',
                            name: 'kode'
                        },

                        {
                            data: 'keterangan_kas',
                            name: 'keterangan_kas'
                        },

                        {
                            data: 'nominal',
                            name: 'nominal'
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
            function edit(id, nama_layanan,keterangan_kas,nominal,id_master_kas_negara) {
                var html = '';

                html += '<form method="POST" id="formeditmjl" action="{{ route("admin.edit.layanan_kas") }}" enctype="multipart/form-data" role="form">';
                html += '@csrf';
                html += '<input name="id" type="hidden" class="form-control" value="' + id + '" required>';
                html += '<div class="form-group">';
                html += '<label>Jenis Setoran</label>';
                html += '<select name="nama_layanan" class="form-control">';
                @foreach($master_kas as $val)
                var layan = '{{ $val->id }}';
                var selec = (layan == id_master_kas_negara) ? 'selected' : '';
                html += '<option value="{{ $val->id_layanan_jasa }}" ' + selec + '>{{ $val->nama_layanan}}</option>';
                @endforeach
                html += '</select>';
                html += '</div>';
                html += '<div class="form-group">';
                html += '<label>Keterangan</label>';
                html += '<textarea name="keterangan" class="form-control" value="" required>' + keterangan_kas + '</textarea>';
                html += '</div>';
                html += '<div class="form-group">';
                html += '<label>Nominal</label>';
                html += '<input type="text" name="nominal" class="form-control rupiah" value="' + nominal + '" required>';
                html += '</div>';
                
                html += '</form>';

                Swal.fire({
                    title: 'Edit Data<br><hr>',
                    // type: 'question',
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
            // function lihat(nama_layanan, kode_akun) {

            //     var html = '<table width="85%" style="font-size:15px;">' +
            //         '<tr>' +
            //         '<td>Jenis Setoran</td>' +
            //         '<td>:</td>' +
            //         '<td>' + nama_layanan + '</td>' +
            //         '</tr>' +
            //         '<tr>' +
            //         '<td>Kode Akun</td>' +
            //         '<td>:</td>' +
            //         '<td>' + kode_akun + '</td>' +
            //         '</tr>' +
            //         '</table>';
            //     Swal.fire({
            //         html: html,
            //         animation: true,
            //         width: 500
            //     })
            // }


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
        @if(Session::has('error'))
        <script type="text/javascript">
            Swal.fire({
                type: 'error',
                text: '{{Session::get("error")}}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php
        Session::forget('error');
        ?>
        @endif
</body>

</html>