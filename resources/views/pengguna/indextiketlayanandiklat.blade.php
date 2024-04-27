<!DOCTYPE html>
<html lang="en">
  @include('template.penggunaheader')

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	  
	  @include('template.penggunanavbarfaq')

    <section class="ftco-section contact-section" id="contact-section">
      <div class="container">
        <div class="row justify-content-center pb-5">
          <div class="col-md-6 heading-section text-center ftco-animate">
            <span class="subheading"><a href="{{ route('pengguna.tiket' )}}">Tiket </a>/ Layanan Diklat</span>
            <h2 class="mb-4">Layanan Diklat</h2>
            <p>Buat Tiket Layanan Diklat</p>
          </div>
        </div>
        <div class="row no-gutters block-9">
              <form method="POST" action="{{ route('pengguna.simpantiketlayanandiklat') }}" id="form" class="bg-light p-5 contact-form" name="formsubmit">
                @csrf
                <div class="col-md-12">
                  <div class="col-md-6">
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
                    <div class="form-group">
                      <input type="text" id="mulai" name="mulai" class="form-control" placeholder="Waktu Mulai" required>
                    </div>
                    <div class="form-group">
                      <input type="text" id="selesai" name="selesai" class="form-control" placeholder="Waktu Selesai" required>
                    </div>
                    <div class="form-group">
                      <select name="id_master_layanandiklat" class="form-control" required id="id_master_layanandiklat">
                        <option value="">Pilih Kategori Layanan Diklat</option>
                      @foreach($masterlayanandiklat as $mlj)
                        <option value="{{ $mlj->id }}">{{ $mlj->nama_layanan_diklat }}</option>
                      @endforeach
                      </select>
                    </div>
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
          var mulai = document.getElementById('mulai').value;
          var selesai = document.getElementById('selesai').value;
          var sel = document.getElementById("id_master_layanandiklat");
          var text = sel.options[sel.selectedIndex].text;
          var id_master_layanandiklat = text;

          var html = '<hr><div class="col-md-12">'+
                    '<div class="form-group">'+
                      '<h5>'+ no_antrian +'</h5>'+
                    '</div>'+
                    '<div class="form-group">'+
                      '<p>Tanggal &nbsp:&nbsp'+ tanggal +'</p>'+
                    '</div>'+
                    '<div class="form-group">'+
                      '<p>('+ mulai +'-'+ selesai +')</p>'+
                    '</div></div>';

            Swal.fire({
              position: 'mid-end',
              title: 'Buat Tiket Layanan Jasa',
              html: html,
              footer : id_master_layanandiklat,
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