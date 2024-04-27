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
                <li class="active">Tiket</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tiket</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Tiket</div>
                    <div class="panel-body">
                        <form action="{{route('admin.export.tiket')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="col-sm-4">
                                <label for="">Tanggal</label>
                                <input type="text" class="form-control filter_data" id="tanggal" name="tanggal">
                                <br>
                                <label for="">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control filter_data">
                                    <option value="">---Pilih Kategori---</option>
                                    <option value="Layanan Jasa">Layanan Jasa</option>
                                    <option value="IG Nol Rupiah">IG Nol Rupiah</option>
                                    <option value="Berbayar">Berbayar</option>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-success">EXPORT</button>
                            </div>
                        </form>
                        <br>
                        <div class="col-md-12 pt-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="users-table-jasa" width="100%">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No.Tiket</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Kategori</th>
                                            <th>Sub Kategori</th>
                                            <th>Pengguna</th>
                                            <th>Status</th>
                                            <th>Pengisian kuesioner</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
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
        <!--/.main-->

        @include('template.adminfooter')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr("#tanggal", {
                mode: "range",
                dateFormat: "Y-m-d"
            });

            function play(no_tiket) {

                var x = document.getElementById(no_tiket);
                x.play();

            }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                var kategori = $('#kategori').val();
                $('#users-table-jasa').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        url: "{{ route('admin.getdataalltiket') }}",
                        data: function(data) {
                            data.tanggal = $('#tanggal').val();
                            data.filter_kat = $('#kategori').val();
                        }
                    },
                    columns: [{
                            data: 'no_tiket',
                            name: 'no_tiket',
                            orderable: false
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'mulai',
                            name: 'mulai'
                        },
                        {
                            data: 'kategori-awal',
                            name: 'kategori-awal'
                        },
                        {
                            data: 'subkategori',
                            name: 'subkategori'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'kuesioner',
                            name: 'kuesioner'
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

                $('.filter_data').on("change", function() {
                    var tanggal = $('#tanggal').val();
                    console.log(tanggal);
                    if (tanggal.includes('to') || tanggal == '') {
                        $('#users-table-jasa').DataTable().ajax.reload();
                    }
                });
                //ini diganti tiap form
                $("#tiketlayananjasa").addClass("active");

                $("#dashboard").removeClass("active");

            });
        </script>
        <script>

        </script>
        <script type="text/javascript">
            function lihat(no_tiket, tanggal, mulai, selesai, nama, nama_layanan_jasa, created_at, updated_at) {
                var ico = '{{url("assets/digilab/images/ico.png")}}';
                Swal.fire({
                    title: 'BADAN INFORMASI <br> GEOSPASIAL',
                    html: '<div style="text-align:left;">' +
                        '<br><font size="2">' +
                        '<div class="col-md-12">' +
                        '<table>' +
                        '<tbody>' +
                        '<col width="100">' +
                        '<col width="20">' +
                        '<col width="100">' +
                        '<col width="100">' +
                        '<tr>' +
                        '<td>Hari/Tanggal</td>' +
                        '<td>:</td>' +
                        '<td colspan="2">' + tanggal + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Nama</td>' +
                        '<td>:</td>' +
                        '<td colspan="2">' + nama + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Waktu</td>' +
                        '<td>:</td>' +
                        '<td colspan="2">(' + mulai + '-' + selesai + ')</td>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '<hr>' +
                        '<table style="width: 100%; border: 1px solid black; ">' +
                        '<tbody>' +
                        '<tr rowspan="2">' +
                        '<th colspan="2" style="width:50%;border-right: 1px solid black;"><center>No. Tiket :<br>' + no_tiket + '</center></th>' +
                        '<th colspan="2"><center>Layanan Jasa : <br>' + nama_layanan_jasa + '</center></th>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '<br>' +
                        '<br>' +
                        '<table style="width: 100%;">' +
                        '<tbody>' +
                        '<tr>' +
                        '<th colspan="3"></th>' +
                        '<th><center>Waktu Dibuat :<br>' + created_at + '<br><br><br>Waktu Selesai :<br>' + updated_at + '</center></th>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table><hr>' +
                        '</div>' +
                        '</font>' +
                        '</div>',
                    imageUrl: ico,
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Custom image',
                    animation: true,
                    width: 450,
                    imageAlt: 'Tidak Ada Gambar'
                })
            }

            function tutup(id, no_tiket, tanggal, mulai, selesai, nama, nama_layanan_diklat, created_at, updated_at) {
                var ico = '{{url("assets/digilab/images/ico.png")}}';
                Swal.fire({
                    title: '<font style="color:orange">Tutup Tiket ' + no_tiket + '</font>',
                    html: '<div style="text-align:left;">' +
                        '<br><font size="2">' +
                        '<div class="col-md-12">' +
                        '<table>' +
                        '<tbody>' +
                        '<col width="100">' +
                        '<col width="20">' +
                        '<col width="100">' +
                        '<col width="100">' +
                        '<tr>' +
                        '<td>Hari/Tanggal</td>' +
                        '<td>:</td>' +
                        '<td colspan="2">' + tanggal + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Nama</td>' +
                        '<td>:</td>' +
                        '<td colspan="2">' + nama + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Waktu</td>' +
                        '<td>:</td>' +
                        '<td colspan="2">(' + mulai + ')</td>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '<hr>' +
                        '<table style="width: 100%; border: 1px solid black; ">' +
                        '<tbody>' +
                        '<tr rowspan="2">' +
                        '<th colspan="2" style="width:50%;border-right: 1px solid black;"><center>No. Tiket :<br>' + no_tiket + '</center></th>' +
                        '<th colspan="2"><center>Layanan Jasa : <br>' + nama_layanan_diklat + '</center></th>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '<br>' +
                        '<br>' +
                        '<table style="width: 100%;">' +
                        '<tbody>' +
                        '<tr>' +
                        '<th colspan="3"></th>' +
                        '<th><center>Waktu Dibuat :<br>' + created_at + '<br><br><br>Waktu Selesai :<br>' + updated_at + '</center></th>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table><hr><center><font style="color:orange">Apakah Anda Yakin Selesaikan TIket ?</font></center>' +
                        '<form method="POST" name="formcloselayananjasa" action="{{ route("admin.tutuptiketlayananjasa") }}" role="form">@csrf<input name="id" type="hidden" value="' + id + '"></form>' +
                        '</div>' +
                        '</font>' +
                        '</div>',
                    imageUrl: ico,
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Custom image',
                    animation: true,
                    width: 450,
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
            }

            function edit(id) {
                var html = '<form method="POST" id="formeditmjl" action="{{ route("admin.update_status.layanan_jasa_nol") }}" enctype="multipart/form-data" role="form">' +
                    '@csrf' +
                    '<div class="form-group">' +
                    '<select name="status" id="status" class="form-control">' +
                    '<option value="1">Setujui</option>' +
                    '<option value="4">Tolak</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="form-group" id="div_tolak" style="display:none;">' +
                    '<label>Alasan</label>' +
                    '<input name="alasan_tolak" id="alasan_tolak" class="form-control" value="" required>' +
                    '<input type="hidden" name="id_data" class="form-control" value="' + id + '">' +
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
                var alasan = document.getElementById("alasan_tolak").required;
                $('#status').change(function() {
                    var value = $(this).val();
                    console.log(value)
                    if (value == 1) {
                        $('#div_tolak').hide();
                    } else if (value == 4) {

                        $('#div_tolak').show();
                    }
                });
            }

            function Catatan(alasan) {
                var html2 = '<center><label>' + alasan + '</label></center>';
                Swal.fire({
                    type: 'warning',
                    title: ' Di tolak',
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

            function LihatDetail(id) {
                // console.log(id)
                var html = '';
                html = '<div class="form-group">' +
                    '<table class="table table-bordered" id="detail_pasut">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Kategori</th>' +
                    '<th>Tahun</th>' +
                    '<th>Bulan</th>' +
                    '<th>Harga</th>' +
                    '<th>Jumlah</th>' +
                    '<th>Total</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody id="body_detail">' +
                    '</tbody>' +
                    '</table>' +
                    '</div>';
                $.ajax({
                    type: "GET",
                    dataType: "html",
                    url: "{{ url('/admin/tiket-pasang-surut/get-detail-pasut').'/' }}" + id,
                    success: function(res) {
                        var detail = '';
                        var parse = JSON.parse(res);
                        $.each(parse, function(index, value) {
                            var total = value.total.toString().split('').reverse().join('').match(/\d{1,3}/g).join('.').split('').reverse().join('');

                            detail += '<tr id="tr_detail">';

                            detail += '<td>' + value.nama_kategori + '</td>';
                            detail += '<td>' + value.tahun + '</td>';
                            if (value.bulan != null) {
                                detail += '<td>' + value.bulan + '</td>';
                            } else {
                                detail += '<td></td>';
                            }
                            detail += '<td>' + value.harga_satuan + '</td>';
                            detail += '<td>' + value.jumlah + '</td>';
                            detail += '<td>' + total + '</td>';

                            detail += '</tr>';
                        });
                        $('#body_detail').html(detail)
                    }
                });

                Swal.fire({
                    title: 'Detail Data<br><hr>',
                    type: 'warning',
                    html: html,
                    showCancelButton: true,
                    width: '50%'
                }).then(function(result) {
                    if (result.value) {
                        document.getElementById("formedittentang").submit();
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
        @if(Session::has('success'))
        <script type="text/javascript">
            Swal.fire({
                type: 'success',
                text: '{{Session::get("success")}}',
                showConfirmButton: true
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
                showConfirmButton: true
            });
        </script>
        <?php
        Session::forget('error');
        ?>
        @endif

</body>

</html>