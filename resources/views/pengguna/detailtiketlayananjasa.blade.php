<!DOCTYPE html>
<html lang="en">
@include('template.penggunaheader')

<style type="text/css">
  @media print {
    body * {
      visibility: hidden;
    }

    #section-to-print,
    #section-to-print * {
      visibility: visible;
    }

    #section-to-print {
      position: absolute;
      left: 0;
      top: 0;
    }
  }
</style>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="{{route('home')}}">Badan<span>Informasi</span>Geospasial</a>
      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav nav ml-auto">
          <input class="btn btn-outline-primary" type="button" value="Cetak Tiket" id="print">
        </ul>
      </div>
    </div>
  </nav>

  <div id="section-to-print">
    <section class="ftco-section ftco-no-pb" id="layanandigital-section">
      <div class="container">
        <div class="row justify-content-center pb-5">
          <div class="col-md-6 heading-section text-center ftco-animate">
            <img src="{{url('assets/digilab/images/ico.png')}}" alt="" style="max-height: 115px; max-width:115px">
            <p>BADAN INFORMASI <br>GEOSPASIAL</p>
            <h3>Formulir Tamu</h3>
          </div>
        </div>
      </div>
    </section>

    <hr>

    <section class="ftco-section contact-section ftco-no-pt ftco-no-pb" id="contact-section-jasa">
      <div class="container">
        <div class="row no-gutters block-9">

          <div class="col-md-12">
            <div class="col-md-6">
              @foreach($tiketlayananjasa as $tlj)
              <?php
              
              
              ?>
              <table>
                <tbody>
                  <col width="230">
                  <col width="80">
                  <col width="230">
                  <col width="230">
                  <tr>
                    <td>Hari/Tanggal</td>
                    <td>:</td>
                    <td colspan="2">{{ hari_indo($tlj->tanggal).', '. tgl_indo($tlj->tanggal) }}</td>
                  </tr>
                  <tr>
                    <td>No. Tiket</td>
                    <td>:</td>
                    <th colspan="2">{{ $tlj->no_tiket }}</th>
                  </tr>
                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td colspan="2">{{ $tlj->namas->nama }}</td>
                  </tr>
                  <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td colspan="2">{{ !empty($tlj->namas->jabatan)?$tlj->namas->jabatan: '-' }}</td>
                  </tr>
                  <tr>
                    <td>Instansi</td>
                    <td>:</td>
                    <td colspan="2">{{ !empty($tlj->namas->instansi)?$tlj->namas->instansi: '-' }}</td>
                  </tr>
                  <tr>
                    <td>Telpon/Hp</td>
                    <td>:</td>
                    <td colspan="2">{{ $tlj->namas->no_telp }}</td>
                  </tr>
                </tbody>
              </table>
              @endforeach
            </div>
            <br>
            <br>
            @foreach($tiketlayananjasa as $tlj)
            <table style="width: 100%; border: 1px solid black; ">
              <tbody>
                <tr rowspan="2">
                  <th colspan="2" style="width:50%;border-right: 1px solid black;">
                    <center>
                      @if($tlj->id_mas != null)
                      {{$tlj->nama_pusat}}
                      @else
                      KAPUS PPKS
                      @endif
                    </center>
                  </th>
                  <th colspan="2">
                    <center>
                      @if($tlj->id_mas != null)
                      Layanan Jasa : {{$tlj->nama_layanan_jasa}}
                      @else
                      Layanan Jasa : {{$tlj->nama_kontrak}}
                      @endif
                      <br><br><br> TTD</center>
                  </th>
                </tr>
              </tbody>
            </table>
            <br>
            <table style="width: 100%;">
              <tbody>
                <tr>
                  <!-- <th><img src="{{url('assets/digilab/images/check-box.png')}}" alt="" style="max-height: 30px; max-width:30px; margin:10px"></th> -->
                  <th><input type="checkbox" id="centang" value="centang" style="margin:10px;transform: scale(2.0);"></th>
                  <th>
                    Saya yang bertanda tangan di bawah ini, menyatakan bahwa tidak melakukan tindakan penyuapan dan gratifikasi terhadap layanan yang diberikan oleh Pelayanan Terpadu Informasi Geospasial BIG.
                  </th>
                </tr>
              </tbody>
            </table>
            <br>
            <br>
            <table style="width: 100%;">
              <tbody>
                <tr>
                  <th colspan="3" style="width:75%;"></th>
                  <th>
                    <center>Cibinong, {{ tgl_indo($datenow) }} <br>Tamu<br><br><br><br>( {{ $tlj->namas->nama }} )</center>
                  </th>
                </tr>
              </tbody>
            </table>


            <br>
            <br>
            <table style="width: 100%; border: 1px solid black; ">
              <tbody>
                <tr rowspan="2">
                  <th colspan="4" style="width:50%;border-right: 1px solid black;">
                    <center>Saran Dan Pengaduan</center><br><br><br><br><br><br>
                  </th>
                </tr>
              </tbody>
            </table>
            <center style="color: black;">*Kami Tidak Menerima Gratifikasi Dalam Bentuk Apapun</center>

            @endforeach
          </div>

        </div><br><br>
      </div>
    </section>

    <section class="ftco-section ftco-no-pb" id="layanandigital-section">
      <div class="container">
        <div class="row justify-content-center pb-5">
          <div class="col-md-6 heading-section text-center ftco-animate">
            <img src="{{url('assets/digilab/images/ico.png')}}" alt="" style="max-height: 115px; max-width:115px">
            <p>BADAN INFORMASI <br>GEOSPASIAL</p>
            <h3>Laporan Hasil Layanan Jasa Konsultasi</h3>
          </div>
        </div>
      </div>
    </section>

    <hr>

    <section class="ftco-section contact-section ftco-no-pt ftco-no-pb" id="contact-section-jasa">
      <div class="container">
        <div class="row no-gutters block-9">

          <div class="col-md-12">
            @foreach($tiketlayananjasa as $tlj)
            <table>
              <tbody>
                <col width="230">
                <col width="80">
                <col width="230">
                <col width="230">
                <tr>
                  <td>Hari/Tanggal</td>
                  <td>:</td>
                  <td colspan="2">{{ hari_indo($tlj->tanggal).', '. tgl_indo($tlj->tanggal) }}</td>
                </tr>
                <tr>
                  <td>No. Tiket</td>
                  <td>:</td>
                  <th colspan="2">{{ $tlj->no_tiket }}</th>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td colspan="2">{{ $tlj->namas->nama }}</td>
                </tr>
                <tr>
                  <td>Jabatan</td>
                  <td>:</td>
                  <td colspan="2">{{ !empty($tlj->namas->jabatan)?$tlj->namas->jabatan: '-' }}</td>
                </tr>
                <tr>
                  <td>Instansi</td>
                  <td>:</td>
                  <td colspan="2">{{ !empty($tlj->namas->instansi)?$tlj->namas->instansi: '-' }}</td>
                </tr>
                <tr>
                  <td>Telpon/Hp</td>
                  <td>:</td>
                  <td colspan="2">{{ $tlj->namas->no_telp }}</td>
                </tr>
                <tr>
                  <td>Jenis Konsultasi</td>
                  <td>:</td>
                  <td colspan="2">1. Pemetaan Batas Wilayah</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td colspan="2">2. Pemetaan Dasar</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td colspan="2">3. Simpul Jaringan</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td colspan="2">4. Diklat Geospasial</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td colspan="2">5. Reposisi Tapal Batas dan Pemasangan Patok </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td colspan="2">6. Pengukuran GCP dan ICP</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td colspan="2">7. Pemetaan Tematik & Informasi Geospasial lainnya</td>
                </tr>
              </tbody>
            </table><br>
            @endforeach
          </div>
          <br>
          <br>
          @foreach($tiketlayananjasa as $tlj)
          <span><b>Hasil Konsultasi</b></span>
          <table style="width: 100%; border: 1px solid black; ">
            <tbody>
              <tr>
                <th colspan="2" style="border-right: 1px solid black;">Ketersediaan Data</th>
              </tr>
              <tr>
                <td>1. Peta Dasar (RBI) skala 1:</td>
                <td>5. Citra Orthosys</td>
              </tr>
              <tr>
                <td>2. Citra Orthorektifikasi</td>
                <td>6. DEM</td>
              </tr>
              <tr>
                <td colspan="2">3. Data GCP/ICP</td>
              </tr>
              <tr>
                <td colspan="2">4. Data Penunjang lainnya</td>
              </tr>

              <tr>
                <th colspan="2" style="border-right: 1px solid black;">Tindak Lanjut</th>
              </tr>
              <tr>
                <td colspan="2">1. Sebagai Informasi</td>
              </tr>
              <tr>
                <td colspan="2">2. Penyusunan RAB & KAK</td>
              </tr>
              <tr>
                <td colspan="2">3. MoU oleh Unit Terkait</td>
              </tr>
              <tr>
                <td colspan="2">4. Perjanjian Kerja Sama</td>
              </tr>
            </tbody>
          </table>
          <table style="width: 100%; border: 1px solid black; ">
            <tbody>
              <tr>
                <th colspan="2" style="border-right: 1px solid black;">Keterangan</th>
              </tr>
            </tbody>
          </table>
          <br>
          <br>
          <table style="width: 100%;">
            <tbody>
              <tr>
                <th colspan="3" style="width:0%;"></th>
                <th>
                  <center>Cibinong, {{ tgl_indo($datenow) }} <br>Petugas Layanan Jasa<br><br><br><br>( ............... )</center>
                </th>
                <th colspan="3" style="width:45%;"></th>
                <th>
                  <center><br>Pemohon<br><br><br><br>( ............... )</center>
                </th>
              </tr>
            </tbody>
          </table>
          @endforeach
        </div>

      </div><br><br>
  </div>
  </section>
  </div>

  @include('template.penggunafooter')

  <script type="text/javascript">
    document.querySelector("#print").addEventListener("click", function() {
      window.print();
    });
  </script>

</body>

</html>