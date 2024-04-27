<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class KepuasanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengguna');
    }

    public function getTiket()
    {
        $data = DB::table('tiket')->where('id_pengguna', Auth::guard('pengguna')->user()->id)->get();


        return json_encode(array('data'=>$data));
    }

    public function storekepuasan(Request $request)
    {
        $id_terkait = $request->input('id_terkait');
        $ket_kep = $request->input('ket_kep');
        $peng_kep = $request->input('peng_kep');
        $sangat_tp = $request->input('sangat_tp');
        $status = 1;

        if($id_terkait !='' && $ket_kep !='' && $peng_kep != '' && $sangat_tp != ''){
            $data = array('id_pengguna'=>$peng_kep,"kategori"=>$ket_kep,"id_terkait"=>$id_terkait,"nilai"=>$sangat_tp);
            $data1 = array("status_kepuasan"=>$status);

            DB::table('tiket')->where('id_pengguna', $peng_kep)->update($data1);
            $value = DB::table('kepuasan_pengguna')->insert($data);
                if($value){
                    return response()->json(['status'=>'success']);
                }else{
                    return response()->json(['status'=>'error']);
                }
        }else{
            return response()->json(['status'=>'Data Kosong']);
        }

        exit;
    }
}
