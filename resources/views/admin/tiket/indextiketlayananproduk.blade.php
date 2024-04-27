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
        <li class="active">Tiket Layanan Produk</li>
      </ol>
    </div>
    <!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Layanan Produk</h1>
      </div>
    </div>
    <!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Tiket Layanan Produk</div>
          <div class="panel-body">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered table-responsive" id="users-table-produk" width="100%">
                  <thead class="table-primary">
                    <tr>
                      <th>No.Tiket</th>
                      <th>Tanggal</th>
                      <th>Pengguna</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <!-- modal tolak -->
              <div class="modal fade" id="modaltolak" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog bd-example-modal-sm" role="document" style="width:1200px">
                  <div class="modal-content" style="color:#1a1a1a;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tolak Uji Kompetensi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form class="form-horizontal" method="post" action="">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" style="background:#d0cdcd; color:black;" id="idnyabuattolak" name="idnyabuattolak">
                        <input type="hidden" name="tolak_peserta[]" id="tolak_peserta">
                        <div class="form-group">
                          <label for="staticEmail" class="col-sm-1 col-form-label">Alasan</label>
                          <div class="col-sm-2">
                            <textarea name="alasan_tolak" id="alasan_tolak" cols="50" rows="10"></textarea>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    </form>
                  </div>
                </div>
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
    <script type="text/javascript">
      $(document).ready(function() {

        //ini diganti tiap form
        $("#tiket").addClass("active");

        $("#dashboard").removeClass("active");

      });
    </script>
    <script>
      $(function() {
        $('#users-table-produk').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('admin.datatables.getdatatiketlayananproduk') }}",
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
              data: 'nama',
              name: 'nama'
            },
            {
              data: 'status',
              name: 'status'
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
      function tutup(id, no_tiket, tanggal, mulai, selesai, nama, created_at, updated_at) {
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
            '</tbody>' +
            '</table>' +
            '<hr>' +
            '<table style="width: 100%; border: 1px solid black; ">' +
            '<tbody>' +
            '<tr rowspan="2">' +
            '<th colspan="2" style="width:50%;border-right: 1px solid black;"><center>No. Tiket :<br>' + no_tiket + '</center></th>' +
            '<th colspan="2"><center>Layanan Produk : <br>Peta</center></th>' +
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

     function lihat(no_tiket, tanggal, mulai, selesai, nama, created_at, updated_at) {
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
                        '</tbody>' +
                        '</table>' +
                        '<hr>' +
                        '<table style="width: 100%; border: 1px solid black; ">' +
                        '<tbody>' +
                        '<tr rowspan="2">' +
                        '<th colspan="2" style="width:50%;border-right: 1px solid black;"><center>No. Tiket :<br>' + no_tiket + '</center></th>' +
                        '<th colspan="2"><center>Layanan Produk : <br> Peta</center></th>' +
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

      function edit(id) {
        var html = '<form method="POST" id="formeditmjl" action="{{ route("admin.update_status.layanan_jasa_nol") }}" enctype="multipart/form-data" role="form">' +
          '@csrf' +
          '<div class="form-group">' +
          '<label>Alasan</label>' +
          '<input name="alasan_tolak" class="form-control" value="" required>' +
          '<input type="hidden" name="id_data" class="form-control" value="' + id + '">' +
          '</div>' +
          '<div class="form-group">' +
          '<select name="status" id="status" class="form-control">' +
          '<option value="1">Setujui</option>' +
          '<option value="4">Tolak</option>' +
          '</select>' +
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

</body>

</html>