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
                <li class="active">Rekap Kuesioner</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Rekap Kuesioner</h1>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Rekap Kuesioner</div>
					<div class="panel-body">
						<p style="color:#110674;"><b>Jumlah Tiket : {{$count_tiket}}</b></p>
						<p style="color:#110674;"><b>Jumlah Tidak Mengisi Kuesioner : {{$count_yang_belum_kuesioner}}</b></p>
						<p style="color:#110674;"><b>Jumlah Sudah Mengisi Kuesioner : {{$count_yang_sudah_kuesioner}}</b></p>
                        <br>
                        <div class="row">
                            <form method="POST" id="formfilter" action="{{route('admin.exportexcel.kuesioner')}}" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Periode Tiket</label>
                                        <input type="text" name="tanggal_range" id="tanggal_range" class="form-control" placeholder="Tanggal" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" onclick="konfirmExport()" class="btn btn-success">Export</button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" name="kategori" id="kategori">
                                            <option value="" style="display:none;">Pilih Kategori Tiket</option>
                                            <option value="online">Online</option>
                                            <option value="offline">Offline</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            </form>
                
                        </div>
                        <form action="{{route('admin.kirim.email.blm.kuisioner')}}" method="post" id="form-multiapprov">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="users-table-jasa" width="100%">
                                                        <thead class="table-primary">
                                                            <tr>
                                                                <th colspan="5">
                                                                    <center>
                                                                        <p id="text-counter">0 data terpilih</p>
                                                                        <button onclick="AccEmail()" class="btn btn-sm btn-success" id="btn-multiapprov" type="button" style="display:none;"><i class="fa fa-check"></i> Kirim Email</button>
                                                                        <br><br><button type="button" onclick="checkAll()" class="btn btn-info">Select All</button> <button type="button" onclick="uncheckAll()" class="btn btn-danger">Uncheck All</button>
                                                                    </center>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>No.Tiket</th>
                                                                <th>Pengguna</th>
                                                                <th>Kategori</th>
                                                                <th>Aksi</i></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($data as $val)
                                                            <?php
                                                            $user_tiket = $val->id_pengguna . '_' . $val->id_tiket;
                                                            $cek = !empty($val->id_tiket) ? getNoTiket($val->id_tiket) : null;
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <center>{{$loop->iteration}}</center>
                                                                </td>
                                                                <td>
                                                                    <center>{{$val->no_tiket}}</center>
                                                                </td>
                                                                <td>
                                                                    <center>{{$val->nama}}</center>
                                                                </td>
                                                                <td>
                                                                    <center>{{$val->kategori}}</center>
                                                                </td>
                                                                <td>
                                                                    @if(!empty($val->status_kuesioner) )
                                                                    <center><a href="{{route('admin.getDataViewKuesioner',$user_tiket)}}" title="View" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a></center>
                                                                    @else
                                                                    <center><input type='checkbox' name="approval[]" value="{{$val->id_tiket}}"></center>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.panel-->

                                </div>
                                <div class="col-sm-12">
                                    <p class="back-link">Badan <a href="https://sigesit.big.go.id/">Informasi</a> Geospasial</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
        <!--/.main-->

        @include('template.adminfooter')

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            var c = 0;
            $('input[type=checkbox]').change(function() {
                if ($(this).is(':checked')) {
                    c = c + 1;
                    $('#text-counter').html(c + ' data terpilih');
                } else {
                    c = c - 1;
                    $('#text-counter').html(c + ' data terpilih');
                }
                if (c > 0) {
                    $('#button-submit').fadeIn();
                    $('#text-ket').fadeIn();
                    $('#btn-multiapprov').fadeIn();
                } else {
                    $('#button-submit').fadeOut();
                    $('#text-ket').fadeOut();
                    $('#btn-multiapprov').fadeOut();
                }
            });

            flatpickr("#tanggal_range", {
                mode: "range",
                dateFormat: "Y-m-d"
            });

            function konfirmExport() {
                var tanggal_range = $('#tanggal_range').val();

                if (tanggal_range == '') {
                    Swal.fire({
                        type: 'error',
                        text: "Periode Tidak Boleh Kosong",
                    });
                } else {
                    document.getElementById("formfilter").submit();
                }
            }

            function AccEmail() {
                Swal.fire({
                    title: 'Apakah Anda Yakin<br>email akan segera di kirim<hr>',
                    type: 'question',
                    showCancelButton: true,
                    cancelButtonText: "Tidak",
                    confirmButtonText: "Ya",
                    width: '30%'
                }).then(function(result) {
                    if (result.value) {
                        document.getElementById("form-multiapprov").submit();
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

            function checkAll() {
                $("#checkAll").click(function() {
                    $('input:checkbox').not(this).prop('checked', this.checked);

                });
            }

            function checkAll() {
                var arrApprov = document.getElementsByName("approval[]");
                var len = arrApprov.length;
                for (var i = 0; i < len; i++) {
                    if (!arrApprov[i].checked) {
                        arrApprov[i].checked = true;
                        c++;
                    }
                }
                if (c > 0) {
                    $('#button-submit').fadeIn();
                    $('#text-ket').fadeIn();
                    $('#btn-multiapprov').fadeIn();
                }
                $('#text-counter').html(c + ' data terpilih');
            }

            function uncheckAll() {
                var arrApprov = document.getElementsByName("approval[]");
                var len = arrApprov.length;
                for (var i = 0; i < len; i++) {
                    if (arrApprov[i].checked) {
                        arrApprov[i].checked = false;
                        c--;
                    }
                }
                $('#text-counter').html(c + ' data terpilih');
                if (c < 1) {
                    $('#button-submit').fadeOut();
                    $('#text-ket').fadeOut();
                    $('#btn-multiapprov').fadeOut();
                }
            }

            function approvmultidata() {
                $('#modalMultiApprov').modal('show');
            }

            function play(no_tiket) {

                var x = document.getElementById(no_tiket);
                x.play();

            }
        </script>
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
                    language: {
                        'paginate': {
                            'previous': '<span><</span>',
                            'next': '<span>></span>'
                        }
                    }
                });
                // $('#users-table-jasa').DataTable({
                //     processing: true,
                //     serverSide: true,
                //     ajax: "{{ route('admin.datatables.get.belom.kuisioner') }}",
                //     columns: [{
                //             data: 'check',
                //             name: 'check'
                //         },
                //         {
                //             data: 'DT_RowIndex',
                //             name: 'DT_RowIndex'
                //         },
                //         {
                //             data: 'no_tiket',
                //             name: 'no_tiket',
                //             orderable: false
                //         },
                //         {
                //             data: 'nama',
                //             name: 'nama'
                //         },
                //         {
                //             data: 'kategori',
                //             name: 'kategori'
                //         },

                //     ],
                //     language: {
                //         'paginate': {
                //             'previous': '<span><</span>',
                //             'next': '<span>></span>'
                //         }
                //     }
                // });
            });
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