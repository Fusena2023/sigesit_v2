<!DOCTYPE html>
<html>

<head>
	<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	<style>
		#sidebar-collapse {
			background: #edf5ff;
		}

		@media (min-width: 768px) {

			.container>.navbar-header,
			.container-fluid>.navbar-header,
			.container>.navbar-collapse,
			.container-fluid>.navbar-collapse {
				margin-right: 0;
				margin-left: 280px;
			}
		}

		/* .navbar {
			background-image: url(../assets/digilab/images/Header.png);
			background-size: cover;
		} */
	</style>
</head>

<body>

	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="background-image: url(../assets/digilab/images/Header.png); background-size: cover;">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="{{url('/')}}">Badan<span>Informasi</span>Geospasial</a>
				<ul class="nav navbar-top-links navbar-right">


				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<center>
					<img src="{{url('assets/digilab/images/big.png')}}" class="img-responsive" alt="">
				</center>
			</div>
			<div class="profile-usertitle">
				<center>
					<div class="profile-usertitle-name">{{ Auth::guard('internal')->user()->nama }}</div>
					<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
				</center>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li class="parent active" id="dashboard"><a href="{{ route('admin.home') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			@if(Auth::guard('internal')->user()->status == 1)
			<li class="parent" id="master"><a data-toggle="collapse" href="#sub-item-1">
					<em class="fa fa-navicon">&nbsp;</em> Master <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li id="katlayananjasa" class=""><a class="" href="{{ route('admin.katlayananjasa') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Layanan Jasa
						</a></li>
					<li id="layanandigital" class=""><a class="" href="{{ route('admin.layanandigital') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Layanan Daring
						</a></li>
					<li id="katlayananjasa" class=""><a class="" href="{{ route('admin.nolrupiah') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Layanan Nol Rupiah
						</a></li>
					<li class="" id="masterkasnegara"><a href="{{route('admin.master.index_kasnegara')}}"><em class="fa fa-arrow-right"></em> Master Kas Negara</a></li>
					<li class="" id="produk"><a href="{{route('admin.produk')}}"><em class="fa fa-arrow-right"></em> Produk</a></li>
					<li class="" id="subproduk"><a href="{{route('admin.subproduk')}}"><em class="fa fa-arrow-right"></em> Sub Produk</a></li>
					<li class="" id="surveypusat"><a href="{{route('admin.hasilsurvey')}}"><em class="fa fa-arrow-right"></em> Survey Perpusat</a></li>
					<li class="" id="surveykomponen"><a href="{{route('admin.hasilsurveykomponen')}}"><em class="fa fa-arrow-right"></em> Survey Komponen</a></li>
					<li class="" id="stasiun"><a href="{{route('admin.stasiun')}}"><em class="fa fa-arrow-right"></em> Stasiun</a></li>
					<li class="" id="standardpelayanan"><a href="{{route('admin.standart')}}"><em class="fa fa-arrow-right"></em> Standard Pelayanan</a></li>
					<li style="display: none;" id="jenislayanan" class=""><a class="" href="{{ route('admin.jenislayanan') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Jenis Layanan
						</a></li>
					<li class=""><a class="" href="{{ route('admin.pusat') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Pusat
						</a></li>
					<li id="faq" class=""><a class="" href="{{ route('admin.faq') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> FAQ
						</a></li>
					<li style="display: none;" id="tentang" class=""><a class="" href="{{ route('admin.tentang') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Tentang
						</a></li>
					<li style="display: none;" id="lokasi" class=""><a class="" href="{{ route('admin.lokasi') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Lokasi & Informasi
						</a></li>
					<li id="lokasi" class=""><a class="" href="{{ route('admin.pertanyaan') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Pertanyaan
						</a></li>
					<li id="lokasi" class=""><a class="" href="{{ route('admin.informasi') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Informasi
						</a></li>
					<li class="" id="unsur"><a href="{{route('admin.unsur')}}"><em class="fa fa-arrow-right"></em> Unsur</a></li>
					
					<li id="katlayanandiklat" class=""><a class="" href="{{ route('admin.katlayanandiklat') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Layanan Diklat
						</a></li>
					<!--<li id="berita" class=""><a class="" href="{{ route('admin.berita') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Berita
						</a></li>-->
				</ul>
			</li>
			<li class="parent" id="katlayananjasa"><a data-toggle="collapse" href="#sub-item-2" style="display:none">
					<em class="fa fa-clone">&nbsp;</em> Kategori Layanan <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">

				</ul>
			</li>
			<!-- <li class="parent " id="tiket"><a data-toggle="collapse" href="#sub-item-3">
					<em class="fa fa-ticket">&nbsp;</em> Tiket Layanan<span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li id="tiketlayananjasa" class=""><a class="" href="{{ route('admin.tiketlayananjasa') }}">
							<span class="fa fa-arrow-right">&nbsp;</span>Tiket
						</a></li>
					<li id="tiketlayananproduk" class=""><a class="" href="{{ route('admin.tiketlayananproduk') }}">
							<span class="fa fa-arrow-right">&nbsp;</span>Peta
						</a>
					</li>
					<li id="pasangsurut" class=""><a class="" href="{{ route('admin.tiketlayananpasut') }}">
							<span class="fa fa-arrow-right">&nbsp;</span>Pasang Surut
						</a>
					</li>
					<li id="kasnegara" class=""><a class="" href="{{ route('admin.tiketlayanankasnegara') }}">
							<span class="fa fa-arrow-right">&nbsp;</span>Kas Negara
						</a>
					</li>
					<li id="tiketlayanankunjunganumum" class="" style="display: none;"><a class="" href="{{ route('admin.tiketlayanankunjunganumum') }}">
							<span class="fa fa-arrow-right">&nbsp;</span>Kunjungan Umum
						</a></li>
	
				</ul>
			</li> -->
			<li style="display: none;" id="pengaduan" class="parent"><a class="" href="{{ route('admin.pengaduan') }}">
					<span class="fa fa-clipboard">&nbsp;</span>Pengaduan(<?php echo CountAduan() ?>)
				</a></li>
			<li class="parent" id="tiketlayananjasa"><a href="{{ route('admin.tiketlayananjasa') }}"><em class="fa fa-arrow-right">&nbsp;</em>Tiket</a></li>
			<li class="parent" id="pesanxtiket"><a href="{{ route('admin.pesanxtiket') }}"><em class="fa fa-comment">&nbsp;</em> Pesan</a></li>
			<!-- <li class="parent" id="banner"><a href="{{ route('admin.banner') }}"><em class="fa fa-image"></em> Banner</a></li> -->
			<li class="parent" id="userpengguna"><a href="{{ route('admin.userpengguna') }}"><em class="fa fa-user"></em> User Pengguna</a></li>
			<li class="parent" id="customerLivechat"><a target="_blank" href="https://dashboard.tawk.to/login"><em class="fa fa-comments"></em> Customer Livechat</a></li>
			<!-- <li class="parent" id="kuesioner"><a href="{{route('admin.kuesioner')}}"><em class="fa fa-pencil fa-fw"></em> Kuesioner</a></li> -->
			<li class="parent" id="kuesioner"><a data-toggle="collapse" href="#sub-item-kuesioner">
					<em class="fa fa-ticket">&nbsp;</em> Kuesioner<span data-toggle="collapse" href="#sub-item-kuesioner" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-kuesioner">
					<li id="rekapKuesioner" class=""><a class="" href="{{ route('admin.kuesioner') }}">
							<span class="fa fa-arrow-right">&nbsp;</span>Rekap Hasil
						</a></li>
					<!-- <li id="perKuesioner" class=""><a class="" href="{{ route('admin.kuesionerTiket') }}">
							<span class="fa fa-arrow-right">&nbsp;</span>Kuesioner/Tiket
						</a></li> -->
					<li id="perKuesioner" class=""><a class="" href="{{ route('admin.index.belum.kuisoner') }}">
							<span class="fa fa-arrow-right">&nbsp;</span>Rekap Kuesioner
						</a></li>
					<!-- <li id="perKuesioner" class=""><a class="" href="{{ route('admin.exportKuesioner') }}">
							<span class="fa fa-arrow-right">&nbsp;</span>Export Kuesioner
						</a></li> -->
				</ul>
			</li>
			<li id="kasnegara" class="">
				<a class="" href="{{ route('admin.tiketlayanankasnegara') }}">
					<span class="fa fa-arrow-right">&nbsp;</span>Kas Negara
				</a>
			</li>
			<li class="parent" id="survey"><a href="{{route('admin.admin.survey')}}"><em class="fa fa-bar-chart fa-fw"></em> Survey</a></li>
			<li id="tiketlayanandiklat" class="" style=""><a class="" href="{{ route('admin.tiketlayanandiklat') }}">
					<span class="fa fa-bar-chart fa-fw">&nbsp;</span>Diklat
				</a>
			</li>
			@elseif(Auth::guard('internal')->user()->status == 2)
			<li id="tiketlayanandiklat" class="parent" style=""><a class="" href="{{ route('admin.tiketlayanandiklat') }}">
					<span class="fa fa-bar-chart fa-fw">&nbsp;</span>Diklat
				</a>
			</li>
			<li id="tiketlayananmes" class="parent" style=""><a class="" href="{{ route('admin.tiketlayananmes') }}">
					<span class="fa fa-bar-chart fa-fw">&nbsp;</span>Mes
				</a>
			</li>
			@else
			<li id="kasnegara" class="">
				<a class="" href="{{ route('admin.tiketlayanankasnegara') }}">
					<span class="fa fa-arrow-right">&nbsp;</span>Kas Negara
				</a>
			</li>
			@endif
			<li><a href="{{ route('internal.auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-internal').submit();"><em class="fa fa-power-off">&nbsp;</em> Logout</a>
				<form id="logout-form-internal" action="{{ route('internal.auth.logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			</li>
		</ul>
	</div>


	<script type="text/javascript">
		$(document).ready(function() {
			$('#sidebar-collapse ul li ul li a').click(function(e) {
				if ($(this).attr('class') != 'active') {
					$('#sidebar-collapse ul li a').removeClass('active');
					$(this).addClass('active');
				}
			});

			$('a').filter(function() {
				return this.href === document.location.href;
			}).addClass('active')
			$("ul.children.collapse > li > a").each(function() {
				var currentURL = document.location.href;
				var thisURL = $(this).attr("href");
				if (currentURL.indexOf(thisURL) != -1) {
					$(this).parents("ul.children.collapse").attr('class', 'children collapse in').css('margin', '0');
				}
			});
			// $('#sidebar-collapse > ul.nav > li.parent > a').each(function() {
			// 	var currURL = document.location.href;
			// 	var myHref = $(this).attr('href');
			// 	if (currURL.match(myHref)) {
			// 		$(this).addClass('active');
			// 		$(this).parent().find("ul.children.collapse").css('display', 'block');
			// 	}
			// });
			// $(".ul.children.collapse > li > a").on("click",function(){
			//     $(".ul.children.collapse").removeClass("active");
			//     $(this).addClass("active");
			// })
		});
	</script>
</body>

</html>




<!--/.sidebar-->