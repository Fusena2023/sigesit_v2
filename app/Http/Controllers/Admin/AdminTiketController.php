<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Session;
use App\TiketLayananJasa;
use App\data;
use App\TiketLayananDiklat;
use App\TiketLayananKunjunganUmum;
use App\TiketLayananKunjunganUmumDetail;
use App\MasterlayananJasa;
use App\Pengguna;
use App\PesanxTiket;
use App\Tiket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailKuesioner;

class AdminTiketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:internal');
    }


    public function indexpesan($tiket, $id)
    {
        $datenow = date('Y-m-d');

        if ($tiket == 'jasa') {

            $tiketlayananjasa = Tiket::leftjoin('master_layanan_jasa', 'tiket.id_master_layananjasa', '=', 'master_layanan_jasa.id')
                ->leftjoin('master_pusat', 'master_layanan_jasa.id_pusat', '=', 'master_pusat.id')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa', 'master_pusat.nama_pusat')
                ->where('tiket.id', $id)
                ->get();

            $validasi_pesan = Tiket::leftjoin('master_layanan_jasa', 'tiket.id_master_layananjasa', '=', 'master_layanan_jasa.id')
                ->leftjoin('master_pusat', 'master_layanan_jasa.id_pusat', '=', 'master_pusat.id')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa', 'master_pusat.nama_pusat')
                ->where('tiket.id', $id)
                ->first();

            return view('admin.indexpesan', compact('validasi_pesan', 'tiketlayananjasa', 'datenow', 'tiket', 'id'));
        }
        if ($tiket == 'produk') {

            $tiketlayananjasa = Tiket::where('id', $id)->orderby('id')->get();
            $validasi_pesan =   Tiket::where('id', $id)->first();
            return view('admin.indexpesan', compact('validasi_pesan', 'tiketlayananjasa', 'datenow', 'tiket', 'id'));
        }
        if ($tiket == 'pasut') {

            $tiketlayananjasa = Tiket::where('id', $id)->orderby('id')->get();
            $validasi_pesan = Tiket::where('id', $id)->orderby('id')->first();
            return view('admin.indexpesan', compact('validasi_pesan', 'tiketlayananjasa', 'datenow', 'tiket', 'id'));
        }
        if ($tiket == 'umum') {

            $tiketlayananjasa = TiketLayananKunjunganUmum::where('id', $id)->get();
            $validasi_pesan = TiketLayananKunjunganUmum::where('id', $id)->get();
            return view('admin.indexpesan', compact('validasi_pesan', 'tiketlayananjasa', 'datenow', 'tiket', 'id'));
        }
        if ($tiket == 'percakapan') {

            $tiketlayananjasa = PesanxTiket::where('id', $id)->get();
            $validasi_pesan =   PesanxTiket::where('id', $id)->first();
            return view('admin.indexpesan', compact('validasi_pesan', 'tiketlayananjasa', 'datenow', 'tiket', 'id'));
        }
    }
    public function kirimpesandefault($param)
    {
        $data = explode(' - ', $param);

        $kategori = $data[0];
        $id_terkait = $data[1];
        $datenow = date('Y-m-d');

        $simpan = DB::table('pesan')
            ->where('kategori', $kategori)->where('id_terkait', $id_terkait)->where('readed', null)->where('dari', 'pengguna')
            ->update([
                'readed' => true,
            ]);
        $tiket = "";
        $id = '';

        $pesan = DB::table('pesan')->where('kategori', $kategori)->where('id_terkait', $id_terkait)->orderby('id', 'desc')->take(10)->get();

        return view('admin.pesan', compact('datenow', 'pesan', 'tiket', 'id'));
    }

    public function kirimpesanbaru($param)
    {
        $data = explode(' - ', $param);
        $tiket = '';
        $id = '';
        $kategori = $data[0];
        $id_terkait = $data[1];
        $pesan = str_replace('&', ' ', $data[2]);

        if ($kategori == 'jasa') {
            $tiketlayananjasa = DB::table('tiket')->where('id', $id_terkait)->get();
            foreach ($tiketlayananjasa as $value) {
                $pengguna = $value->id_pengguna;
            }
        }
        if ($kategori == 'produk') {
            $tiketlayananjasa = DB::table('tiket')->where('id', $id_terkait)->get();
            foreach ($tiketlayananjasa as $value) {
                $pengguna = $value->id_pengguna;
            }
        }
        if ($kategori == 'pasut') {
            $tiketlayananjasa = DB::table('tiket')->where('id', $id_terkait)->get();
            foreach ($tiketlayananjasa as $value) {
                $pengguna = $value->id_pengguna;
            }
        }
        if ($kategori == 'umum') {

            $tiketlayananjasa = TiketLayananKunjunganUmum::where('id', $id_terkait)->get();
            foreach ($tiketlayananjasa as $value) {
                $pengguna = $value->id_pengguna;
            }
        }
        if ($kategori == 'percakapan') {

            $tiketlayananjasa = PesanxTiket::where('id', $id_terkait)->get();
            foreach ($tiketlayananjasa as $value) {
                $pengguna = $value->id_pengguna;
            }
        }

        date_default_timezone_set('Asia/Jakarta');
        $datenow = date('Y-m-d H:i:s');

        $simpan = DB::table('pesan')->insert([
            'kategori' => $kategori,
            'id_terkait' => $id_terkait,
            'pesan' => $pesan,
            'created_at' => $datenow,
            'dari' => 'internal',
            'id_dari' => Auth::guard('internal')->user()->id,
            'untuk' => 'pengguna',
            'id_untuk' => $pengguna,
        ]);

        $simpan = DB::table('pesan')
            ->where('kategori', $kategori)->where('id_terkait', $id_terkait)->where('readed', null)->where('dari', 'pengguna')
            ->update([
                'readed' => true,
            ]);


        $pesan = DB::table('pesan')->where('kategori', $kategori)->where('id_terkait', $id_terkait)->orderby('id', 'desc')->take(10)->get();

        return view('admin.pesan', compact('datenow', 'pesan', 'tiket', 'id'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indextiketlayananjasa()
    {
        return view('admin.tiket.indextiketlayananjasa');
    }
    public function getdatatiketlayananjasa()
    {
        $tiketlayananjasa = DB::table('tiket')
            ->where('tiket.kategori', 'jasa')
            ->leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
            ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
            ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa', 'users_pengguna.nama')
            ->orderby('tiket.id', 'desc')
            ->get();

        return Datatables::of($tiketlayananjasa)
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                        <span class="badge badge-primary" style="background-color:green;">Open</span>';
                } else if ($mjl->status == 2) {
                    return '<center>
                        <span class="badge badge-info"style="background-color: #1e72c4;">Closed</span>';
                } else if ($mjl->status == 3) {
                    return '<center>
                         <span class="badge badge-warning">Menunggu Verifikasi</span>';
                } else if ($mjl->status == 4) {
                    return '<center>
                        <span class="badge badge-danger"style="background-color: #990505;">Di Tolak</span>';
                }
            })
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == 1) {

                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                        <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                        <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                        <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                        <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-sm btn-default notification">
                                        <span ><i class="fa fa-paper-plane "></i></span>
                                        <span class="badge">' . $value->count . '</span>
                                        </a>
                                        </center>';
                        } else {

                            return '<center>
                                        <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                        <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                        <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                        <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                        <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-sm btn-default">
                                        <span><i class="fa fa-paper-plane "></i></span>
                                        </a>
                                        </center>';
                        }
                    }
                } else if ($mjl->status == 3) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {

                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-sm btn-default notification">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            <span class="badge">' . $value->count . '</span>
                                            </a>
                                            <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id . ')"><i class="glyphicon glyphicon-check"></i></a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        } else {
                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-sm btn-default">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            </a>
                                            <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id . ')"><i class="glyphicon glyphicon-check"></i></a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        }
                    }
                } else {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {

                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-sm btn-default notification">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            <span class="badge">' . $value->count . '</span>
                                            </a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        } else {
                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-sm btn-default">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            </a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        }
                    }
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    public function UpdatePenolakanJasaNol(Request $req)
    {
        dd('okee');
        date_default_timezone_set('Asia/Jakarta');
        $id_data = $req->id_data;

        // Kebutuhan Data Simponi
        $result = '';
        if ($req->status == "1") {
            $date = date("Y-m-d H:i:s", strtotime("+ 7 days"));
            $tiket = DB::table('tiket')->where('id', $id_data)->first();
            $user = DB::table('users_pengguna')->where('id', $tiket->id_pengguna)->first();
            $total_nominal = '';
            if ($tiket->kategori == 'jasa') {
                $total_nominal = 0;
                $volume = 0;
                $total_tarif = 120000000 * $volume;
            } elseif ($tiket->kategori == 'produk') {
                $sum_total_nominal = 0;
                $sum_volume = 0;
                $trx_beli = DB::table('trx_beli')->where('id_tiket', $tiket->id)->first();
                $trx_beli_detail = DB::table('trx_beli_detail')->where('id_beli', $trx_beli->id_beli)->get();
                foreach ($trx_beli_detail as $detail) {
                    $sum_total_nominal += $detail->total;
                    $sum_volume += $detail->banyaknya;
                }
                $total_nominal = $sum_total_nominal;
                $volume = $sum_volume;
                $total_tarif = 120000000 * $volume;
            } elseif ($tiket->kategori == 'pasut') {
                $sum_total_nominal = 0;
                $sum_volume = 0;
                $detail_tiket_pasut = DB::table('detail_tiket_pasut')->where('id_tiket', $tiket->id)->get();
                foreach ($detail_tiket_pasut as $detail) {
                    $sum_total_nominal += $detail->total;
                    $sum_volume += $detail->jumlah;
                }
                $total_nominal = $sum_total_nominal;
                $volume = $sum_volume;
                $total_tarif = 120000000 * $volume;
            }
            $header = [
                // trx_id_KL
                $tiket->no_tiket,
                // user_id
                '', // Belum Bener
                // password
                '', // Belum Bener
                // expired_date
                $date,
                // kode_KL
                '083',
                // kode_eselon_1
                '01',
                // kode_satker
                '017216',
                // jenis_pnbp
                'F',
                // Kode_mata_uang
                '1',
                // Total_nominal_billing
                $total_nominal,
                // Nama_wajib_bayar
                $user->nama,
                // Kode_satker_pemungut
                '', // Belum Bener
                // NPWP
                '999999999999999',
                // NIK
                '9999999999999999',
            ];
            $detail = [
                // nama_wajib_bayar
                'BENDAHARA PENERIMAAN SATKER SEKRETARIAT UTAMA BIG',
                // kode_tarif_simponi
                '001687', // Belum Bener
                // kode_PP_simponi
                '2009006', // Belum Bener
                // kode_akun
                '423141', // Belum Bener
                // nominal_tarif_pnbp
                120000000, // Belum Bener
                // volume
                $volume,
                // satuan_tarif
                'per Dokumen', // Belum Bener
                // total_tarif_per_record
                $total_tarif,
                // kode_lokasi
                '', // Belum Bener
                // kode_kabkota
                '', // Belum Bener
            ];
            $data['simponi_req']['method'] = 'billingcode_v4';
            $data['simponi_req']['data']['header'] = $header;
            $data['simponi_req']['data']['detail'][] = $detail;
            $url = env('API_SIMPONI_URL') . "/api/simponi/index/format/json";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "simponi_req=" . json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/x-www-form-urlencoded'
            ]);
            $data = json_decode(curl_exec($ch));
            $result = $data;
            if (curl_error($ch)) {
                return redirect()->back()->with(['error' => curl_error($ch)]);
            }
            curl_close($ch);
        }

        DB::table('tiket')->where('id', $id_data)->update([
            'status' => $req->status,
            'alasan' => $req->alasan_tolak,
            'kuesioner' => ($req->status == 4) ? true : null
        ]);

        return redirect()->back()->with(['success' => $result]);
    }
    public function tutuptiketlayananjasa(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');

        $id = DB::table('tiket')->where('id', $request->id)->update([
            'status' => 2,
            'updated_at' => $datenow,
            'closed_by' => 'Admin'
        ]);

        // $tiket = DB::table('tiket')->where('id_terkait', $request->id)->where('kategori', 'jasa')->update([
        //     'status' => 2
        // ]);

        Session::flash('success', 'Tiket Selesai');


        return redirect('/admin/tiketlayananjasa');
    }


    public function indextiketlayananproduk()
    {
        return view('admin.tiket.indextiketlayananproduk');
    }
    public function getdatatiketlayananproduk()
    {
        $tiketlayananproduk = DB::table('tiket')->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
            ->where('tiket.kategori', 'produk')
            ->select('tiket.*', 'users_pengguna.nama')
            ->orderby('tiket.id', 'desc')
            ->get();

        return Datatables::of($tiketlayananproduk)
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                    <span class="badge badge-primary" style="background-color:green;">Open</span>';
                } else if ($mjl->status == 2) {
                    return '<center>
                    <span class="badge badge-info"style="background-color: #1e72c4;">Closed</span>';
                } else if ($mjl->status == 3) {
                    return '<center>
                     <span class="badge badge-warning">Menunggu Verifikasi</span>';
                } else if ($mjl->status == 4) {
                    return '<center>
                    <span class="badge badge-danger"style="background-color: #990505;">Di Tolak</span>';
                }
            })
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == 1) {

                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                        <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                        <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                        <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                        <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-sm btn-default notification">
                                        <span ><i class="fa fa-paper-plane "></i></span>
                                        <span class="badge">' . $value->count . '</span>
                                        </a>
                                        </center>';
                        } else {

                            return '<center>
                                        <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                        <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                        <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                        <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                        <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-sm btn-default">
                                        <span><i class="fa fa-paper-plane "></i></span>
                                        </a>
                                        </center>';
                        }
                    }
                } else if ($mjl->status == 3) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {

                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-sm btn-default notification">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            <span class="badge">' . $value->count . '</span>
                                            </a>
                                            <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id . ')"><i class="glyphicon glyphicon-check"></i></a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        } else {
                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-sm btn-default">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            </a>
                                            <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id . ')"><i class="glyphicon glyphicon-check"></i></a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        }
                    }
                } else {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {

                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-sm btn-default notification">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            <span class="badge">' . $value->count . '</span>
                                            </a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        } else {
                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-sm btn-default">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            </a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        }
                    }
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function UpdatePenolakan(Request $req)
    {
        // dd($req->all());
        $id_data = $req->id_data;
        $update_data = DB::table('tiket')->where('id', $id_data)->update([
            'status' => $req->status,
            'alasan' => $req->alasan_tolak
        ]);
        return redirect()->back();
    }
    public function indextiketlayananpasut()
    {
        return view('admin.tiket.indextiketlayananpasut');
    }
    public function getdatatiketlayananpasut()
    {
        $tiketlayananproduk = DB::table('tiket')
            ->join('master_stasiun', 'tiket.stasiun', '=', 'master_stasiun.id')
            ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
            ->where('tiket.kategori', 'pasut')
            ->select('tiket.*', 'tiket.id as id_tiket', 'users_pengguna.nama', 'master_stasiun.nama_stasiun')
            ->orderby('tiket.id', 'desc')
            ->get();


        return Datatables::of($tiketlayananproduk)
            ->addColumn('nama_produk', function ($mjl) {
                return $mjl->nama_stasiun;
            })
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                    <span class="badge badge-primary" style="background-color:green;">Open</span>';
                } else if ($mjl->status == 2) {
                    return '<center>
                    <span class="badge badge-info"style="background-color: #1e72c4;">Closed</span>';
                } else if ($mjl->status == 3) {
                    return '<center>
                     <span class="badge badge-warning">Menunggu Verifikasi</span>';
                } else if ($mjl->status == 4) {
                    return '<center>
                    <span class="badge badge-danger"style="background-color: #990505;">Di Tolak</span>';
                }
            })
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == 1) {

                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                        <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id_tiket . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                        <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                        <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                        <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                        <span ><i class="fa fa-paper-plane "></i></span>
                                        <span class="badge">' . $value->count . '</span>
                                        </a>
                                        <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                        </center>';
                        } else {

                            return '<center>
                                        <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                        <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id_tiket . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                        <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                        <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                        <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                        <span><i class="fa fa-paper-plane "></i></span>
                                        </a>
                                            <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                        </center>';
                        }
                    }
                } else if ($mjl->status == 3) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {

                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            <span class="badge">' . $value->count . '</span>
                                            </a>
                                            <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id_tiket . ')"><i class="glyphicon glyphicon-check"></i></a>
                                            <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        } else {
                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            </a>
                                            <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id_tiket . ')"><i class="glyphicon glyphicon-check"></i></a>
                                            <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        }
                    }
                } else {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {

                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            <span class="badge">' . $value->count . '</span>
                                            </a>
                                            <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        } else {
                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            </a>
                                            <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        }
                    }
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function UpdatePenolakanPasut(Request $req)
    {
        // dd($req->all());
        $id_data = $req->id_data;
        $update_data = DB::table('tiket')->where('id', $id_data)->update([
            'status' => $req->status,
            'alasan' => $req->alasan_tolak
        ]);
        return redirect()->back();
    }
    public function GetdetailPasut($id)
    {
        $data =  DB::table('detail_tiket_pasut')
            ->join('master_kategori_pasut', 'detail_tiket_pasut.id_kategori', '=', 'master_kategori_pasut.id')
            ->where('id_tiket', $id)->get();
        // dd($data);
        return json_decode($data);
    }

    public function indexkasnegara()
    {
        $master_kas = DB::table('master_layanan_kas_negara')
            ->select(
                'master_layanan_kas_negara.*',
                'master_layanan_kas_negara.id as id_layanan_jasa',
                'master_kode_akun.*',
                'master_kode_akun.id as idnya_kode_akun'


            )
            ->join('master_kode_akun', 'master_layanan_kas_negara.id_kode_akun', '=', 'master_kode_akun.id')
            ->get();
        //menentukan nomer tiket
        $id_user =  Auth::guard('internal')->user()->id;
        $get_jumlah_laporan = DB::table('tiket')->where('id_pengguna', $id_user)->where('kategori', 'kas')->count();
        $jumlah_id_user = str_pad($id_user, 5, '0', STR_PAD_LEFT);
        $layanan = 'D';
        $nomer_urut = str_pad($get_jumlah_laporan, 3, '0', STR_PAD_LEFT);
        $end = $layanan . "" . $jumlah_id_user . "" . $nomer_urut;
        // dd($master_kas);
        return view('admin.tiket.indextiketlayanankasnegara', compact('master_kas', 'end'));
    }
    public function getdatatiketlayanankasnegara()
    {
        $tiketlayanankas = DB::table('tiket')
            ->select(
                'tiket.id as id_inti',
                'tiket.kategori',
                'tiket.no_tiket',
                'tiket.status',
                'tiket.tanggal',
                'tiket.id_pengguna',
                'tiket.id_master_kas_negara',
                'tiket.keterangan_kas',
                'tiket.nominal',
                'users_internal.nama',
                'users_internal.id',
                'master_layanan_kas_negara.nama_layanan',
                'master_layanan_kas_negara.id',
                'master_kode_akun.id',
                'master_kode_akun.kode_akun'
            )
            ->join('users_internal', 'tiket.id_pengguna', '=', 'users_internal.id')
            ->join('master_layanan_kas_negara', 'tiket.id_master_kas_negara', 'master_layanan_kas_negara.id')
            ->join('master_kode_akun', 'master_layanan_kas_negara.id_kode_akun', '=', 'master_kode_akun.id')
            ->where('tiket.kategori', 'kas')
            ->get();
        // dd($tiketlayanankas);

        return Datatables::of($tiketlayanankas)
            ->addColumn('nomer_tiket', function ($mjl) {
                // dd($mjl);
                return $mjl->no_tiket;
            })
            ->addColumn('nama_layanan', function ($mjl) {
                // dd($mjl);
                return $mjl->nama_layanan;
            })
            ->addColumn('kode', function ($mjl) {
                return $mjl->kode_akun;
            })
            ->addColumn('keterangan', function ($mjl) {
                return $mjl->keterangan_kas;
            })
            ->addColumn('nominal', function ($mjl) {
                return "Rp " . number_format($mjl->nominal, 0, ",", ".");
            })
            ->addColumn('action', function ($mjl) {
                return '<center>
                        <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id_inti . '\',\'' . $mjl->nama_layanan . '\',\'' . $mjl->keterangan_kas . '\',\'' . $mjl->nominal . '\',\'' . $mjl->id_master_kas_negara . '\')"><i class="glyphicon glyphicon-edit"></i></a>';
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function GetKodeAkun($id)
    {
        $data = DB::table('master_kode_akun')->where('id', $id)->first();
        $datanya = $data->kode_akun;
        return $datanya;
    }

    public function SimpanTiketKas(Request $req)
    {
        try {
            $datenow = date('Y-m-d H:i:s');
            $id_user =  Auth::guard('internal')->user()->id;
            $id_data = explode("_", $req->layanan_jasa);
            // dd();

            $id = Tiket::insert([
                'no_tiket' => $req->nomer_tiket,
                'kategori' => 'kas',
                'tanggal' => $datenow,
                'status' => 3,
                'id_pengguna' => $id_user,
                'id_master_kas_negara' => $id_data[0],
                'keterangan_kas' => $req->keterangan,
                'nominal' => str_replace(".", "", $req->nominal),
                'created_at' => $datenow,
                'updated_at' => null,
            ]);

            Session::flash('success', 'Berhasil Buat Tiket Layanan Kas Negara');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('error', 'Error Data ' . $e);
            return redirect()->back();
        }
    }

    public function edit_kasnegara(Request $request)
    {
        try {
            $update = DB::table('tiket')->where('id', $request->id)->update([
                'id_master_kas_negara'  => $request->nama_layanan,
                'keterangan_kas'  => $request->keterangan,
                'nominal'  => str_replace(".", "", $request->nominal),
            ]);

            Session::flash('success', 'Berhasil Update Tiket Layanan Kas Negara');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('error', 'Error Data ' . $e);
            return redirect()->back();
        }
    }


    public function indextiketlayanandiklat()
    {
        $get_diklat = $this->getPembayaranDiklat();
        //menentukan nomer tiket
        $id_user =  Auth::guard('internal')->user()->id;
        $get_jumlah_laporan = DB::table('tiket')->where('id_pengguna', $id_user)->where('kategori', 'diklat')->count();
        $jumlah_id_user = str_pad($id_user, 5, '0', STR_PAD_LEFT);
        $layanan = 'E';
        $nomer_urut = str_pad($get_jumlah_laporan, 3, '0', STR_PAD_LEFT);
        $end = $layanan . "" . $jumlah_id_user . "" . $nomer_urut;
        return view('admin.tiket.indextiketlayanandiklat', compact('end', 'get_diklat'));
    }
    public function getPembayaranDiklat()
    {
        $url = env('API_SIMPLE_URL') . "get-pembayaran-diklat-all?status_bayar=0";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . env('API_SIMPLE_AUTH') . '',
            'Content-Type: application/json'
        ]);
        $data = json_decode(curl_exec($ch));
        $result = !empty($data) ? $data->content : array();
        curl_close($ch);

        return $result;
    }
    public function GetDetailDiklat($id_bayar)
    {
        $url = env('API_SIMPLE_URL') . "get-pembayaran-diklat-detail?id_bayar=" . $id_bayar . "";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . env('API_SIMPLE_AUTH') . '',
            'Content-Type: application/json'
        ]);
        $data = json_decode(curl_exec($ch));
        $result = $data->content;
        curl_close($ch);

        $nama_diklat = $this->GetKelasDiklatById($result->id_diklat);

        $res['id_diklat'] = $result->id_diklat;
        $res['nama_diklat'] = $nama_diklat->judul;
        $res['total_bayar'] = $result->total_bayar;
        $res['tarif_diklat'] = $result->tarif_diklat;
        $res['jml_peserta'] = $result->jml_peserta;
        $res['keterangan'] = $result->keterangan;

        return $res;
    }

    public function GetKelasDiklatById($id_diklat)
    {
        $url = env('API_SIMPLE_URL') . "get-kelas-diklat-by-id?id=" . $id_diklat . "";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . env('API_SIMPLE_AUTH') . '',
            'Content-Type: application/json'
        ]);
        $data = json_decode(curl_exec($ch));
        $result = $data->content;
        curl_close($ch);

        return $result[0];
    }

    public function getdatatiketlayanandiklat()
    {
        $tiketlayananjasa =  DB::table('tiket')
            ->select('layanan_diklat.*', 'tiket.nama_instansi')
            ->join('layanan_diklat', 'layanan_diklat.id_tiket', 'tiket.id')
            ->get();

        return Datatables::of($tiketlayananjasa)
            ->addColumn('no_tiket', function ($mjl) {
                return ($mjl->no_tiket) ? $mjl->no_tiket : '-';
            })
            ->addColumn('nama_diklat', function ($mjl) {
                // $diklat = getDiklatFromSimdiklat($mjl->nama_diklat)[0]->program;
                return ($mjl->nama_diklat) ? $mjl->nama_diklat : '-';
            })
            ->addColumn('kode_bayar', function ($mjl) {
                return ($mjl->kode_bayar) ? $mjl->kode_bayar : '-';
            })
            ->addColumn('jumlah_peserta', function ($mjl) {
                return ($mjl->jumlah_peserta) ? $mjl->jumlah_peserta : '-';
            })
            ->addColumn('total_bayar', function ($mjl) {
                return ($mjl->total_bayar) ? "Rp " . number_format($mjl->total_bayar, 0, ",", ".") : '-';
            })
            ->addColumn('keterangan', function ($mjl) {
                return ($mjl->keterangan) ? $mjl->keterangan : '-';
            })
            ->addColumn('ntpn', function ($mjl) {
                return ($mjl->ntpn) ? $mjl->ntpn : '-';
            })
            ->addColumn('kode_billing', function ($mjl) {
                return ($mjl->kode_billing) ? $mjl->kode_billing : '-';
            })
            ->addColumn('status', function ($mjl) {
                return ($mjl->status) ? $mjl->status : '-';
            })
            ->addColumn('instansi', function ($mjl) {
                return ($mjl->nama_instansi) ? $mjl->nama_instansi : '-';
            })
            ->addColumn('action', function ($mjl) {
                $act = '';
                $act .= '<button class="btn btn-sm btn-secondary"><i class="fa fa-list"></i></button>';
                $act .= '<button class="btn btn-sm btn-primary"><i class="fa fa-send"></i></button>';
                return $act;
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function tutuptiketlayanandiklat(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');

        $id = TiketLayananDiklat::where('id', $request->id)->update([
            'status' => 2,
            'updated_at' => $datenow
        ]);

        Session::flash('success', 'Tiket Selesai');


        return redirect()->back();
    }
    public function SimpanLayananDiklat(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $id_user =  Auth::guard('internal')->user()->id;

        $id = Tiket::create([
            'no_tiket' => $req->nomer_tiket,
            'kategori' => 'diklat',
            'tanggal' => $datenow,
            'status' => 3,
            'id_pengguna' => $id_user,
        ]);

        $diklat = DB::table('layanan_diklat')->insert([
            'id_tiket'          => $id->id,
            'no_tiket'          => $req->nomer_tiket,
            'id_diklat'         => $req->input_id_diklat,
            'nama_diklat'       => $req->input_nama_diklat,
            'kode_bayar'        => $req->kode_bayar,
            'jumlah_peserta'    => $req->input_jml_peserta,
            'tarif_bayar'       => $req->input_tarif_mes,
            'total_bayar'       => $req->input_total_bayar,
            'keterangan'        => $req->input_keterangan,
        ]);

        Session::flash('success', 'Berhasil Buat Tiket Layanan Jasa');
        return redirect()->back();
    }

    public function indextiketlayananmes()
    {
        $get_diklat = $this->getPembayaranMes();
        //menentukan nomer tiket
        $id_user =  Auth::guard('internal')->user()->id;
        $get_jumlah_laporan = DB::table('tiket')->where('id_pengguna', $id_user)->where('kategori', 'mes')->count();
        $jumlah_id_user = str_pad($id_user, 5, '0', STR_PAD_LEFT);
        $layanan = 'F';
        $nomer_urut = str_pad($get_jumlah_laporan, 3, '0', STR_PAD_LEFT);
        $end = $layanan . "" . $jumlah_id_user . "" . $nomer_urut;
        return view('admin.tiket.indextiketlayananmes', compact('end', 'get_diklat'));
    }
    public function getPembayaranMes()
    {
        $url = env('API_SIMPLE_URL') . "get-pembayaran-mess-all?status_bayar=0";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . env('API_SIMPLE_AUTH') . '',
            'Content-Type: application/json'
        ]);
        $data = json_decode(curl_exec($ch));
        $result = $data->content;
        curl_close($ch);

        return $result;
    }
    public function getdatatiketlayananmes()
    {
        $tiket =  DB::table('tiket')
            ->select('layanan_mess.*')
            ->join('layanan_mess', 'layanan_mess.id_tiket', 'tiket.id')
            ->get();

        return Datatables::of($tiket)
            ->addColumn('no_tiket', function ($mjl) {
                return ($mjl->no_tiket) ? $mjl->no_tiket : '-';
            })
            ->addColumn('nama_diklat', function ($mjl) {
                return ($mjl->nama_diklat) ? $mjl->nama_diklat : '-';
            })
            ->addColumn('kode_bayar', function ($mjl) {
                return ($mjl->kode_bayar) ? $mjl->kode_bayar : '-';
            })
            ->addColumn('jumlah_peserta', function ($mjl) {
                return ($mjl->jumlah_peserta) ? $mjl->jumlah_peserta : '-';
            })
            ->addColumn('total_bayar', function ($mjl) {
                return ($mjl->total_bayar) ? "Rp " . number_format($mjl->total_bayar, 0, ",", ".") : '-';
            })
            ->addColumn('keterangan', function ($mjl) {
                return ($mjl->keterangan) ? $mjl->keterangan : '-';
            })
            ->addColumn('ntpn', function ($mjl) {
                return ($mjl->ntpn) ? $mjl->ntpn : '-';
            })
            ->addColumn('kode_billing', function ($mjl) {
                return ($mjl->kode_billing) ? $mjl->kode_billing : '-';
            })
            ->addColumn('status', function ($mjl) {
                return ($mjl->status) ? $mjl->status : '-';
            })
            // ->addColumn('action', function ($mjl) {
            //     $act = '';
            //     $act .= '<button class="btn btn-sm btn-secondary"><i class="fa fa-list"></i></button>';
            //     $act .= '<button class="btn btn-sm btn-primary"><i class="fa fa-send"></i></button>';
            //     return $act;
            // })
            ->addIndexColumn()
            ->make(true);
    }
    public function GetDetailMes($id_bayar)
    {
        $url = env('API_SIMPLE_URL') . "get-pembayaran-mess-detail?id_bayar=" . $id_bayar . "";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . env('API_SIMPLE_AUTH') . '',
            'Content-Type: application/json'
        ]);
        $data = json_decode(curl_exec($ch));
        $result = $data->content;
        curl_close($ch);

        return json_encode($result);
    }

    public function SimpanLayananMes(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $id_user =  Auth::guard('internal')->user()->id;

        $id = Tiket::create([
            'no_tiket' => $req->nomer_tiket,
            'kategori' => 'mes',
            'tanggal' => $datenow,
            'status' => 1,
            'id_pengguna' => $id_user,
        ]);

        $mes = DB::table('layanan_mess')->insert([
            'id_tiket'          => $id->id,
            'no_tiket'          => $req->nomer_tiket,
            'nama_diklat'       => $req->input_nama_mes,
            'kode_bayar'        => $req->kode_bayar,
            'jumlah_peserta'    => $req->input_jml_peserta,
            'total_bayar'       => $req->input_total_bayar,
            'keterangan'        => $req->input_keterangan,
        ]);

        Session::flash('success', 'Berhasil Buat Tiket Layanan Jasa');
        return redirect()->back();
    }

    public function indextiketlayanankunjunganumum()
    {
        return view('admin.tiket.indextiketlayanankunjunganumum');
    }
    public function getdatatiketlayanankunjunganumum()
    {
        $tiketlayanankunjunganumum = TiketLayananKunjunganUmum::leftjoin('users_pengguna', 'tiket_layanan_kunjungan_umum.id_pengguna', '=', 'users_pengguna.id')->select('tiket_layanan_kunjungan_umum.*', 'users_pengguna.nama')->orderby('tanggal', 'desc')->get();

        return Datatables::of($tiketlayanankunjunganumum)
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == 1) {

                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a href="#" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->id . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i> Lihat</a>
                                        <a href="#" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i> Tutup Tiket</a>
                                        <a target="_blank" href=" ' . url('admin/tiket/pesan') . '/umum/' . $mjl->id . '" class="btn btn-sm btn-default notification">
                                        <span><i class="fa fa-paper-plane "></i> Pesan</span>
                                        <span class="badge">' . $value->count . '</span>
                                        </a></center>';
                        } else {
                            return '<center>
                                        <a href="#" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->id . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i> Lihat</a>
                                        <a href="#" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i> Tutup Tiket</a>
                                        <a target="_blank" href=" ' . url('admin/tiket/pesan') . '/umum/' . $mjl->id . '" class="btn btn-sm btn-default"><i class="fa fa-paper-plane "></i> Pesan</a></center>';
                        }
                    }
                } else {

                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a href="#" class="btn btn-sm btn-warning" onclick="lihat(\'' . $mjl->id . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i> Closed</a>
                                        <a target="_blank" href=" ' . url('admin/tiket/pesan') . '/umum/' . $mjl->id . '" class="btn btn-sm btn-default notification">
                                        <span><i class="fa fa-paper-plane "></i> Pesan</span>
                                        <span class="badge">' . $value->count . '</span>
                                        </a>
                                        <br></br>
                                        <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        } else {
                            return '<center>
                                        <a href="#" class="btn btn-sm btn-warning" onclick="lihat(\'' . $mjl->id . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i> Closed</a>
                                        <a target="_blank" href=" ' . url('admin/tiket/pesan') . '/umum/' . $mjl->id . '" class="btn btn-sm btn-default"><i class="fa fa-paper-plane "></i> Pesan</a>
                                        <br></br>
                                        <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                        }
                    }
                }
            })
            ->make(true);
    }
    public function detailkunjunganumumget($id)
    {
        $tiketlayanankunjunganumumdetail = TiketLayananKunjunganUmumDetail::leftjoin('master_pusat', 'tiket_layanan_kunjungan_umum_detail.id_pusat', '=', 'master_pusat.id')->select('tiket_layanan_kunjungan_umum_detail.*', 'master_pusat.nama_pusat')->where('id_tiket_kunjunganumum', $id)->get();

        $html = '';

        foreach ($tiketlayanankunjunganumumdetail as $value) {
            $html .= '<table style="width: 100%; border: 1px solid black; ">
                        <tbody>
                            <tr rowspan="2">
                                <th colspan="2" style="width:50%;border-right: 1px solid black;"><center>Pusat : <br>' . $value->nama_pusat . '</center></th>
                                <th colspan="2" style="padding-top: 5px;padding-bottom: 5px;"><center>Personil : <br>' . $value->personil . '</center></th>
                            </tr>
                            <tr>
                                <th colspan="4" style="width:50%;border-top: 1px solid black;padding-top: 5px;padding-bottom: 5px;"><center>Keperluan :<br>' . $value->keperluan . '</center></th>
                            </tr>
                        </tbody>
                    </table>
                    <br>';
        }
        return $html;
    }
    public function tutuptiketlayanankunjunganumum(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');

        $id = TiketLayananKunjunganUmum::where('id', $request->id)->update([
            'status' => 2,
            'updated_at' => $datenow,
            'closed_by' => 'Admin'
        ]);

        $tiket = DB::table('tiket')->where('id_terkait', $request->id)->where('kategori', 'umum')->update([
            'status' => 2
        ]);

        Session::flash('success', 'Tiket Selesai');


        return redirect('/admin/tiketlayanankunjunganumum');
    }

    public function indexpesanxtiket()
    {
        return view('admin.tiket.indexpesanxtiket');
    }
    public function getdatapesanxtiket()
    {
        $tiketlayananjasa = PesanxTiket::leftjoin('users_pengguna', 'pesanxtiket.id_pengguna', '=', 'users_pengguna.id')->select('pesanxtiket.*', 'users_pengguna.nama')->orderby('pesanxtiket.id', 'desc')->get();

        return Datatables::of($tiketlayananjasa)
            ->addColumn('nama_pengguna', function ($mjl) {
                $nama_pengguna = DB::table('users_pengguna')->where('id', $mjl->id_pengguna)->first();
                if (!empty($nama_pengguna)) {
                    return $nama_pengguna->nama;
                } else {
                    return "-";
                }
            })
            ->addColumn('Status', function ($mjl) {
                if ($mjl->status == 1) {
                    return 'Open';
                } else {
                    return 'Selesai';
                }
            })
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == 1) {

                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->kode . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->perihal . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                        <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id . '\',\'' . $mjl->kode . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->perihal . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-check  "></i></a>
                                        <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/percakapan/' . $mjl->id . '" class="btn btn-sm btn-default notification">
                                        <span><i class="fa fa-paper-plane "></i></span>
                                        <span class="badge">' . $value->count . '</span>
                                        </a>
                                        </center>';
                        } else {

                            return '<center>
                                        <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->kode . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->perihal . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                        <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id . '\',\'' . $mjl->kode . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->perihal . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-check  "></i></a>
                                        <a target="_blank" title="Pesan"href=" ' . url('admin/tiket/pesan') . '/percakapan/' . $mjl->id . '" class="btn btn-sm btn-default">
                                        <span><i class="fa fa-paper-plane "></i></span>
                                        </a>
                                        </center>';
                        }
                    }
                } else {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {

                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->kode . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->perihal . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                            <a target="_blank" title="Pesan"href=" ' . url('admin/tiket/pesan') . '/percakapan/' . $mjl->id . '" class="btn btn-sm btn-default notification">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            <span class="badge">' . $value->count . '</span>
                                            </a></center>';
                        } else {

                            return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->kode . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->perihal . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/percakapan/' . $mjl->id . '" class="btn btn-sm btn-default">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            </a></center>';
                        }
                    }
                }
            })
            ->rawColumns(['Status', 'action'])
            ->make(true);
    }
    public function tutuppesanxtiket(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');

        $id = PesanxTiket::where('id', $request->id)->update([
            'status' => 2,
            'updated_at' => $datenow
        ]);
        Session::flash('success', 'Pesan Percakapan Selesai');


        return redirect('/admin/pesanxtiket');
    }
    public function index_pengaduan()
    {
        $data = DB::table('pengaduan')
            ->get();
        // dd($data);
        return view('admin.tiket.pengaduan', compact('data'));
    }
    public function tanggapi_pengaduan(Request $req)
    {
        date_default_timezone_set('Asia/Jakarta');
        $datenow = date('Y-m-d H:i:s');
        $update = DB::table('pengaduan')->where('id', $req->id_data)->update([
            'tanggapan_admin' => $req->tanggapan_admin,
            'updated_at' => $datenow,
            'status' => 1,
        ]);
        return redirect()->back();
    }

    public function IndexBelumKuisioner()
    {
        $data['data'] = DB::table('tiket')
            ->select('tiket.*', 'tiket.id as id_tiket', 'tiket.kuesioner as status_kuesioner', 'users_pengguna.*')
            ->where('status', 2)
            ->join('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
            ->orderby('tiket.kuesioner', 'desc')
            ->get();
        $data['count_tiket'] = DB::table('tiket')->where('status', 2)->count();
        $data['count_yang_belum_kuesioner'] = DB::table('tiket')->where('status', 2)->where('kuesioner', null)->count();
        $data['count_yang_sudah_kuesioner'] = DB::table('tiket')->where('status', 2)->where('kuesioner', true)->count();
        // dd($data);
        return view('admin.tiket.indexbelomkuesioner', $data);
    }
    public function GetBelomKuisioner()
    {
        $tiketlayananjasa = DB::table('tiket')
            ->where('status', 2)
            ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
            ->whereNull('kuesioner')
            ->get();

        return Datatables::of($tiketlayananjasa)

            ->addColumn('check', function ($mjl) {
                return '<center>
                             <input type="checkbox" onchange="ceklis()" class="approve" name="approval[]" value="' . $mjl->id . '">
                        </center>';
            })
            ->rawColumns(['check', 'action'])
            ->addIndexColumn()
            ->make(true);
    }
    public function KirimEmail(Request $req)
    {
        $approval =  $req->approval;
        // $event = new \stdClass();
        foreach ($approval as $g) {
            $data = DB::table('tiket')
                ->where('tiket.id', $g)
                ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id',)
                ->first();

            $email = $data->email;
            $subject = 'PENGISIAN KUESIONER';
            $content = "
                Dear " . $data->nama . ",

                    Nama Pengunjung : " . $data->nama . "
                    Nomer Tiket : " . $data->no_tiket . "
                    Segera Lakukan Pengisian Kuesioner Pada Link Berikut  Agar Dapat Membuat Tiket Baru

                Terima Kasih..

                Regards,
                Badan Informasi Geospasial
            ";
            sendEmailApi($email, $subject, $content);
        }
        // Mail::send((new EmailKuesioner($event))->delay(30));
        Session::flash('success', 'Berhasil Mengirim Email');
        return redirect()->back();
    }
    public function getdataalltiket(Request $req)
    {

        $tanggal = $req->tanggal;
        $kategori = $req->filter_kat;

        $explode_tanggal = explode('to', $tanggal);
        if ($explode_tanggal[0] != "") {
            $start_date = $explode_tanggal[0];
            $end_date = $explode_tanggal[1];
        } else {
            $start_date = "";
            $end_date = "";
        }

        if ($start_date != "" || $end_date != "") {
            if ($kategori == "Layanan Jasa") {
                $tiketlayananjasa = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                    ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                    ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa', 'users_pengguna.nama')
                    ->where('tiket.kategori', 'jasa')
                    ->whereNotIn('master_layanan_jasa.id_pusat', array(13, 14))
                    ->whereBetween('tiket.tanggal', [$start_date, $end_date])
                    ->orderby('tiket.id', 'desc')->get();
            } elseif ($kategori == "Berbayar") {
                $tiketlayananjasa = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                    ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                    ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                    ->whereBetween('tiket.tanggal', [$start_date, $end_date])
                    ->whereIn('tiket.kategori', array('pasut', 'produk', 'kontrak', 'kas', 'diklat'))
                    ->orderby('tiket.id', 'desc')->get();
            } elseif ($kategori == "IG Nol Rupiah") {
                $tiketlayananjasa = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                    ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                    ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                    ->whereBetween('tiket.tanggal', [$start_date, $end_date])
                    ->where('tiket.kategori', 'jasa')
                    ->whereIn('master_layanan_jasa.id', array(13, 14))
                    ->orderby('tiket.id', 'desc')->get();
            } elseif ($kategori == null) {
                $tiketlayananjasa = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                    ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                    ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                    ->whereBetween('tiket.tanggal', [$start_date, $end_date])
                    ->orderby('tiket.id', 'desc')->get();
            }
        } elseif ($start_date == "" || $end_date == "") {
            if ($kategori == "Layanan Jasa") {
                $tiketlayananjasa = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                    ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                    ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa', 'users_pengguna.nama')
                    ->where('tiket.kategori', 'jasa')
                    ->whereNotIn('master_layanan_jasa.id_pusat', array(13, 14))
                    ->orderby('tiket.id', 'desc')->get();
            } elseif ($kategori == "Berbayar") {
                $tiketlayananjasa = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                    ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                    ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                    ->whereIn('tiket.kategori', array('pasut', 'produk', 'kontrak', 'kas', 'diklat'))
                    ->orderby('tiket.id', 'desc')->get();
            } elseif ($kategori == "IG Nol Rupiah") {
                $tiketlayananjasa = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                    ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                    ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                    ->where('tiket.kategori', 'jasa')
                    ->whereIn('master_layanan_jasa.id', array(13, 14))
                    ->orderby('tiket.id', 'desc')->get();
            } else {
                $tiketlayananjasa = DB::table('tiket')
                    ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa', 'users_pengguna.nama', 'tiket.id as id_tiket')
                    ->leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                    ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                    ->orderby('tiket.id', 'desc')
                    ->get();
            }
        }

        return Datatables::of($tiketlayananjasa)
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                        <span class="badge badge-primary" style="background-color:green;">Open</span>';
                } else if ($mjl->status == 2) {
                    return '<center>
                        <span class="badge badge-info"style="background-color: #1e72c4;">Closed</span>';
                } else if ($mjl->status == 3) {
                    return '<center>
                         <span class="badge badge-warning">Menunggu Verifikasi</span>';
                } else if ($mjl->status == 4) {
                    return '<center>
                    <a href="#" class="btn btn-outline-danger" onclick="Catatan(\'' . $mjl->alasan . '\')"> Di Tolak</a>';
                }
            })
            ->addColumn('kategori-awal', function ($mjl) {
                if ($mjl->kategori == 'jasa') {
                    if ($mjl->id_master_layananjasa == 13 || $mjl->id_master_layananjasa == 14) {
                        return '<center>
                            <p> IG Nol Rupiah</p>';
                    } else {
                        return '<center>
                            <p> Layanan Jasa</p>';
                    }
                } else if ($mjl->kategori == 'produk' || $mjl->kategori == 'pasut' || $mjl->kategori == 'kontrak' || $mjl->kategori == 'kas' || $mjl->kategori == 'diklat') {
                    return '<center><p> Berbayar</p></center>';
                }
            })
            ->addColumn('subkategori', function ($mjl) {
                if ($mjl->kategori == 'jasa') {
                    return "<center>
                            <p> $mjl->nama_layanan_jasa </p>";
                } else if ($mjl->kategori == 'produk') {
                    return '<center>
                            <p> Peta</p>';
                } else if ($mjl->kategori == 'pasut') {
                    return '<center>
                            <p> Pasang Surut</p>';
                } else if ($mjl->kategori == 'kontrak') {
                    return '<center>
                            <p> Layanan Kontrak</p>';
                } else if ($mjl->kategori == 'kas') {
                    return '<center>
                            <p> Kas Negara</p>';
                } else if ($mjl->kategori == 'diklat') {
                    return '<center>
                            <p> Layanan Diklat</p>';
                }
            })
            ->addColumn('kuesioner', function ($mjl) {
                if (empty($mjl->kuesioner)) {
                    return '<center>
                    <p> Belum mengisi</p>';
                } else {
                    return '<center>
                    <p> Sudah Mengisi</p>';
                }
            })

            ->addColumn('nama', function ($mjl) {
                if (empty($mjl->nama)) {
                    return 'Admin';
                } else {
                    return "<center>
                    <p> $mjl->nama </p>";
                }
            })

            ->addColumn('action', function ($mjl) {
                if ($mjl->kategori == 'jasa') {
                    if ($mjl->status == 1) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                return '<center>
                                        <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                        <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id_tiket . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                        <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                        <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                        <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                        <span ><i class="fa fa-paper-plane "></i></span>
                                        <span class="badge">' . $value->count . '</span>
                                        </a>
                                        </center>';
                            } else {

                                return '<center>
                                        <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                        <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id_tiket . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                        <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                        <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                        <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                        <span><i class="fa fa-paper-plane "></i></span>
                                        </a>
                                        </center>';
                            }
                        }
                    } else if ($mjl->status == 3) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {

                                return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            <span class="badge">' . $value->count . '</span>
                                            </a>
                                            <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id_tiket . ')"><i class="glyphicon glyphicon-check"></i></a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            } else {
                                return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            </a>
                                            <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id_tiket . ')"><i class="glyphicon glyphicon-check"></i></a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            }
                        }
                    } else {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {

                                return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            <span class="badge">' . $value->count . '</span>
                                            </a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            } else {
                                return '<center>
                                            <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/jasa/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            </a>
                                            <br></br>
                                            <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            }
                        }
                    }
                } elseif ($mjl->kategori == 'produk') {
                    if ($mjl->status == 1) {

                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                return '<center>
                                            <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                            <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id_tiket . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                            <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                            <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                            <span ><i class="fa fa-paper-plane "></i></span>
                                            <span class="badge">' . $value->count . '</span>
                                            </a>
                                            </center>';
                            } else {

                                return '<center>
                                            <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                            <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id_tiket . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                            <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                            <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            </a>
                                            </center>';
                            }
                        }
                    } else if ($mjl->status == 3) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {

                                return '<center>
                                                <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                                <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                                <span><i class="fa fa-paper-plane "></i></span>
                                                <span class="badge">' . $value->count . '</span>
                                                </a>
                                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id_tiket . ')"><i class="glyphicon glyphicon-check"></i></a>
                                                <br></br>
                                                <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            } else {
                                return '<center>
                                                <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                                <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                                <span><i class="fa fa-paper-plane "></i></span>
                                                </a>
                                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id_tiket . ')"><i class="glyphicon glyphicon-check"></i></a>
                                                <br></br>
                                                <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            }
                        }
                    } else {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {

                                return '<center>
                                                <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                                <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                                <span><i class="fa fa-paper-plane "></i></span>
                                                <span class="badge">' . $value->count . '</span>
                                                </a>
                                                <br></br>
                                                <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            } else {
                                return '<center>
                                                <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                                <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/produk/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                                <span><i class="fa fa-paper-plane "></i></span>
                                                </a>
                                                <br></br>
                                                <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            }
                        }
                    }
                } elseif ($mjl->kategori == 'pasut') {
                    if ($mjl->status == 1) {

                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                return '<center>
                                            <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                            <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id_tiket . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                            <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                            <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                            <span ><i class="fa fa-paper-plane "></i></span>
                                            <span class="badge">' . $value->count . '</span>
                                            </a>
                                            <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                            </center>';
                            } else {

                                return '<center>
                                            <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-eye"></i></a>
                                            <a href="#" title="Tutup Tiket" class="btn btn-sm btn-warning" onclick="tutup(\'' . $mjl->id_tiket . '\',\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-times "></i></a>
                                            <a href="#" title="Call" class="btn btn-sm btn-primary" onclick="play(\'' . $mjl->no_tiket . '\')"><i class="fa fa-phone"></i></a>
                                            <audio id="' . $mjl->no_tiket . '"><source src="' . asset('assets/lumino/images/') . '/' . $mjl->no_tiket . '.mp3' . '" type="audio/mpeg">Your browser does not support the audio element.</audio>
                                            <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                            <span><i class="fa fa-paper-plane "></i></span>
                                            </a>
                                                <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                            </center>';
                            }
                        }
                    } else if ($mjl->status == 3) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {

                                return '<center>
                                                <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                                <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                                <span><i class="fa fa-paper-plane "></i></span>
                                                <span class="badge">' . $value->count . '</span>
                                                </a>
                                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id_tiket . ')"><i class="glyphicon glyphicon-check"></i></a>
                                                <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                                <br></br>
                                                <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            } else {
                                return '<center>
                                                <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                                <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                                <span><i class="fa fa-paper-plane "></i></span>
                                                </a>
                                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id_tiket . ')"><i class="glyphicon glyphicon-check"></i></a>
                                                <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                                <br></br>
                                                <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            }
                        }
                    } else {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'pengguna')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {

                                return '<center>
                                                <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                                <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default notification">
                                                <span><i class="fa fa-paper-plane "></i></span>
                                                <span class="badge">' . $value->count . '</span>
                                                </a>
                                                <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                                <br></br>
                                                <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            } else {
                                return '<center>
                                                <a href="#" title="Closed" class="btn btn-sm btn-danger" onclick="lihat(\'' . $mjl->no_tiket . '\',\'' . $mjl->tanggal . '\',\'' . $mjl->mulai . '\',\'' . $mjl->selesai . '\',\'' . $mjl->nama . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i></a>
                                                <a target="_blank" title="Pesan" href=" ' . url('admin/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-sm btn-default">
                                                <span><i class="fa fa-paper-plane "></i></span>
                                                </a>
                                                <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')"><i class="fa fa-list"></i></a>
                                                <br></br>
                                                <span>Closed By : ' . $mjl->closed_by . '</span></center>';
                            }
                        }
                    }
                } elseif ($mjl->kategori == 'kas') {
                    if ($mjl->status == 1) {
                        return '';
                    } else if ($mjl->status == 3) {
                        return '<center><a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id_tiket . ')"><i class="glyphicon glyphicon-check"></i></a></center>';
                    } else {
                        return '';
                    }
                } elseif ($mjl->kategori == 'diklat') {
                    if ($mjl->status == 1) {
                        return '';
                    } else if ($mjl->status == 3) {
                        return '<center><a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(' . $mjl->id_tiket . ')"><i class="glyphicon glyphicon-check"></i></a></center>';
                    } else {
                        return '';
                    }
                }
            })
            ->rawColumns(['nama', 'kuesioner', 'subkategori', 'kategori-awal', 'status', 'action'])
            ->make(true);
    }

    public function indextiketlayanandiklatAdmin()
    {
        $get_diklat = DB::table('contoh_diklat')->get();
        //menentukan nomer tiket
        $id_user =  Auth::guard('internal')->user()->id;
        $get_jumlah_laporan = DB::table('tiket')->where('id_pengguna', $id_user)->where('kategori', 'diklat')->count();
        $jumlah_id_user = str_pad($id_user, 5, '0', STR_PAD_LEFT);
        $layanan = 'E';
        $nomer_urut = str_pad($get_jumlah_laporan, 3, '0', STR_PAD_LEFT);
        $end = $layanan . "" . $jumlah_id_user . "" . $nomer_urut;
        return view('admin.tiket.indextiketlayanandiklatadmin', compact('end', 'get_diklat'));
    }
    public function getdatatiketlayanandiklatAdmin()
    {
        $tiketlayananjasa =  DB::table('tiket')
            ->select(
                'tiket.id as id_tiketnya',
                'tiket.kategori',
                'tiket.no_tiket',
                'contoh_diklat.*'
            )
            ->join('contoh_diklat', 'tiket.id_contoh_diklat', '=', 'contoh_diklat.id')
            ->get();

        return Datatables::of($tiketlayananjasa)
            ->addColumn('nomer_tiket', function ($mjl) {
                // dd($mjl);
                return $mjl->no_tiket;
            })
            ->addColumn('nama_diklat', function ($mjl) {
                // dd($mjl);
                return $mjl->nama_diklat;
            })
            ->addColumn('instansi', function ($mjl) {
                // dd($mjl);
                return $mjl->instansi;
            })
            ->addColumn('kode_transaksi', function ($mjl) {
                return $mjl->kode_transaksi;
            })
            ->addColumn('npwp', function ($mjl) {
                return $mjl->npwp;
            })
            ->addColumn('nominal', function ($mjl) {
                return $mjl->nominal;
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function cetak_export(Request $req)
    {
        $periode = explode('to', $req->tanggal);
        $kategori = $req->kategori;
        // dd($periode);

        if ($kategori == "Layanan Jasa") {
            $data = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa', 'users_pengguna.nama')
                ->where('tiket.kategori', 'jasa')
                ->where('master_layanan_jasa.id_pusat', '!=', 14)
                ->whereBetween('tiket.tanggal', [$periode[0], $periode[1]])
                ->orderby('tiket.id', 'desc')->get();
        } elseif ($kategori == "Berbayar") {
            $data = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                ->whereBetween('tiket.tanggal', [$periode[0], $periode[1]])
                ->whereIn('tiket.kategori', array('pasut', 'produk', 'kontrak'))
                ->orderby('tiket.id', 'desc')->get();
        } elseif ($kategori == "IG Nol Rupiah") {
            $data = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                ->whereBetween('tiket.tanggal', [$periode[0], $periode[1]])
                ->where('tiket.kategori', 'jasa')
                ->whereIn('master_layanan_jasa.id', array(13, 14))
                ->orderby('tiket.id', 'desc')->get();
        } elseif ($kategori == "" || $periode[0] = "" || $periode[1] = "") {
            $data = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                ->leftjoin('users_pengguna', 'tiket.id_pengguna', '=', 'users_pengguna.id')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                ->orderby('tiket.id', 'desc')->get();
        }
        // dd($data);

        return view('admin.export_tiket', compact('kategori', 'data'));
    }
}
