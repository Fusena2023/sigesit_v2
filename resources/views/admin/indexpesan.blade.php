<!DOCTYPE html>
<html lang="en">
@include('template.penggunaheader')

{{-- <link rel="stylesheet" type="text/css" href="{{url('logincss/css/main.css')}}"> --}}

<style type="text/css">
  @media print {
    body * {
      visibility: hidden;
    }

    #section-to-print,
    #section-to-print * {
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
    margin-left: 20%;
  }

  .darker {
    border-color: #3db3e530;
    background-color: #e1ecf1;
    margin-right: 20%;
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
    margin-right: 0;
  }

  .time-right {
    float: right;
    color: #aaa;
  }

  .time-left {
    float: left;
    color: #999;
  }

  .container-login100-form-btn {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
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
            <p>{{ Auth::guard('internal')->user()->nama }}</p>
            <h3>{{ $tlj->no_tiket }}{{ $tlj->kode }}</h3>
            <p>{{ date("D d M Y ",strtotime($tlj->tanggal)) }}</p>
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
                    @if($validasi_pesan)
                      @if($validasi_pesan->status == 1)
                      <textarea name="pesan" id="pesan" cols="30" rows="2" class="form-control" placeholder="Pesan Anda"></textarea>
                      @endif
                    @endif
                    <input type="hidden" name="kategori" id="kategori" value="{{ $tiket }}">
                    <input type="hidden" name="id_terkait" id="id_terkait" value="{{ $id }}">
                  </div>

                  @if($validasi_pesan)
                    @if($validasi_pesan->status == 1)
                    <div class="form-group" align="right">
                      <a class="btn btn-danger py-2 px-4" href="{{ route('admin.tiketlayananjasa') }}">Kembali</a>
                      <a id="kirimpesan" class="btn btn-primary py-2 px-4">Kirim</a>
                    </div>
                    @endif
                  @endif
                </form>
              </div>

              <div class="heading-section text-center ftco-animate">
                <p>Recently Chat From Bottom to Top</p>
              </div>

              <div id="divmuncul">
              </div>

              @if($validasi_pesan)
                @if($validasi_pesan->status != 1)
                <div class="container-login100-form-btn">
                  <a class="btn btn-primary py-2 px-4" href="{{ route('admin.tiketlayananjasa') }}">Kembali</a>
                </div>
                @endif
              @endif

            </div>

          </div>
          <div class="col-md-2">
          </div>

        </div><br>
        <hr><br>
      </div>
    </section>
  </div>

  @include('template.penggunafooter')

  <script type="text/javascript">
    $(document).ready(function() {

      var kategori = $('#kategori').val();
      var id_terkait = $('#id_terkait').val();
      var drnp = kategori + " - " + id_terkait;
      var urlf = '{{route("admin.tiket.kirim.pesan",":param")}}';
      urlf = urlf.replace(':param', drnp);

      $.get(urlf, function(data) {
        $('#divmuncul').html(data);
      })


      $("#kirimpesan").click(function() {
        var pesan = $('#pesan').val();
        pesan = pesan.replace(/\s+/g, '&').toLowerCase();
        var drnp = kategori + " - " + id_terkait + " - " + pesan;
        var urlf = '{{route("admin.tiket.kirim.pesanbaru",":param")}}';
        urlf = urlf.replace(':param', drnp);

        $.get(urlf, function(data) {
          var pesan = $('#pesan').val('');
          $('#divmuncul').html(data);
        })

      });

    });
  </script>

</body>

</html>