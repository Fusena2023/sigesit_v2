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
                <li class="active">Tiket Layanan Diklat</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Layanan Diklat</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Tiket Layanan Diklat</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped" id="users-table-diklat">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Diklat</th>
                                        <th>No.Tiket</th>
                                        <th>Instansi</th>
                                        <th>Kode Transaksi</th>
                                        <th>NPWP / NTPN</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                            </table>
                            <br>
                            <br>
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
        <script>
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

                $('#kode_transaksi').change(function() {
                    var kode_transaksi = $(this).val();
                    $.ajax({
                        type: "GET",
                        dataType: "JSON",
                        url: "{{ url('admin/get-detail-biling').'/' }}" + kode_transaksi,
                        success: function(res) {
                            $('#nama_diklat').text(res.nama_diklat)
                            $('#instansi').text(res.instansi)
                            $('#nominal').text(res.nominal)
                            $('#npwp').text(res.npwp)
                        }
                    });
                });

            });

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
        <script>
            $(function() {
                $('#users-table-diklat').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.datatables.getdatatiketlayanandiklat.admin') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nama_diklat',
                            name: 'nama_diklat'
                        },
                        {
                            data: 'no_tiket',
                            name: 'no_tiket'
                        },
                        {
                            data: 'instansi',
                            name: 'instansi'
                        },
                        {
                            data: 'kode_transaksi',
                            name: 'kode_transaksi'
                        },
                        {
                            data: 'npwp',
                            name: 'npwp'
                        },
                        {
                            data: 'nominal',
                            name: 'nominal'
                        },
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