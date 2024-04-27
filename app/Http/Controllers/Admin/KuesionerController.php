<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class KuesionerController extends Controller
{
    public function index()
    {
        $data['no'] = 1;
        $data['pertanyaan'] = DB::table('master_pertanyaan')->whereNull('khusus')->orderBy('urutan','ASC')->get();
        $data['pertanyaan_khusus'] = DB::table('master_pertanyaan')->where('khusus', true)->orderBy('urutan','ASC')->get();
        $data['count_tiket'] = DB::table('tiket')->where('status',2)->count();
        $data['count_yang_belum_kuesioner'] = DB::table('tiket')->where('status',2)->where('kuesioner',null)->count();
        $data['count_yang_sudah_kuesioner'] = DB::table('tiket')->where('status',2)->where('kuesioner',true)->count();

        return view('admin.indexkuesioner', $data);
    }

    public function indexpertiket(){
        $data['no'] = 1;
        $data['nom'] = 1;
        $data['page'] = 'table';
        $data['kuesioner'] = DB::table('kuesioner')
                        ->select('id_tiket','id_user')
                        ->groupBy('id_tiket','id_user')->get();
        
        $data['pertanyaan'] = DB::table('master_pertanyaan')->whereNull('khusus')->orderBy('urutan','ASC')->get();
        $data['pertanyaan_khusus'] = DB::table('master_pertanyaan')->where('khusus', true)->orderBy('urutan','ASC')->get();

        return view('admin.indexkuesioner-tiket', $data);
    }

    public function getDataViewKuesioner($user_tiket){
        $dt = explode('_',$user_tiket);
        $data['id_user'] = $dt[0];
        $data['id_tiket'] = $dt[1];
        $data['no'] = 1;
        $data['nom'] = 1;
        $data['page'] = 'view';
        
        $data['pertanyaan'] = DB::table('master_pertanyaan')->whereNull('khusus')->orderBy('urutan','ASC')->get();
        $data['pertanyaan_khusus'] = DB::table('master_pertanyaan')->where('khusus', true)->orderBy('urutan','ASC')->get();

        return view('admin.indexkuesioner-tiket', $data);
    }

    public function index_export(){

        return view('admin.indexkuesioner-export');
    }

    public function cetak_export(Request $req){
        $periode = explode('to',$req->tanggal_range);
        $kategori = $req->kategori;

        // $data['tiket'] = DB::table('tiket')->whereBetween('tiket.tanggal', [$periode[0], $periode[1]])
        //         ->select('users_pengguna.*','tiket.kategori','tiket.id_terkait','tiket.no_tiket','tiket.id_pengguna','tiket.tanggal','tiket_layanan_jasa.id_master_layananjasa')
        //         ->leftjoin('users_pengguna','users_pengguna.id','tiket.id_pengguna')
        //         ->leftjoin('tiket_layanan_jasa','tiket_layanan_jasa.id','tiket.id_terkait')
        //         ->leftjoin("kuesioner",function($kuesioner){
        //             $kuesioner->on("kuesioner.id_tiket","=","tiket.id_terkait")
        //                     ->on("kuesioner.id_user","=","tiket.id_pengguna");
        //         })
        //         ->leftjoin("master_pertanyaan",function($master_pertanyaan) use ($kategori){
        //             $master_pertanyaan->on("master_pertanyaan.id","=","kuesioner.id_master_pertanyaan")
        //                                 ->where("master_pertanyaan.kategori","=",$kategori)
        //                                 ->groupBy('master_pertanyaan.kategori');
        //         })
        //         ->where('master_pertanyaan.kategori', $kategori)
        //         ->orderBy('tiket.tanggal','DESC')
        //         ->get();

        $kondisi_kuesioner = DB::table('kuesioner')->select('kuesioner.id_user','kuesioner.id_tiket')
                        ->leftjoin('master_pertanyaan','master_pertanyaan.id','kuesioner.id_master_pertanyaan')
                        ->when($kategori, function($q, $kategori){
                            $q->where('master_pertanyaan.kategori', $kategori);
                        })
                        ->groupBy('kuesioner.id_user','kuesioner.id_tiket')
                        ->get();
        foreach($kondisi_kuesioner as $val){
            $id_user[] = $val->id_user;
            $id_tiket[] = $val->id_tiket;
        }
        $data['tiket'] = DB::table('tiket')->whereBetween('tiket.tanggal', [$periode[0], $periode[1]])
                ->select('users_pengguna.*','tiket.kategori','tiket.id_terkait','tiket.no_tiket','tiket.id_pengguna','tiket.tanggal','tiket.id_master_layananjasa')
                ->leftjoin('users_pengguna','users_pengguna.id','tiket.id_pengguna')
                ->orderBy('tiket.tanggal','DESC')
                ->get();

        if(!empty($kategori)){
            $data['pertanyaan'] = DB::table('master_pertanyaan')->whereNull("deleted_at")->where('kategori', $kategori)->orderBy('id','ASC')->get();
        }else{
            $data['pertanyaan'] = DB::table('master_pertanyaan')->whereNull("deleted_at")->orderBy('id','ASC')->get();
        }
        $data['kategori'] = $kategori;

        $data['pusat'] = DB::table('master_pusat')->where('status',true)->orderBy('id','ASC')->get();
        $data['no'] = 2;

        return view('admin.exportexcel-kuesioner', $data);
    }
}
