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
                <li class="active">Tiket Layanan Mes</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Layanan Mes</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Tiket Layanan Mes</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="users-table-mes">
                                <thead>
                                    <tr>
										<th>No</th>
										<th>No.Tiket</th>
										<th>Nama Diklat</th>
										<th>Kode Bayar</th>
										<th>Jumlah Peserta</th>
										<th>Total Bayar</th>
										<th>Keterangan</th>
										<th>NTPN</th>
										<th>Kode Biling</th>
										<th>Status</th>
										<th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                            <br>
                            <br>
                        </div>
                    </div>
                </div><!-- /.panel-->

                <div class="panel panel-default" style="">
                    <div class="panel-heading">Tambah Tiket Mes </div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <form method="POST" name="formsubmitmjl" action="{{ route('admin.simpan.mes') }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="form-group">
                                    <label>No Tiket</label>
                                    <input type="text" name="nomer_tiket" id="nomer_tiket" class="form-control" value="{{$end}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Kode Bayar</label>
                                    <select name="kode_bayar" id="kode_bayar" class="form-control" placeholder="Kode Biling" required>
                                        <option value="" style="display:none">--Pilih Kode Bayar--</option>
                                        @foreach($get_diklat as $val)
                                        <option value="{{ $val->id_bayar }}">{{ $val->id_bayar }}</option>
                                        @endforeach
                                    </select>
                                </div>
								<table width="100%">
									<tr>
										<th width="30%" style="vertical-align: top;">Nama Diklat</th>
										<td width="2%" style="vertical-align: top;"> : </td>
										<td id="nama_mes"></td>
										<input type="hidden" name="input_nama_mes" id="input_nama_mes">
									</tr>
									<tr>
										<th width="30%" style="vertical-align: top;">Jumlah Peserta</th>
										<td width="2%" style="vertical-align: top;"> : </td>
										<td id="jml_peserta"></td>
										<input type="hidden" name="input_jml_peserta" id="input_jml_peserta">
									</tr>
									<tr>
										<th width="30%" style="vertical-align: top;">Tarif Diklat</th>
										<td width="2%" style="vertical-align: top;"> : </td>
										<td id="tarif_mes"></td>
										<input type="hidden" name="input_tarif_mes" id="input_tarif_mes">
									</tr>
									<tr>
										<th width="30%" style="vertical-align: top;">Total Bayar</th>
										<td width="2%" style="vertical-align: top;"> : </td>
										<td id="total_bayar"></td>
										<input type="hidden" name="input_total_bayar" id="input_total_bayar">
									</tr>
									<tr>
										<th width="30%" style="vertical-align: top;">Keterangan</th>
										<td width="2%" style="vertical-align: top;"> : </td>
										<td id="keterangan"></td>
										<input type="hidden" name="input_keterangan" id="input_keterangan">
									</tr>
								</table>
                                <br>
                                <a onclick="submitmjlform()" type="submit" class="btn btn-primary">Simpan</a>
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

                $('#kode_bayar').change(function() {
                    var kode_bayar = $(this).val();
                    $.ajax({
                        type: "GET",
                        dataType: "JSON",
                        url: "{{ url('admin/get-detail-mes').'/' }}" + kode_bayar,
                        success: function(res) {
                            var tarif_mess = res.tarif_mess.toString().split('').reverse().join('').match(/\d{1,3}/g).join('.').split('').reverse().join('');
							var total_bayar = res.total_bayar.toString().split('').reverse().join('').match(/\d{1,3}/g).join('.').split('').reverse().join('');

							$('#nama_mes').text(res.id_diklat)
							$('#jml_peserta').text(res.jml_peserta)
							$('#tarif_mes').text('Rp. ' + tarif_mess)
							$('#total_bayar').text('Rp. ' + total_bayar)
							$('#keterangan').text(res.keterangan)

							$('#input_nama_mes').val(res.id_diklat)
							$('#input_jml_peserta').val(res.jml_peserta)
							$('#input_tarif_mes').val(res.tarif_mess)
							$('#input_total_bayar').val(res.total_bayar)
							$('#input_keterangan').val(res.keterangan)
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
                $('#users-table-mes').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.datatables.getdatatiketlayananmes') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
						{
							data: 'no_tiket',
							name: 'no_tiket'
						},
						{
							data: 'nama_diklat',
							name: 'nama_diklat'
						},
						{
							data: 'kode_bayar',
							name: 'kode_bayar'
						},
						{
							data: 'jumlah_peserta',
							name: 'jumlah_peserta'
						},
						{
							data: 'total_bayar',
							name: 'total_bayar'
						},
						{
							data: 'keterangan',
							name: 'keterangan'
						},
						{
							data: 'ntpn',
							name: 'ntpn'
						},
						{
							data: 'kode_billing',
							name: 'kode_billing'
						},
						{
							data: 'status',
							name: 'status'
						},
						{
							data: 'action',
							name: 'action'
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