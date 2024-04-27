<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\PesanxTiket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PesanxTiketController extends Controller
{
    public $successStatus = 200;

	public function count_pesan_baru_by_room($id){
		
		$kategori = 'percakapan';
		
		$jumlah = DB::table('pesan')->where('kategori', $kategori)
									->where('id_untuk', Auth::user()->id)
									->where('id_terkait', $id)
									->where('readed', null)
									->count();
		
		return !empty($jumlah) ? $jumlah : 0;
	}
	
    public function pesanxtiket()
    {
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK',
        ];

        $user = Auth::user();
        $tableIds = PesanxTiket::where('id_pengguna', Auth::user()->id)->orderby('id', 'desc')->get();
		
		$jsonResult = array();
		
		for($i = 0; $i < count($tableIds); $i++)
        {
			 $jsonResult[$i]["id"] = $tableIds[$i]->id;
			 $jsonResult[$i]["kode"] = $tableIds[$i]->kode;
			 $jsonResult[$i]["tanggal"] = $tableIds[$i]->tanggal;
			 $jsonResult[$i]["status"] = $tableIds[$i]->status;
			 $jsonResult[$i]["id_pengguna"] = $tableIds[$i]->id_pengguna;
			 $jsonResult[$i]["created_at"] = $tableIds[$i]->created_at;
			 $jsonResult[$i]["updated_at"] = $tableIds[$i]->updated_at;
			 $jsonResult[$i]["perihal"] = $tableIds[$i]->perihal;
			 $jsonResult[$i]["jumlah_pesan_baru"] = $this->count_pesan_baru_by_room($tableIds[$i]->id);
		}

        $data = $jsonResult;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;

    }

    public function getnoroom()
    {
        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK',
        ];

        $datenow = date('Y-m-d');
        $datenowz = date('Ymd');
        $layananjasa = 'P/' . Auth::user()->id . '/' . $datenowz . '/';
        $last = PesanxTiket::latest('kode')->where('tanggal', $datenow)->first();
        if (empty($last)) {
            $new = 1;
        } else {
            $new = (int) str_replace($layananjasa, "", $last->kode) + 1;
        }
        if (strlen($new) < 2) {
            $no_tiket = $layananjasa . "00" . $new;
        } else {
            $no_tiket = $layananjasa . "0" . $new;
        }

        $data = $no_tiket;
        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;

    }

    public function detailpesanxtiket($id)
    {

        $pesanxtiket = PesanxTiket::where('id', $id)->get();

        $data = $pesanxtiket;

        return $data;

    }

    public function simpanpesanxtiket(Request $request)
    {

        $datenow = date('Y-m-d H:i:s');

        $id = PesanxTiket::insertGetId([
            'kode' => $request->no_tiket,
            'tanggal' => $datenow,
            'perihal' => $request->perihal,
            'status' => 1,
            'id_pengguna' => $request->id_pengguna,
            'created_at' => $datenow,
            'updated_at' => $datenow,
        ]);

        //$success = $id;
        $success = $this->detailpesanxtiket($id);

        $meta = [
            'code' => 200,
            'message' => 'Success',
            'status' => 'OK',
        ];

        $data = $success;

        $res['meta'] = $meta;
        $res['data'] = $data;

        return $res;

    }

    public function kirimpesandefault($param)
    {
        $data = explode(' - ', $param);

        $kategori = $data[0];
        $id_terkait = $data[1];
        $datenow = date('Y-m-d');

        $simpan = DB::table('pesan')
            ->where('kategori', $kategori)->where('id_terkait', $id_terkait)->where('readed', null)->where('dari', 'internal')
            ->update([
                'readed' => true,
            ]);

        $pesan = DB::table('pesan')->where('kategori', $kategori)->where('id_terkait', $id_terkait)->orderby('id', 'desc')->take(10)->get();

    }

    public function kirimpesanbaru(Request $request)
    {
        
        $kategori = 'percakapan';
        $id_terkait = $request->id_room;
        $pesan = $request->pesan;

        date_default_timezone_set('Asia/Jakarta');
        $datenow = date('Y-m-d H:i:s');
        if (!empty($pesan)){
            $simpan = DB::table('pesan')->insert([
                'kategori' => $kategori,
                'id_terkait' => $id_terkait,
                'pesan' => $pesan,
                'created_at' => $datenow,
                'dari' => 'pengguna',
                'id_dari' => Auth::user()->id,
                'untuk' => 'internal',
                'id_untuk' => 1,
            ]);
        }
        
        $simpan = DB::table('pesan')
            ->where('kategori', $kategori)->where('id_terkait', $id_terkait)->where('readed', null)->where('dari', 'internal')
            ->update([
                'readed' => true,
            ]);

        $pesan = DB::table('pesan')->where('kategori', $kategori)->where('id_terkait', $id_terkait)->orderby('created_at', 'ASC')->get();
        $res['data'] = $pesan;
        return $pesan;

    }
	
	public function countpesanbaru(Request $request){
		
		$kategori = 'percakapan';
        $id_untuk = $request->id_untuk;
		
		$pesan = DB::table('pesan')->where('kategori', $kategori)->where('id_untuk', $id_untuk)->where('readed', null)->count();
		$res['count'] = $pesan;
		
		return $res;
		
	}
	
	public function countpesan(Request $request){
	
		$kategori = 'percakapan';
        $id_terkait = $request->id_room;

        $pesan = DB::table('pesan')->where('kategori', $kategori)->where('id_terkait', $id_terkait)->orderby('created_at', 'ASC')->get();
        $res['count'] = count($pesan);
        return $res;
	}
}

