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
                <li class="active">Hasil Survey Perkomponen</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Hasil Survey Perkomponen</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">List Hasil Survey Perkomponen</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="users-table" width="100%">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No.</th>
                                            <th>Tahun</th>
                                            <th>Triwulan</th>
                                            <th>Unsur</th>
                                            <th>Kepuasan</th>
                                            <th>Kepentingan</th>
                                            <th>IKM</th>
                                            <th>Nilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-->


                <div class="panel panel-default">
                    <div class="panel-heading">Tambah Hasil Survey Perkomponen</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form method="POST" name="formsubmitfaq" action="{{ route('admin.simpan.hasilsurveykomponen') }}" enctype="multipart/form-data" role="form">
                                @csrf
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
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Unsur</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="unsur" id="id_unsur" class="form-control" required>
                                            <option value="">--- Pilih Unsur ---</option>
                                            @foreach($master_unsur as $val)
                                            <option value="{{$val->id}}">{{$val->nama_unsur}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Kepuasan</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" oninput="this.value = Math.abs(this.value)" onkeyup="CekKepuasan()" name="kepuasan" id="kepuasan" class="form-control" min="1" max="4" required>
                                        <span style="display: none; color:red" id="allert_kepuasan">Melebihi Jumlah Maksimal</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Kepentingan</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" name="kepentingan" id="kepentingan" class="form-control" min="1" max="4" oninput="this.value = Math.abs(this.value)" onkeyup="cekKepentingan()" required>
                                        <span style="display: none; color:red" id="allert_kepentingan">Melebihi Jumlah Maksimal</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>IKM</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input min="1" max="4" maxlength="1" oninput="this.value = Math.abs(this.value)" type="number" onkeyup="CekIKM()" name="ikm" id="ikm" class="form-control" required>
                                        <span style="display: none; color:red" id="allert_ikm">Melebihi Jumlah Maksimal</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label>Nilai</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="nilai" id="nilai" class="form-control">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                        </select>
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
                $("#pusat").select2();

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
                    ajax: "{{ route('admin.datatables.getdata.hasilsurveykomponen') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
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
                            data: 'nama_unsur',
                            name: 'nama_unsur'
                        },
                        {
                            data: 'kepuasan',
                            name: 'kepuasan'
                        },
                        {
                            data: 'kepentingan',
                            name: 'kepentingan'
                        },
                        {
                            data: 'ikm',
                            name: 'ikm'
                        },
                        {
                            data: 'nilai',
                            name: 'nilai'
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
            function hapus(id_hasil, nama_pusat) {
                var html3 = '<center><font color="red">"' + nama_pusat + '"</font><br><br>Akan di hapus</center><form method="POST" name="formhapusberita" action="{{ route("admin.hapus.hasilsurveykomponen") }}" role="form">@csrf<input name="id" type="hidden" value="' + id_hasil + '"></form>';
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

            function CekKepuasan() {
                var count = $('#kepuasan').val();
                if (count > 4) {
                    $('#allert_kepuasan').show();
                } else {
                    $('#allert_kepuasan').hide();
                }

            }
            function cekKepentingan() {
                var count = $('#kepentingan').val();
                if (count > 4) {
                    $('#allert_kepentingan').show();
                } else {
                    $('#allert_kepentingan').hide();
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
                $.post("{{route('admin.Get_triwulan.hasilPerkomponen')}}", {
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

            function edit(id_hasil, nama_unsur, id, kepuasan, kepentingan, ikm, konversi, nilai) {
                var html = '';
                html += '<form method="POST" id="formeditstasiun" action="{{ route("admin.edit.hasilsurveykomponen") }}" enctype="multipart/form-data" role="form">';
                html += '@csrf';

                html += '<input name="id" type="hidden" class="form-control" value="' + id_hasil + '" required>';

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

                html += '<div class="form-group">';
                html += '<label>Unsur</label>';
                html += '<select name="unsur" class="form-control">';
                @foreach($master_unsur as $val) var kode = '{{ $val->id }}';
                var selec = (kode == id) ? 'selected' : '';
                html += '<option value="{{ $val->id }}" ' + selec + '>{{ $val->nama_unsur }}</option>';
                @endforeach html += '</select>';
                html += '</div>';

                html += '<div class="form-group">';
                html += '<label>Kepuasan</label>';
                html += '<input name="kepuasan" class="form-control" value="' + kepuasan + '" required>';
                html += '</div>';

                html += '<div class="form-group">';
                html += '<label>Kepentingan</label>';
                html += '<input name="kepentingan" class="form-control" value="' + kepentingan + '" required>';
                html += '</div>';

                html += '<div class="form-group">';
                html += '<label>IKM</label>';
                html += '<input name="ikm" type="number" class="form-control" value="' + ikm + '" required>';
                html += '</div>';

                html += '<div class="form-group">';
                html += '<label>Konversi</label>';
                html += '<input name="konversi" type="number" class="form-control" value="' + konversi + '" required>';
                html += '</div>';

                html += '<div class="form-group">';
                html += '<label>Nilai</label>';
                html += '<input name="nilai" type="number" class="form-control" value="' + nilai + '" required>';
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