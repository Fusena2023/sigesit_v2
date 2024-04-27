<!DOCTYPE html>
<html lang="en">
@include('template.penggunaheader')
<style type="text/css">
  .icons {
    width: 110px;
    /* height: 70px; */
    border: 2px solid white;
    border-radius: 50%;
    text-align: center;
    line-height: 70px;
    font-size: 20px;
    margin: 0 auto;
    margin-top: -35px;
    background: #100674;
  }

  .bg-img {
    background-image: url(../assets/digilab/images/BG1-1.png);
    position: relative;
    background-color: #63c4f194;
    padding-bottom: 0px;
    background-size: cover;
  }

  .nav-item {
    border-width: 2px;
    border-style: outset;
    border-radius: 40px;
  }

  .modal-content {
    background: white;
    width: 100%;
    /* height: 200px; */
    border-radius: 30px;
  }

  .modal-header {
    padding: 2px 16px;
    background-color: #fff;
    color: white;
    /* height: 174px; */
    /* height: 4rem; */
    border-radius: 30px;
    background: #a7ddff;
    box-shadow: rgb(16 6 116 / 50%) 5px 5px 8px;
  }

  h5 {
    color: white;
  }

  #btn-back-to-top {
    position: fixed;
    bottom: 20px;
    right: 90px;
    display: none;
    height: 58px;
    background: transparent;
    border-color: #1378b7;
    background: #100674;
    z-index: 1;
  }
  .card {
    background-color: rgb(255,255,255, 0.9);
  }
  
</style>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  @include('template.penggunanavbar')

  <section class="ftco-section bg-img" id="testimony-section">
    <div class="container">
      <div class="row justify-content-center pb-3">
        <div class="col-md-7 text-center ftco-animate pt-5 pb-5">
          <h1 class="text-blue"><b>BEBERAPA PERTANYAAN ANDA</b></h1>
          {{-- <img src="{{ url('/assets/digilab/images/big2-18.png')}}" class="img-fluid" alt="Colorlib Template"> --}}
        </div>
      </div>
      <!-- <div class="row ftco-animate justify-content-center">
        <div class="col-md-12">
          <div class="carousel-testimony owl-carousel ftco-owl">
            @foreach($masterfaq as $mf)
            <div class="item">
              <div class="testimony-wrap text-center py-4 pb-5">
                <div class="user-img" style="background-image: url(../assets/digilab/images/person.jpg)">
                  <span class="quote d-flex align-items-center justify-content-center">
                    <i class="icon-question"></i>
                  </span>
                </div>
                <div class="text px-4 pb-5">
                  <p class="mb-4">{{ $mf->pertanyaan }}</p>
                  <p class="ml-auto mb-0"><a onclick="lihat('{{$mf->pertanyaan}}','{{$mf->jawaban}}')" class="btn btn-primary"> Baca Selengkapnya <span class="ion-ios-arrow-round-forward"></span></a></p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div> -->
      <form action="{{route('homefaqfilter')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-sm-6">
            <input type="text" class="form-control" id="filter" name="filter" value="@isset($filter){{ $filter }}@endisset">
          </div>

          <div class="col-sm-6">
            <button type="submit" class="btn btn-info">CARI</button>
          </div>

        </div>
      </form>
      <br><br>
      <div class="accordion" id="accordionExample">

        @foreach($masterfaq as $mf)
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne_{{$mf->id}}" aria-expanded="true" aria-controls="collapseOne">
                {{$mf->pertanyaan }}
              </button>
            </h2>
          </div>

          <div id="collapseOne_{{$mf->id}}" class="collapse @isset($filter){{ $show }}@endisset" aria-labelledby="headingOne" data-parent="#accordionExample" style="padding: 0 10px 0 10px">
            <div class="card-body">
              {{$mf->jawaban}}
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- <div class="row">
        <div class="col-12">
          <div class="row">
            @foreach($masterfaq as $mf)
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 pb-5">
              <div class="card" style="background: #56bbf1; height: 300px; border-radius: 30px; box-shadow: rgb(0 0 0 / 50%) 5px 5px 8px;">
                <div class="icons p-3">
                  <span><img src="{{url('upload/big.png')}}" alt="" style="height: 100%;width:80%"></span>
                </div>
                <div class="card-body text-center" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne_{{$mf->id}}" aria-expanded="true" aria-controls="collapseOne">
                    {{$mf->pertanyaan }}
                    </button>
                    <h5>
                      {{$mf->pertanyaan }}
                    </h5>
                  </h2>
                </div>
                <div class="card-footer text-center">
                  <button type="button" class="btn btn-primary" style="background: #100674" data-toggle="modal" data-target="#exampleModal_{{$mf->id}}">
                    <p class="mb-0">Baca Selengkapnya <span><i class="icon-chevron-circle-right"></i></span></p>
                  </button>
                </div>

                <div id="collapseOne_{{$mf->id}}" class="collapse @isset($filter){{ $show }}@endisset" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                    {{$mf->jawaban}}
                  </div>
                </div>
                <div class="modal fade @isset($filter){{ $show }}@endisset bd-example-modal-lg" id="exampleModal_{{$mf->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title pt-3 pb-3" id="exampleModalLabel" style="color: #100674"><b>{{$mf->pertanyaan }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body p-4">
                        {{$mf->jawaban}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div> -->
      <br>
      <div class="row">
        <div class="col-sm-12">
          <div class="row justify-content-center pb-3">
            <!-- <div class="col-md-12 text-center ftco-animate pt-5">
              <h1 class="text-blue"><b>TIDAK MENEMUKAN JAWABAN?</b></h1>
              {{-- <img src="{{ url('/assets/digilab/images/big2-18.png')}}" class="img-fluid" alt="Colorlib Template"> --}}
            </div> -->
          </div>
          <h3>Tidak Menemukan Jawaban?</h3>
          @if(Auth::guard('pengguna')->check())
          <center>
            <a href="{{route('pengguna.pesan.baru')}}" class="btn btn-success" style="color:white ;">&nbsp&nbsp&nbsp Ajukan Pertanyaan &nbsp&nbsp&nbsp</a>
          </center>
          @else
          <center>
            <a onclick="CekLogin()" class="btn btn-success" style="color:white ;">&nbsp&nbsp&nbsp Ajukan Pertanyaan &nbsp&nbsp&nbsp</a>
          </center>
          @endif
        </div>
      </div>
      <br>
  </section>
  <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
    <img src="{{url('upload/angle-double-small-up-white.png')}}" alt="" style="width: 24px; height: 25px;">
  </button>

  @include('template.penggunafooter')

  <script type="text/javascript">
    //start scroll
    //Get the button
    let mybutton = document.getElementById("btn-back-to-top");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
      scrollFunction();
    };

    function scrollFunction() {
      if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
      ) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }
    // When the user clicks on the button, scroll to the top of the document
    mybutton.addEventListener("click", backToTop);

    function backToTop() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
    //end scroll
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function() {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/5ef5b10b9e5f69442291574a/default';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();

    function CekLogin() {
      swal.fire({
        title: "Login",
        text: "silahkan login terlebih dahulu untuk mengajukan pertanyaan",
        type: "warning"
      }).then(function() {
        window.location = "{{route('login', ['faq'=> "
        yes "])}}";
      });

    }

    function lihat(pertanyaan, jawaban) {
      Swal.fire({
        title: '<h3><br><b>' + pertanyaan + '</b></h3>',
        html: '<div style="text-align:left;"><br><font size="2">' + jawaban + '</font></div><br><hr>',
        animation: true,
        width: '60%'
      })
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>