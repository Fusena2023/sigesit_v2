<!DOCTYPE html>
<html>
@include('template.adminheader')
<body>
	@include('template.adminnavbar')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-database"></em>
				</a></li>
				<li class="active">Kuesioner Per Tiket</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Kuesioner Per Tiket</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List Kuesioner Per Tiket @if($page == 'view') <a href="{{route('admin.kuesionerTiket')}}" style="float:right" class="btn btn-sm btn-danger"><i class="fa fa-backward">&nbsp;</i>Kembali</a> @endif</div>
					<div class="panel-body">
                        @if($page == 'view')
                          <table class="table table-bordered" style="width:60%!important">
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
                          <table class="table table-bordered">
                            <tr>
                              <th>No.</th>
                              <th>PERNYATAAN</th>
                              <th colspan="4">TINGKAT KEPUASAN</th>
                              <th colspan="4">TINGKAT KEPENTINGAN</th>
                            </tr>
                            <tr>
                              <th colspan="2"></th>
                              <th>1</th>
                              <th>2</th>
                              <th>3</th>
                              <th>4</th>
                              <th>1</th>
                              <th>2</th>
                              <th>3</th>
                              <th>4</th>
                            </tr>
                            @foreach($pertanyaan as $key => $val)
                            <?php
                              $jawab_puas1 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepuasan', 1)->where('id_master_pertanyaan', $val->id)->count();
                              $jawab_puas2 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepuasan', 2)->where('id_master_pertanyaan', $val->id)->count();
                              $jawab_puas3 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepuasan', 3)->where('id_master_pertanyaan', $val->id)->count();
                              $jawab_puas4 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepuasan', 4)->where('id_master_pertanyaan', $val->id)->count();
                              $jawab_penting1 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepentingan', 1)->where('id_master_pertanyaan', $val->id)->count();
                              $jawab_penting2 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepentingan', 2)->where('id_master_pertanyaan', $val->id)->count();
                              $jawab_penting3 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepentingan', 3)->where('id_master_pertanyaan', $val->id)->count();
                              $jawab_penting4 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepentingan', 4)->where('id_master_pertanyaan', $val->id)->count();
                            ?>
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$val->pertanyaan}} <input type="hidden" name="id_pertanyaan[{{$val->urutan}}]" value="{{$val->id}}"> <span style="color:red;">{{$val->required}}</span></td>
                              <td><input type="radio" name="tingkat_kepuasan[{{$val->urutan}}]" @if($jawab_puas1 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepuasan[{{$val->urutan}}]" @if($jawab_puas2 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepuasan[{{$val->urutan}}]" @if($jawab_puas3 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepuasan[{{$val->urutan}}]" @if($jawab_puas4 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepentingan[{{$val->urutan}}]" @if($jawab_penting1 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepentingan[{{$val->urutan}}]" @if($jawab_penting2 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepentingan[{{$val->urutan}}]" @if($jawab_penting3 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepentingan[{{$val->urutan}}]" @if($jawab_penting4 == '1') checked="checked" @else disabled @endif></td>
                            </tr>
                            @endforeach
                            <tr>
                              <th colspan="10">Khusus yang pernah menyampaikan pengaduan terhadap layanan BIG</th>
                            </tr>
                            @foreach($pertanyaan_khusus as $key => $val)
                            <?php 
                            $jawab_puas_khusus1 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepuasan', 1)->where('id_master_pertanyaan', $val->id)->count();
                            $jawab_puas_khusus2 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepuasan', 2)->where('id_master_pertanyaan', $val->id)->count();
                            $jawab_puas_khusus3 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepuasan', 3)->where('id_master_pertanyaan', $val->id)->count();
                            $jawab_puas_khusus4 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepuasan', 4)->where('id_master_pertanyaan', $val->id)->count();
                            $jawab_penting_khusus1 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepentingan', 1)->where('id_master_pertanyaan', $val->id)->count();
                            $jawab_penting_khusus2 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepentingan', 2)->where('id_master_pertanyaan', $val->id)->count();
                            $jawab_penting_khusus3 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepentingan', 3)->where('id_master_pertanyaan', $val->id)->count();
                            $jawab_penting_khusus4 = DB::table('kuesioner')->where('id_user', $id_user)->where('id_tiket', $id_tiket)->where('tingkat_kepentingan', 4)->where('id_master_pertanyaan', $val->id)->count();
                            ?>
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$val->pertanyaan}} <input type="hidden" name="id_pertanyaan[{{$val->urutan}}]" value="{{$val->id}}"> <span style="color:red;">{{$val->required}}</span></td>
                              <td><input type="radio" name="tingkat_kepuasan[{{$val->urutan}}]" @if($jawab_puas_khusus1 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepuasan[{{$val->urutan}}]" @if($jawab_puas_khusus2 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepuasan[{{$val->urutan}}]" @if($jawab_puas_khusus3 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepuasan[{{$val->urutan}}]" @if($jawab_puas_khusus4 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepentingan[{{$val->urutan}}]" @if($jawab_penting_khusus1 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepentingan[{{$val->urutan}}]" @if($jawab_penting_khusus2 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepentingan[{{$val->urutan}}]" @if($jawab_penting_khusus3 == '1') checked="checked" @else disabled @endif></td>
                              <td><input type="radio" name="tingkat_kepentingan[{{$val->urutan}}]" @if($jawab_penting_khusus4 == '1') checked="checked" @else disabled @endif></td>
                            </tr>
                            @endforeach
                          </table>
                        @else
                          <div class="col-md-12">
                            <div class="table-responsive">
                              <table class="table table-bordered table-striped" id="kuesioner-table" width="100%">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>User Pengguna</th>
                                        <th>Tiket</th>
                                        <th><center>Aksi</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(!empty($kuesioner))
                                    @foreach($kuesioner as $k)
                                    <?php
                                      $user_tiket = $k->id_user.'_'.$k->id_tiket;
                                      $cek = !empty($k->id_tiket) ? getNoTiket($k->id_tiket) : null;
                                    ?>
                                    {{-- @if($cek != null) --}}
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{ !empty($k->id_user) ? getNamaPengguna($k->id_user) : ''}}</td>
                                        <td>{{ !empty($k->id_tiket) ? getNoTiket($k->id_tiket) : ''}}</td>
                                        <td>
                                            <center>
                                                <a href="{{route('admin.getDataViewKuesioner',$user_tiket)}}" title="View" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                    {{-- @endif --}}
                                    @endforeach
                                @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                        @endif
					</div>
				</div>
			</div>
        </div>
			<div class="col-sm-12">
				<p class="back-link">Badan <a href="https://sigesit.big.go.id/">Informasi</a> Geospasial</p>
			</div>
	</div>	<!--/.main-->
	
	@include('template.adminfooter')
	<script>
      $(document).ready(function() {
        $("#kuesioner-table").dataTable({
          language: {
              'paginate': {
                  'previous': '<span><</span>',
                  'next': '<span>></span>'
              }
          }
        });
        $("#kuesioner").addClass("active");
        $("#dashboard").removeClass("active");
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