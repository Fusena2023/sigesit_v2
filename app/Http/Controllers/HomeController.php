<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterJenisLayanan;
use App\MasterLayananJasa;
use App\MasterLayananDiklat;
use App\MasterTentang;
use App\MasterBerita;
use App\MasterLayananDigital;
use App\Pengguna;
use App\MasterFAQ;
use App\Helper;
use Auth;
use DB;
use Hash;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cek_login = Auth::check();
        $getDataInformasi = DB::table('master_informasi')->where('status', 1)->first();
        $masterjenislayanan = MasterJenisLayanan::where('show', true)->orderby('id', 'asc')->get();
        $masterlayananjasa = MasterLayananJasa::where('id_pusat', '!=', 14)->where('status',1)->orderby('id', 'asc')->get();
        $masterlayananprodukig = MasterLayananJasa::where('id_pusat', 14)->orderby('id', 'asc')->get();
        $masterlayanandiklat = MasterLayananDiklat::orderby('id', 'asc')->get();
        $mastertentang = MasterTentang::where('status', true)->get();
        $masterberita = MasterBerita::where('show', true)->limit(6)->get();
        $masterlokasi = MasterTentang::where('status_lokasi', true)->get();
        $masterlayanandigital = MasterLayananDigital::where('show', true)->orderby('id', 'asc')->get();
        $masterbanner = DB::table('master_banner')->where('show', true)->orderby('id', 'asc')->get();
        $mastersurvey = DB::table('master_survey')->select('tahun')->groupBy('tahun')->orderby('tahun', 'asc')->get();
        $master_survey_p = DB::table('master_hasil_survey')->select('tahun')->groupBy('tahun')->orderby('tahun', 'asc')->get();
        $master_survey_k = DB::table('master_hasil_survey_komponen')->select('tahun')->groupBy('tahun')->orderby('tahun', 'asc')->get();

        $curl = curl_init(Helper::API() . 'produk');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("APP-KEY:" . Helper::APPKEY(), "cache-control: no-cache"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, 6);
        $result = curl_exec($curl);

        curl_close($curl);
        $resProduk = json_decode($result, true);

        $curl1 = curl_init(Helper::API() . 'sub_produk');
        curl_setopt($curl1, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl1, CURLOPT_HTTPHEADER, array("APP-KEY:" . Helper::APPKEY(), "cache-control: no-cache"));
        curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl1, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl1, CURLOPT_TIMEOUT, 6);
        $result1 = curl_exec($curl1);

        curl_close($curl1);
        $resSubProduk = json_decode($result1, true);

        return view('home', compact('cek_login','master_survey_k', 'master_survey_p', 'mastersurvey', 'masterbanner', 'masterjenislayanan', 'masterlayananjasa', 'masterlayanandiklat', 'mastertentang', 'masterberita', 'masterlokasi', 'masterlayanandigital', 'resProduk', 'resSubProduk', 'masterlayananprodukig', 'getDataInformasi'));
    }
    public function indexfaq()
    {
        $masterfaq = MasterFAQ::where('status', true)->orderby('id', 'asc')->get();
        return view('homefaq', compact('masterfaq'));
    }
    public function FilterFaq(Request $req)
    {
        // dd($req->all());
        $show = 'show';
        $filter = $req->filter;
        // $masterfaq = MasterFAQ::where('jawaban', 'ilike', '%' . $filter . '%')->Orwhere('pertanyaan', 'ilike', '%' . $filter . '%')->get();
        $masterfaq = MasterFAQ::where('status', true)->where(function ($query) use ($filter) {
            $query->where('jawaban', 'ilike', '%' . $filter . '%')->Orwhere('pertanyaan', 'ilike', '%' . $filter . '%');
        })->get();
        // dd($masterfaq);
        return view('homefaq', compact('show', 'filter', 'masterfaq'));
    }

    public function getSurvey()
    {
        $tahun = $_GET['tahunSurvey'];
        $series = [];
        $seriesData = [];
        $categories = [];
        $categoriesForeach = [];
        $sumNilai = 0;

        $mastersurvey = DB::table('master_survey')->where('tahun', $tahun)->orderby('triwulan', 'asc')->get();
        foreach ($mastersurvey as $ms) {
            $categoriesForeach[] = $ms;
            $tri = ($ms->triwulan == 1) ? "I" : (($ms->triwulan == 2)  ? "II" : (($ms->triwulan == 3) ? "III" : (($ms->triwulan == 4) ? "IV" : "")));
            $categories[] = 'Triwulan ' . $tri;
        }
        $sumNilai = DB::table('master_survey')->where('tahun', $tahun)->orderby('triwulan', 'asc')->sum('nilai');
        foreach ($categoriesForeach as $c) {
            $tri = ($c->triwulan == 1) ? "I" : (($c->triwulan == 2)  ? "II" : (($c->triwulan == 3) ? "III" : (($c->triwulan == 4) ? "IV" : "")));
            $seriesData['name'] = 'Nilai ';
            $seriesData['data'][] = Round($c->nilai, 2);
        }
        $series[] = $seriesData;
        $seriesData = [];

        echo json_encode([
            'table'     => $mastersurvey,
            'series'    => $series,
            'categories'    => $categories,
        ]);
    }

    public function getSurveyPerpusat()
    {
        $tahun = $_GET['tahun_pusat'];
        $series = [];
        $seriesData = [];
        $categories = [];

        $pusat = DB::table('master_pusat')->where('master_pusat.id','!=',14)->get();
        foreach ($pusat as $ms) {
            $categories[] = $ms->nama_pusat;
            $cat[] = $ms->id;
        }
        $triwulan = [1,2,3,4];
        foreach ($triwulan as $t) {
            if($t == 1){
                $ubahTriwulan = 'I';
            }elseif($t == 2){
                $ubahTriwulan = 'II';
            }elseif($t == 3){
                $ubahTriwulan = 'III';
            }else{
                $ubahTriwulan = 'IV';
            }
            $seriesData['name'] = 'TRIWULAN '.$ubahTriwulan;
            foreach($cat as $c){
                $dataIKM = DB::table('master_hasil_survey')->where('id_pusat', $c)->where('tw', $t)->where('tahun', $tahun)->first();

                $seriesData['data'][] = ($dataIKM) ? $dataIKM->ikm : 0;
            }
            $series[] = $seriesData;
            $seriesData = [];
        }

        echo json_encode([
            'series'    => $series,
            'categories'    => $categories,
        ]);
    }

    public function getSurveyKomponen()
    {
        $tahun = $_GET['tahun_kompon'];
        $series = [];
        $seriesData = [];
        $categories = [];

        $unsur = DB::table('master_unsur')->get();
        foreach ($unsur as $ms) {
            $categories[] = $ms->nama_unsur;
            $cat[] = $ms->id;
        }
        $triwulan = [1,2,3,4];
        foreach ($triwulan as $t) {
            if($t == 1){
                $ubahTriwulan = 'I';
            }elseif($t == 2){
                $ubahTriwulan = 'II';
            }elseif($t == 3){
                $ubahTriwulan = 'III';
            }else{
                $ubahTriwulan = 'IV';
            }
            $seriesData['name'] = 'TRIWULAN '.$ubahTriwulan;
            foreach($cat as $c){
                $dataIKM = DB::table('master_hasil_survey_komponen')->where('id_unsur', $c)->where('tw', $t)->where('tahun', $tahun)->first();

                $seriesData['data'][] = ($dataIKM) ? $dataIKM->ikm : 0;
            }
            $series[] = $seriesData;
            $seriesData = [];
        }

        echo json_encode([
            'series'    => $series,
            'categories'    => $categories,
        ]);
    }

    public function getResponden($param)
    {
        $series = [];
        $seriesData = [];

        if ($param == 'kelamin') {
            $laki = DB::table('kuesioner')->select('kuesioner.id_tiket')
                ->leftjoin('users_pengguna', 'users_pengguna.id', 'kuesioner.id_user')
                ->where('jenis_kelamin', 1)
                ->groupBy('kuesioner.id_tiket')->get();
            $perempuan = DB::table('kuesioner')->select('kuesioner.id_tiket')
                ->leftjoin('users_pengguna', 'users_pengguna.id', 'kuesioner.id_user')
                ->where('jenis_kelamin', 2)
                ->groupBy('kuesioner.id_tiket')->get();
            //Grafik
            $kelamin = array('Laki-Laki', 'Perempuan');
            foreach ($kelamin as $k) {
                $seriesData['name'] = $k;
                $seriesData['y'] = ($k == 'Laki-Laki') ? count($laki) : count($perempuan);

                $series[] = $seriesData;
                $seriesData = [];
            }
            //Table
            $jumlah = count($laki) + count($perempuan);
            $data['laki'] = count($laki);
            $data['laki_persentase'] = ($jumlah != 0) ? Round(count($laki) / $jumlah * 100, 2) : 0;
            $data['perempuan'] = count($perempuan);
            $data['perempuan_persentase'] = ($jumlah != 0) ? Round(count($perempuan) / $jumlah * 100, 2) : 0;

            echo json_encode([
                'table'     => $data,
                'series'    => $series,
            ]);
        } else if ($param == 'pendidikan') {
            $data = [];
            $tmp = [];
            $series = [];
            $seriesData = [];
            $pendidikan = array('SD', 'SMP', 'SMA', 'DIPLOMA', 'S1', 'S2', 'S3');
            foreach ($pendidikan as $key => $p) {
                $jumlah = DB::table('kuesioner')->select('kuesioner.id_tiket')->leftjoin('users_pengguna', 'users_pengguna.id', 'kuesioner.id_user')
                    ->where('pendidikan', $p)
                    ->groupBy('kuesioner.id_tiket')->get();
                $JumlahAll = DB::table('kuesioner')->select('kuesioner.id_tiket')->leftjoin('users_pengguna', 'users_pengguna.id', 'kuesioner.id_user')
                    ->whereNotNull('pendidikan')
                    ->groupBy('kuesioner.id_tiket')->get();

                $tmp['no'] = $key + 1;
                $tmp['nama'] = ($p) ? $p : '';
                $tmp['jumlah'] = (count($jumlah) != 0) ? count($jumlah) : 0;
                $tmp['persentase'] = (count($JumlahAll) != 0) ? Round(count($jumlah) / count($JumlahAll) * 100, 2) : 0;

                $seriesData['name'] = ($p) ? $p : '';
                $seriesData['y'] = !empty($jumlah) ? count($jumlah) : 0;

                $data[] = $tmp;
                $tmp = [];

                $series[] = $seriesData;
                $seriesData = [];
            }
            echo json_encode([
                'data' => $data,
                'series' => $series,
            ]);
        } else if ($param == 'instansi') {
            $data = [];
            $tmp = [];
            $series = [];
            $seriesData = [];
            $cat = [];
            $no = 1;

            $instansi = array('Kementerian', 'Pendidikan', 'Pemda', 'Lainnya');
            foreach ($instansi as $in) {
                $cat[] = $in;
            }

            $seriesData['name'] = 'Responden';
            foreach ($cat as $u) {
                if ($u == 'Lainnya') {
                    $jumlah = DB::table('kuesioner')->select('kuesioner.id_tiket')->leftjoin('users_pengguna', 'users_pengguna.id', 'kuesioner.id_user')
                        ->whereNotIn('jenis_instansi', $instansi)
                        ->groupBy('kuesioner.id_tiket')->get();
                    $JumlahAll = DB::table('kuesioner')->select('kuesioner.id_tiket')->leftjoin('users_pengguna', 'users_pengguna.id', 'kuesioner.id_user')
                        ->whereNotNull('jenis_instansi')
                        ->groupBy('kuesioner.id_tiket')->get();
                } else {
                    $jumlah = DB::table('kuesioner')->select('kuesioner.id_tiket')->leftjoin('users_pengguna', 'users_pengguna.id', 'kuesioner.id_user')
                        ->where('jenis_instansi', $u)
                        ->groupBy('kuesioner.id_tiket')->get();
                    $JumlahAll = DB::table('kuesioner')->select('kuesioner.id_tiket')->leftjoin('users_pengguna', 'users_pengguna.id', 'kuesioner.id_user')
                        ->whereNotNull('jenis_instansi')
                        ->groupBy('kuesioner.id_tiket')->get();
                }

                $seriesData['data'][] = (count($jumlah) != 0) ? count($jumlah) : 0;

                $tmp['no'] = $no++;
                $tmp['nama'] = ($u) ? $u : '';
                $tmp['jumlah'] = (count($jumlah) != 0) ? count($jumlah) : 0;
                $tmp['persentase'] = (count($JumlahAll) != 0) ? Round(count($jumlah) / count($JumlahAll) * 100, 2) : 0;

                $data[] = $tmp;
                $tmp = [];
            }

            $series[] = $seriesData;
            $seriesData = [];

            echo json_encode([
                'data' => $data,
                'series' => $series,
                'categories' => $cat,
            ]);
        }
    }

    public function getNilaiKepuasan()
    {
        $totalData1 = 0;
        $totalData2 = 0;
        $totalData3 = 0;
        $totalData4 = 0;
        $data1 = DB::table('kepuasan_pengguna')->where('nilai', 1)->count();
        $data2 = DB::table('kepuasan_pengguna')->where('nilai', 2)->count();
        $data3 = DB::table('kepuasan_pengguna')->where('nilai', 3)->count();
        $data4 = DB::table('kepuasan_pengguna')->where('nilai', 4)->count();
        $total = DB::table('kepuasan_pengguna')->count();

        if ($data1 > 0) {
            $totalData1 = round(($data1 / $total) * 100, 2);
        } else {
            $totalData1 = 0;
        }
        if ($data2 > 0) {
            $totalData2 = round(($data2 / $total) * 100, 2);
        } else {
            $totalData2 = 0;
        }
        if ($data3 > 0) {
            $totalData3 = round(($data3 / $total) * 100, 2);
        } else {
            $totalData3 = 0;
        }
        if ($data4 > 0) {
            $totalData4 = round(($data4 / $total) * 100, 2);
        } else {
            $totalData4 = 0;
        }

        return json_encode(
            array(
                'data1' => $totalData1,
                'data2' => $totalData2,
                'data3' => $totalData3,
                'data4' => $totalData4
            )
        );
    }
    public function indexpengaduan()
    {
        return view('home_pengaduan');
    }
    public function save_pengaduan(Request $req)
    {
        // dd($req->all());
        date_default_timezone_set('Asia/Jakarta');
        $datenow = date('Y-m-d H:i:s');
        $destination =  public_path() . '/uploads/pengaduan';
        $nama_file = date('d-m-Y') . '_' . $req->file('upload_dokumen')->getClientOriginalName();
        $move = $req->file('upload_dokumen')->move($destination, $nama_file);
        $simpan = DB::table('pengaduan')->insert([
            'nama_pengguna' => $req->nama_pengguna,
            'nama_instansi' => $req->nama_instansi,
            'email' => $req->email,
            'no_hp' => $req->no_hp,
            'isi_pengaduan' => $req->isi_pengaduan,
            'upload_dokumen' => $nama_file,
            'created_at' => $datenow,
            'status' => 0,
        ]);
        return redirect()->back();
    }
    public function index_profile()
    {
        return view('home_profile');
    }
    public function indexstandartpelayanan()
    {

        $masterbanner = DB::table('master_banner')->where('show', true)->orderby('id', 'asc')->get();
        $master_standard = DB::table('master_standart')->where('status', 1)->first();

        return view('indexstandartpelayanan', compact('masterbanner', 'master_standard'));
    }
    
    public function sendEmailforgotPassword(Request $request){
        $cek = DB::table('users_pengguna')->where('email',$request->email)->first();
        if(!empty($cek)){
            $email = $request->email;
            $subject = 'RESET PASSWORD SIGESIT';
            $content = "
                HELLO !
                You are receiving this email because we received a password reset request for your account.
                
                ".route('pengguna.LupaPasswordApi', base64_encode($cek->id))."
                
                If you did not request a password reset, no further action is required.

                Regards,
                Badan Informasi Geospasial
            ";
            sendEmailApi($email, $subject, $content);

            return redirect()->back()->with(['success'=>'Silahkan Check Email']);
        }else{
            return redirect()->back()->with(['error'=>'Email Tidak Terdaftar']);
        }
    }

    public function LupaPasswordApi($id)
    {
        $id_user = base64_decode($id);
        $user = DB::table('users_pengguna')->where('id',$id_user)->first();
        return view('pengguna.lupa_password',compact('user'));
    }
    
    public function updatePassword(Request $request)
    {
        try{
            DB::table('users_pengguna')->where('id',$request->id)->update([
                'password'  => Hash::make($request->password)
            ]);

            return redirect()->route('login')->with(['success'=>'Berhasil Ubah Password']);
        }catch(Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Ubah Password']);
        }
    }

    public function cetak_pdf()
    {
        $data = array();
        $pdf = PDF::setOptions(
            [
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'enable_php' => true
            ]
        )->loadView('admin.tiket.cetak_tiket_simponi', $data)
        ->setPaper('a4', 'portrait');
        // return view('admin.tiket.cetak_tiket_simponi');
        return $pdf->stream('Cetak PDF.pdf');
    }
}
