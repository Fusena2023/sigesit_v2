<!DOCTYPE html>
<html lang="en">
  @include('template.penggunaheader')

  <style type="text/css">
    @media print {
      body * {
        visibility: hidden;
      }
      #section-to-print, #section-to-print * {
        visibility: visible;
      }
      #section-to-print {
        position: absolute;
        left: 0;
        top: 0;
      }
    }
    .kepuasan{
      background-color: #ffe29d;
      text-align: center;
    }
    .kepentingan{
      background-color: #bcf592;
      text-align: center;
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
                <a href="{{ route('pengguna.tiket') }}" class="btn btn-outline-primary">Kembali</a>
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
            <h3>KUESIONER SURVEI KEPUASAN MASYARAKAT (SKM)</h3>
          </div>
        </div>
      </div>
    </section>

    <hr>

    <section class="ftco-section contact-section ftco-no-pt ftco-no-pb" id="contact-section-jasa">
      <div class="container">
        <div class="row no-gutters block-9">
                <form id="kirimKuesioner" class="bg-light p-5 contact-form" method="post" action="{{ route('pengguna.kuesioner.submit') }}">
                  @csrf
                  @php 
                    $no=1;
                    $index=0;
                  @endphp
                    <div class="col-md-12">
                        <!-- <div class="form-group">
                          <span class="text-danger">* ) Wajib Isi</span>
                        </div> -->
                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="hidden" name="jenis_layanan" value="{{$layanan}}">
                                <input type="hidden" name="id_tiket" value="{{$id_tiket}}">
                                <input type="hidden" name="kategori" value="{{$kategori}}">
                            </div>
                        </div>
                        <table class="table table-bordered" style="width:60%!important;">
                          <tr>
                            <th>Tingkat Kepuasan</th>
                            <th>Tingkat Kepentingan</th>
                          </tr>
                          <tr>
                            <td>
                              1 : SANGAT TIDAK PUAS (STP)<br>
                              2 : TIDAK PUAS (TP)<br>
                              3 : PUAS (P)<br>
                              4 : SANGAT PUAS (SP)<br>
                            </td>
                            <td>
                              1 : SANGAT TIDAK PENTING (STP)<br>
                              2 : TIDAK PENTING (TP)<br>
                              3 : PENTING (P)<br>
                              4 : SANGAT PENTING (SP)<br>
                            </td>
                          </tr>
                        </table>
                        <table class="table table-bordered" width="100%">
                        <span class="text-danger" style="float:right;">* ) Wajib Isi Baik Tingkat Kepuasan Maupun Tingkat Kepentingan</span>
                          <tr>
                            <th>No.</th>
                            <th>PERNYATAAN</th>
                            <th class="kepuasan" colspan="4"><center>TINGKAT KEPUASAN</center></th>
                            <th class="kepentingan" colspan="4"><center>TINGKAT KEPENTINGAN</center></th>
                          </tr>
                          <tr>
                            <th colspan="2"></th>
                            <th class="kepuasan">1</th>
                            <th class="kepuasan">2</th>
                            <th class="kepuasan">3</th>
                            <th class="kepuasan">4</th>
                            <th class="kepentingan">1</th>
                            <th class="kepentingan">2</th>
                            <th class="kepentingan">3</th>
                            <th class="kepentingan">4</th>
                          </tr>
                          @foreach($pertanyaan as $key => $val)
                          <?php $index = $key?>
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$val->pertanyaan}} <input type="hidden" name="id_pertanyaan[{{$index}}]" value="{{$val->id}}"> <span style="color:red;">{{$val->required}}</span></td>
                            <td class="kepuasan">
                              <label data-toggle="tooltip" data-placement="bottom" title="SANGAT TIDAK PUAS">
                                <input type="radio" name="tingkat_kepuasan[{{$index}}]" value="1" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepuasan">
                              <label data-toggle="tooltip" data-placement="bottom" title="TIDAK PUAS">
                                <input type="radio" name="tingkat_kepuasan[{{$index}}]" value="2" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepuasan">
                              <label data-toggle="tooltip" data-placement="bottom" title="PUAS">
                                <input type="radio" name="tingkat_kepuasan[{{$index}}]" value="3" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepuasan">
                              <label data-toggle="tooltip" data-placement="bottom" title="SANGAT PUAS">
                                <input type="radio" name="tingkat_kepuasan[{{$index}}]" value="4" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepentingan">
                              <label data-toggle="tooltip" data-placement="bottom" title="SANGAT TIDAK PENTING">
                                <input type="radio" name="tingkat_kepentingan[{{$index}}]" value="1" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepentingan">
                              <label data-toggle="tooltip" data-placement="bottom" title="TIDAK PENTING">
                                <input type="radio" name="tingkat_kepentingan[{{$index}}]" value="2" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepentingan">
                              <label data-toggle="tooltip" data-placement="bottom" title="PENTING">
                                <input type="radio" name="tingkat_kepentingan[{{$index}}]" value="3" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepentingan">
                              <label data-toggle="tooltip" data-placement="bottom" title="SANGAT PENTING">
                                <input type="radio" name="tingkat_kepentingan[{{$index}}]" value="4" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                          </tr>
                          @endforeach
                          <tr>
                            <th colspan="10">Khusus yang pernah menyampaikan pengaduan terhadap layanan BIG</th>
                          </tr>
                          <?php $indexs = $index + 1 ?>
                          @foreach($pertanyaan_khusus as $key => $val)
                          <?php $index_khusus = $indexs + $key?>
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$val->pertanyaan}} <input type="hidden" name="id_pertanyaan[{{$index_khusus}}]" value="{{$val->id}}"> <span style="color:red;">{{$val->required}}</span></td>
                            <td class="kepuasan">
                              <label data-toggle="tooltip" data-placement="bottom" title="SANGAT TIDAK PUAS">
                                <input type="radio" name="tingkat_kepuasan[{{$index_khusus}}]" value="1" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepuasan">
                              <label data-toggle="tooltip" data-placement="bottom" title="TIDAK PUAS">
                                <input type="radio" name="tingkat_kepuasan[{{$index_khusus}}]" value="2" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepuasan">
                              <label data-toggle="tooltip" data-placement="bottom" title="PUAS">
                                <input type="radio" name="tingkat_kepuasan[{{$index_khusus}}]" value="3" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepuasan">
                              <label data-toggle="tooltip" data-placement="bottom" title="SANGAT PUAS">
                                <input type="radio" name="tingkat_kepuasan[{{$index_khusus}}]" value="4" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepentingan">
                              <label data-toggle="tooltip" data-placement="bottom" title="SANGAT TIDAK PENTING">
                                <input type="radio" name="tingkat_kepentingan[{{$index_khusus}}]" value="1" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepentingan">
                              <label data-toggle="tooltip" data-placement="bottom" title="TIDAK PENTING">
                                <input type="radio" name="tingkat_kepentingan[{{$index_khusus}}]" value="2" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepentingan">
                              <label data-toggle="tooltip" data-placement="bottom" title="PENTING">
                                <input type="radio" name="tingkat_kepentingan[{{$index_khusus}}]" value="3" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                            <td class="kepentingan">
                              <label data-toggle="tooltip" data-placement="bottom" title="SANGAT PENTING">
                                <input type="radio" name="tingkat_kepentingan[{{$index_khusus}}]" value="4" @if(!empty($val->required)) required @else @endif>
                              </label>
                            </td>
                          </tr>
                          @endforeach
                        </table>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary py-3 px-5 mt-5">Kirim</button>
                      </div>
                    </div>
                </form>
        </div><br><br>
      </div>
    </section>
  </div>

    @include('template.penggunafooter')

    <script type="text/javascript">
      $(document).ready(function(){

      });

      function kirimKuesioner(){
        Swal.fire({
            position: 'mid-end',
            title: 'Kirim Kuesioner?',
            showCancelButton: true,
            cancelButtonText:'Batal',
          }).then(function(result) {
                if (result.value) {
                    document.getElementById("kirimKuesioner").submit();
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
    </script>
    
  </body>
</html>
