<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BIG</title>

	<link rel="icon" type="image/ico" href="{{url('assets/digilab/images/ico.png')}}" />
	<link href="{{url('assets/lumino/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/lumino/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/lumino/css/datepicker3.css')}}" rel="stylesheet">
	<link href="{{url('assets/lumino/css/styles.css')}}" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!--Datatable-->
	<link rel="stylesheet" href="{{url('assets/digilab/css/dataTables.css')}}">
        {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> --}}

</head>
	<style>

	    .notification {
		    text-decoration: none;
		    position: relative;
		    display: inline-block;
		 }

		  .notification .badge {
		    position: absolute;
		    top: -10px;
		    right: -10px;
		    background-color: #ff303a;
		    color: white;
		}
		.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
			color: #110674 !important;
		}
		.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.next, .dataTables_wrapper .dataTables_paginate .paginate_button.previous, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
			cursor: default;
			color: white !important;
			border: 1px solid #110674;
			box-shadow: none;
			border-radius: 50%;
			margin: 1px;
			font-weight: 700;
			background: #110674;
		}
		thead.table-primary {
			background: #110674;
			color: white;
		}
		table.dataTable.no-footer, table.dataTable thead th, table.dataTable thead td {
			border-bottom: none;
		}
	</style>