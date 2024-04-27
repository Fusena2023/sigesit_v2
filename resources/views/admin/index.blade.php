<!DOCTYPE html>
<html>
@include('template.adminheader')
<body>
	<style>
		#panelhilang1 {
			background-image: url('../assets/digilab/images/Group 194.png');
			background-size: cover;
			margin-left: 20px;
			/* background: gray; */
			border-bottom-right-radius: 30px;
		}
		#panelhilang2 {
			background-image: url('../assets/digilab/images/Group 195.png');
			background-size: cover;
			margin-left: 20px;
			/* background: gray; */
			border-bottom-right-radius: 30px;
		}
		#panelhilang3 {
			background-image: url('../assets/digilab/images/Group 196.png');
			background-size: cover;
			margin-left: 20px;
			/* background: gray; */
			border-bottom-right-radius: 30px;
		}
		#panelhilang4 {
			background-image: url('../assets/digilab/images/Group 197.png');
			background-size: cover;
			margin-left: 20px;
			/* background: gray; */
			border-bottom-right-radius: 30px;
		}
		.panel.panel-container {
			background: none;
		}
		.panel-body.easypiechart-panel {
			background: black;
			border-top-right-radius: 30px;
			border-bottom-left-radius: 30px;
		}
		#divmuncul, #divmuncul2, #divmuncul3, #divmuncul4{
			float: right;
			padding-right: 30px
		}
	</style>
	@include('template.adminnavbar')
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container" style="box-shadow: none">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right" id="panelhilang1">
						<div class="row no-padding">
							<div id="divmuncul"></div>
							<img id="hilang1" src="{{asset('assets/lumino/images/loading.gif')}}" style="width:100px;height:100px:">
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right" id="panelhilang2">
						<div class="row no-padding">
							<div id="divmuncul2"></div>
							<img id="hilang2" src="{{asset('assets/lumino/images/loading.gif')}}" style="width:100px;height:100px:">
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right" id="panelhilang3">
						<div class="row no-padding">
							<div id="divmuncul3"></div>
							<img id="hilang3" src="{{asset('assets/lumino/images/loading.gif')}}" style="width:100px;height:100px:">
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding" style="display: none;">
					<div class="panel panel-teal panel-widget border-right" id="panelhilang4">
						<div class="row no-padding">
							<div id="divmuncul4"></div>
							<img id="hilang4" src="{{asset('assets/lumino/images/loading.gif')}}" style="width:100px;height:100px:">
						</div>
					</div>
				</div>
			</div><!--/.row-->
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Grafik Tiket Dibuat
						<ul class="pull-right panel-settings panel-button-tab-right">
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="panel-body">
							<div class="canvas-wrapper">
								<div id="divmunculgrafik"></div><center>
								<img id="hilanggarfik" src="{{asset('assets/lumino/images/loading.gif')}}" style="width:100px;height:100px:"></center>
								<!--<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>-->
							</div>
						</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div id="divmunculbaru">
			  	<div id="divhilangbaru">
					<div class="col-xs-6 col-md-3">
						<div class="panel panel-default" style="background: none">
							<div class="panel-body easypiechart-panel" style="background-color: #00a6fb">
								<h4>Layanan Jasa Bulan Ini</h4><center>
								<img id="hilanggarfik" src="{{asset('assets/lumino/images/loading.gif')}}" style="width:100px;height:100px:"></center>
								<!--<div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span></div>-->
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-3">
						<div class="panel panel-default" style="background: none">
							<div class="panel-body easypiechart-panel" style="background-color: #0582ca">
								<h4>Layanan Poduk Bulan Ini</h4><center>
								<img id="hilanggarfik" src="{{asset('assets/lumino/images/loading.gif')}}" style="width:100px;height:100px:"></center>
								<!--<div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span></div>-->
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-3">
						<div class="panel panel-default" style="background: none">
							<div class="panel-body easypiechart-panel" style="background-color: #006494">
								<h4>Layanan Diklat Bulan Ini</h4><center>
								<img id="hilanggarfik" src="{{asset('assets/lumino/images/loading.gif')}}" style="width:100px;height:100px:"></center>
								<!--<div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span></div>-->
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-3" style="display: none;">
						<div class="panel panel-default" style="background: none">
							<div class="panel-body easypiechart-panel" style="background-color: #051923">
								<h4>Layanan Lain nya Bulan Ini</h4>
								<center>
								<img id="hilanggarfik" src="{{asset('assets/lumino/images/loading.gif')}}" style="width:100px;height:100px:"></center>
								<!--<div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span></div>-->
							</div>
						</div>
					</div>
			  	</div>
			</div>
		</div><!--/.row-->

	</div>	<!--/.main-->
	
	@include('template.adminfooter')


	<script> 
		$(document).ready(function () {

				$.get('{{URL::to("admin/home/getdata1")}}',function(data){
                    $('#divmuncul').html(data);
                    $("#hilang1").css("display", "none");
                })

                $.get('{{URL::to("admin/home/getdata2")}}',function(data){
                    $('#divmuncul2').html(data);
                    $("#hilang2").css("display", "none");
                })

                $.get('{{URL::to("admin/home/getdata3")}}',function(data){
                    $('#divmuncul3').html(data);
                    $("#hilang3").css("display", "none");
                })

                $.get('{{URL::to("admin/home/getdatagrafik")}}',function(data){
                    $('#divmunculgrafik').html(data);
                    $("#hilanggarfik").css("display", "none");
                })

                $.get('{{URL::to("admin/home/getdatabaru")}}',function(data){
                    $('#divmunculbaru').html(data);
                    $("#divhilangbaru").css("display", "none");
                })


		});
	</script>
	
		
</body>
</html>