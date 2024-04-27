<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class KuesionerPenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengguna');
    }

    public function index(Request $request)
    {
        $layanan = $request->layanan;
        $id_tiket = $request->id_tiket;
        $kategori = $request->kategori;
        // dd($kategori);
        
        $data['nama']=Auth::guard('pengguna')->user()->nama;
        $data['layanan']=$layanan;
        $data['id_tiket']=$id_tiket;
        $data['kategori']=$kategori;
        $data['pertanyaan'] = DB::table("master_pertanyaan")->where("kategori", $kategori)->whereNull("deleted_at")->whereNull("khusus")->orderBy("urutan","ASC")->get();
        $data['pertanyaan_khusus'] = DB::table("master_pertanyaan")->where("kategori", $kategori)->whereNull("deleted_at")->where("khusus", true)->orderBy("urutan","ASC")->get();
        
        return view('pengguna.kuesioner',$data);
    }

    public function submit(Request $request){
        // dd($request->all());
        $kategori = $request->kategori;
        $id_user = Auth::guard('pengguna')->user()->id;
        $data['pertanyaan'] = DB::table("master_pertanyaan")->where("kategori", $kategori)->whereNull("deleted_at")->whereNull("khusus")->orderBy("urutan","ASC")->get();

        $count = count($request->tingkat_kepuasan);
        if($count > 0){
            for($i=0 ; $i < $count ; $i++){
                
                $insert = DB::table('kuesioner')->insert([
                    'id_user'   => $id_user,
                    'id_tiket'  => $request->id_tiket,
                    'id_master_pertanyaan'  => $request->id_pertanyaan[$i],
                    'tingkat_kepuasan'  => $request->tingkat_kepuasan[$i],
                    'tingkat_kepentingan'   => $request->tingkat_kepentingan[$i],
                    'created_at'            => date('Y-m-d H:i:s'),
                ]);
            }
        }

        DB::table('tiket')->where('id',$request->id_tiket)->update(['kuesioner'=>true]);

        return redirect()->route('pengguna.tiket')->with(['success'=>'Kuesioner Terisi']);
    }

}
