<!DOCTYPE html>
<html lang="en">
  @include('template.penggunaheader')

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	  
	  @include('template.penggunanavbarfaq')

    <section class="ftco-section contact-section" id="contact-section">
      <div class="container">
        <div class="row justify-content-center pb-5">
          <div class="col-md-6 heading-section text-center ftco-animate">
            <span class="subheading"><a href="{{ route('pengguna.tiket' )}}">Tiket </a>/ Layanan Konsultasi Teknis dan Diklat</span>
            <h2 class="mb-4">Layanan Konsultasi Teknis dan Diklat</h2>
            <p>Buat Tiket Layanan Konsultasi Teknis dan Diklat</p>
          </div>
        </div>
        <div class="row no-gutters block-9">
              <form method="POST" action="{{ route('pengguna.simpantiketlayanankunjunganumum') }}" id="form" class="bg-light p-5 contact-form" name="formsubmit">
                @csrf
                <div class="col-md-12">
                  <div class="col-md-6">
                    <input id="idf" value="1" type="hidden" name="panjangarray">
                    <div class="form-group">
                      <input type="hidden" name="no_tiket" class="form-control" value="{{ $no_tiket }}" id="no_tiket">
                      <h4>&nbspNomer Tiket &nbsp {{ $no_tiket }}</h4>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="id_pengguna" value="{{ Auth::guard('pengguna')->user()->id }}" class="form-control">
                      <h5>&nbsp{{ Auth::guard('pengguna')->user()->nama }}</h5>
                    </div>
                    <div class="form-group">
                      <input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="Pilih Tanggal" required>
                    </div>
                    <div id="detail">
                      <hr>
                      <div class="form-group">
                        <select name="id_pusat[]" class="form-control" required id="id_pusat_0">
                          <option value="">Pilih Pusat</option>
                        @foreach($masterpusat as $mlj)
                          <option value="{{ $mlj->id }}">{{ $mlj->nama_pusat }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group kategori_layanan" style="display:none;" id="kategori_layanan_0">
                        <select name="id_kategori[]" class="form-control id_kategori" id="id_kategori_0">
                          <option value="">Pilih Kategori</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <textarea type="text" id="keperluan[]" name="keperluan[]" class="form-control keperluan" placeholder="Keperluan" required rows="5"></textarea>
                      </div>
                      <div class="form-group">
                        <input type="text" id="personil[]" name="personil[]" class="form-control personil" placeholder="Personil Dituju" required>
                      </div>
                      <hr>
                    </div>
                    <div style="text-align:right;">
                      <button onclick="tambahtujuan();" class="btn btn-outline-info mt-2">Tambah Tujuan</button>
                    </div>
                    <hr>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary py-3 px-5 mt-5">Kirim</button>
                    </div>
                  </div>
                </div>
                

              </form>
        </div>
      </div>
    </section>


    @include('template.penggunafooter')
    <script language="javascript">
        function tambahtujuan() {
                var idf = document.getElementById("idf").value;
                var stre = '<div id="srow'+ idf +'"><div class="form-group">'+
                        '<select name="id_pusat[]" class="form-control id_pusat" onclick="getKategori('+idf+')" required id="id_pusat_'+idf+'">'+
                          '<option value="">Pilih Pusat</option>'+
                        '@foreach($masterpusat as $mlj)'+
                          '<option value="{{ $mlj->id }}">{{ $mlj->nama_pusat }}</option>'+
                        '@endforeach'+
                        '</select>'+
                      '</div>'+
                      '<div class="form-group" style="display:none;" id="kategori_layanan_'+idf+'">'+
                        '<select name="id_kategori[]" class="form-control id_kategori" id="id_kategori_'+idf+'">'+
                          '<option value="">Pilih Kategori</option>'+
                        '</select>'+
                      '</div>'+
                      '<div class="form-group">'+
                        '<textarea type="text" id="keperluan[]" name="keperluan[]" class="form-control keperluan" placeholder="Keperluan" required rows="5"></textarea>'+
                      '</div>'+
                      '<div class="form-group">'+
                        '<input type="text" id="personil[]" name="personil[]" class="form-control personil" placeholder="Personil Dituju" required>'+
                      '</div>'+
                      '<a href="#" class="btn btn-outline-danger mt-2" onclick="hapusElemen(\'#srow' + idf + '\',\''+ idf +'\'); return false;">Hapus</a>'+
                      '<hr></div>';
                $("#detail").append(stre); 
                idf = (idf-1) + 2;
                document.getElementById("idf").value = idf;
            }
        function hapusElemen(srowidf,idf) {
                $(srowidf).remove();
                var idfkurang = document.getElementById('idf').value - 1;
                document.getElementById("idf").value = idfkurang;
            }
        function getKategori(idf){
          var id_master_pusat = $('#id_pusat_'+idf+'').val();
          var html = '';
            $.get('{{URL::to("/getmastertiketlayanan/kunjungan-umum/")}}',{id_master_pusat:id_master_pusat},function(data){
              $.each(data, function(i, val){
                html += '<option value="'+val.id+'">'+val.nama_layanan_diklat+'</option>'
              })
              if(id_master_pusat != ''){
                $('#kategori_layanan_'+idf+'').show();
                $('#id_kategori_'+idf+'').html(html);
              }else{
                $('#kategori_layanan_'+idf+'').hide();
                $('#id_kategori_'+idf+'').html(html);
              }
            })
        };
        $('#id_pusat_0').change(function(){
          var id_master_pusat = $(this).val();
          var html = '';
            $.get('{{URL::to("/getmastertiketlayanan/kunjungan-umum/")}}',{id_master_pusat:id_master_pusat},function(data){
              $.each(data, function(i, val){
                html += '<option value="'+val.id+'">'+val.nama_layanan_diklat+'</option>'
              })
              if(id_master_pusat != ''){
                $('#kategori_layanan_0').show();
                $('#id_kategori_0').html(html);
              }else{
                $('#kategori_layanan_0').hide();
                $('#id_kategori_0').html(html);
              }
            })
        })
    </script>
    <script type="text/javascript">
      flatpickr("#tanggal", {
        minDate: "today",
        maxDate: new Date().fp_incr(14) // 14 days from now
      });
      flatpickr("#mulai", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        minDate: "08:00",
        maxDate: "16:00"
      });
      flatpickr("#selesai", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        minDate: "08:00",
        maxDate: "16:00"
      });

      $("#form").submit(function(event) {
          event.preventDefault();
          var no_antrian = document.getElementById('no_tiket').value;
          var nama = "{{ Auth::guard('pengguna')->user()->nama }}";
          var tanggal = document.getElementById('tanggal').value;

          var detail_idpusat = document.getElementsByClassName('id_pusat');
          var detail_keperluan = document.getElementsByClassName('keperluan');
          var detail_personil = document.getElementsByClassName('personil');
          const result = [];
          for ( var i = 0; i < detail_idpusat.length; i++ ) {
              result.push( [  detail_personil[i],detail_keperluan[i] ] );
          }
          var details_kunjungan = 
              [].map.call(result, function(string) {
                  return '<tr><td>'+string[0].value+'</td><td>'+string[1].value+'</td></tr>'
              });


          var html = '<hr><div class="col-md-12">'+
                    '<div class="form-group">'+
                      '<h5>'+ no_antrian +'</h5>'+
                    '</div>'+
                    '<div class="form-group">'+
                      '<p>Tanggal &nbsp:&nbsp'+ tanggal +'</p>'+
                    '</div>'+
                                        '<div class="table-responsive" style="overflow-x:auto;">'+
                                            '<table class="table table-hover">'+
                                                '<thead>'+
                                                    '<tr>'+
                                                        '<th>Personil Tujuan</th>'+
                                                        '<th>Keperluan</th>'+
                                                    '</tr>'+
                                                '</thead>'+
                                                '<tbody style="text-align:left;">'+ 
                                                    details_kunjungan +
                                                '</tbody>'+
                                            '</table>'+
                                        '</div>'+
                    '</div>';


            Swal.fire({
              position: 'mid-end',
              title: 'Buat Tiket Layanan Kunjungan Umum',
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

      });

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
