<!DOCTYPE html>
<html lang="en">
  @include('template.penggunaheader')

  <style type="text/css">
  .nav-item{
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
          <div class="col-md-8 heading-section text-center ftco-animate pt-5">
            <h2 class="mb-4 text-navy">Pesan Anda</h2>
            <p>Pesan Anda Kepada Admin Pelayanan Terpadu Inforrmasi Geospasial.<br> Anda Dapat Mengirimkan Pertanyaan Dalam Bentuk Pesan Kepada Admin PTIG BIG Terkait Informasi Geospasial Tanpa Membuat Tiket Pada Layanan - Layanan Pelayanan Terpadu Inforrmasi Geospasial.</p>
          </div>
        </div>
      </div>
      <hr>
      <div class="container-2" id="contact-section-jasa">
        <div class="row justify-content-center pb-4">
          <div class="col-md-7 heading-section text-center ftco-animate fadeInUp ftco-animated">
            <span class="subheading text-navy">Pesan Percakapan Anda</span>
          </div>
        </div>
        <a href="{{ route('pengguna.pesanxtiket.add') }}" class="btn btn-primary px-3 py-2">Buat Pesan Percakapan Baru</a>
        <div class="row no-gutters block-9">
          <div class="col-md-12 pt-5 pb-5">
                <table class="table table-bordered" id="users-table-jasa">
                    <thead class="table-primary">
                        <tr>
                            <th>Nomor Pesan</th>
                            <th>Tanggal</th>
                            <th>Perihal</th>
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
          $('#users-table-jasa').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('pengguna.datatables.getdatapesanxtiket') }}",
              columns: [
                  { data: 'kode', name: 'kode' },
                  { data: 'tanggal', name: 'tanggal' },
                  { data: 'perihal', name: 'perihal' },
                  { data: 'action', name: 'action', orderable: false, searchable: false}
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
          $('#users-table-produk').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('pengguna.datatables.getdatatiketlayananproduk') }}",
              columns: [
                  { data: 'no_tiket', name: 'no_tiket' },
                  { data: 'tanggal', name: 'tanggal' },
                  { data: 'action', name: 'action', orderable: false, searchable: false}
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
          $('#users-table-diklat').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('pengguna.datatables.getdatatiketlayanandiklat') }}",
              columns: [
                  { data: 'no_tiket', name: 'no_tiket' },
                  { data: 'tanggal', name: 'tanggal' },
                  { data: 'mulai', name: 'mulai' },
                  { data: 'nama_layanan_diklat', name: 'nama_layanan_diklat' },
                  { data: 'action', name: 'action', orderable: false, searchable: false}
              ]
          });
      });
    </script>
    <script>
      $(function() {
          $('#users-table-kunjunganumum').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('pengguna.datatables.getdatatiketlayanankunjunganumum') }}",
              columns: [
                  { data: 'no_tiket', name: 'no_tiket' },
                  { data: 'tanggal', name: 'tanggal' },
                  { data: 'action', name: 'action', orderable: false, searchable: false}
              ]
          });
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){


        $("#layananjasa").click(function(){
          $("#contact-section-jasa").css("display", "block");
          $("#contact-section-produk").css("display", "none");
          $("#contact-section-diklat").css("display", "none");
          $("#contact-section-kunjunganumum").css("display", "none");
        });

        $("#layananproduk").click(function(){
          $("#contact-section-produk").css("display", "block");
          $("#contact-section-jasa").css("display", "none");
          $("#contact-section-diklat").css("display", "none");
          $("#contact-section-kunjunganumum").css("display", "none");
        });
        $("#layanandiklat").click(function(){
          $("#contact-section-diklat").css("display", "block");
          $("#contact-section-produk").css("display", "none");
          $("#contact-section-jasa").css("display", "none");
          $("#contact-section-kunjunganumum").css("display", "none");
        });

        $("#layanankunjunganumum").click(function(){
          $("#contact-section-kunjunganumum").css("display", "block");
          $("#contact-section-produk").css("display", "none");
          $("#contact-section-diklat").css("display", "none");
          $("#contact-section-jasa").css("display", "none");
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
