<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>


<script> 
		var lineChartData = {
				labels : ["January","February","March","April","May","June","July","Agustus","September","Oktober","November","Desember"],
				datasets : [
					{
						label: "My First dataset",
						fillColor : "#fff0",
						strokeColor : "rgba(48, 164, 255, 1)",
						pointColor : "rgba(48, 164, 255, 1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(48, 164, 255, 1)",
						data : [{{$jumlahjasajan}},{{$jumlahjasafeb}},{{$jumlahjasamar}},{{$jumlahjasaapr}},{{$jumlahjasamei}},{{$jumlahjasajun}},{{$jumlahjasajul}},{{$jumlahjasaags}},{{$jumlahjasasep}},{{$jumlahjasaokt}},{{$jumlahjasanov}},{{$jumlahjasades}}]
					},
					{
						label: "My Second dataset",
						fillColor : "#fff0",
						strokeColor : "rgba(255, 181, 62, 1)",
						pointColor : "rgba(255, 181, 62, 1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(255, 181, 62, 1)",
						data : [{{$jumlahprodjan}},{{$jumlahprodfeb}},{{$jumlahprodmar}},{{$jumlahprodapr}},{{$jumlahprodmei}},{{$jumlahprodjun}},{{$jumlahprodjul}},{{$jumlahprodags}},{{$jumlahprodsep}},{{$jumlahprodokt}},{{$jumlahprodnov}},{{$jumlahproddes}}]
					},
					{
						label: "My Third dataset",
						fillColor : "#fff0",
						strokeColor : "rgba(30, 191, 174, 0.72)",
						pointColor : "rgba(30, 191, 174, 0.72)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(30, 191, 174, 0.72)",
						data : [{{$jumlahdikjan}},{{$jumlahdikfeb}},{{$jumlahdikmar}},{{$jumlahdikapr}},{{$jumlahdikmei}},{{$jumlahdikjun}},{{$jumlahdikjul}},{{$jumlahdikags}},{{$jumlahdiksep}},{{$jumlahdikokt}},{{$jumlahdiknov}},{{$jumlahdikdes}}]
					}
				]

			}
	</script>

	<script>  
			var chart1 = document.getElementById("line-chart").getContext("2d");
			window.myLine = new Chart(chart1).Line(lineChartData, {
				responsive: true,
				scaleLineColor: "rgba(0,0,0,.2)",
				scaleGridLineColor: "rgba(0,0,0,.05)",
				scaleFontColor: "#c5c7cc"
			});
	</script>