<!DOCTYPE html>
<html lang="en">
@include('template.penggunaheader')

<style type="text/css">
  .form-control {
    /* height: 40px !important; */
  }

  .nav-item a span {
    font-weight: bold;
    /* font-weight: 900; */
    /* border-width: 2px;
      border-style: outset;
      border-radius: 40px; */
  }

  a.text-blue.text.d-block {
    font-size: 25px;
  }

  .nav-item:hover a span {
    color: #007bff;
  }

  .modal-penilaian {
    display: none;
    /* Hidden by default */
    position: absolute;
    /* Stay in place */
    z-index: 2;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
  }

  p {
    line-height: 23px;
  }

  h1.text-white.headlpinr {
    text-align: left;
    padding-top: 200px;
    padding-bottom: 200px;
    padding-left: 160px;
    padding-right: 100px;
  }

  a.text-blue {
    font-size: 15px;
  }

  .modal-content-penilaian {
    margin-left: 30px;
    padding: 0px;
    width: 24%;
  }

  #textcontent {
    text-align: justify;
    color: white;
    padding-top: 15px;
  }

  #projects-section {
    padding: 0rem !important;
    margin-top: -215px;
  }

  img#imgsig {
    margin-top: -4rem;
  }

  #contentlayanan {
    background: #100674;
    border-radius: 25px;
    height: 200px;
    /* margin-bottom: 2rem !important; */
  }

  #layanandiklatc {
    background: #100674;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }

  @font-face {
    font-family: 'FontPresentase';
    src: url('../public/assets/digilab/fonts/arialbd.ttf') format('truetype');
  }

  .icon-penilaian {
    width: 100px;
    height: 100px;
  }

  .table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
  }

  #about-section table thead tr {
    background-color: #0B8CC4 !important;
    border-bottom: 1px solid #fff;
  }

  /* #about-section table tbody tr:nth-child(odd){
      background-color: #ccf0ff;
      color:#006b99;
    }
    #about-section table tbody tr:nth-child(even){
      background-color: #fff4cc;
      color:#665000;
    } */
  #about-section table th {
    padding: 5px;
    font-size: 15px;
    font-weight: 600;
    color: #fff;
  }

  #about-section table td {
    padding: 5px;
    font-size: 1em;
    font-weight: 550;
    /* color: black; */
  }

  #about-section table tbody td:nth-child(2) {
    width: 40%;
    text-align: left;
    border: none
  }


  .highcharts-credits {
    display: none;
  }

  #defaultGrafik1 .highcharts-legend{
    display: none;
  }

  .card-body.layananjasa {
    padding: 0px;
    height: 75px;
    background-color: #a7ddff;
    border-bottom-left-radius: 25px;
    border-bottom-right-radius: 25px;
  }

  a.textlayanan {
    color: white;
    font-weight: bold;
    font-size: 15px;
  }

  .col-xs-6.col-sm-6.col-lg-8.contlpinr {
    padding: 5rem 3rem 5rem 3rem;
  }

  span.carousel-control-prev-icon,
  span.carousel-control-next-icon {
    background-image: none;
  }

  @media (max-width: 767.98px) {
    .col-xs-6.col-sm-6.col-lg-8.contlpinr {
      padding: 0px;
    }
  }

  @media (min-width: 1200px) {
    #containerlyndik {
      max-width: 1585px !important;
    }
  }

  @media (min-width: 487px) {
    .col-sm-6 {
      width: 100%;
    }
  }

  @media only screen and (min-width: 600px) {

    /* For tablets: */
    .col-sm-1 {
      width: 8.33%;
    }

    .col-sm-2 {
      width: 16.66%;
    }

    .col-sm-3 {
      width: 25%;
    }

    .col-sm-4 {
      width: 33.33%;
    }

    .col-sm-5 {
      width: 41.66%;
    }

    .col-sm-6 {
      width: 100%;
    }

    .col-sm-7 {
      width: 58.33%;
    }

    .col-sm-8 {
      width: 66.66%;
    }

    .col-sm-9 {
      width: 75%;
    }

    .col-sm-10 {
      width: 83.33%;
    }

    .col-sm-11 {
      width: 91.66%;
    }

    .col-sm-12 {
      width: 100%;
    }

    .item-caption {
      width: 24%;
    }

  }

  @media only screen and (min-width: 768px) {

    /* For desktop: */
    .col-1 {
      width: 8.33%;
    }

    .col-2 {
      width: 16.66%;
    }

    .col-3 {
      width: 25%;
    }

    .col-4 {
      width: 33.33%;
    }

    .col-5 {
      width: 41.66%;
    }

    .col-6 {
      width: 50%;
    }

    .col-7 {
      width: 58.33%;
    }

    .col-8 {
      width: 66.66%;
    }

    .col-9 {
      width: 75%;
    }

    .col-10 {
      width: 83.33%;
    }

    .col-11 {
      width: 91.66%;
    }

    .col-12 {
      width: 100%;
    }
  }

  @media only screen and (min-width: 950px) {
    .item-caption {
      width: 24%;
    }
  }

  @media only screen and (min-width: 800px) {
    .item-caption {
      width: 18.8%;
    }
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

  .section_naik {
    margin-top: -35px;
  }
</style>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  @include('template.penggunanavbar')

  {{-- <section id="home-section" class="hero">
	  	
		  <div class="home-slider js-fullheight owl-carousel">
	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
          @foreach($masterbanner as $ban)
	        <div class="container-fluid p-0">
	          <div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
	          	<div class="one-third order-md-last img js-fullheight" style="background-image:url({{url('upload'.'/'.$ban->gambar)}});width:50%;height:50%;margin-top: 5%;position: center;">
  <div class="overlay"></div>
  </div>
  <div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
    <!--<div class="text" style="padding: 470px 0px 0px 150px;">
			            <p><a href="{{route('register')}}" class="btn btn-primary px-5 py-3 mt-3">Daftar</a></p>-->
  </div>
  </div>
  </div>
  </div>
  @endforeach
  </div>
  </div>
  </section> --}}

  <section id="home-section" class="hero">
    <div class="home-slider js-fullheight owl-carousel">

      @foreach($masterbanner as $ban)
      <div class="slider-item js-fullheight">
        <div class="container-fluid p-0" style="background-image: url('assets/digilab/images/BG1-1.png'); background-size: cover; height: 650px !important;">
          <div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
            <div class="one-third order-md-last img js-fullheight" style="background-image:url({{url('upload'.'/'.$ban->gambar)}});background-size: 60% 60%;position: center;z-index: 2;">
            </div>
            <div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
              <div class="text" {{-- style="border-radius: 25px;background: #DFF1FC;padding: 30px;" --}}>
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-xs-12">
                    <a href=""><span>
                        <center>
                          <img id="imgsig" src="{{ asset('assets/digilab/images/img1-1.png') }}">
                        </center>
                      </span></a>
                  </div>
                </div>
                {{-- <span class="subheading"></span>
                  <h1 class="mb-4 mt-3"><span>SIGESIT</span></h1>
                  <h4 class="mb-4">Aplikasi Pelayanan Terpadu Informasi Geospasial (PTIG)</h4>
                  <p>
                    Mempermudah pengguna informasi geospasial dari<br>
                    kementerian/lembaga, pemerintah daerah, institusi pendidikan<br>
                    dan swasta mendapatkan layanan produk dan jasa geospasial.
                  </p>
                  <p><hr style="height:2px;color:#497FB2;background-color:#497FB2;"></p> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </section>

  {{-- <section class="ftco-section ftco-project bg-success" id="projects-section">
      <div class="container px-md-5">
        <div class="row justify-content-center pb-5">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <span><font color="black">Pilihan Layanan</font></span>
            <h2 class="mb-4"><font color="#0c87be">Layanan Kami</font></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 testimonial">
            <div class="carousel-project owl-carousel">
              @foreach($masterjenislayanan as $mjl)
                <div class="item">
                  <div class="project">
                    <div class="img">
                      <img src="{{ Storage::url('public/'). $mjl->icon }}" class="img-fluid" alt="Colorlib Template">
  <div class="text px-4">
    <h3><a href="{{ $mjl->url }}">{{ $mjl->jenis_layanan }}</a></h3>
    <span>{{ $mjl->deskripsi }}</span>
  </div>
  </div>
  </div>
  </div>
  @endforeach
  </div>
  </div>
  </div>
  </div>
  </section> --}}

  <section class="ftco-section" id="projects-section">
    <div class="container-2">
      {{-- <div class="row pb-5">
          <div class="col-md-7 heading-section ftco-animate">
            <h4>Layanan Jasa</h4>
          </div>
        </div> --}}
      <div class="row d-flex pb-4" style="justify-content: center">
        {{-- <div class="col-md-1"></div> --}}
        <div class="col-12 col-lg-2 col-xl-2 pb-2 ftco-animate">
          <div class="card" id="contentlayanan">
            <div class="card-title pt-3 mb-2">
              <span>
                <center><img src="{{url('upload/consulting.png')}}" style="width: 80px" alt=""></center>
              </span>
            </div>
            <div class="card-body pt-2">
              <center>
                <h5 class="heading"><a href="#" class="textlayanan">Layanan Jasa Konsultasi</a></h5>
              </center>
            </div>
          </div>
          {{-- <div class="blog-entry justify-content-end" id="contentlayanan">
              <a href="#" class="block-20" style="background-image:url({{url('upload/consulting.png')}});background-size: 60% 75%;border-top-left-radius: 25px;border-top-right-radius: 25px;">
          </a>
          <div class="text float-right d-block" style="border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;padding: 0px 20px 20px 20px;">
            <center>
              <h3 class="heading"><a href="#">Layanan Jasa Konsultasi</a></h3>
            </center>
            <center>
              <h3 class="heading"><a href="#">Pembuatan Peta <br> Dasar Desa</a></h3>
            </center>
            <p id="textcontent">Peta penetapan batas Desa adalah peta yang menyajikan batas Desa hasil penetapan berbasis peta dasar atau citra tegak resolusi tinggi. Dalam proses penetapan batas desa dapat digunakan metode Kartometrik.</p>
            @if(Auth::guard('pengguna')->check())
            <center>
              <p><a href="{{route('pengguna.tiket')}}" class="btn btn-primary">&nbsp&nbsp&nbsp Buat Tiket &nbsp&nbsp&nbsp</a></p>
            </center>
            @else
            <center>
              <p><a onclick="Swal.fire({title: 'LOGIN',text: 'silahkan masuk untuk membuat tiket pada layanan',icon: 'success',});" class="btn btn-primary">&nbsp&nbsp&nbsp Buat Tiket &nbsp&nbsp&nbsp</a></p>
            </center>
            @endif
          </div>
        </div> --}}
      </div>
      <div class="col-12 col-lg-2 col-xl-2 pb-2 ftco-animate">
        <div class="card" id="contentlayanan">
          <div class="card-title pt-3 mb-2">
            <span>
              <center><img src="{{url('upload/gadget.png')}}" style="width: 80px" alt=""></center>
            </span>
          </div>
          <div class="card-body pt-2">
            <center>
              <h5 class="heading"><a href="#" class="textlayanan">Layanan Produk Daring</a></h5>
            </center>
          </div>
        </div>
        {{-- <div class="blog-entry justify-content-end" id="contentlayanan">
              <a href="#" class="block-20" style="background-image:url({{url('upload/gadget.png')}});background-size: 60% 75%;border-top-left-radius: 25px;border-top-right-radius: 25px;">
        </a>
        <div class="text float-right d-block" style="border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;padding: 0px 20px 20px 20px;">
          <center>
            <h3 class="heading"><a href="#">Layanan Produk Daring</a></h3>
          </center>
          <center>
            <h3 class="heading"><a href="#">Konsultasi<br> Tata Ruang</a></h3>
          </center>
          <p id="textcontent">Penyusunan Peta Rencana Tata Ruang wajib dikonsultasikan kepada BIG, untuk dilakukan asistensi dan supervisi peta rencana tata ruang, memverifikasi terhadap data geospasial dan informasi geospasial.</p>
          @if(Auth::guard('pengguna')->check())
          <center>
            <p><a href="{{route('pengguna.tiket')}}" class="btn btn-primary">&nbsp&nbsp&nbsp Buat Tiket &nbsp&nbsp&nbsp</a></p>
          </center>
          @else
          <center>
            <p><a onclick="Swal.fire({title: 'LOGIN',text: 'silahkan masuk untuk membuat tiket pada layanan',icon: 'success',});" class="btn btn-primary">&nbsp&nbsp&nbsp Buat Tiket &nbsp&nbsp&nbsp</a></p>
          </center>
          @endif
        </div>
      </div> --}}
    </div>
    <div class="col-12 col-lg-2 col-xl-2 pb-2 ftco-animate">
      <div class="card" id="contentlayanan">
        <div class="card-title pt-3 mb-2">
          <span>
            <center><img src="{{url('upload/settings.png')}}" style="width: 80px" alt=""></center>
          </span>
        </div>
        <div class="card-body pt-2">
          <center>
            <h5 class="heading"><a href="#" class="textlayanan">Layanan Produk IG Nol Rupiah</a></h5>
          </center>
        </div>
      </div>
      {{-- <div class="blog-entry justify-content-end" id="contentlayanan">
              <a href="#" class="block-20" style="background-image:url({{url('upload/settings.png')}});background-size: 60% 75%;border-top-left-radius: 25px;border-top-right-radius: 25px;">
      </a>
      <div class="text float-right d-block" style="border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;padding: 0px 20px 20px 20px;">
        <center>
          <h3 class="heading"><a href="#">Layanan Produk IG Nol Rupiah</a></h3>
        </center>
        <center>
          <h3 class="heading"><a href="#">Pembuatan <br> Simpul Jaringan</a></h3>
        </center>
        <p id="textcontent">Simpul Jaringan adalah institusi yang bertanggungjawab dalam penyelenggaraan pengumpulan, pemeliharaan, pemutakhiran, penggunaan dan penyebarluasan Data Geospasial (DG) dan Informasi Geospasial (IG) tertentu.</p>
        @if(Auth::guard('pengguna')->check())
        <center>
          <p><a href="{{route('pengguna.tiket')}}" class="btn btn-primary">&nbsp&nbsp&nbsp Buat Tiket &nbsp&nbsp&nbsp</a></p>
        </center>
        @else
        <center>
          <p><a onclick="Swal.fire({title: 'LOGIN',text: 'silahkan masuk untuk membuat tiket pada layanan',icon: 'success',});" class="btn btn-primary">&nbsp&nbsp&nbsp Buat Tiket &nbsp&nbsp&nbsp</a></p>
        </center>
        @endif
      </div>
    </div> --}}
    </div>
    <div class="col-12 col-lg-2 col-xl-2 pb-2 ftco-animate">
      <div class="card" id="contentlayanan">
        <div class="card-title pt-3 mb-2">
          <span>
            <center><img src="{{url('upload/vehicle.png')}}" style="width: 80px" alt=""></center>
          </span>
        </div>
        <div class="card-body pt-2">
          <center>
            <h5 class="heading"><a href="#" class="textlayanan">Layanan Produk IG, Jasa dan Diklat Berbayar</a></h5>
          </center>
        </div>
      </div>
      {{-- <div class="blog-entry justify-content-end" id="contentlayanan">
              <a href="#" class="block-20" style="background-image:url({{url('upload/vehicle.png')}});background-size: 60% 75%;border-top-left-radius: 25px;border-top-right-radius: 25px;">
      </a>
      <div class="text float-right d-block" style="border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;padding: 0px 20px 20px 20px;">
        <center>
          <h3 class="heading"><a href="#">Layanan Produk IG, Jasa dan Diklat Berbayar</a></h3>
        </center>
        <center>
          <h3 class="heading"><a href="#">Pembuatan Unsur <br> Peta Dasar</a></h3>
        </center>
        <p id="textcontent">Peta penetapan batas Desa adalah peta yang menyajikan batas Desa hasil penetapan berbasis peta dasar atau citra tegak resolusi tinggi. Dalam proses penetapan batas desa dapat digunakan metode Kartometrik.</p>
        @if(Auth::guard('pengguna')->check())
        <center>
          <p><a href="{{route('pengguna.tiket')}}" class="btn btn-primary">&nbsp&nbsp&nbsp Buat Tiket &nbsp&nbsp&nbsp</a></p>
        </center>
        @else
        <center>
          <p><a onclick="Swal.fire({title: 'LOGIN',text: 'silahkan masuk untuk membuat tiket pada layanan',icon: 'success',});" class="btn btn-primary">&nbsp&nbsp&nbsp Buat Tiket &nbsp&nbsp&nbsp</a></p>
        </center>
        @endif
      </div>
    </div> --}}
    </div>
    {{-- <div class="col-12 col-lg-2 col-xl-2 pb-2 ftco-animate">
            <div class="card" id="contentlayanan">
                <div class="card-title pt-4">
                  <span>
                    <center><img src="{{url('upload/payment.png')}}" style="width: 120px" alt=""></center>
    </span>
    </div>
    <div class="card-body">
      <center>
        <h5 class="heading"><a href="#" class="textlayanan">Layanan Pembayaran ke Kas Negara</a></h5>
      </center>
    </div>
    </div> --}}
    {{-- <div class="blog-entry justify-content-end" id="contentlayanan">
              <a href="#" class="block-20" style="background-image:url({{url('upload/payment.png')}});background-size: 60% 75%;border-top-left-radius: 25px;border-top-right-radius: 25px;">
    </a>
    <div class="text float-right d-block" style="border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;padding: 0px 20px 20px 20px;">
      <center>
        <h3 class="heading"><a href="#">Layanan Pembayaran ke Kas Negara</a></h3>
      </center>
      <center>
        <h3 class="heading"><a href="#">Pembuatan Unsur <br> Peta Dasar</a></h3>
      </center>
      <p id="textcontent">Peta penetapan batas Desa adalah peta yang menyajikan batas Desa hasil penetapan berbasis peta dasar atau citra tegak resolusi tinggi. Dalam proses penetapan batas desa dapat digunakan metode Kartometrik.</p>
      @if(Auth::guard('pengguna')->check())
      <center>
        <p><a href="{{route('pengguna.tiket')}}" class="btn btn-primary">&nbsp&nbsp&nbsp Buat Tiket &nbsp&nbsp&nbsp</a></p>
      </center>
      @else
      <center>
        <p><a onclick="Swal.fire({title: 'LOGIN',text: 'silahkan masuk untuk membuat tiket pada layanan',icon: 'success',});" class="btn btn-primary">&nbsp&nbsp&nbsp Buat Tiket &nbsp&nbsp&nbsp</a></p>
      </center>
      @endif
    </div>
    </div> --}}
    </div>
    {{-- <div class="col-md-1"></div> --}}
    </div>
    <p>
      <hr>
    </p>
    </div>
  </section>


  {{-- <section class="ftco-section ftco-no-pb ftco-no-pt ftco-services bg-light2" id="services-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <br><br><span><font color="orange" size="6">Layanan Jasa</font></span>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-md-4 ftco-animate py-5 nav-link-wrap">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              @foreach($masterlayananjasa as $mlj)
                <a class="nav-link px-4 {{$mlj->status}}" id="v-pills-{{$mlj->id}}-tab" data-toggle="pill" href="#v-pills-{{$mlj->id}}" role="tab" aria-controls="v-pills-{{$mlj->id}}" aria-selected="true"><span class="mr-2 {{$mlj->icon}}"></span>
  <font size="4">{{$mlj->nama_layanan_jasa}}</font></a>
  @endforeach
  </div>
  </div>
  <div class="col-md-8 ftco-animate p-4 p-md-5 d-flex align-items-center">

    <div class="tab-content pl-md-5" id="v-pills-tabContent">
      @foreach($masterlayananjasa as $mlj)
      <div class="tab-pane fade show {{$mlj->status}} py-5" id="v-pills-{{$mlj->id}}" role="tabpanel" aria-labelledby="v-pills-{{$mlj->id}}-tab">
        @if(!empty($mlj->gambar))
        <img src="{{ Storage::url('public/'). $mlj->gambar }}" class="img-fluid" alt="Colorlib Template">
        @endif
        <h4 class="mb-4">{{$mlj->nama_layanan_jasa}}</h4>
        <p>{{$mlj->deskripsi}}</p>
        <p>
          @if(Auth::guard('pengguna')->check())
          <a href="{{route('pengguna.tiket')}}" class="btn btn-primary px-4 py-3">Buat Tiket</a>
          @else
          <a href="{{ route('login') }}" class="btn btn-primary px-4 py-3">Buat Tiket</a>
          @endif
        </p>
      </div>
      @endforeach
    </div>
  </div>
  </div>
  </div>
  </section> --}}

  <!-- <section class="ftco-section-2 img" style="background-image: url(../public/assets/digilab/images/bg_3.jpg);" id="services-section2">
    	<div class="container">
    		<div class="row d-md-flex justify-content-end">
    			<div class="col-md-6">
    				<div class="row">
    					<div class="col-md-12">
    						<a href="#" class="services-wrap ftco-animate">
    							<div class="icon d-flex justify-content-center align-items-center">
    								<span class="ion-ios-arrow-back"></span>
    								<span class="ion-ios-arrow-forward"></span>
    							</div>
    							<h2>Market Research</h2>
    							<p>Even the all-powerful Pointing has no control about the blind.</p>
    						</a>
    						<a href="#" class="services-wrap ftco-animate">
    							<div class="icon d-flex justify-content-center align-items-center">
    								<span class="ion-ios-arrow-back"></span>
    								<span class="ion-ios-arrow-forward"></span>
    							</div>
    							<h2>Financial Services</h2>
    							<p>Even the all-powerful Pointing has no control about the blind.</p>
    						</a>
    						<a href="#" class="services-wrap ftco-animate">
    							<div class="icon d-flex justify-content-center align-items-center">
    								<span class="ion-ios-arrow-back"></span>
    								<span class="ion-ios-arrow-forward"></span>
    							</div>
    							<h2>Online Marketing</h2>
    							<p>Even the all-powerful Pointing has no control about the blind.</p>
    						</a>
    						<a href="#" class="services-wrap ftco-animate">
    							<div class="icon d-flex justify-content-center align-items-center">
    								<span class="ion-ios-arrow-back"></span>
    								<span class="ion-ios-arrow-forward"></span>
    							</div>
    							<h2>24/7 Help &amp; Support</h2>
    							<p>Even the all-powerful Pointing has no control about the blind.</p>
    						</a>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section> -->

  <section class="ftco-section ftco-no-pb ftco-no-pt ftco-services" id="layananjasa_konsultasi" style="margin-top:-71px ;">
    <div class="container-2 pt-4">
      <div class="row pb-4">
        <div class="col-md-12 heading-section ftco-animate">
          <h4 style="color: #100674"><b>Layanan Jasa Konsultasi</b></h4>
        </div>
      </div>
      <div class="row pb-4">
        @foreach($masterlayananjasa as $val)

        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 mb-4 ftco-animate">
          <div class="card" style="background: black; border-radius:25px">
            <div class="card-title mb-0">
              @php
              $cekjasa = checkKuesionerIsFilled('jasa');
              $cekjasa_nya = !empty($cekjasa)?count((array)$cekjasa):0;
              @endphp
              @if(Auth::guard('pengguna')->check())
                @if($cekjasa_nya > 0)
                <a title="Buat tiket" onclick="alertKuesioner()" class="block-20" style="background-image:url({{url('upload/jasa/'.$val->gambar.'')}});border-top-left-radius: 25px;border-top-right-radius: 25px;height: 150px;"></a>
                @else
                <a title="Buat tiket" href="{{ route('pengguna.tiketlayananjasa', base64_encode($val->id)) }}" class="block-20" style="background-image:url({{url('upload/jasa/'.$val->gambar.'')}});border-top-left-radius: 25px;border-top-right-radius: 25px;height: 150px;"></a>
                @endif
              @else
              <a title="Buat tiket" onclick="CekLoginLayanan('{{$val->id}}','jasa')" class="block-20" style="background-image:url({{url('upload/jasa/'.$val->gambar.'')}});border-top-left-radius: 25px;border-top-right-radius: 25px;height: 150px;"></a>
              @endif
            </div>
            <div class="card-body layananjasa">
              <div class="text d-block pt-3" style="line-height: 20px">
                <center><b>{{ $val->nama_layanan_jasa }}</b></center>
              </div>
            </div>
          </div>
          {{-- <div class="blog-entry justify-content-end">
                  </div> --}}
        </div>

        @endforeach
      </div>
      <p>
        <hr>
      </p>
    </div>
  </section>

  <section class="ftco-section ftco-project pt-4" id="layanandigital-section" style="margin-top:-31px ;">
    <div class="container-2">
      <div class="row justify-content-center pb-5">
        <div class="col-md-12 heading-section ftco-animate">
          <h4 style="color: #100674"><b>Layanan Produk Daring</b></h4>
        </div>
      </div>
      <div class="row" style="margin-top:-31px ;">

        <div class="MultiCarousel" data-items="1,2,3,4" data-slide="1" id="MultiCarousel" data-interval="1000">
          <div class="MultiCarousel-inner">
            <div class="row">
              <?php $i = 0;
              foreach ($masterlayanandigital as $mld) : ?>
                <?php if ($i == 0) {
                    $set_ = 'active';
                  } else {
                    $set_ = '';
                  } ?>
                <a href="{{ $mld->url }}" target="_blank">
                  <div class="item <?php echo $set_; ?>" style="width: auto !important;">
                    <div class="pad15">
                      <div class="cardlpd" style="width: 18rem;">
                        <img src="{{ url('upload/daring/' . $mld->icon) }}" alt="Layanan Digital" title="{{ $mld->deskripsi }}" class="card-img-toplpd d-block w-100 img-fluid">
                        <div class="card-bodylpd">
                          <p class="card-textlpd"><b><a href="{{ $mld->url }}">{{ $mld->nama_layanan }}</a></b></p>
                        </div>
                      </div>
                      {{-- <img class="d-block w-100 img-fluid" src="{{ url('upload/daring/' . $mld->icon) }}" alt="Layanan Digital" title="{{ $mld->deskripsi }}">
                      <div class="item-caption">
                        <p><b><a href="{{ $mld->url }}">{{ $mld->nama_layanan }}</a></b></p>
                      </div> --}}
                    </div>
                  </div>
                </a>
              <?php $i++;
              endforeach ?>
            </div>
          </div>
          <button class="btn btn-primary leftLst">
            <</button> <button class="btn btn-primary rightLst">>
          </button>
        </div>
      </div>
      {{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-items="1,2,3,4" data-slide="1">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class='carousel-inner'>
            <?php $i = 0;
            foreach ($masterlayanandigital as $mld) : ?>
            <?php if ($i == 0) {
                $set_ = 'active';
              } else {
                $set_ = '';
              } ?> 
            <div class='carousel-item <?php echo $set_; ?>'>
                <div class="col-xs-6 col-sm-6 col-lg-3 pb-2 ftco-animate">
                  <img class="d-block w-100 img-fluid" src="{{url('upload/'.$mld->icon)}}" alt="Layanan Digital" title="{{$mld->deskripsi}}">
      <div class="carousel-caption d-none d-md-block">
        <p><b><a href="{{$mld->url}}">{{$mld->nama_layanan}}</a></b></p>
      </div>
    </div>
    </div>
  <?php $i++;
  endforeach ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div> --}}
  {{-- <div class="row">
          <div class="col-md-12 testimonial">
            <div class="carousel-project owl-carousel">
              @foreach($masterlayanandigital as $mld)
              <div class="item">
                <div class="project">
                  <div class="img">
                    <img src="{{url('upload/'.$mld->icon)}}" class="img-fluid" alt="Layanan Digital" title="{{$mld->deskripsi}}">
  <div class="text px-4">
    <h3><a href="{{$mld->url}}" target="_blank">{{$mld->nama_layanan}}</a></h3>
  </div>
  </div>
  </div>
  </div>
  @endforeach
  </div>
  </div>
  </div> --}}
  </div>
  </section>

  <section class="ftco-section lyndik" id="blog-section" style="margin-top: -21px;">
    <div class="container-2 lyndik" id="containerlyndik">
      {{-- <div class="row pb-5">
          <div class="col-md-7 heading-section ftco-animate">
            <h4 style="color: #100674"><b>Layanan Diklat</b></h4>
          </div>
        </div> --}}
      <div class="row d-flex">
        <div class="col-xs-6 col-sm-6 col-lg-4" style="background-image: url('assets/digilab/images/bg-textlayndik.png'); background-size: cover; text-align:center; height: 550px">
          <h1 class="text-white headlpinr"><b>Layanan Produk IG Nol Rupiah</b></h1>
        </div>
        <div class="col-xs-6 col-sm-6 col-lg-8 contlpinr ftco-animate" style="background-image: url('assets/digilab/images/bg-textlayndik2.png'); background-size:cover; height: 550px">
          <div class="row mt-3 mb-3">
            @php
            $cekprodukig = checkKuesionerIsFilled('ig_nol');
            $cekprodukig = !empty($cekprodukig)?count((array)$cekprodukig):0;
            @endphp
            @foreach($masterlayananprodukig as $val)
            <div class="col-12 col-md-6 col-sm-6 col-lg-6 col-xl-6 pb-3 ftco-animate fadeInUp ftco-animated">
              <div class="card" style="background: #e8f6fe; border-radius: 25px;">
                <div class="card-title">
                    <a title="Buat tiket"
                    @if(Auth::guard('pengguna')->check())
                      @if($cekprodukig > 0)
                      onclick="alertKuesioner()"
                      @else
                      href="{{ route('pengguna.tiketlayananjasa', base64_encode($val->id)) }}"
                      @endif
                    @else
                      onclick="CekLoginLayanan('{{$val->id}}','ig')"
                    @endif>
                      <span class="block-20" style="background-image:url({{url('upload/peta_indonesia.jpg')}});border-top-left-radius: 25px;border-top-right-radius: 25px;"></span>
                    </a>
                </div>
                <div class="card-body" style="height: 200px">
                  <h3 class="heading pb-3" id="a1"><b><a class="text-blue text d-block" {{-- onclick="$('#m1').show('slow');$('#b1').show();$('#a1').hide();" --}}>{{ $val->nama_layanan_jasa }}</a></b></h3>
                  <div id="m1">
                    <p>{{ $val->deskripsi }}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>



      </div>
    </div>
  </section>

  {{-- <section class="ftco-section bg-success" id="layanandigital-section">
      <div class="container">
        <div class="row justify-content-center pb-5">
          <div class="col-md-6 heading-section text-center ftco-animate">
            <h2 class="mb-4">Layanan Digital</h2>
            <p><font color="#0c87be">Layanan - Layanan Lain atau Website - Website yang Terdapat di Badan Informasi Geospasial</font></p>
          </div>
        </div>
        <div class="row">
        @foreach($masterlayanandigital as $mld)
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="staff">
              <div class="img-wrap d-flex align-items-stretch">
                <div class="img align-self-stretch" style="background-image: url('{{ Storage::url('public/'). $mld->icon }}');"></div>
  </div>
  <div class="text d-flex align-items-center pt-3 text-center">
    <div>
      <span class="position mb-4"><a href="{{$mld->url}}" target="_blank"><strong>{{$mld->nama_layanan}}</strong></a></span>
      <p class="mb-2">{{$mld->deskripsi}}</p>
    </div>
  </div>
  </div>
  </div>
  @endforeach
  </div>
  </div>
  </section> --}}

  <section class="ftco-section ftco-project pb-3" style="margin-top: -55px;">
    <div class="container-2">
      <div class="row mt-4 pb-5">
        <div class="col-md-12 heading-section ftco-animate">
          <center>
            <h4 class="text-blue">
              <b>Layanan Produk IG, Jasa dan Diklat Berbayar</b>
            </h4>
          </center>
        </div>
      </div>
      <div class="row" style="margin-top: -31px;">
        {{-- <div class="col-md-1"></div> --}}
        <div class="col-md-3 ftco-animate pb-4">
          @php
            $cekpeta = checkKuesionerIsFilled('peta');
            $cekpeta = !empty($cekpeta)?count((array)$cekpeta):0;
          @endphp
          <a title="Buat tiket"
          @if(Auth::guard('pengguna')->check())
            @if($cekpeta > 0)
            onclick="alertKuesioner()"
            @else
            href="{{ route('pengguna.tiketlayananproduk','peta') }}"
            @endif
          @else
            onclick="CekLoginLayanan('0','peta')"
          @endif>
            <div class="card text-center" style="background: #00a6fb; border-radius: 15px;">
              <div class="card-title" style="border-bottom: 2px solid white; margin-left: 20px;">
                <p class="card-title text-right text-white p-3">Peta RBI Cetak</p>
              </div>
              {{-- <img class="card-img-top" src="holder.js/100px180/" alt=""> --}}
              <div class="card-body" style="padding-left: 5px">
                {{-- <p class="card-text">Body</p> --}}
                <span>
                  <img style="width: 175px; padding-top: 8px" src="{{url('assets/digilab/images/world-map.png')}}" alt="">
                </span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 ftco-animate pb-4">
          @php
            $cekpasut = checkKuesionerIsFilled('pasut');
            $cekpasut = !empty($cekpasut)?count((array)$cekpasut):0;
          @endphp
          <a title="Buat tiket"
          @if(Auth::guard('pengguna')->check())
            @if($cekpasut > 0)
            onclick="alertKuesioner()"
            @else
            href="{{ route('pengguna.index.pasang_surut') }}"
            @endif
          @else
            onclick="CekLoginLayanan('0','pasut')"
          @endif>
            <div class="card text-center" style="background: #0582ca; border-radius: 15px;">
              {{-- <img class="card-img-top" src="holder.js/100px180/" alt=""> --}}
              <div class="card-title" style="border-bottom: 2px solid white; margin-left: 20px;">
                <p class="card-title text-right text-white p-3">Data Pasang Surut</p>
              </div>
              <div class="card-body" style="padding-left: 5px;">
                {{-- <p class="card-text">Body</p> --}}
                <span>
                  <img style="width: 180px; padding-top: 8px;" src="{{url('assets/digilab/images/ct2.png')}}" alt="">
                </span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 ftco-animate pb-4">
          @php
            $cekkontrak = checkKuesionerIsFilled('kontrak');
            $cekkontrak = !empty($cekkontrak)?count((array)$cekkontrak):0;
          @endphp
          <a title="Buat Tiket"
          @if(Auth::guard('pengguna')->check())
            @if($cekkontrak > 0)
            onclick="alertKuesioner()"
            @else
            href="{{ route('pengguna.index.kerja_sama') }}"
            @endif
          @else
            onclick="CekLoginLayanan('0','kontrak')"
          @endif>
            <div class="card text-center" style="background: #006494; border-radius: 15px;">
              {{-- <img class="card-img-top" src="holder.js/100px180/" alt=""> --}}
              <div class="card-title" style="border-bottom: 2px solid white; margin-left: 20px;">
                <p class="card-title text-right text-white p-3">Jasa Kontrak Kerjasama</p>
              </div>
              <div class="card-body">
                {{-- <p class="card-text">Body</p> --}}
                <span>
                  <img style="width: 100px" src="{{url('assets/digilab/images/handshake.png')}}" alt="">
                </span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 ftco-animate pb-4">
          <a href="https://simpel.big.go.id/" target="_black">
            <div class="card text-center" style="background: #003554; border-radius: 15px;">
              <div class="card-title" style="border-bottom: 2px solid white; margin-left: 20px;">
                <p class="card-title text-right text-white p-3">Diklat Geospasial</p>
              </div>
              <div class="card-body">
                <span>
                  <img style="width: 100px" src="{{url('assets/digilab/images/geospasial.png')}}" alt="">
                </span>
              </div>
            </div>
          </a>
        </div>
        {{-- <div class="col-md-2 ftco-animate">
            <div class="card text-center" style="background: #051923">
              <div class="card-title" style="border-bottom: 2px solid white; margin-left: 20px;">
                <p class="card-title text-right text-white p-3">Mess Diklat</p>
              </div>
              <div class="card-body">
                <span>
                  <img style="width: 100px" src="{{url('assets/digilab/images/messdiklat.png')}}" alt="">
        </span>
      </div>
    </div>
    </div> --}}
    {{-- <div class="col-md-1"></div> --}}
    </div>
    </div>
  </section>

  <section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb" id="skm-section" style="background: #f5fcff">
    <div class="container-2">
      <div class="row">
        <div class="col-12 col-md-12 col-sm-12 col-lg-4 col-xl-4 mb-4">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="card" style="background: #a7ddff">
                <div class="card-body">
                  <div class="row">
                    <label for="block" class="col-sm-8 col-form-label text-right">Tahun</label>
                    <div class="col-sm-4 pr-0">
                      <select id="tahunSurvey" name="tahunSurvey" class="form-control">
                        @foreach($mastersurvey as $ms)
                        <option value="{{$ms->tahun}}" @if($ms->tahun == date('Y')) selected @endif>{{$ms->tahun}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <br>
                  <h4 class="text-blue text-left mt-1"><b>Hasil Survei</b></h4>
                  <div id="defaultGrafik1"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-sm-12 col-lg-4 col-xl-4 mb-4">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="card" style="background: #a7ddff">
                <div class="card-body">
                  <div id="defaultGrafik3"></div>
                  <div class="col-lg-12 col-md-12 m-0 p-0" style="border-bottom: 2px solid #100674;">
                    <div class="row">
                      <div class="col-6">
                        <h4 class="text-blue text-left mt-1"><b>Responden</b></h4>
                      </div>
                      <div class="col-6 p-0">
                        <p class="text-blue text-right mr-3 mt-3">Berdasarkan Pendidikan <i class="fa fa-square" aria-hidden="true"></i></p>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer" style="background: none;color: blue; border-top: 0px">
                    <table id="tableRespondenPendidikan" class="text-white" style="border: none">
                      <tbody class="text-blue">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-sm-12 col-lg-4 col-xl-4 mb-4">
          <div class="row mb-4">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="card" style="background: #a7ddff">
                <div class="card-body">
                  <div class="col-lg-12 col-md-12 mx-auto text-center p-0 m-0" style="border-bottom: 2px solid #100674;">
                    <div class="row">
                      <div class="col-6">
                        <h4 class="text-blue text-left mt-1"><b>Responden</b></h4>
                      </div>
                      <div class="col-6 p-0">
                        <p class="text-blue text-right mr-3 mt-3">Berdasarkan Instansi</p>
                      </div>
                    </div>
                  </div>
                  {{-- <div class="col-lg-5 col-md-12 mx-auto text-center">
                        <div class="table-responsive-sm">
                            <table id="tableRespondenInstansi" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Instansi</th>
                                        <th>Responden</th>
                                        <th>Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
        
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                  <div class="col-12">
                    <center>
                      <div id="defaultGrafik2"></div>
                    </center>
                  </div>
                  <div class="card-footer" style="background: none;color: blue">
                    <table id="tableRespondenInstansi" class="text-white" style="border: none">
                      <tbody class="text-blue">
                        {{-- <tr>
                                <th><span class="icon icon-square" style="color: #f47340"></span></th>
                                  <td>kementerian</td>
                                  <td>1</td>
                              </tr>
                              <tr>
                                <th><span class="icon icon-square" style="color: #56bbf1"></span></th>
                                  <td>Pendidikan</td>
                                  <td>3</td>
                              </tr>

                              <tr>
                                <th><span class="icon icon-square" style="color: #100674"></span></th>
                                  <td>Pemda</td>
                                  <td>3</td>
                              </tr> --}}
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row pt-2">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="card" style="background: #a7ddff">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 text-center p-0 m-0">
                      <div class="row ml-3" style="border-bottom: 2px solid #100674;">
                        <div class="col-6 pl-0">
                          <h4 class="text-blue text-left mt-1" style="font-size: 14px;"><b>Responden</b></h4>
                        </div>
                        <div class="col-6 p-0">
                          <p class="text-blue text-right mt-3">Berdasarkan Jenis Kelamin</p>
                        </div>
                      </div>
                      <div class="row pl-5 pt-5">
                        <table id="tableRespondenKelamin" class="text-white" style="border: none">
                          <tbody class="text-blue">
                          </tbody>
                        </table>
                      </div>

                    </div>
                    <div class="col-lg-6">
                      <div id="defaultGrafik4"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <label for="block" class="col-sm-8 col-form-label text-right">Tahun</label>
        <div class="col-sm-4 pr-0">
          <select id="tahun_pusat" name="tahun_pusat" class="form-control">
            @foreach($master_survey_p as $ms)
            <option value="{{$ms->tahun}}" @if($ms->tahun == date('Y')) selected @endif>{{$ms->tahun}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <h4 class="text-blue text-left mt-1"><b>Hasil Survei Perpusat</b></h4>
      <div id="baru_satu"></div>
      <div class="row">
        <label for="block" class="col-sm-8 col-form-label text-right">Tahun</label>
        <div class="col-sm-4 pr-0">
          <select id="tahun_kompon" name="tahun_kompon" class="form-control">
            @foreach($master_survey_k as $ms)
            <option value="{{$ms->tahun}}" @if($ms->tahun == date('Y')) selected @endif>{{$ms->tahun}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <h4 class="text-blue text-left mt-1"><b>Hasil Survei PerKomponen</b></h4>
      <div id="baru_dua"></div>
      <div class="col-12">
        <table id="tableHasilSurvey" class="text-white" style="display:none;border: none">
          <tbody class="text-blue">

          </tbody>
        </table>
      </div>
      <div class="row" style="padding: 20px;">
      </div>
      <div class="row" style="padding: 15px;">
        <div class="col-lg-12 col-md-12 mx-auto text-center">
          <h4 style="font-weight:700;font-size: 1.5em;color: #002366;">Indeks Survei</h4>
          <br>
          <h5 style="margin-top:-18px!important;font-size: 1em;">(Permenpan No. 14 Tahun 2017)</h5>
          <div class="row"><br></div>
          <div class="table-responsive-sm">
            <table class="table table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Nilai Persepsi</th>
                  <th>Nilai Interval (NI)</th>
                  <th>Nilai Interval Konversi (NIK)</th>
                  <th>Mutu Pelayanan (x)</th>
                  <th>Kinerja Unit Pelayanan (y)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>1,00 - 2,5996</td>
                  <td>25,00 - 64,99</td>
                  <td>D</td>
                  <td>Tidak Baik</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>2,60 - 3,064</td>
                  <td>65,00 - 76,60</td>
                  <td>C</td>
                  <td>Kurang Baik</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>3,0644 - 3,532</td>
                  <td>76,61 - 88,30</td>
                  <td>B</td>
                  <td>Baik</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>3,5324 - 4,00</td>
                  <td>88,31 - 100,00</td>
                  <td>A</td>
                  <td>Sangat Baik</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
    <img src="{{url('upload/angle-double-small-up-white.png')}}" alt="" style="width: 24px; height: 25px;">
  </button>

  {{-- <section class="ftco-section contact-section ftco-no-pb bg-light2" id="contact-section">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Lokasi</span>
            <h2 class="mb-4">Kontak & Lokasi</h2>
          </div>
        </div>
        @foreach($masterlokasi as $ml)
          <div class="row d-flex contact-info mb-5">
            <div class="col-md-6 col-lg-3 d-flex ftco-animate">
            	<div class="align-self-stretch box p-4 text-center">
            		<div class="icon d-flex align-items-center justify-content-center">
            			<span class="icon-map-signs"></span>
            		</div>
            		<h3 class="mb-4">Alamat BIG</h3>
  	            <p>{{ $ml->lokasi_big }}</p>
  </div>
  </div>
  <div class="col-md-6 col-lg-3 d-flex ftco-animate">
    <div class="align-self-stretch box p-4 text-center">
      <div class="icon d-flex align-items-center justify-content-center">
        <span class="icon-building"></span>
      </div>
      <h3 class="mb-4">Lokasi Tatap Muka</h3>
      <p>{{ $ml->lokasi_tatapmuka }}</a></p>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 d-flex ftco-animate">
    <div class="align-self-stretch box p-4 text-center">
      <div class="icon d-flex align-items-center justify-content-center">
        <span class="icon-phone2"></span>
      </div>
      <h3 class="mb-4">Nomor Telepon</h3>
      <p><a href="tel://{{ $ml->telpon }}">{{ $ml->telpon }}</a></p>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 d-flex ftco-animate">
    <div class="align-self-stretch box p-4 text-center">
      <div class="icon d-flex align-items-center justify-content-center">
        <span class="icon-paper-plane"></span>
      </div>
      <h3 class="mb-4">Email & Website</h3>
      <p><a href="mailto:{{ $ml->email }}">{{ $ml->email }}</a><br><a href="{{ $ml->website }}">{{ $ml->website }}</a></p>
    </div>
  </div>
  </div>
  @endforeach
  </div>
  </section> --}}

  {{-- <section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb bg-light" id="about-section">
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-6 col-lg-5 d-flex">
            <div class="img d-flex align-self-stretch align-items-center" style="background-image:url(../assets/digilab/images/fotodepan.jpg);background-position: center;">
            </div>
          </div>
          <div class="col-md-6 col-lg-7 pl-lg-5 py-5">
            <div class="py-md-5">
              <div class="bg-white">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.2536980088485!2d106.847761014363!3d-6.48952526525231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c1bb1acd1965%3A0x709d5406c97d2b1c!2sBadan+Informasi+Geospasial!5e0!3m2!1sid!2sid!4v1557307916896!5m2!1sid!2sid" width="555" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}

  <div id="sec_footer">
    @include('template.penggunafooter')
  </div>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://use.fontawesome.com/your-embed-code.js"></script>
  <script type="text/javascript">
    function alertKuesioner(){
      swal.fire({
        title: "Informasi",
        text: "Silahkan Isi Kuesioner Terlebih Dahulu Pada Transaksi Terakhir Anda",
        type: "info",
        confirmButtonText: 'Tiket',
      }).then(function(res) {
        if(res.value){
          window.location = "{{route('pengguna.tiket')}}";
        }
      });
    }

    function CekLoginLayanan(id, jenis) {
      swal.fire({
        title: "Login",
        text: "Silahkan Login Dahulu Untuk Membuat Tiket",
        type: "warning",
        confirmButtonText: 'Login',
      }).then(function(res) {
        if(res.value){
          var url = "{{ route('login', ':param') }}";
          url = url.replace(':param', 'id='+btoa(id)+'&jenis='+btoa(jenis)+'');
          window.location.href = url;
        }
      });

    }
  </script>
  <script>
    $(document).ready(function() {
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
      //start info
      var cek = "{{Auth::guard('pengguna')->check()}}";
      if (cek != 1) {
        Swal.fire({
          imageUrl: "{{ url('storage/app/public').'/'.$getDataInformasi->dokumen}}",
          imageWidth: 400,
          imageHeight: 400,
          html: '{{$getDataInformasi->text_informasi}}',
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
      //en info
      var itemsMainDiv = ('.MultiCarousel');
      var itemsDiv = ('.MultiCarousel-inner');
      var itemWidth = "";

      $('.leftLst, .rightLst').click(function() {
        var condition = $(this).hasClass("leftLst");
        if (condition)
          click(0, this);
        else
          click(1, this)
      });

      ResCarouselSize();




      $(window).resize(function() {
        ResCarouselSize();
      });

      //this function define the size of the items
      function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function() {
          id = id + 1;
          var itemNumbers = $(this).find(itemClass).length;
          btnParentSb = $(this).parent().attr(dataItems);
          itemsSplit = btnParentSb.split(',');
          $(this).parent().attr("id", "MultiCarousel" + id);


          if (bodyWidth >= 1200) {
            incno = itemsSplit[3];
            itemWidth = sampwidth / incno;
          } else if (bodyWidth >= 992) {
            incno = itemsSplit[2];
            itemWidth = sampwidth / incno;
          } else if (bodyWidth >= 768) {
            incno = itemsSplit[1];
            itemWidth = sampwidth / incno;
          } else {
            incno = itemsSplit[0];
            itemWidth = sampwidth / incno;
          }
          $(this).css({
            'transform': 'translateX(0px)',
            'width': itemWidth * itemNumbers
          });
          $(this).find(itemClass).each(function() {
            $(this).outerWidth(itemWidth);
          });

          $(".leftLst").addClass("over");
          $(".rightLst").removeClass("over");

        });
      }


      //this function used to move the items
      function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
          translateXval = parseInt(xds) - parseInt(itemWidth * s);
          $(el + ' ' + rightBtn).removeClass("over");

          if (translateXval <= itemWidth / 2) {
            translateXval = 0;
            $(el + ' ' + leftBtn).addClass("over");
          }
        } else if (e == 1) {
          var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
          translateXval = parseInt(xds) + parseInt(itemWidth * s);
          $(el + ' ' + leftBtn).removeClass("over");

          if (translateXval >= itemsCondition - itemWidth / 2) {
            translateXval = itemsCondition;
            $(el + ' ' + rightBtn).addClass("over");
          }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
      }

      //It is used to get some elements from btn
      function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
      }
      //$('#modal-penilaian').show();
      $.ajax({
        url: "{{url('/kepuasan/count')}}",
        type: "POST",
        data: {
          _token: '{{ csrf_token() }}'
        },
        cache: false,
        dataType: 'json',
        success: function(dataCount) {
          $('#sapu').html(dataCount.data4 + '%');
          $('#puas').html(dataCount.data3 + '%');
          $('#cupu').html(dataCount.data2 + '%');
          $('#tipu').html(dataCount.data1 + '%');
        }
      });

      hasilSurvey();
      hasilSurveyPusat();
      hasilSurveyKompon();
      respondenKelamin();
      respondenPendidikan();
      respondenInstansi();
      $('#tahunSurvey').change(function() {
        hasilSurvey();
      })
      $('#tahun_pusat').change(function() {
        hasilSurveyPusat();
      })
      $('#tahun_kompon').change(function() {
        hasilSurveyKompon();
      })

    });
  </script>
  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
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
  </script>
  <!--End of Tawk.to Script-->
  <script type="text/javascript">
    function lihat(id, judul, deskripsi, gambar, created_at, updated_at) {
      var ico = '{{ Storage::url("public/") }}' + gambar;
      Swal.fire({
        title: '<h3><br><b>' + judul + '</b></h3>',
        html: '<div style="text-align:left;"><br><font size="2">' + deskripsi + '</font></div><br><hr>',
        imageUrl: ico,
        imageAlt: 'Custom image',
        animation: true,
        width: '60%'
      })
    }
  </script>
  <!-- Highchart -->
  <script>
    function hasilSurvey() {
      var tahunSurvey = $('#tahunSurvey').val();
      $.get(
        "{{route('getSurvey')}}", {
          tahunSurvey: tahunSurvey
        },
        function(res) {
          var data = JSON.parse(res);
          var html = '';

          if (data.table.length > 0) {
            $.each(data.table, function(i, val) {
              var no = i + 1;
              if (val.triwulan == 1) {
                var t = 'I';
              } else if (val.triwulan == 2) {
                var t = 'II';
              } else if (val.triwulan == 3) {
                var t = 'III';
              } else {
                var t = 'IV';
              }
              html += '<tr>';
              // html += '<td>'+no+'</td>';
              html += '<td><center>Triwulan ' + t + '</center></td>';
              html += '<td>' + val.nilai + '</td>';
              html += '</tr>';
            })
          } else {
            html += '<tr>';
            html += '<td colspan="3">Belum Ada Data</td>';
            html += '</tr>';
          }
          $('#tableHasilSurvey tbody').html(html);
          defaultGrafik1(data);
        }
      );
    }

    function hasilSurveyPusat() {
      var tahun_pusat = $('#tahun_pusat').val();
      $.get(
        "{{route('getSurveyPerpusat')}}", {
          tahun_pusat: tahun_pusat
        },
        function(res) {
          var data = JSON.parse(res);
          defaultGrafik10(data);
        }
      );
    }

    function hasilSurveyKompon() {
      var tahun_kompon = $('#tahun_kompon').val();
      $.get(
        "{{route('getSurveyKomponen')}}", {
          tahun_kompon: tahun_kompon
        },
        function(res) {
          var data = JSON.parse(res);
          defaultGrafik11(data);
        }
      );
    }

    function respondenKelamin() {
      $.get(
        "{{url('/home/getResponden/kelamin')}}",
        function(res) {
          var data = JSON.parse(res);
          var kelamin = '';

          kelamin += '<tr>';
          kelamin += '<td></td>';
          kelamin += '<td>Laki-Laki</td>';
          kelamin += '<td>' + data.table.laki + '</td>';
          kelamin += '<td>' + data.table.laki_persentase + ' %</td>';
          kelamin += '</tr>';
          kelamin += '<tr>';
          kelamin += '<td></td>';
          kelamin += '<td>Perempuan</td>';
          kelamin += '<td>' + data.table.perempuan + '</td>';
          kelamin += '<td>' + data.table.perempuan_persentase + ' %</td>';
          kelamin += '</tr>';

          $('#tableRespondenKelamin tbody').html(kelamin);
          defaultGrafik4(data);
        }
      );
    }

    function respondenPendidikan() {
      $.get(
        "{{url('/home/getResponden/pendidikan')}}",
        function(res) {
          var data = JSON.parse(res);
          var pendidikan = '';
          $.each(data.data, function(i, val) {
            pendidikan += '<tr>';
            // pendidikan += '<td>'+val.no+'</td>';
            pendidikan += '<td></td>';
            pendidikan += '<td></td>';
            pendidikan += '<td>' + val.nama + '</td>';
            pendidikan += '<td></td>';
            pendidikan += '<td></td>';
            pendidikan += '<td><center>' + val.jumlah + '</center></td>';
            pendidikan += '<td></td>';
            pendidikan += '<td></td>';
            pendidikan += '<td></td>';
            pendidikan += '<td style="float: right">' + val.persentase + ' %</td>';
            pendidikan += '<td></td>';
            pendidikan += '<td></td>';
            pendidikan += '</tr>';
          })

          $('#tableRespondenPendidikan tbody').html(pendidikan);
          defaultGrafik3(data);
        }
      );
    }

    function respondenInstansi() {
      $.get(
        "{{url('/home/getResponden/instansi')}}",
        function(res) {
          var data = JSON.parse(res);
          console.log(data);
          var instansi = '';
          if (data.data.length > 0) {
            $.each(data.data, function(i, val) {
              instansi += '<tr>';
              instansi += '<td>' + val.nama + '</td>';
              instansi += '<td></td>';
              instansi += '<td></td>';
              instansi += '<td><center>' + val.jumlah + '</center></td>';
              instansi += '<td></td>';
              instansi += '<td></td>';
              instansi += '<td style="float: right">' + val.persentase + ' %</td>';
              instansi += '<td></td>';
              instansi += '<td></td>';
              instansi += '</tr>';
            })
          } else {
            instansi += '<tr>';
            instansi += '<td colspan="4">Belum Ada Data</td>';
            instansi += '</tr>';
          }

          $('#tableRespondenInstansi tbody').html(instansi);
          defaultGrafik2(data);
        }
      );
    }


    function defaultGrafik1(data) {
      Highcharts.chart('defaultGrafik1', {
        chart: {
          type: 'column',
          backgroundColor: '#f5fcff'
        },
        title: {
          text: ''
        },
        xAxis: {
          categories: data.categories,
          title: {
            text: null
          }
        },
        yAxis: {
          min: 0,
          title: {
            text: ' ',
            align: 'high'
          },
          labels: {
            overflow: 'justify'
          }
        },
        tooltip: {
          valueSuffix: ''
        },
        plotOptions: {
          bar: {
            dataLabels: {
              enabled: true
            }
          }
        },
        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'top',
          x: -40,
          y: 80,
          floating: true,
          borderWidth: 1,
          backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
          shadow: true
        },
        credits: {
          enabled: false
        },
        series: data.series
      });
    }

    function defaultGrafik10(data) {
      Highcharts.chart('baru_satu', {
        chart: {
          type: 'column',
          backgroundColor: '#f5fcff'
        },
        title: {
          text: ''
        },

        xAxis: {
          categories: data.categories,
          crosshair: true
        },
        yAxis: {
          min: 0,
          title: {
            text: ''
          }
        },
        tooltip: {
          valueSuffix: ''
        },
        plotOptions: {
          bar: {
            dataLabels: {
              enabled: true
            }
          }
        },
        series: data.series
      });
    }

    function defaultGrafik11(data) {
      Highcharts.chart('baru_dua', {
        chart: {
          type: 'column',
          backgroundColor: '#f5fcff'
        },
        title: {
          text: ''
        },

        xAxis: {
          categories: data.categories,
          crosshair: true
        },
        yAxis: {
          min: 0,
          title: {
            text: ''
          }
        },
        tooltip: {
          valueSuffix: ''
        },
        plotOptions: {
          bar: {
            dataLabels: {
              enabled: true
            }
          }
        },
        series: data.series
      });
    }

    function defaultGrafik2(data) {
      Highcharts.chart('defaultGrafik2', {
        chart: {
          type: 'bar',
          height: '200',
          width: '750',
          backgroundColor: '#a7ddff'
        },
        title: {
          text: ''
        },
        xAxis: {
          min: 0,
          categories: data.categories,
          title: {
            text: null
          },
          scrollbar: {
            enabled: true
          }
        },
        yAxis: {
          min: 0,
          max: 500,
          title: {
            text: 'Responden',
            align: 'high'
          },
          labels: {
            overflow: 'justify'
          }
        },
        tooltip: {
          valueSuffix: ''
        },
        plotOptions: {
          bar: {
            dataLabels: {
              enabled: true
            }
          }
        },
        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'top',
          floating: true,
          borderWidth: 1,
          backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
          shadow: true
        },
        credits: {
          enabled: false
        },
        series: data.series
      });
    }

    function defaultGrafik3(data) {

      Highcharts.chart('defaultGrafik3', {
        chart: {
          type: 'pie',
          options3d: {
            enabled: true,
            alpha: 45
          },
          backgroundColor: '#a7ddff'
        },
        title: {
          text: ''
        },
        subtitle: {
          text: ''
        },
        plotOptions: {
          pie: {
            innerSize: 100,
            depth: 45
          }
        },
        series: [{
          name: 'Responden',
          data: data.series
        }]
      });
    }

    function defaultGrafik4(data) {

      Highcharts.chart('defaultGrafik4', {
        chart: {
          type: 'pie',
          options3d: {
            enabled: true,
            alpha: 45
          },
          height: '240',
          backgroundColor: '#a7ddff'
        },
        title: {
          text: ''
        },
        subtitle: {
          text: ''
        },
        plotOptions: {
          pie: {
            innerSize: 100,
            depth: 45
          }
        },
        series: [{
          name: 'Responden',
          data: data.series
        }]
      });
    }
  </script>
  <!-- End Highchart -->
</body>

</html>