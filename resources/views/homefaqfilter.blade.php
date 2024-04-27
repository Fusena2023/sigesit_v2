<!DOCTYPE html>
<html lang="en">
@include('template.penggunaheader')
<style type="text/css">
  .bg-img {
    background-image: url(../assets/digilab/images/bg-img.png);
    position: relative;
    background-color: #63c4f194;
    padding-bottom: 0px;
  }

  .nav-item {
    border-width: 2px;
    border-style: outset;
    border-radius: 40px;
  }
</style>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  @include('template.penggunanavbarfaq')

  <section class="ftco-section bg-img" id="testimony-section">
    <div class="container">
      <div class="row justify-content-center pb-3">
        <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
          <img src="{{ url('/assets/digilab/images/big2-18.png')}}" class="img-fluid" alt="Colorlib Template">
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
        <div class="col-sm-12">
          <div class="col-sm-6">
            <input type="text" class="form-control" id="filter" name="filter">
          </div>

          <div class="col-sm-6">
            <button type="submit" class="btn btn-info">CARI</button>
          </div>

        </div>
      </form>
      <div class="accordion" id="accordionExample">

        `@foreach($masterfaq as $mf)
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne_{{$mf->id}}">
                {{$mf->pertanyaan }}
              </button>
            </h2>
          </div>

          <div id="collapseOne_{{$mf->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              {{$mf->jawaban}}
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <br>
  </section>

  @include('template.penggunafooter')

  <script type="text/javascript">
    function lihat(pertanyaan, jawaban) {
      Swal.fire({
        title: '<h3><br><b>' + pertanyaan + '</b></h3>',
        html: '<div style="text-align:left;"><br><font size="2">' + jawaban + '</font></div><br><hr>',
        animation: true,
        width: '60%'
      })
    }
  </script>

</body>

</html>