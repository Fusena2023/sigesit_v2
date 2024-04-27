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
                    <h2 class="mb-4">Layanan Produk Pasang Surut</h2>
                    <p>Buat Tiket Layanan Produk Pasang Surut</p> --}}
                </div>
            </div>
            <div class="row no-gutters block-9">
                <form method="POST" action="{{ route('pengguna.simpan.pasang_surut') }}" id="form" class="bg-light p-5 contact-form" name="formsubmit">
                    @csrf
                    <div class="col-sm-12">
                        <input type="hidden" name="no_tiket" class="form-control" value="{{ $end }}" id="no_tiket">
                        <h4>&nbspNomer Tiket &nbsp {{ $end }}</h4>
                    </div>
                    <div class="col-sm-12">
                        <h5>&nbspLayanan Pasang Surut &nbsp</h5>
                    </div>
                    <div class="col-sm-12">
                        <input type="hidden" name="id_pengguna" value="{{ Auth::guard('pengguna')->user()->id }}" class="form-control">
                        <h5>&nbsp{{ Auth::guard('pengguna')->user()->nama }}</h5>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="text" id="tanggal" name="tanggal" class="form-control col-sm-6" placeholder="Pilih Tanggal" required>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <select name="stasiun" id="stasiun" class="form-control col-sm-6">
                                <option value="">--- Silahkan Pilih Stasiun ---</option>
                                @foreach($master_stasiun as $val)
                                <option value="{{$val->id}}">{{$val->nama_stasiun}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <h5>Detail Pasang Surut</h5>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <select id="kategori" class="form-control col-sm-6">
                                <option value="">--- Silahkan Pilih Kategori ---</option>
                                @foreach($master_kategori as $val)
                                <option value="{{$val->id}}_{{$val->harga}}">{{$val->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12" id="div_tahun" style="display: none;">
                        <div class="input-group">
                            <select id="tahun" class="form-control col-sm-6">
                                <option value="" selected>-- Masukan Tahun --</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12" id="div_bulan" style="display: none;">
                        <div class="input-group">
                            <select id="bulan" class="form-control col-sm-6">
                                <option value="" selected>-- Masukan Bulan --</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="text" id="harga_satuan" class="form-control col-sm-6" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="number" id="jumlah" class="form-control col-sm-6" placeholder="Masukan Jumlah" required>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <button type="button" onclick="TambahDetail()" class="btn btn-primary py-3 px-5 mt-5" style="float: right;">Tambah Detail</button>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <table class="table table-bordered" id="detail_pasut">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Tahun</th>
                                        <th>Bulan</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="body_detail">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
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
        $(document).ready(function() {
            let jenis_produk = '{{ $jenis_produk }}';
            if (jenis_produk == 'peta') {
                var jenis = 1;
            } else {
                var jenis = 3;
            }

            if (jenis != '') {
                $('#keranjangField').hide();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('pengguna.tiketlayananproduk.fetch_data_katalog') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        jenis: jenis
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
            } else {
                $('#keranjangField').hide();
                $('#bukuField').html('');
            }


        })
        $('#kategori').change(function() {
            var value_kategori = $(this).val();

            var data_get = value_kategori.split("_");
            var data_get_1 = data_get[1];
            var harga_satuan = data_get_1.toString().split('').reverse().join('').match(/\d{1,3}/g).join('.').split('').reverse().join('');
								
            $('#harga_satuan').val(harga_satuan);
            if (data_get[0] == 1) {
                $('#div_tahun').show();
                $('#div_bulan').hide('');
                $('#bulan').val('');
            } else if (data_get[0] == 2) {
                $('#div_tahun').show();
                $('#div_bulan').show();
            } else {
                $('#div_tahun').hide();
                $('#div_bulan').hide();
            }
        });

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

        $('.jenis').change(function() {
            let jenis = $(this).val();

            if (jenis != '') {
                $('#keranjangField').show();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('pengguna.tiketlayananproduk.fetch_data_katalog') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        jenis: jenis
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
            } else {
                $('#keranjangField').hide();
                $('#bukuField').html('');
            }
        });

        function tambahItemKeKeranjang(id_sub, persatuan, nama_lembar) {

            var html = '<hr><div class="col-md-12">' +
                '<div class="form-group">' +
                '<h5>Nama Produk : ' + nama_lembar + '</h5>' +
                '</div>' +
                '</div>';
            Swal.fire({
                position: 'mid-end',
                title: 'Tambahkan ke keranjang?',
                html: html,
                input: 'number',
                inputValue: 1,
                showCancelButton: true,
                cancelButtonText: 'Batal',
                didOpen: () => {
                    const input = Swal.getInput()
                    input.setSelectionRange(0, input.value.length)
                }
            }).then(function(result) {
                if (result.value) {
                    //console.log(result.value);
                    addrow(id_sub, persatuan, nama_lembar, result.value);
                } else {
                    console.log(`modal was dismissed by ${result.dismiss}`)
                }
            })

        }

        function addrow(id_sub, persatuan, nama_lembar, jumlah) {
            var no = parseInt($('#numbRows').val());
            var html = '';

            $('#numbRows').val(no + 1);
            html += '<tr id="dinamisKeranjang' + $('#numbRows').val() + '">';
            html += '<td>' + $('#numbRows').val() + '</td>';
            html += '<td>' + nama_lembar + '</td>';
            html += '<td><input type="hidden" name="id_sub[]" value="' + id_sub + '"><input type="number" class="jumlahHitung" id="jumlah' + $('#numbRows').val() + '" name="jumlah[]" min="1" value="' + jumlah + '"></td>';
            html += '<td><input type="text" readonly id="satuan' + $('#numbRows').val() + '" name="satuan[]" value="' + persatuan + '"></td>';
            html += '<td><input type="text" id="totalHarga' + $('#numbRows').val() + '" class="totalHarga" readonly value="' + (persatuan * jumlah) + '"></td>';
            html += '<td><button type="button" onclick="removeRow(' + $('#numbRows').val() + ')" class="btn btn-danger py-1 px-3 mt-0"><span class="icon icon-times"></span></button></td>';
            html += '</tr>';

            $('#tbKeranjang tbody').append(html);
            totalAll();
        }

        function removeRow(no) {
            var cek = parseInt($('#numbRows').val());
            if (cek != 0) {
                $('#numbRows').val(cek - 1);
            }
            $('#dinamisKeranjang' + no).remove();
            totalAll();
        }
        var total = 0;

        function totalAll() {
            total = 0;
            $('.totalHarga').each(function(i) {
                total += parseFloat($(this).val()) || 0;

            });

            $('#totalHargaDiKeranjang').text(total)

        }

        $(document).on('keyup mouseup', '.jumlahHitung', function() {

            total = 0;
            $('.jumlahHitung').each(function(i) {
                var id = $(this).attr('id');
                id = id.substr(-1);
                var jum = parseInt($('#jumlah' + id).val()) || 0;
                var satuan = parseFloat($('#satuan' + id).val()) || 0;
                $('#totalHarga' + id).val(jum * satuan);
            });
            totalAll();
        });

        function TambahDetail() {
            var awal_kategori = $('#kategori').val();
            var data_get = awal_kategori.split("_");
            var value_kategori = data_get[0];
            var jenis_kategori = $('#kategori option:selected').text();
            var tahun = $('#tahun').val();
            var bulan = $('#bulan option:selected').text();
            var value_bulan = $('#bulan').val();
            var harga_satuan = $('#harga_satuan').val();
            var jumlah = $('#jumlah').val();
            var total_satu = jumlah * harga_satuan.replace('.', '');;
            var option = "";

            var total_satu_new = total_satu.toString().split('').reverse().join('').match(/\d{1,3}/g).join('.').split('').reverse().join('');
            if(awal_kategori == ''){
                Swal.fire({
                    type: 'warning',
                    text: "Wajib Isi Kategori"
                });
            }else if(tahun == ''){
                Swal.fire({
                    type: 'warning',
                    text: "Wajib Isi Tahun"
                });
            }else if(jumlah == ''){
                Swal.fire({
                    type: 'warning',
                    text: "Wajib Isi Jumlah"
                });
            }else{
                if(jenis_kategori == 'pertahun'){
                    value_bulan = '-';
                    bulan = '-';
                    var isi = '<tr id="tr_detail">' +
                        '<td><input type="hidden" name="jenis_kategori[]" value="' + value_kategori + '">' + jenis_kategori + '</td>' +
                        '<td><input type="hidden" name="tahun[]" value="' + tahun + '">' + tahun + '</td>' +
                        '<td><input type="hidden" name="bulan[]" value="' + value_bulan + '">' + bulan + '</td>' +
                        '<td><input type="hidden" name="harga_satuan[]" value="' + harga_satuan + '">' + harga_satuan + '</td>' +
                        '<td><input type="hidden" name="jumlah[]" value="' + jumlah + '">' + jumlah + '</td>' +
                        '<td><input type="hidden" name="total_satu[]" value="' + total_satu + '">' + total_satu_new + '</td>' +
                        '<td><button type="button" class="btn btn-sm btn-danger" onclick="HapusDetail(this)" title="Hapus">Hapus</button></td>' +
                        '</tr>';
                    $('#body_detail').append(isi);
                }else if(jenis_kategori == 'perbulan'){
                    if(value_bulan == ''){
                        Swal.fire({
                            type: 'warning',
                            text: "Wajib Isi Bulan"
                        });
                    }else{
                        var isi = '<tr id="tr_detail">' +
                            '<td><input type="hidden" name="jenis_kategori[]" value="' + value_kategori + '">' + jenis_kategori + '</td>' +
                            '<td><input type="hidden" name="tahun[]" value="' + tahun + '">' + tahun + '</td>' +
                            '<td><input type="hidden" name="bulan[]" value="' + value_bulan + '">' + bulan + '</td>' +
                            '<td><input type="hidden" name="harga_satuan[]" value="' + harga_satuan + '">' + harga_satuan + '</td>' +
                            '<td><input type="hidden" name="jumlah[]" value="' + jumlah + '">' + jumlah + '</td>' +
                            '<td><input type="hidden" name="total_satu[]" value="' + total_satu + '">' + total_satu_new + '</td>' +
                            '<td><button type="button" class="btn btn-sm btn-danger" onclick="HapusDetail(this)" title="Hapus">Hapus</button></td>' +
                            '</tr>';
                        $('#body_detail').append(isi);
                    }
                }else{
                    var isi = '<tr id="tr_detail">' +
                        '<td><input type="hidden" name="jenis_kategori[]" value="' + value_kategori + '">' + jenis_kategori + '</td>' +
                        '<td><input type="hidden" name="tahun[]" value="' + tahun + '">' + tahun + '</td>' +
                        '<td><input type="hidden" name="bulan[]" value="' + value_bulan + '">' + bulan + '</td>' +
                        '<td><input type="hidden" name="harga_satuan[]" value="' + harga_satuan + '">' + harga_satuan + '</td>' +
                        '<td><input type="hidden" name="jumlah[]" value="' + jumlah + '">' + jumlah + '</td>' +
                        '<td><input type="hidden" name="total_satu[]" value="' + total_satu + '">' + total_satu_new + '</td>' +
                        '<td><button type="button" class="btn btn-sm btn-danger" onclick="HapusDetail(this)" title="Hapus">Hapus</button></td>' +
                        '</tr>';
                    $('#body_detail').append(isi);
                }
            }
        }

        function HapusDetail(obj) {
            $(obj).parent().parent().remove()
        }

        function submitBro() {
            if ($('#tanggal').val() == '') {
                Swal.fire({
                    type: 'warning',
                    text: "Wajib Isi tanggal"
                });
            } else {
                var cek = 0;
                $("input[name='jenis_kategori[]']").each(function() {
                    cek++;
                });
                console.log(cek);
                if (cek > 0) {

                    var no_antrian = document.getElementById('no_tiket').value;
                    var nama = "{{ Auth::guard('pengguna')->user()->nama }}";
                    var tanggal = document.getElementById('tanggal').value;

                    var html = '<hr><div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<h5>' + no_antrian + '</h5>' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<p>Tanggal &nbsp:&nbsp' + tanggal + '</p>' +
                        '</div></div>';

                    Swal.fire({
                        position: 'mid-end',
                        title: 'Buat Tiket Layanan Produk',
                        html: html,
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
                } else {
                    Swal.fire({
                        type: 'info',
                        text: "Detail Belum Ada"
                    });
                    // Swal.fire({
                    //     type: 'question',
                    //     title: 'Simpan data',
                    //     text: 'Data sudah Benar'
                    // }).then(function(result) {
                    //     if (result.value) {
                    //         document.formsubmit.submit();
                    //     } else if (result.value === 0) {
                    //         Swal.fire({
                    //             type: 'error',
                    //             text: "Batal Simpan"
                    //         });

                    //     } else {
                    //         console.log(`modal was dismissed by ${result.dismiss}`)
                    //     }
                    // })
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