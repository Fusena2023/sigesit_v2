<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Kepuasan;
use App\Tiket;
use App\TiketLayananJasa;
use App\TiketLayananProduk;
use App\TiketLayananKunjunganUmum;
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
use Illuminate\Support\Facades\Hash;


class KepuasanController extends Controller 
{
    public $successStatus = 200;
    
    public function kepuasan(Request $request)
    {
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        $kepuasan = Kepuasan::insert([
            'id_pengguna' => Auth::user()->id,
            'kategori' => $request->kategori,
            'id_terkait' => $request->id_tiket,
            'nilai' => $request->nilai_survei
        ]);

        $tiket = Tiket::where('id', $request->id_tiket)->get();

        $res['meta'] = $meta;
        $res['data'] = $tiket;

        return $res;
    }

    public function kuisioner(Request $request)
    {
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK'
        ];

        if ($request->kategori == 'jasa') {
            $data = TiketLayananJasa::where('id', $request->id_layanan)
                    ->update([
                        'kuesioner' => 't',
                    ]);
        } else if ($request->kategori == 'umum') {
            $data = TiketLayananKunjunganUmum::where('id', $request->id_layanan)
                    ->update([
                        'kuesioner' => 't',
                    ]);
        } else if ($request->kategori == 'produk') {
            $data = TiketLayananProduk::where('id', $request->id_layanan)
                    ->update([
                        'kuesioner' => 't',
                    ]);
        }

        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;
    }
}
