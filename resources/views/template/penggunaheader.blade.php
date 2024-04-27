<head>
    <title>BIG</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/ico" href="{{url('assets/digilab/images/ico.png')}}" />
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="{{url('assets/digilab/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/digilab/css/animate.css')}}">

    <link rel="stylesheet" href="{{url('assets/digilab/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/digilab/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/digilab/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{url('assets/digilab/css/aos.css')}}">

    <link rel="stylesheet" href="{{url('assets/digilab/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{url('assets/digilab/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{url('assets/digilab/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{url('assets/digilab/css/style.css')}}">
    <!--Datatable-->
    <link rel="stylesheet" href="{{url('assets/digilab/css/dataTables.css')}}">
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> --}}
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Highchart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!--Date-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
      .shape{    
      border-style: solid; border-width: 0 70px 40px 0; float:right; height: 0px; width: 0px;
      -ms-transform:rotate(360deg); /* IE 9 */
      -o-transform: rotate(360deg);  /* Opera 10.5 */
      -webkit-transform:rotate(360deg); /* Safari and Chrome */
      transform:rotate(360deg);
      }
      .offer{
        background:#fff; border:1px solid #ddd; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); margin: 15px 0; overflow:hidden;
      }
      .offer:hover {
          -webkit-transform: scale(1.1); 
          -moz-transform: scale(1.1); 
          -ms-transform: scale(1.1); 
          -o-transform: scale(1.1); 
          transform:rotate scale(1.1); 
          -webkit-transition: all 0.4s ease-in-out; 
      -moz-transition: all 0.4s ease-in-out; 
      -o-transition: all 0.4s ease-in-out;
      transition: all 0.4s ease-in-out;
          }
      .shape {
        border-color: rgba(255,255,255,0) #d9534f rgba(255,255,255,0) rgba(255,255,255,0);
      }
      .offer-radius{
        border-radius:7px;
      }
      .offer-danger {	border-color: #d9534f; }
      .offer-danger .shape{
        border-color: transparent #d9534f transparent transparent;
      }
      .offer-success {	border-color: #5cb85c; }
      .offer-success .shape{
        border-color: transparent #5cb85c transparent transparent;
      }
      .offer-default {	border-color: #999999; }
      .offer-default .shape{
        border-color: transparent #999999 transparent transparent;
      }
      .offer-primary {	border-color: #428bca; }
      .offer-primary .shape{
        border-color: transparent #428bca transparent transparent;
      }
      .offer-info {	border-color: #5bc0de; }
      .offer-info .shape{
        border-color: transparent #fea621 transparent transparent;
      }
      .offer-warning {	border-color: #f0ad4e; }
      .offer-warning .shape{
        border-color: transparent #f0ad4e transparent transparent;
      }

      .shape-text{
        color:#fff; font-size:12px; font-weight:bold; position:relative; right:-40px; top:2px; white-space: nowrap;
        -ms-transform:rotate(30deg); /* IE 9 */
        -o-transform: rotate(360deg);  /* Opera 10.5 */
        -webkit-transform:rotate(30deg); /* Safari and Chrome */
        transform:rotate(30deg);
      }	
      .offer-content{
        padding:0 20px 10px;
      }
      @media (min-width: 487px) {
        .container {
          max-width: 750px;
        }
        .col-sm-6 {
          width: 50%;
        }
      }
      @media (min-width: 900px) {
        .container {
          max-width: 970px;
        }
        .col-md-4 {
          width: 33.33333333333333%;
        }
      }

      @media (min-width: 1200px) {
        .container {
          max-width: 1300px;
        }
        .col-lg-3 {
          width: 25%;
        }
      }
    </style>
    <!-- Modal CSS -->
    <style type="text/css">
      body {font-family: Arial, Helvetica, sans-serif;}

      .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 100; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      }

      /* Modal Content */
      .modal-content {
        position: relative;
        background-image: linear-gradient(to right, #0a416b , #339eb9);
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 45%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
      }

      /* Add Animation */
      @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0} 
        to {top:0; opacity:1}
      }

      @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
      }

      /* The Close Button */
      .close {
        color: #858585;
        float: right;
        font-size: 28px;
        font-weight: bold;
      }

      .close:hover,
      .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
      }

      .modal-header {
        padding: 2px 16px;
        background-color: #fff;
        color: white;
      }

      .modal-body {padding: 2px 16px;}

      .modal-footer {
        padding: 2px 16px;
        background-color: #fff;
        color: white;
      }
      .iconImage{
        width: 85%;
        height : 100%;
        margin: 0px 10px 0px 10px;
        padding: 10px 0px 10px 5px;
        cursor : pointer;
      }
      @font-face {
        font-family: 'FontPresentase';
        src: url('../public/assets/digilab/fonts/arialbd.ttf')  format('truetype');
      }
    </style>
</head>

<body>

  <script>
  $(document).ready(function(){
    // $.ajax({
    //   url: "{{url('/pengguna/kepuasan')}}",
    //   type: "POST",
    //   data:{ 
    //       _token:'{{ csrf_token() }}'
    //   },
    //   cache: false,
    //   dataType: 'json',
    //   success:function(dataResult) {
    //     // console.log(dataResult);
        
    //     var len = 0;
    //     if(dataResult['data'] != null){
    //           len = dataResult['data'].length;
    //        }
        
    //         if(len > 0){
    //             for(var i=0; i<len; i++){
    //               var id = dataResult['data'][i].id;
    //               var kategori = dataResult['data'][i].kategori;
    //               var no_tiket = dataResult['data'][i].no_tiket;
    //               var id_pengguna = dataResult['data'][i].id_pengguna;
    //               var status = dataResult['data'][i].status_kepuasan;
    //               if(status == null){
    //                 var tr_str = "<tr>" +
    //                   "<td align='center'><input type='text' id='id_tiket' value='"+ id +"'></td>" +
    //                   "<td align='center'><input type='text' id='kat_tiket' value='"+ kategori +"'></td>" +
    //                   "<td align='center'><input type='text' id='id_pengguna_tiket' value='"+ id_pengguna +"'></td>" +
    //                 "</tr>";

    //                 $("#modalkepuasan tbody").append(tr_str);
    //                 $('#myModal').show();
    //               }
    //             }
    //         }else{
    //             var tr_str = "<tr>" +
    //                         "<td align='center' colspan='4'>No record found.</td>" +
    //                         "</tr>";

    //             $("#modalkepuasan tbody").append(tr_str);
    //         }
    //     }
    // });
  });

  $('#stp, #close').click(function(){
      var sangat_tp = 1;
      var id_terkait = $('#id_tiket').val();
      var ket_kep = $('#kat_tiket').val();
      var peng_kep = $('#id_pengguna_tiket').val();
      
        $.ajax({
        url: "{{url('/insert/kepuasan')}}",
        type: "POST",
        data:{ 
            _token:'{{ csrf_token() }}',
            id_terkait,
            ket_kep,
            peng_kep,
            sangat_tp
        },
        cache: false,
        dataType: 'json',
        success:function(response) {
          location.reload();
        }
      });
  });

  $('#tp').click(function(){
      var sangat_tp = 2;
      var id_terkait = $('#id_tiket').val();
      var ket_kep = $('#kat_tiket').val();
      var peng_kep = $('#id_pengguna_tiket').val();
      
        $.ajax({
        url: "{{url('/insert/kepuasan')}}",
        type: "POST",
        data:{ 
            _token:'{{ csrf_token() }}',
            id_terkait,
            ket_kep,
            peng_kep,
            sangat_tp
        },
        cache: false,
        dataType: 'json',
        success:function(response) {
          location.reload();
        }
      });
  });

  $('#p').click(function(){
      var sangat_tp = 3;
      var id_terkait = $('#id_tiket').val();
      var ket_kep = $('#kat_tiket').val();
      var peng_kep = $('#id_pengguna_tiket').val();
      
        $.ajax({
        url: "{{url('/insert/kepuasan')}}",
        type: "POST",
        data:{ 
            _token:'{{ csrf_token() }}',
            id_terkait,
            ket_kep,
            peng_kep,
            sangat_tp
        },
        cache: false,
        dataType: 'json',
        success:function(response) {
          location.reload();
        }
      });
  });

  $('#sp').click(function(){
      var sangat_tp = 4;
      var id_terkait = $('#id_tiket').val();
      var ket_kep = $('#kat_tiket').val();
      var peng_kep = $('#id_pengguna_tiket').val();
      
        $.ajax({
        url: "{{url('/insert/kepuasan')}}",
        type: "POST",
        data:{ 
            _token:'{{ csrf_token() }}',
            id_terkait,
            ket_kep,
            peng_kep,
            sangat_tp
        },
        cache: false,
        dataType: 'json',
        success:function(response) {
          location.reload();
        }
      });
  });

  
  </script>
</body>
