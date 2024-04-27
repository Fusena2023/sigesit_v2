<style>
  h2.ftco-heading-2, span.text, .ftco-footer p, .ftco-footer .ftco-footer-widget ul li a,
  .block-23 ul li .icon {
    color: white !important;
  }
</style>

<?php  use App\MasterTentang; ?>
<footer class="ftco-footer ftco-section">
      <div class="container-2">
        <div class="row">
          <?php $mastertentangs = MasterTentang::where('status',true)->get(); ?>
          @foreach($mastertentangs as $mt)
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Kontak Kami</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">{{$mt->lokasi_big}}</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">{{$mt->telpon}}</span></a></li>
			            <li><a href="#"><span class="icon icon-mobile-phone"></span><span class="text">0811 1195 005</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">{{$mt->website}}</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
          @endforeach
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">APLIKASI PELAYANAN TERPADU INFORMASI GEOSPASIAL (PTIG)</h2>
              @foreach($mastertentangs as $mt)
              <p>{{$mt->deskripsi}}</p>
              @endforeach
              <!-- <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul> -->
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Layanan Kami</h2>
              <ul class="list-unstyled">
                <li><a href="#services-section">Layanan Jasa Konsultasi </a></li>
                <li><a href="#services-section2">Layanan Produk Daring</a></li>
                <li><a href="#services-section3">Layanan Produk IG Nol Rupiah</a></li>
                <li><a href="#services-section4">Layanan Produk IG, Jasa dan Diklat Berbayar</a></li>
                <li><a href="#services-section5">Layanan Pembayaran ke Kas Negara</a></li>

                {{-- <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Layanan Umum</a></li> --}}
              </ul>
            </div>
          </div>
          {{-- <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Layanan Digital</h2>
              <ul class="list-unstyled">
                <li><a href="#layanandigital-section"><span class="icon-long-arrow-right mr-2"></span>Layanan Digital</a></li>
               
              </ul>
            </div>
          </div> --}}
          {{-- @foreach($mastertentangs as $mt)
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Kontak Kami</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">{{$mt->lokasi_big}}</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">{{$mt->telpon}}</span></a></li>
			            <li><a href="#"><span class="icon icon-mobile-phone"></span><span class="text">0811 1195 005</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">{{$mt->website}}</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
          @endforeach --}}
        </div>
      </div>
    </footer>
    <section class="footer pt-3" style="background: #a7ddff">
      <div class="row">
        <div class="col-md-12 text-center">
          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy;<script>document.write(new Date().getFullYear());</script> Pusat Terpadu Informasi Geospasial <!--| This template is modified from <a href="https://colorlib.com" target="_blank">Colorlib</a>-->
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
      </div>
    </section>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#0f88bf"/></svg></div>


  <script src="{{url('assets/digilab/js/jquery.min.js')}}"></script>
  <script src="{{url('assets/digilab/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{url('assets/digilab/js/popper.min.js')}}"></script>
  <script src="{{url('assets/digilab/js/bootstrap.min.js')}}"></script>
  <script src="{{url('assets/digilab/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{url('assets/digilab/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{url('assets/digilab/js/jquery.stellar.min.js')}}"></script>
  <script src="{{url('assets/digilab/js/owl.carousel.min.js')}}"></script>
  <script src="{{url('assets/digilab/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{url('assets/digilab/js/aos.js')}}"></script>
  <script src="{{url('assets/digilab/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{url('assets/digilab/js/scrollax.min.js')}}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{url('assets/digilab/js/google-map.js')}}"></script>
  
  <script src="{{url('assets/digilab/js/main.js')}}"></script>
        <!--sweetalert-->
              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <!--sweetalertEND-->
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <!--Date-->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
