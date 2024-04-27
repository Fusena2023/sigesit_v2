<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\PesanxTiket; 
use App\TiketLayananJasa;
use App\TiketLayananProduk;
use App\TiketLayananKunjunganUmum;
use App\TiketLayananKunjunganUmumDetail;
use App\Tiket;
use App\MasterLayananJasa; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
use Illuminate\Support\Facades\Hash;


class TiketController extends Controller 
{
    public $successStatus = 200;
    

    public function tiketlayananjasa() 
    { 
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        $user = Auth::user();
        $tiketlayananjasa = TiketLayananJasa::leftjoin('master_layanan_jasa','master_layanan_jasa.id','=','tiket_layanan_jasa.id_master_layananjasa')->select('tiket_layanan_jasa.*','master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')->where('tiket_layanan_jasa.id_pengguna',Auth::user()->id)
            ->where('tiket_layanan_jasa.status',1)
            ->orderby('id','desc')->get();

        $data = $tiketlayananjasa;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
         
    }

    public function tiketlayananjasatutup() 
    { 
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        $user = Auth::user();
        $tiketlayananjasa = TiketLayananJasa::leftjoin('master_layanan_jasa','master_layanan_jasa.id','=','tiket_layanan_jasa.id_master_layananjasa')->select('tiket_layanan_jasa.*','master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')->where('tiket_layanan_jasa.id_pengguna',Auth::user()->id)
            ->where('tiket_layanan_jasa.status',2)
            ->orderby('id','desc')->get();

        $data = $tiketlayananjasa;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
         
    }

    public function getnotiketlayananjasa() 
    { 
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

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

        $masterlayananjasa = MasterLayananJasa::select('id','nama_layanan_jasa')->orderby('id')->get();

        $success['no_tiket'] =  $no_tiket; 
        $success['masterlayananjasa'] =  $masterlayananjasa; 

        

        $data = $success;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
         
    } 

    public function detailtiketlayananjasa($id) 
    {

        $pesanxtiket = TiketLayananJasa::where('id',$id)->get();

        $data = $pesanxtiket;

        return $data;

    }

    public function getidkategorilayananjasa($kategori) 
    {

        $pesanxtiket = MasterLayananJasa::where('nama_layanan_jasa',$kategori)->first();

        $data = $pesanxtiket->id;

        return $data;

    }

    public function simpantiketlayananjasa(Request $request) 
    { 

        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';


        $id_kat = $this->getidkategorilayananjasa($request->id_master_layananjasa);

        $layananjasa = 'A';
        $datenow = $request->tanggal;

        $cek = TiketLayananJasa::select('no_tiket')->where('tanggal',$request->tanggal)->where('no_tiket',$request->no_tiket)->first();
        if(empty($cek)){
            $no_tiket = $request->no_tiket;
        }else{
            $last = TiketLayananJasa::latest('no_tiket')->where('tanggal',$request->tanggal)->first();

            $new = (int)str_replace("A","",$last->no_tiket) + 1;

            if(strlen($new)<2){
                $no_tiket=$layananjasa."00".$new; 
            }else{
                $no_tiket=$layananjasa."0".$new;
            }
        }
        


        $id = TiketLayananJasa::insertGetId([
            'no_tiket' => $no_tiket,
            'tanggal' => $request->tanggal,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'status' => 1,
            'id_master_layananjasa' => $id_kat,
            'id_pengguna' => Auth::user()->id,
            'created_at' => $datenow,
            'updated_at' => $datenow,
        ]);

        $id2 = Tiket::insertGetId([
            'no_tiket' => $no_tiket,
            'tanggal' => $request->tanggal,
            'status' => 1,
            'kategori' => 'jasa',
            'id_terkait' => $id,
            'id_pengguna' => Auth::user()->id,
        ]);

        //$success = $id;
        $success = $this->detailtiketlayananjasa($id);
        $success[0]['id_tiket'] = $id2;

        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        
        $data = $success;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;

    }



    public function tiketlayananproduk() 
    { 
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        $user = Auth::user();
        $tiketlayananproduk = TiketLayananProduk::where('id_pengguna',$user->id)->where('status',1)->orderby('id','desc')->get();

        $data = $tiketlayananproduk;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
         
    }

    public function tiketlayananproduktutup() 
    { 
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        $user = Auth::user();
        $tiketlayananproduk = TiketLayananProduk::where('id_pengguna',$user->id)->where('status',2)->orderby('id','desc')->get();

        $data = $tiketlayananproduk;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
         
    }

    public function getnotiketlayananproduk() 
    { 
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        $layananjasa = 'B';
        $datenow = date('Y-m-d');
        $last = TiketLayananProduk::latest('no_tiket')->where('tanggal',$datenow)->first();
        if(empty($last)){
            $new = 1;
        }else{
            $new = (int)str_replace("B","",$last->no_tiket) + 1;
        }
        if(strlen($new)<2){
            $no_tiket=$layananjasa."00".$new; 
        }else{
            $no_tiket=$layananjasa."0".$new;
        }

        $success['no_tiket'] =  $no_tiket;


        $data = $success;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
         
    }

    public function detailtiketlayananproduk($id) 
    {

        $pesanxtiket = TiketLayananProduk::where('id',$id)->get();

        $data = $pesanxtiket;

        return $data;

    }

    public function simpantiketlayananproduk(Request $request) 
    { 

        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';


        $layananjasa = 'B';
        $datenow = $request->tanggal;

        $cek = TiketLayananProduk::select('no_tiket')->where('tanggal',$request->tanggal)->where('no_tiket',$request->no_tiket)->first();
        if(empty($cek)){
            $no_tiket = $request->no_tiket;
        }else{
            $last = TiketLayananProduk::latest('no_tiket')->where('tanggal',$request->tanggal)->first();

            $new = (int)str_replace("B","",$last->no_tiket) + 1;

            if(strlen($new)<2){
                $no_tiket=$layananjasa."00".$new; 
            }else{
                $no_tiket=$layananjasa."0".$new;
            }
        }
        

        $id = TiketLayananProduk::insertGetId([
            'no_tiket' => $no_tiket,
            'tanggal' => $request->tanggal,
            'status' => 1,
            'id_pengguna' => Auth::user()->id,
            'created_at' => $datenow,
            'updated_at' => $datenow,
            ]);


        $id2 = Tiket::insertGetId([
            'no_tiket' => $no_tiket,
            'tanggal' => $request->tanggal,
            'status' => 1,
            'kategori' => 'produk',
            'id_terkait' => $id,
            'id_pengguna' => Auth::user()->id,
        ]);

        //$success = $id;
        $success = $this->detailtiketlayananproduk($id);
        $success[0]['id_tiket'] = $id2;

        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        
        $data = $success;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;

    }



    public function tiketlayananumum() 
    { 
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        $user = Auth::user();
        $tiketlayananjasa = TiketLayananKunjunganUmum::leftjoin('tiket_layanan_kunjungan_umum_detail','tiket_layanan_kunjungan_umum.id','=','tiket_layanan_kunjungan_umum_detail.id_tiket_kunjunganumum')
            ->leftjoin('master_pusat','tiket_layanan_kunjungan_umum_detail.id_pusat','=','master_pusat.id')
            ->select('tiket_layanan_kunjungan_umum.*','tiket_layanan_kunjungan_umum_detail.*','master_pusat.nama_pusat')
            ->where('tiket_layanan_kunjungan_umum.id_pengguna',Auth::user()->id)
            ->where('tiket_layanan_kunjungan_umum.status',1)
            ->orderby('tiket_layanan_kunjungan_umum.id','desc')->get();

        $data = $tiketlayananjasa;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
         
    }

    public function tiketlayananumumtutup() 
    { 
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        $user = Auth::user();
        $tiketlayananjasa = TiketLayananKunjunganUmum::leftjoin('tiket_layanan_kunjungan_umum_detail','tiket_layanan_kunjungan_umum.id','=','tiket_layanan_kunjungan_umum_detail.id_tiket_kunjunganumum')
            ->leftjoin('master_pusat','tiket_layanan_kunjungan_umum_detail.id_pusat','=','master_pusat.id')
            ->select('tiket_layanan_kunjungan_umum.*','tiket_layanan_kunjungan_umum_detail.*','master_pusat.nama_pusat')
            ->where('tiket_layanan_kunjungan_umum.id_pengguna',Auth::user()->id)
            ->where('tiket_layanan_kunjungan_umum.status',2)
            ->orderby('tiket_layanan_kunjungan_umum.id','desc')->get();

        $data = $tiketlayananjasa;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
         
    }

    public function getnotiketlayananumum() 
    { 
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        $layananjasa = 'C';
        $datenow = date('Y-m-d');
        $last = TiketLayananKunjunganUmum::latest('no_tiket')->where('tanggal',$datenow)->first();
        if(empty($last)){
            $new = 1;
        }else{
            $new = (int)str_replace("C","",$last->no_tiket) + 1;
        }
        if(strlen($new)<2){
            $no_tiket=$layananjasa."00".$new; 
        }else{
            $no_tiket=$layananjasa."0".$new;
        }

        $masterlayananjasa = DB::table('master_pusat')->select('id','nama_pusat')->where('status',true)->orderby('id')->get();

        $success['no_tiket'] =  $no_tiket; 
        $success['masterlayananumum'] =  $masterlayananjasa; 

        

        $data = $success;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
         
    } 

    public function detailtiketlayananumum($id) 
    {

        $pesanxtiket = TiketLayananKunjunganUmum::leftjoin('tiket_layanan_kunjungan_umum_detail','tiket_layanan_kunjungan_umum.id','=','tiket_layanan_kunjungan_umum_detail.id_tiket_kunjunganumum')
            ->leftjoin('master_pusat','tiket_layanan_kunjungan_umum_detail.id_pusat','=','master_pusat.id')
            ->select('tiket_layanan_kunjungan_umum.*','tiket_layanan_kunjungan_umum_detail.*','master_pusat.nama_pusat')->where('tiket_layanan_kunjungan_umum.id',$id)->get();

        $data = $pesanxtiket;

        return $data;

    }

    public function getidkategorilayananumum($kategori) 
    {

        $pesanxtiket = DB::table('master_pusat')->where('nama_pusat',$kategori)->first();

        $data = $pesanxtiket->id;

        return $data;

    }

    public function simpantiketlayananumum(Request $request) 
    { 

        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';


        $id_kat = $this->getidkategorilayananumum($request->id_pusat);

        $layananjasa = 'C';
        $datenow = $request->tanggal;

        $cek = TiketLayananKunjunganUmum::select('no_tiket')->where('tanggal',$request->tanggal)->where('no_tiket',$request->no_tiket)->first();
        if(empty($cek)){
            $no_tiket = $request->no_tiket;
        }else{
            $last = TiketLayananKunjunganUmum::latest('no_tiket')->where('tanggal',$request->tanggal)->first();

            $new = (int)str_replace("C","",$last->no_tiket) + 1;

            if(strlen($new)<2){
                $no_tiket=$layananjasa."00".$new; 
            }else{
                $no_tiket=$layananjasa."0".$new;
            }
        }
        


        $id = TiketLayananKunjunganUmum::insertGetId([
            'no_tiket' => $no_tiket,
            'tanggal' => $request->tanggal,
            'status' => 1,
            'id_pengguna' => Auth::user()->id,
            'created_at' => $datenow,
            'updated_at' => $datenow,
        ]);
        $id3 = TiketLayananKunjunganUmumDetail::insertGetId([
            'personil' => $request->personil,
            'keperluan' => $request->keperluan,
            'id_pusat' => $id_kat,
            'id_tiket_kunjunganumum' => $id,
        ]);

        $id2 = Tiket::insertGetId([
            'no_tiket' => $no_tiket,
            'tanggal' => $request->tanggal,
            'status' => 1,
            'kategori' => 'umum',
            'id_terkait' => $id,
            'id_pengguna' => Auth::user()->id,
        ]);


        //$success = $id;
        $success = $this->detailtiketlayananumum($id);
        $success[0]['id_tiket'] = $id2;

        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        
        $data = $success;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;

    }

    public function tiket() 
    { 
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        $user = Auth::user();
        $tiketlayananjasa = Tiket::leftjoin('tiket_layanan_jasa','tiket_layanan_jasa.id','=','tiket.id_terkait')->
                            leftjoin('tiket_layanan_kunjungan_umum','tiket_layanan_kunjungan_umum.id','=','tiket.id_terkait')->
                            leftjoin('tiket_layanan_kunjungan_umum_detail','tiket_layanan_kunjungan_umum.id','=','tiket_layanan_kunjungan_umum_detail.id_tiket_kunjunganumum')->
                            leftjoin('master_layanan_jasa','master_layanan_jasa.id','=','tiket_layanan_jasa.id_master_layananjasa')->
                            leftjoin('master_pusat','tiket_layanan_kunjungan_umum_detail.id_pusat','=','master_pusat.id')->
                            select('tiket.*','tiket_layanan_jasa.mulai','tiket_layanan_jasa.selesai','tiket_layanan_jasa.id_master_layananjasa','tiket_layanan_kunjungan_umum_detail.personil','tiket_layanan_kunjungan_umum_detail.keperluan','master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa','master_pusat.nama_pusat','tiket_layanan_kunjungan_umum_detail.id_pusat')->
                            where('tiket.id_pengguna',Auth::user()->id)->
                            orderby('tiket.id','desc')->take(10)->get();

        for ($i = 0; $i < count($tiketlayananjasa); $i++) {
            
            if($tiketlayananjasa[$i]->mulai != null){
                $mulai = $tiketlayananjasa[$i]->mulai;
            }else{
                $mulai = '';
            }

            if($tiketlayananjasa[$i]->selesai != null){
                $selesai = $tiketlayananjasa[$i]->selesai;
            }else{
                $selesai = '';
            }

            if($tiketlayananjasa[$i]->nama_layanan_jasa != null){
                $nama_layanan_jasa = $tiketlayananjasa[$i]->nama_layanan_jasa;
            }else{
                $nama_layanan_jasa = '';
            }

            if($tiketlayananjasa[$i]->personil != null){
                $personil = $tiketlayananjasa[$i]->personil;
            }else{
                $personil = '';
            }

            if($tiketlayananjasa[$i]->keperluan != null){
                $keperluan = $tiketlayananjasa[$i]->keperluan;
            }else{
                $keperluan = '';
            }

            if($tiketlayananjasa[$i]->nama_pusat != null){
                $nama_pusat = $tiketlayananjasa[$i]->nama_pusat;
            }else{
                $nama_pusat = '';
            }



            $success['id'] =  $tiketlayananjasa[$i]->id;
            $success['kategori'] =  $tiketlayananjasa[$i]->kategori;
            $success['id_terkait'] =  $tiketlayananjasa[$i]->id_terkait;
            $success['no_tiket'] =  $tiketlayananjasa[$i]->no_tiket;
            $success['tanggal'] =  $tiketlayananjasa[$i]->tanggal;
            $success['status'] =  $tiketlayananjasa[$i]->status;
            $success['id_pengguna'] =  $tiketlayananjasa[$i]->id_pengguna;
            $success['mulai'] =  $mulai;
            $success['selesai'] =  $selesai;
            $success['personil'] =  $personil;
            $success['keperluan'] =  $keperluan;
            $success['nama_layanan_jasa'] =  $nama_layanan_jasa;
            $success['nama_pusat'] =  $nama_pusat;

            $data[$i] = $success;
        }
        
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
         
    }




}
