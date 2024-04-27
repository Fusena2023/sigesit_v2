<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Session;
use App\PesanxTiket;
use Illuminate\Support\Facades\Crypt;

class PesanxTiketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:pengguna');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('pengguna.indexpesanxtiket');
    }
    public function getdatapesanxtiket()
    {
        $tiketlayananjasa = PesanxTiket::where('id_pengguna',Auth::guard('pengguna')->user()->id)->orderby('id','desc')->get();

        return Datatables::of($tiketlayananjasa)
                ->addColumn('action', function ($mjl) {
                    if($mjl->status == 1){
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait',$mjl->id)->where('dari','internal')->where('readed',null)->get();
                        foreach ($pesan as $value) {
                            if($value->count > 0){
                                return '<center>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/percakapan/'.$mjl->id.'" class="btn btn-outline-success notification"> 
                                        <span>Pesan</span>
                                        <span class="badge">'.$value->count.'</span> 
                                        </a>
                                        </center>';
                            }else{
                                return '<center>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/percakapan/'.$mjl->id.'" class="btn btn-outline-success"> Pesan</a>
                                        </center>';
                            }
                        }
                        
                    }else{
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait',$mjl->id)->where('dari','internal')->where('readed',null)->get();
                        foreach ($pesan as $value) {
                            if($value->count > 0){
                                return '<center>
                                        <a href="#" class="btn btn-outline-dark"> Closed</a>
                                        </center>';
                            }else{
                                return '<center>
                                        <a href="#" class="btn btn-outline-dark"> Closed</a>
                                        </center>';

                            }
                        }
                        
                    }
                    
                })
                ->make(true);
    }
    public function indexpesanxtiketadd()
    {
        //no_antrian per hari
        $layananjasa = 'P';
        $datenow = date('Y-m-d');
        $last = PesanxTiket::latest('kode')->where('tanggal',$datenow)->first();
        if(empty($last)){
            $new = 1;
        }else{
            $new = (int)str_replace("P","",$last->kode) + 1;
        }
        if(strlen($new)<2){
            $no_tiket=$layananjasa."00".$new; 
        }else{
            $no_tiket=$layananjasa."0".$new;
        }


        return view('pengguna.indexpesanxtiketadd',compact('no_tiket'));
    }
    public function simpanpesanxtiket(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';

        $id = PesanxTiket::insertGetId([
            'kode' => $request->no_tiket,
            'tanggal' => $datenow,
            'perihal' => $request->perihal,
            'status' => 1,
            'id_pengguna' => $request->id_pengguna,
            'created_at' => $datenow,
            'updated_at' => null,
            ]);


        if(!empty($id)){
            Session::flash('success', 'Berhasil Buat Room Pesan Percakapan');
            return redirect('/pesan-baru');
        }
        

    }


    public function indexpesan($tiket,$id)
    {
        $datenow = date('Y-m-d');

        if($tiket == 'jasa'){

            $tiketlayananjasa = TiketLayananJasa::leftjoin('master_layanan_jasa','tiket_layanan_jasa.id_master_layananjasa','=','master_layanan_jasa.id')->leftjoin('master_pusat','master_layanan_jasa.id_pusat','=','master_pusat.id')->select('tiket_layanan_jasa.*','master_layanan_jasa.nama_layanan_jasa','master_pusat.nama_pusat')->where('tiket_layanan_jasa.id',$id)->get();

            return view('pengguna.indexpesan',compact('tiketlayananjasa','datenow','tiket','id'));


        }
        if($tiket == 'produk'){

            $tiketlayananjasa = TiketLayananProduk::where('id_pengguna',Auth::guard('pengguna')->user()->id)->where('id',$id)->orderby('id')->get();
            return view('pengguna.indexpesan',compact('tiketlayananjasa','datenow','tiket','id'));

        }
        if($tiket == 'umum'){

            $tiketlayananjasa = TiketLayananKunjunganUmum::where('id',$id)->get();
            return view('pengguna.indexpesan',compact('tiketlayananjasa','datenow','tiket','id'));

        }

        
        
    }

    public function kirimpesandefault($param)
    {
        $data = explode(' - ', $param);

        $kategori = $data[0];
        $id_terkait = $data[1];
        $datenow = date('Y-m-d');

        $simpan = DB::table('pesan')
            ->where('kategori',$kategori)->where('id_terkait',$id_terkait)->where('readed',null)->where('dari','internal')
            ->update([
                'readed' => true,
            ]);
        
        $pesan = DB::table('pesan')->where('kategori',$kategori)->where('id_terkait',$id_terkait)->orderby('id','desc')->take(10)->get();

        return view('pengguna.pesan',compact('datenow','pesan','tiket','id'));

    }

    public function kirimpesanbaru($param)
    {
        $data = explode(' - ', $param);

        $kategori = $data[0];
        $id_terkait = $data[1];
        $pesan = str_replace('&', ' ', $data[2]);

        date_default_timezone_set('Asia/Jakarta');
        $datenow = date('Y-m-d H:i:s');

        $simpan = DB::table('pesan')->insert([
            'kategori' => $kategori,
            'id_terkait' => $id_terkait,
            'pesan' => $pesan,
            'created_at' => $datenow,
            'dari' => 'pengguna',
            'id_dari' => Auth::guard('pengguna')->user()->id,
            'untuk' => 'internal',
            'id_untuk' => 1,
            ]);
        $simpan = DB::table('pesan')
            ->where('kategori',$kategori)->where('id_terkait',$id_terkait)->where('readed',null)->where('dari','internal')
            ->update([
                'readed' => true,
            ]);
        

        $pesan = DB::table('pesan')->where('kategori',$kategori)->where('id_terkait',$id_terkait)->orderby('id','desc')->take(10)->get();

        return view('pengguna.pesan',compact('datenow','pesan','tiket','id'));

    }

    public function indextiket()
    {
        $masterjenislayanan = MasterJenisLayanan::orderby('id','asc')->get();
        foreach ($masterjenislayanan as $value) {
            if($value->id == 1)
            {
                $layananproduk = $value->icon;
            }elseif($value->id == 2){
                $layananjasa = $value->icon;
            }elseif($value->id == 3){
                $layanandiklat = $value->icon;
            }elseif($value->id == 4){
                $layanankunjunganumum = $value->icon;
            }
        }

        return view('pengguna.indextiket',compact('layananproduk','layananjasa','layanandiklat','layanankunjunganumum'));
    }
    public function getdatatiketlayananjasa()
    {
        $tiketlayananjasa = TiketLayananJasa::leftjoin('master_layanan_jasa','master_layanan_jasa.id','=','tiket_layanan_jasa.id_master_layananjasa')->select('tiket_layanan_jasa.*','master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')->where('tiket_layanan_jasa.id_pengguna',Auth::guard('pengguna')->user()->id)->orderby('id')->get();

        return Datatables::of($tiketlayananjasa)
                ->addColumn('action', function ($mjl) {
                    if($mjl->status == 1){
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait',$mjl->id)->where('dari','internal')->where('readed',null)->get();
                        foreach ($pesan as $value) {
                            if($value->count > 0){
                                return '<center>
                                        <a target="_blank" href=" '.url('detailtiketlayananjasa').'/'.$mjl->id.'" class="btn btn-outline-primary"> Cetak Tiket</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/jasa/'.$mjl->id.'" class="btn btn-outline-success notification"> 
                                        <span>Pesan</span>
                                        <span class="badge">'.$value->count.'</span> 
                                        </a>
                                        </center>';
                            }else{
                                return '<center>
                                        <a target="_blank" href=" '.url('detailtiketlayananjasa').'/'.$mjl->id.'" class="btn btn-outline-primary"> Cetak Tiket</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/jasa/'.$mjl->id.'" class="btn btn-outline-success"> Pesan</a>
                                        </center>';
                            }
                        }
                        
                    }else{
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait',$mjl->id)->where('dari','internal')->where('readed',null)->get();
                        foreach ($pesan as $value) {
                            if($value->count > 0){
                                return '<center>
                                        <a href="#" class="btn btn-outline-dark"> Closed</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/jasa/'.$mjl->id.'" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">'.$value->count.'</span> 
                                        </a>
                                        </center>';
                            }else{
                                return '<center>
                                        <a href="#" class="btn btn-outline-dark"> Closed</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/jasa/'.$mjl->id.'" class="btn btn-outline-success"> Pesan</a>
                                        </center>';

                            }
                        }
                        
                    }
                    
                })
                ->make(true);
    }
    public function getdatatiketlayananproduk()
    {
        $tiketlayananproduk = TiketLayananProduk::where('id_pengguna',Auth::guard('pengguna')->user()->id)->orderby('id')->get();

        return Datatables::of($tiketlayananproduk)
                ->addColumn('action', function ($mjl) {
                    if($mjl->status == 1){
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait',$mjl->id)->where('dari','internal')->where('readed',null)->get();
                        foreach ($pesan as $value) {
                            if($value->count > 0){
                                return '<center>
                                        <a href="#" class="btn btn-outline-primary"> Open</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/produk/'.$mjl->id.'" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">'.$value->count.'</span> 
                                        </a>
                                        </center>';
                            }else{
                                return '<center>
                                        <a href="#" class="btn btn-outline-primary"> Open</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/produk/'.$mjl->id.'" class="btn btn-outline-success"> Pesan</a>
                                        </center>';
                            }
                        }
                        
                    }else{
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait',$mjl->id)->where('dari','internal')->where('readed',null)->get();
                        foreach ($pesan as $value) {
                            if($value->count > 0){
                                return '<center>
                                        <a href="#" class="btn btn-outline-dark"> Closed</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/produk/'.$mjl->id.'" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">'.$value->count.'</span> 
                                        </a>
                                        </center>';
                            }else{
                                return '<center>
                                        <a href="#" class="btn btn-outline-dark"> Closed</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/produk/'.$mjl->id.'" class="btn btn-outline-success"> Pesan</a>
                                        </center>';
                            }
                        }
                        
                    }
                    
                })
                ->make(true);
    }
    public function getdatatiketlayanandiklat()
    {
        $tiketlayanandiklat = TiketLayananDiklat::leftjoin('master_layanan_diklat','master_layanan_diklat.id','=','tiket_layanan_diklat.id_master_layanandiklat')->select('tiket_layanan_diklat.*','master_layanan_diklat.nama_layanan_diklat as nama_layanan_diklat')->where('id_pengguna',Auth::guard('pengguna')->user()->id)->orderby('id')->get();

        return Datatables::of($tiketlayanandiklat)
                ->addColumn('action', function ($mjl) {
                    if($mjl->status == 1){
                        return '<center>
                                <a href="#" class="btn btn-outline-primary"> Open</a>
                                </center>';
                    }else{
                        return '<center>
                                <a href="#" class="btn btn-outline-dark"> Closed</a>
                                </center>';
                    }
                    
                })
                ->make(true);
    }
    public function getdatatiketlayanankunjunganumum()
    {
        $tiketlayanankunjunganumum = TiketLayananKunjunganUmum::where('id_pengguna',Auth::guard('pengguna')->user()->id)->orderby('id')->get();

        return Datatables::of($tiketlayanankunjunganumum)
                ->addColumn('action', function ($mjl) {
                    if($mjl->status == 1){
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait',$mjl->id)->where('dari','internal')->where('readed',null)->get();
                        foreach ($pesan as $value) {
                            if($value->count > 0){
                                return '<center>
                                        <a target="_blank" href=" '.url('detailtiketlayanankunjunganumum').'/'.$mjl->id.'" class="btn btn-outline-primary"> Cetak Tiket</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/umum/'.$mjl->id.'" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">'.$value->count.'</span>
                                        </a>
                                        </center>';
                            }else{
                                return '<center>
                                        <a target="_blank" href=" '.url('detailtiketlayanankunjunganumum').'/'.$mjl->id.'" class="btn btn-outline-primary"> Cetak Tiket</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/umum/'.$mjl->id.'" class="btn btn-outline-success"> Pesan</a>
                                        </center>';
                            }
                        }
                        
                    }else{
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait',$mjl->id)->where('dari','internal')->where('readed',null)->get();
                        foreach ($pesan as $value) {
                            if($value->count > 0){
                                return '<center>
                                        <a href="#" class="btn btn-outline-dark"> Closed</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/umum/'.$mjl->id.'" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">'.$value->count.'</span>
                                        </a>
                                        </center>';
                            }else{
                                return '<center>
                                        <a href="#" class="btn btn-outline-dark"> Closed</a>
                                        <a target="_blank" href=" '.url('/tiket/pesan').'/umum/'.$mjl->id.'" class="btn btn-outline-success"> Pesan</a>
                                        </center>';
                            }
                        }
                        
                    }
                    
                })
                ->make(true);
    }

    public function indextiketlayananjasa()
    {
        //no_antrian per hari
        $layananjasa = 'A';
        $datenow = date('Y-m-d');
        $last = TiketLayananJasa::latest('no_tiket')->where('tanggal',$datenow)->first();
        if(empty($last)){
            $new = 1;
        }else{
            $new = (int)str_replace("A","",$last->no_tiket) + 1;
        }
        if(strlen($new)<2){
            $no_tiket=$layananjasa."00".$new; 
        }else{
            $no_tiket=$layananjasa."0".$new;
        }


        $masterlayananjasa = MasterlayananJasa::orderby('id')->get();

        return view('pengguna.indextiketlayananjasa',compact('no_tiket','masterlayananjasa'));
    }
    public function simpantiketlayananjasa(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';

        $id = TiketLayananJasa::insertGetId([
            'no_tiket' => $request->no_tiket,
            'tanggal' => $request->tanggal,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'status' => 1,
            'id_master_layananjasa' => $request->id_master_layananjasa,
            'id_pengguna' => $request->id_pengguna,
            'created_at' => $datenow,
            'updated_at' => null,
            ]);

        /*$id2 = DB::connection('mysql2')->table('tqueue')->insertGetId([
            'layanan' => 1,//di DB A itu 1
            'layanan_awal' => 0, //rata2 isi di db
            'nomor' => $request->no_tiket,
            'status' => 4, //ga tau
            'waktu_ambil_tiket' => $datenow,
            'waktu_dipanggil' => $datenull,
            'waktu_dilayani' => $datenull,
            'waktu_selesai' => $datenull,
            'waktu_diambil' => $datenull,
            'transfer' => 1, // ga tau
            'm_prioritas' => 255, //samain aja
            'status_pakai' => 0,
            'user_id' => 'root',
            'group_nomor_urut' => 0,
            'is_spesial_call' => 0,
            'is_aktif_call_gab' => 0,
            ]);*/

        if(!empty($id)){
            Session::flash('success', 'Berhasil Buat Tiket Layanan Jasa');
            return redirect('/tiket');
        }
        

    }
    public function detailtiketlayananjasa($id)
    {
        $tiketlayananjasa = TiketLayananJasa::leftjoin('master_layanan_jasa','tiket_layanan_jasa.id_master_layananjasa','=','master_layanan_jasa.id')->leftjoin('master_pusat','master_layanan_jasa.id_pusat','=','master_pusat.id')->select('tiket_layanan_jasa.*','master_layanan_jasa.nama_layanan_jasa','master_pusat.nama_pusat')->where('tiket_layanan_jasa.id',$id)->get();
        $datenow = date('Y-m-d');

        return view('pengguna.detailtiketlayananjasa',compact('tiketlayananjasa','datenow'));
    }

    public function indextiketlayananproduk()
    {
        //no_antrian per hari
        $layananproduk = 'B';
        $datenow = date('Y-m-d');
        $last = TiketLayananProduk::latest('no_tiket')->where('tanggal',$datenow)->first();
        if(empty($last)){
            $new = 1;
        }else{
            $new = (int)str_replace("B","",$last->no_tiket) + 1;
        }
        if(strlen($new)<2){
            $no_tiket=$layananproduk."00".$new; 
        }else{
            $no_tiket=$layananproduk."0".$new;
        }

        return view('pengguna.indextiketlayananproduk',compact('no_tiket'));
    }
    public function simpantiketlayananproduk(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';

        $id = TiketLayananProduk::insertGetId([
            'no_tiket' => $request->no_tiket,
            'tanggal' => $request->tanggal,
            'status' => 1,
            'id_pengguna' => $request->id_pengguna,
            'created_at' => $datenow,
            'updated_at' => null,
            ]);

        /*$id2 = DB::connection('mysql2')->table('tqueue')->insertGetId([
            'layanan' => 2,//di DB B itu 2
            'layanan_awal' => 0, //rata2 isi di db
            'nomor' => $request->no_tiket,
            'status' => 4, //ga tau
            'waktu_ambil_tiket' => $datenow,
            'waktu_dipanggil' => $datenull,
            'waktu_dilayani' => $datenull,
            'waktu_selesai' => $datenull,
            'waktu_diambil' => $datenull,
            'transfer' => 1, // ga tau
            'm_prioritas' => 255, //samain aja
            'status_pakai' => 0,
            'user_id' => 'root',
            'group_nomor_urut' => 0,
            'is_spesial_call' => 0,
            'is_aktif_call_gab' => 0,
            ]);*/

        if(!empty($id)){
            Session::flash('success', 'Berhasil Buat Tiket Layanan Produk');
            return redirect('/tiket');
        }
        

    }




    public function indextiketlayanandiklat()
    {
        //no_antrian per hari
        $layanandiklat = 'C';
        $datenow = date('Y-m-d');
        $last = TiketLayananDiklat::latest('no_tiket')->where('tanggal',$datenow)->first();
        if(empty($last)){
            $new = 1;
        }else{
            $new = (int)str_replace("C","",$last->no_tiket) + 1;
        }
        if(strlen($new)<2){
            $no_tiket=$layanandiklat."00".$new; 
        }else{
            $no_tiket=$layanandiklat."0".$new;
        }

        $masterlayanandiklat = MasterlayananDiklat::orderby('id')->get();

        return view('pengguna.indextiketlayanandiklat',compact('no_tiket','masterlayanandiklat'));
    }
    public function simpantiketlayanandiklat(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';

        $id = TiketLayananDiklat::insertGetId([
            'no_tiket' => $request->no_tiket,
            'tanggal' => $request->tanggal,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'status' => 1,
            'id_master_layanandiklat' => $request->id_master_layanandiklat,
            'id_pengguna' => $request->id_pengguna,
            'created_at' => $datenow,
            'updated_at' => null,
            ]);

        /*$id2 = DB::connection('mysql2')->table('tqueue')->insertGetId([
            'layanan' => 3,//di DB C itu 3
            'layanan_awal' => 0, //rata2 isi di db
            'nomor' => $request->no_tiket,
            'status' => 4, //ga tau
            'waktu_ambil_tiket' => $datenow,
            'waktu_dipanggil' => $datenull,
            'waktu_dilayani' => $datenull,
            'waktu_selesai' => $datenull,
            'waktu_diambil' => $datenull,
            'transfer' => 1, // ga tau
            'm_prioritas' => 255, //samain aja
            'status_pakai' => 0,
            'user_id' => 'root',
            'group_nomor_urut' => 0,
            'is_spesial_call' => 0,
            'is_aktif_call_gab' => 0,
            ]);*/

        if(!empty($id)){
            Session::flash('success', 'Berhasil Buat Tiket Layanan Diklat');
            return redirect('/tiket');
        }
    }



    public function indextiketlayanankunjunganumum()
    {
        //no_antrian per hari
        $layananjasa = 'C';
        $datenow = date('Y-m-d');
        $last = TiketLayananKunjunganUmum::latest('no_tiket')->where('tanggal',$datenow)->first();
        if(empty($last)){
            $new = 1;
        }else{
            $new = (int)str_replace("D","",$last->no_tiket) + 1;
        }
        if(strlen($new)<2){
            $no_tiket=$layananjasa."00".$new; 
        }else{
            $no_tiket=$layananjasa."0".$new;
        }

        $masterpusat = MasterPusat::orderby('id')->get();

        return view('pengguna.indextiketlayanankunjunganumum',compact('no_tiket','masterpusat'));
    }
    public function simpantiketlayanankunjunganumum(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';

        $id = TiketLayananKunjunganUmum::insertGetId([
            'no_tiket' => $request->no_tiket,
            'tanggal' => $request->tanggal,
            'status' => 1,
            'id_pengguna' => $request->id_pengguna,
            'created_at' => $datenow,
            'updated_at' => null,
            ]);

        $jumlahkunjungan = $request->panjangarray;

            if ($jumlahkunjungan > 0) {
                for ($i = 0; $i < $jumlahkunjungan; $i++) {

                    $id3 = TiketLayananKunjunganUmumDetail::insert([
                            'personil' => $request->personil[$i],
                            'keperluan' => $request->keperluan[$i],
                            'id_pusat' => $request->id_pusat[$i],
                            'id_tiket_kunjunganumum' => $id,
                        ]);

                }
            }

        /*$id2 = DB::connection('mysql2')->table('tqueue')->insertGetId([
            'layanan' => 4,//di DB D itu 4
            'layanan_awal' => 0, //rata2 isi di db
            'nomor' => $request->no_tiket,
            'status' => 4, //ga tau
            'waktu_ambil_tiket' => $datenow,
            'waktu_dipanggil' => $datenull,
            'waktu_dilayani' => $datenull,
            'waktu_selesai' => $datenull,
            'waktu_diambil' => $datenull,
            'transfer' => 1, // ga tau
            'm_prioritas' => 255, //samain aja
            'status_pakai' => 0,
            'user_id' => 'root',
            'group_nomor_urut' => 0,
            'is_spesial_call' => 0,
            'is_aktif_call_gab' => 0,
            ]);*/

        if(!empty($id)){
            Session::flash('success', 'Berhasil Buat Tiket Layanan Kunjungan Umum');
            return redirect('/tiket');
        }
        
    }
    public function detailtiketlayanankunjunganumum($id)
    {
        $tiketlayanankunjunganumum = TiketLayananKunjunganUmum::where('id',$id)->get();
        $tiketlayanankunjunganumumdetail = TiketLayananKunjunganUmumDetail::leftjoin('master_pusat','tiket_layanan_kunjungan_umum_detail.id_pusat','=','master_pusat.id')->select('tiket_layanan_kunjungan_umum_detail.*','master_pusat.nama_pusat')->where('id_tiket_kunjunganumum',$id)->get();
        $datenow = date('Y-m-d');

        return view('pengguna.detailtiketlayanankunjunganumum',compact('tiketlayanankunjunganumum','datenow','tiketlayanankunjunganumumdetail'));
    }



}

