<!DOCTYPE html>
<html lang="en">
@include('template.penggunaheader')

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  @include('template.penggunanavbarfaq')

  <section class="ftco-section contact-section" id="contact-section">
    <div class="container">
      <div class="row justify-content-center pb-5">
        <div class="col-md-6 heading-section text-center ftco-animate">
          {{-- <span class="subheading"><a href="{{ route('pengguna.tiket' )}}">Tiket </a>/ Layanan Jasa</span> --}}
          {{-- <h2 class="mb-4">Layanan Jasa</h2> --}}
          {{-- <p>{{$get_jenis_layanan->nama_layanan_jasa}}</p> --}}
        </div>
      </div>
      <div class="row no-gutters block-9">
        <form method="POST" action="{{ route('pengguna.simpantiketlayananjasa') }}" id="form" class="bg-light p-5 contact-form" name="formsubmit">
          @csrf
          <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-group">
                <input type="hidden" name="no_tiket" class="form-control" value="{{ $end }}" id="no_tiket">
                <h4>&nbspNomer Tiket &nbsp {{ $end }}</h4>
              </div>
              <div class="form-group">
                @if($id_master_layanan == 13 || $id_master_layanan == 14)
                <h5>&nbspLayanan Ig Nol Rupiah &nbsp / {{$get_jenis_layanan->nama_layanan_jasa}}</h4>
                @else
                <h5>&nbspLayanan Jasa &nbsp / {{$get_jenis_layanan->nama_layanan_jasa}}</h5>
                @endif
              </div>
              <div class="form-group">
                <input type="hidden" name="id_pengguna" value="{{ Auth::guard('pengguna')->user()->id }}" class="form-control">
                <h5>&nbsp{{ Auth::guard('pengguna')->user()->nama }}</h5>
              </div>
              <div class="form-group">
                <input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="Pilih Tanggal" required>
              </div>
              <div class="form-group">
                <select class="form-control" id="mulai" name="mulai" required>
                  <option value="">Waktu Kedatangan</option>
                  <option value="08:30">08:30</option>
                  <option value="09.00">09:00</option>
                  <option value="09:30">09:30</option>
                  <option value="10:00">10:00</option>
                  <option value="10:30">10:30</option>
                  <option value="11:00">11:00</option>
                  <option value="11:30">11:30</option>
                  <option value="12:00">12:00</option>
                  <option value="12:30">12:30</option>
                  <option value="13:00">13:00</option>
                  <option value="13:30">13:30</option>
                  <option value="14:00">14:00</option>
                  <option value="14:30">14:30</option>
                  <option value="15:00">15:00</option>
                </select>
              </div>
              <div class="form-group" id="kategori_layanan" style="display:none;">
                <select name="id_master_layananjasa" class="form-control" id="id_master_layananjasa">
                  @foreach($masterlayanan as $val)
                  <option value="{{ $val->id }}" @if($val->id == $id_master_layanan) selected @endif>{{ $val->nama_layanan_jasa }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <button type="button" onclick="submitBro()" class="btn btn-primary py-3 px-5 mt-5">Kirim</button>
                <a href="{{route('home')}}" class="btn btn-danger py-3 px-5 mt-5">Kembali</a>
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
    // flatpickr("#mulai", {
    //   enableTime: true,
    //   noCalendar: true,
    //   dateFormat: "H:i",
    //   minDate: "08:30",
    //   maxDate: "16:30"
    // });
    // flatpickr("#selesai", {
    //   enableTime: true,
    //   noCalendar: true,
    //   dateFormat: "H:i",
    //   minDate: "08:00",
    //   maxDate: "16:00"
    // });

    function submitBro(){
      if($('#tanggal').val() == ''){
        Swal.fire({
            type: 'warning',
            text: "Wajib Isi tanggal"
        });
      }else if($('#mulai').val() == ''){
        Swal.fire({
            type: 'warning',
            text: "Wajib Isi Waktu"
        });
      }else{
        event.preventDefault();
        var no_antrian = document.getElementById('no_tiket').value;
        var nama = "{{ Auth::guard('pengguna')->user()->nama }}";
        var tanggal = document.getElementById('tanggal').value;
        var mul = document.getElementById('mulai');
        var texts = mul.options[mul.selectedIndex].text;
        var mulai = texts;
        var imlj = document.getElementById('id_master_layananjasa');
        var sel_imlj = imlj.options[imlj.selectedIndex].text;
        var id_master_layananjasa = sel_imlj;

        var html = '<hr><div class="col-md-12">' +
          '<div class="form-group">' +
          '<h5>' + no_antrian + '</h5>' +
          '</div>' +
          '<div class="form-group">' +
          '<p>Tanggal &nbsp:&nbsp' + tanggal + '</p>' +
          '</div>' +
          '<div class="form-group">' +
          '<p>(' + mulai + ')</p>' +
          '</div></div>';

        Swal.fire({
          position: 'mid-end',
          title: 'Buat Tiket Layanan Jasa',
          html: html,
          footer: id_master_layananjasa,
          showCancelButton: true,
          cancelButtonText: 'Batal',
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
      }

    };
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