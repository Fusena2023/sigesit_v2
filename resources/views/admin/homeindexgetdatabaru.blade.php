					<style>
						.panel-body.easypiechart-panel {
							background: black;
							border-top-right-radius: 30px;
							border-bottom-left-radius: 30px;
						}
						h4 {
							float: left;
							padding-left: 10px;
							color: white !important;
						}
						h2 {
							color: white !important;
						}
					</style>
					
					<div class="col-xs-6 col-md-3">
						<div class="panel panel-default" style="background: none">
							<div class="panel-body easypiechart-panel" style="background-color: #00a6fb">
								<h4>Layanan Jasa Bulan Ini</h4>
								<div class="easypiechart" id="easypiechart-white" data-percent="92" ><h2>{{ $jumlahjasabulan }}</h2></div>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-3">
						<div class="panel panel-default" style="background: none">
							<div class="panel-body easypiechart-panel" style="background-color: #0582ca">
								<h4>Layanan Berbayar Bulan Ini</h4>
								<div class="easypiechart" id="easypiechart-white" data-percent="65" ><h2>{{ $jumlahprodbulan }}</h2></div>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-3">
						<div class="panel panel-default" style="background: none">
							<div class="panel-body easypiechart-panel" style="background-color: #006494">
								<h4>Layanan IG Nol Rupiah Bulan Ini</h4>
								<div class="easypiechart" id="easypiechart-white" data-percent="56" ><h2>{{ $jumlahdikbulan }}</h2></div>
							</div>
						</div>
					</div>
					