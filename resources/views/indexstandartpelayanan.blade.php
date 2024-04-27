<!DOCTYPE html>
<html lang="en">
@include('template.penggunaheader')

<style type="text/css">
    .form-control {
        height: 40px !important;
    }

    .nav-item a span {
        font-weight: bold;
        font-weight: 900;
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
        line-height: 15px;
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
        margin-top: 7rem;
        width: 550px;
        height: 500px;
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

    .highcharts-legend,
    .highcharts-credits {
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
            width: 23.5%;
        }
    }
</style>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    @include('template.penggunanavbar')


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
                                    <div class="col-xl-12 col-lg-12 col-xs-12" style="margin-top: 10px;important!">
                                        <a href=""><span>
                                                <center>
                                                    <img id="imgsig" src="{{ url('assets/digilab/images'.'/'.$master_standard->gambar) }}">
                                                </center>
                                            </span></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-7 col-lg-6 col-xs-6" style="margin-top: 10px;margin-left: 213px;padding-left: 69px;">
                                        <div class="card" id="contentlayanan">
                                            <div class="card-body pt-2">
                                                <center>
                                                    <h5 class="heading"><a href="#" class="textlayanan">{{$master_standard->text}}</a></h5>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <br>



    @include('template.penggunafooter')
    <script>
        $(document).ready(function() {
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
                        pendidikan += '<td>' + val.nama + '</td>';
                        pendidikan += '<td><center>' + val.jumlah + '</center></td>';
                        pendidikan += '<td style="float: right">' + val.persentase + ' %</td>';
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
                            // instansi += '<td>'+val.no+'</td>';
                            instansi += '<td>' + val.nama + '</td>';
                            instansi += '<td><center>' + val.jumlah + '</center></td>';
                            instansi += '<td style="float: right">' + val.persentase + ' %</td>';
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
                    type: 'bar',
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