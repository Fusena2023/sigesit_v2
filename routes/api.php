<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/cekuser',function(Request $request){
        try{
            $user=DB::table('users_pengguna')
            ->join('tiket_layanan_produk','users_pengguna.id','=','tiket_layanan_produk.id_pengguna')
            ->where('users_pengguna.email',$request->email)
            ->where('tiket_layanan_produk.no_tiket',$request->no_tiket)
            ->where('tiket_layanan_produk.tanggal',date('Y-m-d'))
            ->where('tiket_layanan_produk.status','!=',2)
            ->count();

            if($user == 1){
                 $query=DB::table('users_pengguna')->select('users_pengguna.nama','users_pengguna.email','users_pengguna.jenis_pengguna','tiket_layanan_produk.no_tiket','tiket_layanan_produk.id_pengguna')
                ->join('tiket_layanan_produk','users_pengguna.id','=','tiket_layanan_produk.id_pengguna')
                ->where('users_pengguna.email',$request->email)
                ->where('tiket_layanan_produk.no_tiket',$request->no_tiket)
                ->where('tiket_layanan_produk.tanggal',date('Y-m-d'))
                ->where('tiket_layanan_produk.status','!=',2)
                ->first();
                    $data=[
                        'id_pengguna' => $query->id_pengguna,
                        'nama' => $query->nama,
                        'email'=> $query->email,
                        'no_tiket'=> $query->no_tiket,
                        'jenis_user' => $query->jenis_pengguna,
                    ];
                $response=[
                    'status' => 'sukses',
                    'data' => $data
                ];
                return response()->json($response,200);
            } else {
                $response=[
                    'status' => 'gagal',
                    'message' => 'email tidak sesuai atau no.antrian sudah closed dan kadaluarsa'
                ];
                return response()->json($response,401);
            }
        }catch(Exception $e){
            $response=[
                'status'=>'ERROR',
                'error'=>$e->getCode(),
                //'message'=>$e->getMessage()

            ];
            return response()->json($response,200);
        }
});

Route::post('/closeTicket',function(Request $request){
    try{
        $update=DB::table('tiket_layanan_produk')->where('no_tiket',$request->no_tiket)->where('tanggal',date('Y-m-d'))->update(['status'=>2,'updated_at'=>date('Y-m-d')]);
        $response=[
            'status' => 'sukses',
            'message' => 'berhasil update'
        ];
        return response()->json($response,200);
    }catch(Exception $e){
        $response=[
                'status'=>'ERROR',
                'error'=>$e->getCode(),
                //'message'=>$e->getMessage()

            ];
            return response()->json($response,200);
    }
});




Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register1');
Route::post('register-instansi', 'API\UserController@register2');
Route::post('logout','API\UserController@logoutApi');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');

    Route::post('pesanxtiket', 'API\PesanxTiketController@pesanxtiket');
    Route::post('getnoroom', 'API\PesanxTiketController@getnoroom');
    Route::post('simpanpesanxtiket', 'API\PesanxTiketController@simpanpesanxtiket');
    Route::post('kirimpesandefault/{param}', 'API\PesanxTiketController@kirimpesandefault');
    Route::post('kirimpesanbaru', 'API\PesanxTiketController@kirimpesanbaru');
    Route::post('countpesan', 'API\PesanxTiketController@countpesan');
    Route::post('countpesanbaru', 'API\PesanxTiketController@countpesanbaru');

    Route::post('tiketlayananjasa', 'API\TiketController@tiketlayananjasa');
    Route::post('tiketlayananjasatutup', 'API\TiketController@tiketlayananjasatutup');
    Route::post('getnotiketlayananjasa', 'API\TiketController@getnotiketlayananjasa');
    Route::post('simpantiketlayananjasa', 'API\TiketController@simpantiketlayananjasa');

    Route::post('tiketlayananproduk', 'API\TiketController@tiketlayananproduk');
    Route::post('tiketlayananproduktutup', 'API\TiketController@tiketlayananproduktutup');
    Route::post('getnotiketlayananproduk', 'API\TiketController@getnotiketlayananproduk');
    Route::post('simpantiketlayananproduk', 'API\TiketController@simpantiketlayananproduk');

    Route::post('tiketlayananumum', 'API\TiketController@tiketlayananumum');
    Route::post('tiketlayananumumtutup', 'API\TiketController@tiketlayananumumtutup');
    Route::post('getnotiketlayananumum', 'API\TiketController@getnotiketlayananumum');
    Route::post('simpantiketlayananumum', 'API\TiketController@simpantiketlayananumum');

    Route::get('tiket', 'API\TiketController@tiket');

    Route::post('kepuasan', 'API\KepuasanController@kepuasan');
    Route::post('kuisioner', 'API\KepuasanController@kuisioner');
    

});



