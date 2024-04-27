	<script src="{{url('assets/lumino/js/jquery-1.11.1.min.js')}}"></script>
	<script src="{{url('assets/lumino/js/bootstrap.min.js')}}"></script>
	<script src="{{url('assets/lumino/js/chart.min.js')}}"></script>
	<script src="{{url('assets/lumino/js/chart-data.js')}}"></script>
	<!--<script src="{{url('assets/lumino/js/easypiechart.js')}}"></script>
	<script src="{{url('assets/lumino/js/easypiechart-data.js')}}"></script>-->
	<script src="{{url('assets/lumino/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{url('assets/lumino/js/custom.js')}}"></script>

	<!-- DataTables -->
	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!--sweetalert-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<!--sweetalertEND-->
	<script>
		function fileValidasi(id) {
			var fileInput = document.getElementById(id);
			var file = fileInput.files[0];
			var filePath = fileInput.value;
			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
			if (!allowedExtensions.exec(filePath)) {
				Swal.fire(
					'Format File Tidak Sesuai !',
					'File yang biasa di upload .jpg/.jpeg/.png.',
					'info'
				)
				fileInput.value = '';
				return false;
			}
		}
	</script>