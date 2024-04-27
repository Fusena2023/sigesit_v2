<!DOCTYPE html>
<html lang="en">
@include('template.penggunaheader')

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    @include('template.penggunanavbarfaq')

    <section class="ftco-section contact-section" id="contact-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-6 heading-section text-center ftco-animate">
                    {{-- <span class="subheading"><a href="{{ route('pengguna.tiket' )}}">Tiket </a>/ Layanan Jasa</span>
                    <h4 class="mb-4">Layanan Kerja Sama Kontrak</h4> --}}
                </div>
            </div>
            <div class="row no-gutters block-9">
                <form method="POST" action="{{ route('pengguna.simpan.kerja_sama') }}" id="form" class="bg-light p-5 contact-form" name="formsubmit">
                    @csrf
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="no_tiket" class="form-control" value="{{ $end }}" id="no_tiket">
                                <h4>&nbspNomer Tiket &nbsp {{ $end }}</h4>
                            </div>
                            <div class="form-group">
                                <h5>&nbspLayanan Kerja Sama Kontrak &nbsp</h5>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="id_pengguna" value="{{ Auth::guard('pengguna')->user()->id }}" class="form-control">
                                <h5>&nbsp{{ Auth::guard('pengguna')->user()->nama }}</h5>
                            </div>
                            <div class="form-group">
                                <input type="text" id="nama_kontrak" name="nama_kontrak" class="form-control" placeholder="Nama Kontrak" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="jumlah_setoran" id="jumlah_setoran" class="form-control" placeholder="Jumlah Setoran" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary py-3 px-5 mt-5">Kirim</button>
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
        // $(function() {

        //     var rupiah = document.getElementById('jumlah_setoran');
        //     rupiah.addEventListener('keyup', function(e) {
        //         // tambahkan 'Rp.' pada saat form di ketik
        //         // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        //         rupiah.value = formatRupiah(this.value, 'Rp. ');
        //     });

        //     /* Fungsi formatRupiah */
        //     function formatRupiah(angka, prefix) {
        //         var number_string = angka.replace(/[^,\d]/g, '').toString(),
        //             split = number_string.split(','),
        //             sisa = split[0].length % 3,
        //             rupiah = split[0].substr(0, sisa),
        //             ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        //         // tambahkan titik jika yang di input sudah menjadi angka ribuan
        //         if (ribuan) {
        //             separator = sisa ? '.' : '';
        //             rupiah += separator + ribuan.join('.');
        //         }

        //         rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        //         return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        //     }
        // });
    </script>
    <script type="text/javascript">
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


        $("#form").submit(function(event) {
            event.preventDefault();
            var no_antrian = document.getElementById('no_tiket').value;
            var nama = "{{ Auth::guard('pengguna')->user()->nama }}";
            // var tanggal = document.getElementById('tanggal').value;
                // var Jumlah = document.getElementById('mulai');
                // var texts = mul.options[mul.selectedIndex].text;
                // var mulai = texts;
                // var imlj = document.getElementById('id_master_layananjasa');
                // var sel_imlj = imlj.options[imlj.selectedIndex].text;
                // var id_master_layananjasa = sel_imlj;

            var html = '<hr><div class="col-md-12">' +
                '<div class="form-group">' +
                '<h5> No tiket anda : ' + no_antrian + '</h5>' +
                '</div>' +
                '<div class="form-group">' +
                '</div>' +
                '<div class="form-group">' +
                '</div></div>';

            Swal.fire({
                position: 'mid-end',
                title: 'Buat Tiket Layanan Kontrak',
                html: html,
                // footer: id_master_layananjasa,
                showCancelButton: true,
                cancelButtonText: 'Batal',
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