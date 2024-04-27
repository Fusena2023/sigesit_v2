<!DOCTYPE html>
<html lang="en">
  @include('template.penggunaheader')
  <style>
    .kepentingan {
      background-color: #bcf592;
      text-align: center;
  }
  .kepuasan {
    background-color: #ffe29d;
    text-align: center;
}
  </style>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	  
	  @include('template.penggunanavbarfaq')

    <section class="ftco-section contact-section" id="contact-section">
      <div class="container">
        <div class="row justify-content-center pb-5">
          <div class="col-md-6 heading-section text-center ftco-animate">
            {{-- <span class="subheading"><a href="{{ route('pengguna.tiket' )}}">Tiket </a>/ Layanan Produk</span>
            <h2 class="mb-4">Layanan Produk</h2>
            <p>Buat Tiket Layanan Produk</p> --}}
          </div>
        </div>
        <div class="row no-gutters block-9">
              <form method="POST" action="{{ route('pengguna.simpantiketlayananproduk') }}" id="form" class="bg-light p-5 contact-form" name="formsubmit">
                @csrf
                <div class="col-sm-12">
                  <input type="hidden" name="no_tiket" class="form-control" value="{{ $end }}" id="no_tiket">
                  <h4>&nbspNomer Tiket &nbsp {{ $end }}</h4>
                </div>
                <div class="col-sm-12">
                  <h5>&nbspLayanan Produk &nbsp</h5>
                </div>
                <div class="col-sm-12">
                  <input type="hidden" name="id_pengguna" value="{{ Auth::guard('pengguna')->user()->id }}" class="form-control">
                  <h5>&nbsp{{ Auth::guard('pengguna')->user()->nama }}</h5>
                  <input type="hidden" name="nama_pengguna" value="{{ Auth::guard('pengguna')->user()->nama }}" class="form-control">
                </div>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="text" id="tanggal" name="tanggal" class="form-control col-sm-6" placeholder="Pilih Tanggal" required>
                  </div>
                </div>
                <div class="col-sm-12" style="margin-top:20px;margin-bottom:10px;display:none;">
                  <div class="input-group">
                      <select name="jenis" id="jenis" class="form-control col-sm-6 jenis">
                            <option value="" selected>--Pilih Jenis Produk--</option>
                            <option value="1">Peta</option>
                            <option value="3">Buku/Pedoman</option>
                      </select>
                      <div id="loaderForm" style="display:none;" class="input-group-addon"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div style="margin-top:10px" id="bukuField"></div>
                </div>
                <div class="col-sm-12" id="keranjangField" style="display:none">
                  <input type="hidden" id="numbRows" value="0">
                  <table id="tbKeranjang" class="table table-bordered" width="100%">
                    <thead class="kepuasan">
                      <tr>
                        <th colspan="6"><center>KERANJANG PEMBELIAN</center></th>
                      </tr>
                      <tr>
                        <th>No</th>
                        <th width="20%">Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Harga Total</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="kepentingan"></tbody>
                    <tfoot class="kepuasan">
                      <tr>
                        <td colspan="4"><center>TOTAL</center></td>
                        <td ><span id="totalHargaDiKeranjang">0</span></td>
                        <td></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="col-sm-12">
                  <div class="col-sm-10">
                      <button type="button" onclick="submitBro()" class="btn btn-primary py-3 px-5 mt-5">Kirim</button>
                  </div>
                </div>
                
              </form>
        </div>
        
      </div>
    </section>


    @include('template.penggunafooter')
    
    <script type="text/javascript">
      $(document).ready(function(){
        let jenis_produk = '{{ $jenis_produk }}';
        if(jenis_produk == 'peta'){
          var jenis = 1;
        }else{
          var jenis = 3;
        }
        
        if(jenis != ''){
          $('#keranjangField').show();
          
          $.ajax({
            type: 'POST',
            url: "{{ route('pengguna.tiketlayananproduk.fetch_data_katalog') }}",
            data: {
              _token:"{{ csrf_token() }}",
              jenis:jenis
            },
            beforeSend: function() {
                $('#loaderForm').show();
            },
            success: function(data) {
              $('#loaderForm').hide();
               $('#bukuField').html(data);
            },
            error: function(xhr) { // if error occured

                $('#loaderForm').hide();
                console.log(xhr.statusText + xhr.responseText);
                
            },
            complete: function() {
              $('#loaderForm').hide();
            }
          });
        }else{
          $('#keranjangField').hide();
          $('#bukuField').html('');
        }
      })

      flatpickr("#tanggal", {
        minDate: "today",
        maxDate: new Date().fp_incr(14) // 14 days from now
      });

      /* $("#form").submit(function(event) {
          event.preventDefault();
          var no_antrian = document.getElementById('no_tiket').value;
          var nama = "{{ Auth::guard('pengguna')->user()->nama }}";
          var tanggal = document.getElementById('tanggal').value;

          var html = '<hr><div class="col-md-12">'+
                    '<div class="form-group">'+
                      '<h5>'+ no_antrian +'</h5>'+
                    '</div>'+
                    '<div class="form-group">'+
                      '<p>Tanggal &nbsp:&nbsp'+ tanggal +'</p>'+
                    '</div></div>';

            Swal.fire({
              position: 'mid-end',
              title: 'Buat Tiket Layanan Produk',
              html: html,
              showCancelButton: true,
              cancelButtonText:'Batal',
            }).then(function(result) {
                  if (result.value) {
                      document.formsubmit.submit();
                  } else if (result.value === 0) {
                      Swal.fire({
                          type: 'error',
                          text: "Batal Simpan"
                      });

                  } else {
                      console.log(`modal was dismissed by ${result.dismiss}`)
                  }
            })

      }); */

      $('.jenis').change(function(){
        let jenis = $(this).val();
        
        if(jenis != ''){
          $('#keranjangField').show();
          
          $.ajax({
            type: 'POST',
            url: "{{ route('pengguna.tiketlayananproduk.fetch_data_katalog') }}",
            data: {
              _token:"{{ csrf_token() }}",
              jenis:jenis
            },
            beforeSend: function() {
                $('#loaderForm').show();
            },
            success: function(data) {
              
              $('#loaderForm').hide();
               $('#bukuField').html(data);
            },
            error: function(xhr) { // if error occured

                $('#loaderForm').hide();
                console.log(xhr.statusText + xhr.responseText);
                
            },
            complete: function() {
              $('#loaderForm').hide();
            }
          });
        }else{
          $('#keranjangField').hide();
          $('#bukuField').html('');
        }
      });

      function tambahItemKeKeranjang(id_sub,persatuan,nama_lembar)
      {
        
        var html = '<hr><div class="col-md-12">'+
                    '<div class="form-group">'+
                      '<h5>Nama Produk : '+ nama_lembar +'</h5>'+
                    '</div>'+
                    '</div>';
        Swal.fire({
              position: 'mid-end',
              title: 'Tambahkan ke keranjang?',
              html: html,
              input:'number',
              inputValue:1,
              showCancelButton: true,
              cancelButtonText:'Batal',
              didOpen: () => {
                const input = Swal.getInput()
                input.setSelectionRange(0, input.value.length)
              }
            }).then(function(result) {
                  if (result.value) {
                      //console.log(result.value);
                      addrow(id_sub,persatuan,nama_lembar,result.value);
                  } else {
                      console.log(`modal was dismissed by ${result.dismiss}`)
                  }
        })

      }

      function addrow(id_sub,persatuan,nama_lembar,jumlah){
        var no = parseInt($('#numbRows').val());
        var html='';
        
        $('#numbRows').val(no+1);
        html +='<tr id="dinamisKeranjang'+$('#numbRows').val()+'">';
          html +='<td>'+$('#numbRows').val()+'</td>';
          html +='<td>'+nama_lembar+'</td>';
          html +='<td>'+jumlah+'<input type="hidden" name="id_sub[]" value="'+id_sub+'"><input type="hidden" class="jumlahHitung" id="jumlah'+$('#numbRows').val()+'" name="jumlah[]" min="1" value="'+jumlah+'"></td>';
          html +='<td>'+formatRupiah(persatuan)+'<input type="hidden" readonly id="satuan'+$('#numbRows').val()+'" name="satuan[]" value="'+persatuan+'"></td>';
          html +='<td>'+formatRupiah((persatuan*jumlah))+'<input type="hidden" id="totalHarga'+$('#numbRows').val()+'" class="totalHarga" readonly value="'+(persatuan*jumlah)+'"></td>';
          html +='<td><button type="button" onclick="removeRow('+$('#numbRows').val()+')" class="btn btn-danger py-1 px-3 mt-0"><span class="icon icon-times"></span></button></td>';
        html +='</tr>';

        $('#tbKeranjang tbody').append(html);
        totalAll();
      }

      /* Fungsi formatRupiah */
      function formatRupiah(angka){
        var	number_string = angka.toString(),
        sisa 	= number_string.length % 3,
        rupiah 	= number_string.substr(0, sisa),
        ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
          
        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }
  
        return rupiah;
      }

      function removeRow(no)
      {
          var cek = parseInt($('#numbRows').val());
          if (cek != 0) {
              $('#numbRows').val(cek - 1);
          }
          $('#dinamisKeranjang' + no).remove();
          totalAll();
      } 
      var total=0;
      function totalAll()
      {
        total=0;
        $('.totalHarga').each(function(i){
          total +=parseFloat($(this).val()) || 0; 
          
        });

        $('#totalHargaDiKeranjang').text(formatRupiah(total))
       
      }
      
      $(document).on('keyup mouseup', '.jumlahHitung', function() {                                                                                                                     
        
        total =0;
        $('.jumlahHitung').each(function(i){
          var id = $(this).attr('id');
          id = id.substr(-1);
          var jum = parseInt($('#jumlah'+id).val()) || 0;
          var satuan = parseFloat($('#satuan'+id).val()) || 0;
          $('#totalHarga'+id).val(jum*satuan);
        });
        totalAll();
      });

      function submitBro(){
        if($('#tanggal').val() == ''){
          Swal.fire({
                          type: 'warning',
                          text: "Wajib Isi tanggal"
                      });
        }else{
          var cek=0;
          $("input[name='id_sub[]']").each(function(){
            cek++;
          });
          if(cek > 0){
            
            var no_antrian = document.getElementById('no_tiket').value;
            var nama = "{{ Auth::guard('pengguna')->user()->nama }}";
            var tanggal = document.getElementById('tanggal').value;

            var html = '<hr><div class="col-md-12">'+
                      '<div class="form-group">'+
                        '<h5>'+ no_antrian +'</h5>'+
                      '</div>'+
                      '<div class="form-group">'+
                        '<p>Tanggal &nbsp:&nbsp'+ tanggal +'</p>'+
                      '</div></div>';

              Swal.fire({
                position: 'mid-end',
                title: 'Buat Tiket Layanan Produk',
                html: html,
                showCancelButton: true,
                cancelButtonText:'Batal',
              }).then(function(result) {
                    if (result.value) {
                      $('#form').submit();
                    } else if (result.value === 0) {
                        Swal.fire({
                            type: 'error',
                            text: "Batal Simpan"
                        });

                    } else {
                        console.log(`modal was dismissed by ${result.dismiss}`)
                    }
              })
          }else{
            Swal.fire({
                          type: 'warning',
                          text: "Produk Belum Dipilih"
            });
          }
        }
      }
    </script>
          @if(Session::has('success'))
              <script type="text/javascript">
                    Swal.fire({
                    type: 'success',
                    text: '{{Session::get("success")}}',
                    showConfirmButton: false,
                    timer: 1500
                });
              </script>
              <?php
                  Session::forget('success');
              ?>
          @endif

    
  </body>
</html>