<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                <li class="active">Hasil Survey</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Hasil Survey</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">List Hasil Survey</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="users-table" width="100%">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No.</th>
                                            <th>Pusat</th>
                                            <th>Jumlah Pengunjung</th>
                                            <th>IKM</th>
                                            <th>Tahun</th>
                                            <th>Triwulan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-->


                <div class="panel panel-default">
                    <div class="panel-heading">Tambah Hasil Survey</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form method="POST" name="formsubmitfaq" action="{{ route('admin.simpan.hasilsurvey') }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Pusat</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="pusat" id="idnya_pusat" class="form-control" required>
                                            <option value="">--- Pilih pusat ---</option>
                                            @foreach($master_pusat as $val)
                                            <option value="{{$val->id}}">{{$val->nama_pusat}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Jumlah Pengunjung</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" name="jumlah_pengunjung" id="jumlah_pengunjung" class="form-control" onkeyup="cekJP()" required>
                                        <span style="display: none; color:red" id="allert_JP">Melebihi Jumlah Maksimal</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>IKM</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input min="1" max="4" maxlength="1" oninput="this.value = Math.abs(this.value)" type="number" onkeyup="CekIKM()" name="ikm" id="ikm" class="form-control cek_value" required>
                                        <span style="display: none; color:red" id="allert_ikm">Melebihi Jumlah Maksimal</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Tahun</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="tahun" id="tahun" class="form-control">
                                            <option value="">---Silahkan Pilih Tahun</option>
                                            @for($i=date('Y'); $i>=date('Y')-5; $i-=1)
                                            <option value="{{ $i }}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Triwulan</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="tw" id="tw" class="form-control">
                                            <option value="">---Silahkan Pilih Triwulan</option>
                                            <option value="1">I</option>
                                            <option value="2">II</option>
                                            <option value="3">III</option>
                                            <option value="4">IV</option>
                                        </select>
                                        <span id="alert_tw" style="display: none;color:red">Triwulan di tahun tersebut sudah ada</span>
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $("#idnya_pusat").select2();

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
                    ajax: "{{ route('admin.datatables.getdata.hasilsurvey') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nama_pusat',
                            name: 'nama_pusat'
                        },
                        {
                            data: 'jumlah_pengunjung',
                            name: 'jumlah_pengunjung'
                        },
                        {
                            data: 'ikm',
                            name: 'ikm'
                        },
                        {
                            data: 'tahun',
                            name: 'tahun'
                        },
                        {
                            data: 'tw',
                            name: 'tw'
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
            function cekJP() {
                var count = $('#jumlah_pengunjung').val();
                if (count > 4) {
                    $('#allert_JP').show();
                } else {
                    $('#allert_JP').hide();
                }

            }

            function CekIKM() {
                var count = $('#ikm').val();
                if (count > 4) {
                    $('#allert_ikm').show();
                } else {
                    $('#allert_ikm').hide();
                }

            }
            $("#tw").change(function() {
                $.post("{{route('admin.Get_triwulan.hasilsurvey')}}", {
                    tahun: $("#tahun").val(),
                    tw: $("#tw").val(),
                    _token: "{{csrf_token()}}"
                }, function(data) {
                    if (data == 0) {
                        $("#alert_tw").hide();
                    } else {
                        $("#alert_tw").show();
                    }
                });
            });

            function hapus(id_hasil, nama_pusat) {
                var html3 = '<center><font color="red">"' + nama_pusat + '"</font><br><br>Akan di hapus</center><form method="POST" name="formhapusberita" action="{{ route("admin.hapus.hasilsurvey") }}" role="form">@csrf<input name="id" type="hidden" value="' + id_hasil + '"></form>';
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

            function edit(id_hasil, nama_pusat, id, jumlah_pengunjung, ikm, tw, tahun) {
                var html = '';
                html += '<form method="POST" id="formeditstasiun" action="{{ route("admin.edit.hasilsurvey") }}" enctype="multipart/form-data" role="form">';
                html += '@csrf';

                html += '<input name="id" type="hidden" class="form-control" value="' + id_hasil + '" required>';

                html += '<div class="form-group">';
                html += '<label>Pusat</label>';
                html += '<select name="pusat" id="idnya_pusat_edit" class="form-control">';
                @foreach($master_pusat as $val) var kode = '{{ $val->id }}';
                var selec = (kode == id) ? 'selected' : '';
                html += '<option value="{{ $val->id }}" ' + selec + '>{{ $val->nama_pusat }}</option>';
                @endforeach html += '</select>';
                html += '</div>';

                html += '<div class="form-group">';
                html += '<label>Jumlah Pengunjung</label>';
                html += '<input name="jumlah_pengunjung" class="form-control" value="' + jumlah_pengunjung + '" required>';
                html += '</div>';


                html += '<div class="form-group">';
                html += '<label>IKM</label>';
                html += '<input name="ikm" type="number" class="form-control" value="' + ikm + '" required>';
                html += '</div>';

                html += '<div class="form-group">';
                html += '<label>Tahun</label>';
                html += '<select name="tahun" class="form-control">';
                @for($i = date('Y'); $i >= date('Y') - 5; $i -= 1)
                var kode = '{{ $i }}';
                var selec = (kode == tahun) ? 'selected' : '';
                html += '<option value="{{ $i }}" ' + selec + '>{{ $i }}</option>';
                @endfor html += '</select>';
                html += '</div>';

                html += '<div class="form-group">';
                html += '<label>Triwulan</label>';
                html += '<select name="tw" class="form-control">';
                html += '<option value="1">I</option>';
                html += '<option value="2">II</option>';
                html += '<option value="3">III</option>';
                html += '<option value="4">IV</option>';
                html += '</select>';
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