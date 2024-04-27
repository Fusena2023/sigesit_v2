<!DOCTYPE html>
<html lang="en">
@include('template.penggunaheader')

<style type="text/css">
  .nav-item {
    border-width: 2px;
    border-style: outset;
    border-radius: 40px;
  }

  .notification {
    text-decoration: none;
    position: relative;
    display: inline-block;
  }

  .notification .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    padding: 5px 10px;
    border-radius: 50%;
    background: #ff303a;
    color: white;
  }

  .bg-img {
    background-image: url(../assets/digilab/images/BG1-1.png);
    position: relative;
    background-color: #63c4f194;
    padding-bottom: 0px;
    background-size: cover;
  }
</style>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  @include('template.penggunanavbarfaq')

  <section class="ftco-section ftco-no-pb bg-img" id="layanandigital-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 heading-section text-center ftco-animate pb-3 pt-5">
          <h2 class="mb-4 text-navy">Tiket Anda</h2>
          <p>List Tiket Dari Layanan - Layanan Pelayanan Terpadu Inforrmasi Geospasial</p>
        </div>
      </div>
      <div class="row" style="display: none;">
        <div class="col-md-6 col-lg-4 ftco-animate">
          <div class="staff">
            <div class="img-wrap d-flex align-items-stretch">
              <div class="img align-self-stretch" style="background-color: navy">
                <center>
                  <img src="{{url('upload/consulting.png')}}" style="width: 100px; margin: 25px" alt="">
                </center>
              </div>
            </div>
            <div class="text d-flex align-items-center pt-3 text-center">
              <div>
                <span class="position mb-4"><a id="layananjasa" href="#">Layanan Jasa</a></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 ftco-animate">
          <div class="staff">
            <div class="img-wrap d-flex align-items-stretch">
              <div class="img align-self-stretch" style="background-color: navy">
                <center>
                  <img src="{{url('upload/gadget.png')}}" style="width: 100px; margin: 25px" alt="">
                </center>
              </div>
            </div>
            <div class="text d-flex align-items-center pt-3 text-center">
              <div>
                <span class="position mb-4"><a id="layananproduk" href="#">Layanan Produk</a></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 ftco-animate">
          <div class="staff">
            <div class="img-wrap d-flex align-items-stretch">
              <div class="img align-self-stretch" style="background-color: navy">
                <center>
                  <img src="{{url('upload/teamwork.png')}}" style="width: 100px; margin: 25px" alt="">
                </center>
              </div>
            </div>
            <div class="text d-flex align-items-center pt-3 text-center">
              <div>
                <span class="position mb-4"><a id="layanankunjunganumum" href="#">Pasang Surut</a></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 ftco-animate" style="display:none;">
          <div class="staff">
            <div class="img-wrap d-flex align-items-stretch">
              <div class="img align-self-stretch" style="background-image: url('{{ Storage::url('public/'). $layanankunjunganumum }}');"></div>
            </div>
            <div class="text d-flex align-items-center pt-3 text-center">
              <div>
                <span class="position mb-4"><a id="layanankunjunganumum">Layanan Konsultasi Teknis dan Diklat</a></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="container-2" id="contact-section-jasa">
      <div class="row justify-content-center pb-4" style="display: none;">
        <div class="col-md-7 heading-section text-center ftco-animate fadeInUp ftco-animated">
          <span class="subheading text-navy"><b>Layanan Jasa</b></span>
        </div>
      </div>
      @php
      $cekjasa = checkKuesionerIsFilled('jasa');
      $cekjasa = !empty($cekjasa)?count((array)$cekjasa):0;
      @endphp
      @if($cekjasa > 0)
      <a onclick="alertKuesioner('Jasa')" class="btn btn-primary px-3 py-2">Buat Tiket</a>
      @else
      <a href="{{ route('home') }}" class="btn btn-primary px-3 py-2">Buat Tiket</a>
      @endif


      <div class="row no-gutters block-9">
        <div class="col-md-2">
          <p></p>
          <select name="filter-kategori" id="filter-kategori" class="form-control">
            <option value="">Semua</option>
            <option value="Layanan Jasa">Layanan Jasa</option>
            <option value="IG Nol Rupiah">IG Nol Rupiah</option>
            <option value="Berbayar">Berbayar</option>
          </select>
        </div>
        <div class="col-md-12 pt-3 pb-5">
          <table class="table table-bordered" id="users-table-all">
            <thead class="table-primary">
              <tr>
                <th>No.Tiket</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="container-2" id="contact-section-produk" style="display: none">
      <div class="row justify-content-center pb-4" style="display:none;">
        <div class="col-md-7 heading-section text-center ftco-animate fadeInUp ftco-animated">
          <span class="subheading text-navy"><b>Layanan Produk</b></span>
        </div>
      </div>
      @php
      $cekproduk = checkKuesionerIsFilled('produk');
      $cekproduk = !empty($cekproduk)?count((array)$cekproduk):0;
      @endphp
      @if($cekproduk > 0)
      <a onclick="alertKuesioner('Produk')" class="btn btn-primary px-3 py-2">Buat Tiket Layanan Produk</a>
      @else
      <a href="{{ route('home') }}" class="btn btn-primary px-3 py-2">Buat Tiket Layanan Produk</a>
      @endif
      <div class="row no-gutters block-9">
        <div class="col-md-12 pt-3 pb-5">
          <table class="table table-bordered" id="users-table-produk">
            <thead class="table-primary">
              <tr>
                <th>No.Tiket</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="container-2" id="contact-section-diklat" style="display: none;">
      <div class="row justify-content-center pb-4">
        <div class="col-md-7 heading-section text-center ftco-animate fadeInUp ftco-animated">
          <span class="subheading text-navy"><b>Layanan Diklat</b></span>
        </div>
      </div>
      <a href="{{ route('pengguna.tiketlayanandiklat') }}" class="btn btn-primary px-3 py-2">Buat Tiket Layanan Diklat</a>
      <div class="row no-gutters block-9">
        <div class="col-md-12 pt-3 pb-5">
          <table class="table table-bordered" id="users-table-diklat">
            <thead class="table-primary">
              <tr>
                <th>No.Tiket</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Kategori Layanan</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="container-2" id="contact-section-kunjunganumum" style="display: none;">
      <div class="row justify-content-center pb-4">
        <div class="col-md-7 heading-section text-center ftco-animate fadeInUp ftco-animated">
          <span class="subheading text-navy"><b>Layanan Pasang Surut</b></span>
        </div>
      </div>
      @php
      $cekumum = checkKuesionerIsFilled('pasut');
      $cekumum = !empty($cekumum)?count((array)$cekumum):0;
      @endphp
      @if($cekumum > 0)
      <a onclick="alertKuesioner('Pasang surut')" class="btn btn-primary px-3 py-2">Buat Tiket Layanan Pasang Surut</a>
      @else
      <a href="{{ route('pengguna.index.pasang_surut') }}" class="btn btn-primary px-3 py-2">Buat Tiket Layanan Pasang Surut</a>
      @endif

      <div class="row no-gutters block-9">
        <div class="col-md-12 pt-3 pb-5">
          <table class="table table-bordered" id="users-table-pasang-surut">
            <thead class="table-primary">
              <tr>
                <th>No.Tiket</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </section>

  @include('template.penggunafooter')
  <script>
    $(function() {
      var table = $('#users-table-all').DataTable({
        processing: true,
        serverSide: true,
        ajax: { 
          url: "{{ route('pengguna.datatables.getDatatiketall') }}",
          data: function(data) {
            data.filter_kat = $('#filter-kategori').val();
          }
        },
        columns: [{
            data: 'no_tiket',
            name: 'no_tiket'
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
            data: 'nominal',
            name: 'nominal'
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
      $('#filter-kategori').on("change", function() {

        $('#users-table-all').DataTable().ajax.reload();
        // Redraw the DataTable
      });
    });
  </script>
  <script>
    // $(function() {
    //   var jasa = $('#users-table-jasa').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "{{ route('pengguna.datatables.getdatatiketlayananjasa') }}",
    //     columns: [{
    //         data: 'no_tiket',
    //         name: 'no_tiket'
    //       },
    //       {
    //         data: 'tanggal',
    //         name: 'tanggal'
    //       },
    //       {
    //         data: 'mulai',
    //         name: 'mulai'
    //       },
    //       {
    //         data: 'nama_layanan_jasa',
    //         name: 'nama_layanan_jasa'
    //       },
    //       {
    //         data: 'status',
    //         name: 'status'
    //       },
    //       {
    //         data: 'action',
    //         name: 'action',
    //         orderable: false,
    //         searchable: false
    //       }
    //     ],
    //     language: {
    //             'paginate': {
    //                 'previous': '<span><</span>',
    //                 'next': '<span>></span>'
    //             }
    //         }
    //   });
    // });
  </script>
  <script>
    $(function() {
      var produk = $('#users-table-produk').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pengguna.datatables.getdatatiketlayananproduk') }}",
        columns: [{
            data: 'no_tiket',
            name: 'no_tiket'
          },
          {
            data: 'tanggal',
            name: 'tanggal'
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
  <script>
    $(function() {
      // var diklat = $('#users-table-diklat').DataTable({
      //   processing: true,
      //   serverSide: true,
      //   ajax: "{{ route('pengguna.datatables.getdatatiketlayanandiklat') }}",
      //   columns: [{
      //       data: 'no_tiket',
      //       name: 'no_tiket'
      //     },
      //     {
      //       data: 'tanggal',
      //       name: 'tanggal'
      //     },
      //     {
      //       data: 'mulai',
      //       name: 'mulai'
      //     },
      //     {
      //       data: 'nama_layanan_diklat',
      //       name: 'nama_layanan_diklat'
      //     },
      //     {
      //       data: 'action',
      //       name: 'action',
      //       orderable: false,
      //       searchable: false
      //     }
      //   ],
      //   language: {
      //           'paginate': {
      //               'previous': '<span><</span>',
      //               'next': '<span>></span>'
      //           }
      //       }
      // });
    });
  </script>
  <script>
    $(function() {
      var umum = $('#users-table-kunjunganumum').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pengguna.datatables.getdatatiketlayanankunjunganumum') }}",
        columns: [{
            data: 'no_tiket',
            name: 'no_tiket'
          },
          {
            data: 'tanggal',
            name: 'tanggal'
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
  <script>
    $(function() {
      var umum = $('#users-table-pasang-surut').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('datatables.get.pasut') }}",
        columns: [{
            data: 'no_tiket',
            name: 'no_tiket'
          },
          {
            data: 'tanggal',
            name: 'tanggal'
          },
          {
            data: 'nama_produk',
            name: 'nama_produk'
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
    $(document).ready(function() {

      $("#layananjasa").click(function() {
        $("#contact-section-jasa").css("display", "block");
        $("#contact-section-produk").css("display", "none");
        $("#contact-section-diklat").css("display", "none");
        $("#contact-section-kunjunganumum").css("display", "none");
      });

      $("#layananproduk").click(function() {
        $("#contact-section-produk").css("display", "block");
        $("#contact-section-jasa").css("display", "none");
        $("#contact-section-diklat").css("display", "none");
        $("#contact-section-kunjunganumum").css("display", "none");
      });
      $("#layanandiklat").click(function() {
        $("#contact-section-diklat").css("display", "block");
        $("#contact-section-produk").css("display", "none");
        $("#contact-section-jasa").css("display", "none");
        $("#contact-section-kunjunganumum").css("display", "none");
      });

      $("#layanankunjunganumum").click(function() {
        $("#contact-section-kunjunganumum").css("display", "block");
        $("#contact-section-produk").css("display", "none");
        $("#contact-section-diklat").css("display", "none");
        $("#contact-section-jasa").css("display", "none");
      });


    });



    function KuesionerKategori(layanan, id_tiket) {
      var html = '<form id="kategoriKuesioner" method="post" action="{{route("pengguna.kuesioner.index")}}" width="100%">' +
        '@csrf' +
        '<input type="hidden" name="layanan" value="' + layanan + '">' +
        '<input type="hidden" name="id_tiket" value="' + id_tiket + '">' +
        '<input type="radio" id="Online" name="kategori" value="online">' +
        '<label for="Online">&nbsp;ONLINE </label><br>' +
        '<input type="radio" id="Offline" name="kategori" value="offline">' +
        '<label for="Offline">&nbsp;OFFLINE </label><br>' +
        '</form>';
      Swal.fire({
        position: 'mid-end',
        title: '<h3><b>Anda Mendapat Layanan Secara...</b></h3>',
        html: html,
        showCancelButton: true,
        cancelButtonText: 'Batal',
      }).then(function(result) {
        if (result.value) {
          if ($('input:radio[name="kategori"]').is(':checked')) {
            document.getElementById("kategoriKuesioner").submit();
          } else {
            Swal.fire({
              type: 'error',
              text: "Must be Selected Online or Offline",
            });
          }
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
        url: "{{ url('tiket-pasang-surut/get-detail-pasut').'/' }}" + id,
        success: function(res) {
          var detail = '';
          var parse = JSON.parse(res)
          console.log(parse);
          $.each(parse, function(index, value) {
            console.log(value)

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
            detail += '<td>' + value.total + '</td>';

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

    function updateStatus(layanan, id) {
      $.ajax({
        url: '{{route("pengguna.updatestatuskuesioner")}}',
        type: 'post',
        data: {
          "_token": "{{ csrf_token() }}",
          "layanan": layanan,
          "id": id,
        },
        success: function(response) {
          if (response.status == 'success') {
            $('#users-table-jasa').DataTable().ajax.reload();
            $('#users-table-produk').DataTable().ajax.reload();
            $('#users-table-kunjunganumum').DataTable().ajax.reload();
          }
        }
      });
    }

    function alertKuesioner(layanan) {
      Swal.fire(
        'Informasi',
        'Harap Menyelesaikan Tiket dan Mengisi Kuesioner Terlebih Dahulu',
        'info'
      )
    }

    function LihatKeranjang(obj) {
      var item = JSON.parse(atob($(obj).data('item')));
      //console.log(item);
      var tot = 0;
      var html = '<table style="border-collapse: collapse;width=100%;"><tr style="border: 1px solid black;"><th style="border: 1px solid black;">No</th><th style="border: 1px solid black;">Nama Produk</th><th style="border: 1px solid black;">Jumlah</th><th style="border: 1px solid black;">Harga</th><th style="border: 1px solid black;">Total</th></tr>';
      $.each(item, function(i, val) {
        html += '<tr style="border: 1px solid black;">';
        html += '<td style="border: 1px solid black;">' + (i + 1) + '</td>';
        html += '<td style="border: 1px solid black;">' + val.nama_lembar + '</td>';
        html += '<td style="border: 1px solid black;">' + val.banyaknya + '</td>';
        html += '<td style="border: 1px solid black;">' + val.tarif + '</td>';
        html += '<td style="border: 1px solid black;">' + val.total + '</td>';
        html += '</tr>';
        tot += val.total;
      });
      html += '<tr style="border: 1px solid black;"><td style="border: 1px solid black;" colspan="4">Total</td><td style="border: 1px solid black;">' + tot + '</td></tr>';
      html += '</table>';

      Swal.fire({
        position: 'mid-end',
        title: 'Daftar Pembelian',
        html: html,
        showCancelButton: false,
      }).then(function(result) {

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