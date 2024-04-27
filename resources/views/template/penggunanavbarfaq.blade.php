<style>
  li.nav-item {
    border-style: none;
  }
  .nav-item a span {
    font-weight: bold;
    /* font-weight: 900; */
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
  <div class="container">
     <img src="{{ url('assets/digilab/images/ico.png')}}" {{-- style="width:80%;height:80%;" --}}>&nbsp;&nbsp;
    {{-- <a class="navbar-brand" href="{{route('home')}}">Badan<span>&nbsp;Informasi</span>&nbsp;Geospasial</a> --}}
    <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav nav ml-auto">
        <li class="nav-item" style="border-color: rgb(59, 89, 239);">
          <a href="{{route('home')}}" class="nav-link"><span>Home</span></a>
        </li>
        <li class="nav-item" style="border-color: rgb(254, 166, 33); border:none;">
          <a href="https://ppid.big.go.id/" target="_blank" class="nav-link"><span>PPID</span></a>
        </li>
        <div class="dropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown" style="border-color: rgb(254, 166, 33); border:none;">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <b>Pengaduan</b>
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink" style="margin-top: -11px;">
                <li><a class="dropdown-item" href="https://lapor.go.id/">SP4N-LAPOR</a></li>
                <li><a href="#sec_footer" class="dropdown-item">KONTAK</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <li class="nav-item" style="border-color: rgba(40, 167, 69, 0.9);">
          <a href="{{route('homefaq')}}" class="nav-link"><span>FAQ</span></a>
        </li>
        <li class="nav-item" style="border-color: rgb(254, 166, 33); border:none;">
          <a href="{{route('standartpelayanan')}}" class="nav-link"><span>Standard Pelayanan</span></a>
        </li>
        @if(Auth::guard('internal')->check())
        <li class="nav-item" style="border-color: rgba(28,110,164,0.51);">
          <a href="" class="nav-link"><span>{{ Auth::guard('internal')->user()->nama }}</span></a>
        </li>
        <li class="nav-item" style="border-color: rgba(28,110,164,0.51);">
          <a href="{{ route('internal.auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-internal').submit();" class="nav-link"><span>Keluar</span></a>
          <form id="logout-form-internal" action="{{ route('internal.auth.logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
        @elseif(Auth::guard('pengguna')->check())
        <li class="nav-item" style="border-color: rgb(59, 89, 239);">
          <a href="{{route('index_profile')}}" class="nav-link"><span>Profile</span></a>
        </li>
        <li class="nav-item" style="border-color: rgb(239, 187, 25);">
          <a href="{{route('pengguna.tiket')}}" class="nav-link"><span>Tiket</span></a>
        </li>
        <li class="nav-item" style="border-color: rgb(239, 25, 25);">
          <a href="{{route('pengguna.pesan.baru')}}" class="nav-link"><span>Pesan</span></a>
        </li>
        <div class="dropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown" style="border-color: rgb(254, 166, 33); border:none;">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <b>{{Auth::guard('pengguna')->user()->nama}}</b>
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink" style="margin-top: -11px;">
                <li><a class="dropdown-item" onclick='return lihatauth()'>Detail Pengguna</a></li>
                <li>
                  <a href="{{ route('pengguna.auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-internal').submit();" class="dropdown-item">keluar</a>
                  <form id="logout-form-internal" action="{{ url('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
          <script type="text/javascript">
            function lihatauth(){
              if({{ Auth::guard('pengguna')->user()->jenis_pengguna }} == 1){
                var jp = 'Perorangan';
                var info = '<h5 class="mb-2"><span class="icon icon-envelope"></span> {{ Auth::guard("pengguna")->user()->email }}<br><span class="icon icon-map-marker"></span> {{ Auth::guard("pengguna")->user()->alamat }}<br><span class="icon icon-phone"></span> {{ Auth::guard("pengguna")->user()->no_telp }}</h5>'
              }else{
                var jp = 'Instansi';
                var info = '<h5 class="mb-2"><span class="icon icon-envelope"></span> {{ Auth::guard("pengguna")->user()->email }}<br>{{ Auth::guard("pengguna")->user()->instansi }}, &nbsp{{ Auth::guard("pengguna")->user()->jenis_instansi }}<br>Direktorat {{ Auth::guard("pengguna")->user()->direktorat }}<br>NPWP : {{ Auth::guard("pengguna")->user()->npwp }}<br><span class="icon icon-map-marker"></span>  {{ Auth::guard("pengguna")->user()->alamat_instansi }}<br><span class="icon icon-phone"></span> {{ Auth::guard("pengguna")->user()->no_telp }}</h5>'
              }
              var html = '<div class="staff">'+
                            '<div class="img-wrap d-flex align-items-stretch">'+
                              '<div class="text d-flex align-items-center pt-3 text-center">'+
                              '<div>'+
                                '<span class="position mb-4"><a>'+ jp +' </a></span>'+info+
                              '</div>'+
                            '</div>'+
                          '</div></div>';
              Swal.fire({
                position: 'top-end',
                title: '{{ Auth::guard("pengguna")->user()->nama }}',
                html: html,
                footer: '<a>Tanggal Terdaftar : {{ Auth::guard("pengguna")->user()->created_at }}</a>',
              })
            }
          </script>
        @else
        <li class="nav-item" style="border-color: rgb(187, 187, 1);">
          <a href="#layanandigital-section" class="nav-link"><span>Layanan Digital</span></a>
        </li>
        <li class="nav-item" style="border-color: rgba(28,110,164,0.51);">
          <a href="#about-section" class="nav-link"><span>Tentang</span></a>
        </li>
        <li class="nav-item" style="border-color: rgba(40, 167, 69, 0.9);">
          <a href="{{route('homefaq')}}" class="nav-link"><span>FAQ</span></a>
        </li>
        <!-- <li class="nav-item" style="border-color: rgba(40, 167, 69, 0.9);">
          <a href="{{route('home_pengaduan')}}" class="nav-link"><span>Pengaduan</span></a>
        </li> -->
        <li class="nav-item" style="border-color: rgb(191, 58, 85);">
          <a href="{{ url('/login') }}" class="nav-link"  style="background: yellow; border-radius: 50px; margin-top: 5px; margin-bottom: 5px; padding-top: 5px; padding-bottom: 5px;"><span>Masuk</span></a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>