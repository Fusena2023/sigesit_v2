<!DOCTYPE html>
<html lang="en">
  @include('template.penggunaheader')

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	  
	  @include('template.penggunanavbarfaq')

    <section class="ftco-section contact-section" id="contact-section">
      <div class="container">
        <div class="row justify-content-center pb-5">
          <div class="col-md-6 heading-section text-center ftco-animate">
            <span class="subheading"><a href="{{ route('pengguna.pesan.baru' )}}">Pesan </a>/ Pesan Percakapan</span>
            <h2 class="mb-4">Pesan Percakapan</h2>
            <p>Buat Pesan Percakapan Anda</p>
          </div>
        </div>
        <div class="row no-gutters block-9">
              <form method="POST" action="{{ route('pengguna.simpanpesanxtiket') }}" id="form" class="bg-light p-5 contact-form" name="formsubmit">
                @csrf
                <div class="col-md-12">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="hidden" name="no_tiket" class="form-control" value="{{ $no_tiket }}" id="no_tiket">
                      <h4>&nbspNomor Pesan &nbsp {{ $no_tiket }}</h4>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="id_pengguna" value="{{ Auth::guard('pengguna')->user()->id }}" class="form-control">
                      <h5>&nbsp{{ Auth::guard('pengguna')->user()->nama }}</h5>
                    </div>
                    <div class="form-group">
                      <input type="text" id="tanggal" name="tanggal" class="form-control" value="{{date('Y-m-d H:i:s')}}" placeholder="Pilih Tanggal" hidden="">
                    </div>
                    <div class="form-group">
                      <textarea type="text" id="perihal" name="perihal" class="form-control" placeholder="Perihal" required></textarea>
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
          var perihal = document.getElementById('perihal').value;

          var html = '<hr><div class="col-md-12">'+
                    '<div class="form-group">'+
                      '<h5>'+ no_antrian +'</h5>'+
                    '</div>'+
                    '<div class="form-group">'+
                      '<p>Tanggal &nbsp:&nbsp'+ tanggal +'</p>'+
                    '</div>'+
                    '<div class="form-group">'+
                      '<p>'+ perihal +'</p>'+
                    '</div></div>';

            Swal.fire({
              position: 'mid-end',
              title: 'Buat Pesan Percakapan Anda',
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
