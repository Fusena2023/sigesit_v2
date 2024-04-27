<!DOCTYPE html>
<html lang="en">
@include('template.penggunaheader')

<style type="text/css">
    .nav-item a span {
        font-weight: bold;
        /* font-weight: 900; */
        /* border-width: 2px;
      border-style: outset;
      border-radius: 40px; */
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

    .modal-content-penilaian {
        margin-left: 30px;
        padding: 0px;
        width: 24%;
    }

    @font-face {
        font-family: 'FontPresentase';
        src: url('../public/assets/digilab/fonts/arialbd.ttf') format('truetype');
    }
    @media (max-width: 767.98px) {
        #homeprofile2 {
            margin-bottom: 30px !important;
            margin-top: 2cm;
        }
        img.imglynpublik {
            height: 50% !important;
            width: 180% !important;
            margin-left: -70px !important;
            margin-top: 260px;
            /* margin-left: -108px; */
            position: absolute;
        }
        img.imghallo {
            width: 155px !important;
        }
        h1.textbantuan{
            font-size: 15px !important;
        }
        p.textcontent {
            padding-left: 1rem !important;
            font-size: 12px !important;
            padding-top: 1rem !important;
        }
        h4.textchat {
            font-size: 15px !important;
        }
    }
    img.imglynpublik{
        height: 115%;
        width: 250%;
        margin-left: -235px;
    }

    img.imghallo{
        width: 300px
    }

    p.textcontent {
        padding-left: 5.2cm;
        text-align: justify;
        font-size: 20px;
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

    #about-section table tbody tr:nth-child(odd) {
        background-color: #ccf0ff;
        color: #006b99;
    }

    #about-section table tbody tr:nth-child(even) {
        background-color: #fff4cc;
        color: #665000;
    }

    #about-section table th {
        padding: 5px;
        font-size: 1.11em;
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
        border-right: 1px solid #5767c8;
        border-left: 1px solid #5767c8;
    }

    .highcharts-legend,
    .highcharts-credits {
        display: none;
    }
    @media (min-width: 1200px){
        #layananpublikc {
            max-width: 1300px;
        }
    }
</style>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    @include('template.penggunanavbar')

    <section id="home-section" class="">
        <div class="one-forth d-flex js-fullheight align-items-center ftco-animate">
            <div class="container" style="margin-top: 150px">
                <div class="text" style="background-image:url({{url('upload/bgprofile.png')}});border-radius: 25px;padding: 73px; background-size: cover; ">
                    <span class="subheading"></span>
                    <h2 class="mb-4 mt-3" style="color:white;text-align:center"><span>Aplikasi Pelayanan Terpadu Informasi <br> Geospasial (PTIG)</span></h2>
                    <p style="text-align:center;color:#f2f2f7">
                        Pimpinan dan seluruh pegawai Pusat Peneletian,Promosi dan Kerjasama Badan Informasi<br>
                        Geospasial (BIG) berkomitmen menyelenggarakan kegiatan dan memberikan pelayanan<br>
                        secara profesional dalam mendukung mewujudkan peran BIG sebagai penyedia informasi<br>
                        geospasial yang lengkap,andal dapat di pertanggung jawabkan.
                    </p>
                    <p>
                        <hr style="height:2px;color:#497FB2;background-color:#497FB2;">
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section" id="projects-section" style="padding:0em!important">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="blog-entry justify-content-end" id="homeprofile2">
                        <!-- <a href="#" class="block-20" style="background-image:url({{url('upload/Group_57.png')}});background-size: 60% 60%;border-top-left-radius: 25px;border-top-right-radius: 25px;">
                        </a> -->
                        <img src="{{url('upload/home2.png')}}" alt="" style="height: 100%;width:80%">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section" id="projects-section" style="padding:0em!important">
        <div class="container">
            <div class="row m-3">
                <div class="col-8 col-lg-6 col-xl-10 p-4 pl-5" style="background: #a7ddff; border-radius: 35px">
                    <h1 class="heading" style="color:#100674 ;"><b>Layanan Publik</b></h1>
                    <p>
                        <hr style="height:2px;color:#497FB2;background-color:white;">
                    </p>
                    <p>
                        <a href="#">Layanan Jasa Konsultasi</a>
                    </p>
                    <p>
                        <a href="#">Layanan Produk Daring</a>
                    </p>
                    <p>
                        <a href="#">Layanan Produk IG Nol Rupiah</a>
                    </p>
                    <p>
                        <a href="#">Layanan Produk IG, Jasa dan Diklat Berbayar</a>
                    </p>
                    <p>
                        <a href="#">Layanan Pembayaran Ke Kas Negara</a>
                    </p>
                </div>
                <div class="col-4 col-lg-6 col-xl-2">
                    <a href="">
                        <img class="imglynpublik" src="{{url('upload/robot.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <br><br><br>
    <section class="ftco-section" id="projects-section" style="padding:0em!important">
        <div class="container">
            <div>
                <div class="row m-2" style="background-color: #f7fcff;border-radius: 46px; "
                {{-- width: 77%;" --}}
                >
                    <div class="col-6 col-lg-6 col-xl-6">
                        <img src="{{url('upload/hallo.png')}}" class="imghallo" alt="">
                    </div>
                    {{-- <div class="col-2 col-lg-2 col-xl-2">
                        <img src="{{url('upload/group_78.png')}}" alt="" style="height: 40%;width: 65%;margin-left: -82px;margin-top: 40px;">
                    </div> --}}
                    <div class="col-6 col-lg-6 col-xl-6 pt-4">
                        <h1 style="color: #100674;" class="textbantuan"><b>PERLU BANTUAN?</b></h1>
                    </div>
                    <div class="col-12 col-lg-12 col-xl-12"
                    {{-- style="margin-top: 38px;margin-left: 75px;" --}}
                    >
                        <p class="textcontent">
                            Kami akan membantu Anda untuk menjelaskan secara langsung
                            kesulitan dalam menggunakan aplikasi ini. layanan online siap
                            berintraksi dengan Anda sekarang. Katakan Sesuatu untuk
                            memulai obrolan langsung.
                        </p>
                    </div>
                    <div class="col-6 col-lg-6 col-xl-6"></div>
                    <div class="col-6 col-lg-6 col-xl-6" style="text-align: end">
                        <h4 class="textchat"> <a href="" style="color: #55baf1"><b>Chat Sekarang</b></a></h4>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <br><br>

    @include('template.penggunafooterNew')
    <script>
        $(document).ready(function() {
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
                    // console.log(dataCount);
                    $('#sapu').html(dataCount.data4 + '%');
                    $('#puas').html(dataCount.data3 + '%');
                    $('#cupu').html(dataCount.data2 + '%');
                    $('#tipu').html(dataCount.data1 + '%');
                }
            });

            hasilSurvey();
            respondenKelamin();
            respondenPendidikan();
            respondenInstansi();
            $('#tahunSurvey').change(function() {
                hasilSurvey();
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
                            html += '<td>' + no + '</td>';
                            html += '<td><center>' + t + '</center></td>';
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

        function respondenKelamin() {
            $.get(
                "{{url('/home/getResponden/kelamin')}}",
                function(res) {
                    var data = JSON.parse(res);
                    var kelamin = '';

                    kelamin += '<tr>';
                    kelamin += '<td>1</td>';
                    kelamin += '<td><center>Laki-Laki</center></td>';
                    kelamin += '<td>' + data.table.laki + '</td>';
                    kelamin += '<td>' + data.table.laki_persentase + ' %</td>';
                    kelamin += '</tr>';
                    kelamin += '<tr>';
                    kelamin += '<td>2</td>';
                    kelamin += '<td><center>Perempuan</center></td>';
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
                        pendidikan += '<td>' + val.no + '</td>';
                        pendidikan += '<td><center>' + val.nama + '</center></td>';
                        pendidikan += '<td>' + val.jumlah + '</td>';
                        pendidikan += '<td>' + val.persentase + ' %</td>';
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
                    var instansi = '';
                    if (data.data.length > 0) {
                        $.each(data.data, function(i, val) {
                            instansi += '<tr>';
                            instansi += '<td>' + val.no + '</td>';
                            instansi += '<td><center>' + val.nama + '</center></td>';
                            instansi += '<td>' + val.jumlah + '</td>';
                            instansi += '<td>' + val.persentase + ' %</td>';
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
                    type: 'bar'
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

        function defaultGrafik2(data) {
            Highcharts.chart('defaultGrafik2', {
                chart: {
                    type: 'bar'
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

        function defaultGrafik3(data) {

            Highcharts.chart('defaultGrafik3', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45
                    }
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
                    }
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