<!DOCTYPE html>
<html lang="en">
  @include('template.penggunaheader')

  <style type="text/css">
    @media print {
      body * {
        visibility: hidden;
      }
      #section-to-print, #section-to-print * {
        visibility: visible;
      }
      #section-to-print {
        position: absolute;
        left: 0;
        top: 0;
      }
    }

    .container2 {
      border-radius: 5px;
      padding: 10px;
      margin: 10px 0;
    }

    .blue {
      border: 2px solid #dedede;
      background-color: #f1f1f1;
      margin-left:20%;
    }

    .darker {
      border-color: #3db3e530;
      background-color: #e1ecf1;
      margin-right:20%;
    }

    .container2::after {
      content: "";
      clear: both;
      display: table;
    }

    .container2 img {
      float: left;
      max-width: 60px;
      width: 100%;
      margin-right: 20px;
      border-radius: 50%;
    }

    .container2 img.right {
      float: right;
      margin-left: 20px;
      margin-right:0;
    }

    .time-right {
      float: right;
      color: #aaa;
    }

    .time-left {
      float: left;
      color: #999;
    }
  </style>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
        <div class="container">
          <a class="navbar-brand" href="{{route('home')}}">Badan<span>Informasi</span>Geospasial
            <img src="{{url('assets/digilab/images/ico.png')}}" alt="" style="max-height: 30px; max-width:30px"></a>
          <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
          </button>
        </div>
    </nav>

  <div id="section-to-print">
    <section class="ftco-section ftco-no-pb" id="layanandigital-section">
      @foreach($tiketlayananjasa as $tlj)
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 heading-section text-center ftco-animate">
            <p>{{ Auth::guard('pengguna')->user()->nama }}</p>
            <h3>{{ $tlj->no_tiket }}{{ $tlj->kode }}</h3>
            <span>{{ hari_indo($tlj->tanggal).', '.tgl_indo($tlj->tanggal) }}</span>
            @if ($tlj->kategori == 'jasa')
                <center>
                @if ($tlj->id_master_layananjasa == 13 || $tlj->id_master_layananjasa == 14)
                    <span> IG Nol Rupiah / {{ $tlj->nama_layanan_jasa }}</span>
                @else
                    <span> Layanan Jasa  / {{ $tlj->nama_layanan_jasa }}</span>
                @endif
                </center>
            @else
                @if($tlj->kategori == 'produk')
                  <center><span> Berbayar / Peta</span></center>
                @elseif($tlj->kategori == 'pasut')
                  <center><span> Berbayar / Pasang Surut</span></center>
                @endif
            @endif

            @if($tlj->status == 1)
                <span> OPEN</span>
            @elseif($tlj->status == 2)
                <span> CLOSED</span>
            @elseif($tlj->status == 3)
                <span> MENUNGGU VERIFIKASI</span>
            @elseif($tlj->status == 4)
                <span> DI TOLAK</span>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </section>

    <hr>

    <section class="ftco-section contact-section ftco-no-pt ftco-no-pb" id="contact-section-jasa">
      <div class="container">
        <div class="row no-gutters block-9">

              <div class="col-md-2">
              </div>
              <div class="col-md-8">
                    
                  <div id="result">
                  <div class="container2">
                        <form action="#" class="bg-light p-5 contact-form">
                          <div class="form-group">
                            <textarea name="pesan" id="pesan" cols="30" rows="2" class="form-control" placeholder="Pesan Anda"></textarea>
                            <input type="hidden" name="kategori" id="kategori" value="{{ $tiket }}">
                            <input type="hidden" name="id_terkait" id="id_terkait" value="{{ $id }}">
                          </div>
                          <div class="form-group" align="right">
                            <a class="btn btn-danger py-2 px-4" href="{{ route('pengguna.tiket') }}">Kembali</a>
                            <a id="kirimpesan" class="btn btn-primary py-2 px-4">Kirim</a>
                          </div>
                        </form>
                    </div>

                    <div class="heading-section text-center ftco-animate">
                     <p>Recently Chat From Bottom to Top</p>
                    </div>
                    

                    <div id="divmuncul">
                    </div>

                      

                  </div>

              </div>
              <div class="col-md-2">
              </div>

        </div><br><hr><br>
      </div>
    </section>
  </div>

    @include('template.penggunafooter')

    <script type="text/javascript">
      $(document).ready(function(){

              var kategori = $('#kategori').val();
              var id_terkait = $('#id_terkait').val();
              var drnp = kategori + " - " + id_terkait;
              var urlf = '{{route("pengguna.tiket.kirim.pesan",":param")}}';
              urlf = urlf.replace(':param', drnp);

              $.get(urlf,function(data){
                    $('#divmuncul').html(data);
                })


          $("#kirimpesan").click(function() {
              var pesan = $('#pesan').val();
              pesan = pesan.replace(/\s+/g, '&').toLowerCase();
              var drnp = kategori + " - " + id_terkait + " - " + pesan;
              var urlf = '{{route("pengguna.tiket.kirim.pesanbaru",":param")}}';
              urlf = urlf.replace(':param', drnp);

              $.get(urlf,function(data){
                    var pesan = $('#pesan').val('');
                    $('#divmuncul').html(data);
              })

          });

      });
    </script>
    
  </body>
</html>
