<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Session;
use App\TiketLayananJasa;
use App\Tiket;
use App\TrxBeli;
use App\TiketLayananProduk;
use App\TiketLayananDiklat;
use App\TiketLayananKunjunganUmum;
use App\TiketLayananKunjunganUmumDetail;
use App\MasterLayananJasa;
use App\MasterLayananDiklat;
use App\Pengguna;
use App\MasterPusat;
use App\MasterJenisLayanan;
use App\PesanxTiket;
use Illuminate\Support\Facades\Crypt;
use App\Helper;

class TiketController extends Controller
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
    public function indexpesan($tiket, $id)
    {
        $datenow = date('Y-m-d');

        if ($tiket == 'jasa') {

            $tiketlayananjasa = Tiket::leftjoin('master_layanan_jasa', 'tiket.id_master_layananjasa', '=', 'master_layanan_jasa.id')
                ->leftjoin('master_pusat', 'master_layanan_jasa.id_pusat', '=', 'master_pusat.id')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa', 'master_pusat.nama_pusat')
                ->where('tiket.id', $id)
                ->where('tiket.kategori', $tiket)
                ->get();

            return view('pengguna.indexpesan', compact('tiketlayananjasa', 'datenow', 'tiket', 'id'));
        }
        if ($tiket == 'produk') {

            $tiketlayananjasa = Tiket::where('id_pengguna', Auth::guard('pengguna')->user()->id)
                ->where('id', $id)->where('kategori', $tiket)->orderby('id')->get();

            return view('pengguna.indexpesan', compact('tiketlayananjasa', 'datenow', 'tiket', 'id'));
        }
        if ($tiket == 'pasut') {

            $tiketlayananjasa = Tiket::where('id_pengguna', Auth::guard('pengguna')->user()->id)
                ->where('id', $id)->where('kategori', $tiket)->orderby('id')->get();

            return view('pengguna.indexpesan', compact('tiketlayananjasa', 'datenow', 'tiket', 'id'));
        }
        if ($tiket == 'umum') {

            $tiketlayananjasa = Tiket::where('id', $id)->where('kategori', $tiket)->get();
            return view('pengguna.indexpesan', compact('tiketlayananjasa', 'datenow', 'tiket', 'id'));
        }

        if ($tiket == 'percakapan') {

            $tiketlayananjasa = PesanxTiket::where('id', $id)->get();
            return view('pengguna.indexpesan', compact('tiketlayananjasa', 'datenow', 'tiket', 'id'));
        }
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
            ->where('kategori', $kategori)->where('id_terkait', $id_terkait)->where('readed', null)->where('dari', 'internal')
            ->update([
                'readed' => true,
            ]);
        $tiket = "";
        $id = "";

        $pesan = DB::table('pesan')->where('kategori', $kategori)->where('id_terkait', $id_terkait)->orderby('id', 'desc')->take(10)->get();

        return view('pengguna.pesan', compact('datenow', 'pesan', 'tiket', 'id'));
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
        $tiket = "";
        $id = '';

        return view('pengguna.pesan', compact('datenow', 'pesan', 'tiket', 'id'));
    }

    public function indextiket()
    {
        $masterjenislayanan = MasterJenisLayanan::orderby('id', 'asc')->get();
        foreach ($masterjenislayanan as $value) {
            if ($value->id == 1) {
                $layananproduk = $value->icon;
            } elseif ($value->id == 2) {
                $layananjasa = $value->icon;
            } elseif ($value->id == 3) {
                $layanandiklat = $value->icon;
            } elseif ($value->id == 4) {
                $layanankunjunganumum = $value->icon;
            }
        }

        return view('pengguna.indextiket', compact('layananproduk', 'layananjasa', 'layanandiklat', 'layanankunjunganumum'));
    }
    public function getdatatiket()
    {

        $tiket = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
            ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
            ->where('tiket.id_pengguna', Auth::guard('pengguna')->user()->id)
            ->orderby('tiket.tanggal', 'DESC')->get();

        return Datatables::of($tiket)
            ->addColumn('layanan', function ($mjl) {
                if ($mjl->kategori == 'jasa') {
                    return '<center><span class="badge badge-warning"> JASA</span>';
                } elseif ($mjl->kategori == 'produk') {
                    return '<center><span class="badge badge-info"> PRODUK</span>';
                } elseif ($mjl->kategori == 'umum') {
                    return '<center><span class="badge badge-success"> UMUM</span>';
                }
            })
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                                <a href="#" class="btn btn-outline-primary"> Open</a>';
                } else {
                    return '<center>
                                <a href="#" class="btn btn-outline-dark"> Closed</a>';
                }
            })
            ->addColumn('action', function ($mjl) {
                $html = '';
                if ($mjl->status == 1) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>
                                        </center>';
                        } else {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        </center>';
                        }
                    }
                } else {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'jasa\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        ';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'jasa\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                }
            })
            ->rawColumns(['layanan', 'status', 'action'])
            ->make(true);
    }
    public function getdatatiketlayananjasa()
    {
        $tiketlayananjasa = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
            ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
            ->where('tiket.id_pengguna', Auth::guard('pengguna')->user()->id)
            ->where('tiket.kategori', 'jasa')
            ->orderby('id')->get();

        return Datatables::of($tiketlayananjasa)
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                            <a href="#" class="btn btn-outline-primary"> Open</a>';
                } else if ($mjl->status == 2) {
                    return '<center>
                            <a href="#" class="btn btn-outline-dark"> Closed</a>';
                } else if ($mjl->status == 3) {
                    return '<center>
                            <a href="#" class="btn btn-outline-warning"> Menunggu Verifikasi</a>';
                } else if ($mjl->status == 4) {
                    return '<center>
                            <a href="#" class="btn btn-outline-danger" onclick="Catatan(\'' . $mjl->alasan . '\')"> Di Tolak</a>';
                }
            })
            ->addColumn('action', function ($mjl) {
                $html = '';
                if ($mjl->status == 1) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>
                                        </center>';
                        } else {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        </center>';
                        }
                    }
                } else if ($mjl->status == 2) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'jasa\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        ';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'jasa\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                } else if ($mjl->status == 3) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        ';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                } else if ($mjl->status == 4) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        ';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    public function getdatatiketlayananproduk()
    {
        $tiketlayananproduk = Tiket::where('id_pengguna', Auth::guard('pengguna')->user()->id)->where('kategori', 'produk')->orderby('id')->get();

        return Datatables::of($tiketlayananproduk)
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                                <a href="#" class="btn btn-outline-primary"> Open</a>';
                } else if ($mjl->status == 2) {
                    return '<center>
                                <a href="#" class="btn btn-outline-dark"> Closed</a>';
                } else if ($mjl->status == 3) {
                    return '<center>
                                <a href="#" class="btn btn-outline-warning"> Menunggu Verifikasi</a>';
                } else if ($mjl->status == 4) {
                    return '<center>
                                <a href="#" class="btn btn-outline-danger" onclick="Catatan(\'' . $mjl->alasan . '\')"> DiTolak</a>';
                }
            })
            ->addColumn('action', function ($mjl) {
                $html = '';
                if ($mjl->status == 1) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>
                                        </center>';
                        } else {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        </center>';
                        }
                    }
                } else if ($mjl->status == 2) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        ';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                } else if ($mjl->status == 3) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        ';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                } else if ($mjl->status == 4) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        ';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    public function getdatatiketlayananpasut()
    {
        $tiketlayananproduk = Tiket::where('id_pengguna', Auth::guard('pengguna')->user()->id)->where('kategori', 'pasut')->orderby('id')->get();

        return Datatables::of($tiketlayananproduk)
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                            <a href="#" class="btn btn-outline-primary"> Open</a>';
                } else if ($mjl->status == 2) {
                    return '<center>
                            <a href="#" class="btn btn-outline-dark"> Closed</a>';
                } else if ($mjl->status == 3) {
                    return '<center>
                            <a href="#" class="btn btn-outline-warning"> Menunggu Verifikasi</a>';
                } else if ($mjl->status == 4) {
                    return '<center>
                            <a href="#" class="btn btn-outline-danger"> DiTolak</a>';
                }
            })
            ->addColumn('action', function ($mjl) {
                $html = '';
                if ($mjl->status == 1) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>
                                        </center>';
                        } else {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        </center>';
                        }
                    }
                } else {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'pasut\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        ';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'pasut\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    public function getdatatiketlayanandiklat()
    {
        $tiketlayanandiklat = TiketLayananDiklat::leftjoin('master_layanan_diklat', 'master_layanan_diklat.id', '=', 'tiket_layanan_diklat.id_master_layanandiklat')->select('tiket_layanan_diklat.*', 'master_layanan_diklat.nama_layanan_diklat as nama_layanan_diklat')->where('id_pengguna', Auth::guard('pengguna')->user()->id)->orderby('id')->get();

        return Datatables::of($tiketlayanandiklat)
            ->addColumn('action', function ($mjl) {
                $html = '';
                if ($mjl->status == 1) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                    <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                    <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                    <span>Pesan</span>
                                    <span class="badge">' . $value->count . '</span> 
                                    </a>
                                    </center>';
                        } else {
                            return '<center>
                                    <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                    <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                    </center>';
                        }
                    }
                } else {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                    <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification">
                                    <span>Pesan</span>
                                    <span class="badge">' . $value->count . '</span> 
                                    </a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'jasa\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                    <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                    ';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'jasa\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                }
            })
            ->make(true);
    }
    public function getdatatiketlayanankunjunganumum()
    {
        $tiketlayanankunjunganumum = TiketLayananKunjunganUmum::where('id_pengguna', Auth::guard('pengguna')->user()->id)->orderby('id')->get();

        return Datatables::of($tiketlayanankunjunganumum)
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                                <a href="#" class="btn btn-outline-primary"> Open</a>';
                } else {
                    return '<center>
                                <a href="#" class="btn btn-outline-dark"> Closed</a>';
                }
            })
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == 1) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayanankunjunganumum') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/umum/' . $mjl->id . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span>
                                        </a>
                                        </center>';
                        } else {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayanankunjunganumum') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/umum/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        </center>';
                        }
                    }
                } else {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        $html = '';
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/umum/' . $mjl->id . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span>
                                        </a>';
                            if ($mjl->kuesioner != true) {
                                //  $html .='<a href="http://bit.ly/skmBIG2020" target="_blank" onclick="updateStatus(\'umum\','.$mjl->id.')" class="btn btn-outline-warning">Kuesioner</a>';
                                // $html .= '<a href="'.url('/kuesioner').'/umum/'.$mjl->id.'" class="btn btn-outline-warning">Kuesioner</a>';
                                $html .= '<button type="button" onclick="KuesionerKategori(\'umum\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html .= '<center>
                                         <a target="_blank" href=" ' . url('/tiket/pesan') . '/umum/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>';
                            if ($mjl->kuesioner != true) {
                                //  $html .='<a href="http://bit.ly/skmBIG2020" target="_blank" onclick="updateStatus(\'umum\','.$mjl->id.')" class="btn btn-outline-warning">Kuesioner</a>';
                                // $html .= '<a href="'.url('/kuesioner').'/umum/'.$mjl->id.'" class="btn btn-outline-warning">Kuesioner</a>';
                                $html .= '<button type="button" onclick="KuesionerKategori(\'umum\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';

                            return $html;
                        }
                    }
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function indextiketlayananjasa($id_master_layanan)
    {
        //no_antrian per hari
        // $layananjasa = 'A';
        // $datenow = date('Y-m-d');
        // $last = DB::table('tiket')->latest('no_tiket')->where('tanggal', $datenow)->first();
        // if (empty($last)) {
        //     $new = 1;
        // } else {
        //     $new = (int) str_replace("A", "", $last->no_tiket) + 1;
        // }
        // if (strlen($new) < 2) {
        //     $no_tiket = $layananjasa . "00" . $new;
        // } else {
        //     $no_tiket = $layananjasa . "0" . $new;
        // }

        $id_master_layanan = base64_decode($id_master_layanan);
        $masterpusat = DB::table('master_pusat')->orderby('id', 'asc')->get();
        $masterlayanan = DB::table('master_layanan_jasa')->orderby('id', 'asc')->get();
        $get_jenis_layanan = DB::table('master_layanan_jasa')->where('id', $id_master_layanan)->first();
        // dd($get_jenis_layanan);
        //no berdasarkan id_user dan jenis layanan
        $id_user =  Auth::guard('pengguna')->user()->id;
        $get_jumlah_laporan = DB::table('tiket')->where('id_pengguna', $id_user)->where('kategori', 'jasa')->count();
        $jumlah_id_user = str_pad($id_user, 5, '0', STR_PAD_LEFT);
        $layanan = 'A';
        $nomer_urut = str_pad($get_jumlah_laporan, 3, '0', STR_PAD_LEFT);
        $end = $layanan . "" . $jumlah_id_user . "" . $nomer_urut;
        // dd($end);

        return view('pengguna.indextiketlayananjasa', compact('get_jenis_layanan', 'end', 'masterpusat', 'masterlayanan', 'id_master_layanan'));
    }
    public function simpantiketlayananjasa(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';
        if ($request->id_master_layananjasa == 13 || $request->id_master_layananjasa == 14) {
            $status = 3;
        } else {
            $status = 1;
        }

        $id = Tiket::insertGetId([
            'no_tiket' => $request->no_tiket,
            'tanggal' => $request->tanggal,
            'mulai' => $request->mulai,
            'selesai' => null,
            'status' => $status,
            'id_master_layananjasa' => $request->id_master_layananjasa,
            'kategori' => 'jasa',
            'id_pengguna' => $request->id_pengguna,
            'status_kepuasan' => null,
            'created_at' => $datenow,
            'updated_at' => null,
        ]);

        if (!empty($id)) {
            Session::flash('success', 'Berhasil Buat Tiket Layanan Jasa');
            return redirect('/tiket');
        }
    }
    public function detailtiketlayananjasa($id)
    {
        $tiketlayananjasa = Tiket::leftjoin('master_layanan_jasa', 'tiket.id_master_layananjasa', '=', 'master_layanan_jasa.id')
            ->leftjoin('master_pusat', 'master_layanan_jasa.id_pusat', '=', 'master_pusat.id')
            ->select('tiket.*', 'tiket.id_master_layananjasa as id_mas', 'master_layanan_jasa.nama_layanan_jasa', 'master_pusat.nama_pusat')
            ->where('tiket.id', $id)->get();
        $datenow = date('Y-m-d');

        return view('pengguna.detailtiketlayananjasa', compact('tiketlayananjasa', 'datenow'));
    }

    public function getmastertiketlayananjasa()
    {
        $id_master_pusat = $_GET['id_master_pusat'];
        if (!empty($id_master_pusat)) {
            $masterlayananjasa = MasterlayananJasa::where('id_pusat', $id_master_pusat)->orderby('id')->get();
        } else {
            $masterlayananjasa = '';
        }

        return $masterlayananjasa;
    }

    public function indextiketlayananproduk($jenis_produk)
    {

        //no_antrian per hari
        // $layananproduk = 'B';
        // $datenow = date('Y-m-d');
        // $last = Tiket::latest('no_tiket')->where('tanggal', $datenow)->first();
        // if (empty($last)) {
        //     $new = 1;
        // } else {
        //     $new = (int) str_replace("B", "", $last->no_tiket) + 1;
        // }
        // if (strlen($new) < 2) {
        //     $no_tiket = $layananproduk . "00" . $new;
        // } else {
        //     $no_tiket = $layananproduk . "0" . $new;
        // }

        $id_user =  Auth::guard('pengguna')->user()->id;
        $get_jumlah_laporan = DB::table('tiket')->where('id_pengguna', $id_user)->where('kategori', 'produk')->count();
        $jumlah_id_user = str_pad($id_user, 5, '0', STR_PAD_LEFT);
        $layanan = 'B';
        $nomer_urut = str_pad($get_jumlah_laporan, 3, '0', STR_PAD_LEFT);
        $end = $layanan . "" . $jumlah_id_user . "" . $nomer_urut;


        return view('pengguna.indextiketlayananproduk', compact('end', 'jenis_produk'));
    }

    public function IndexPasangSurut()
    {
        $jenis_produk = '';
        $id_user =  Auth::guard('pengguna')->user()->id;
        $get_jumlah_laporan = DB::table('tiket')->where('id_pengguna', $id_user)->where('kategori', 'pasut')->count();
        $jumlah_id_user = str_pad($id_user, 5, '0', STR_PAD_LEFT);
        $layanan = 'C';
        $nomer_urut = str_pad($get_jumlah_laporan, 3, '0', STR_PAD_LEFT);
        $end = $layanan . "" . $jumlah_id_user . "" . $nomer_urut;

        $master_stasiun = DB::table('master_stasiun')->where('status', 1)->get();
        $master_kategori = DB::table('master_kategori_pasut')->get();

        return view('pengguna.indexpasangsurut', compact('end', 'jenis_produk', 'master_stasiun', 'master_kategori'));
    }

    public function GetDataPasangSurut()
    {
        $data = DB::table('tiket')
            ->select(
                'tiket.*',
                'tiket.id as id_tiket',
                'master_stasiun.*'
            )
            ->join('master_stasiun', 'tiket.stasiun', '=', 'master_stasiun.id')
            ->where('id_pengguna', Auth::guard('pengguna')->user()->id)
            ->where('kategori', 'pasut')
            ->orderby('tiket.id')->get();

        return Datatables::of($data)
            ->addColumn('nama_produk', function ($mjl) {
                return $mjl->nama_stasiun;
            })
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                        <a href="#" class="btn btn-outline-primary"> Open</a>';
                } else if ($mjl->status == 2) {
                    return '<center>
                        <a href="#" class="btn btn-outline-dark"> Closed</a>';
                } else if ($mjl->status == 3) {
                    return '<center>
                        <a href="#" class="btn btn-outline-warning"> Menunggu Verifikasi</a>';
                } else if ($mjl->status == 4) {
                    return '<center>
                            <a href="#" class="btn btn-outline-danger" onclick="Catatan(\'' . $mjl->alasan . '\')"> Di Tolak</a>';
                }
            })
            ->addColumn('action', function ($mjl) {
                $html = '';
                if ($mjl->status == 1) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id_tiket)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id_tiket . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-outline-success notification"> 
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>
                                        
                                        <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')">Detail</a>
                                        </center>';
                        } else {
                            return '<center>
                                        <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id_tiket . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-outline-success"> Pesan</a>
                                        
                                        <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')">Detail</a>
                                        </center>';
                        }
                    }
                } else if ($mjl->status == 2) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id_tiket)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>
                                        <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')">Detail</a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id_tiket . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-outline-success"> Pesan</a>
                                        <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')">Detail</a>
                                        ';
                            if ($mjl->kuesioner != true) {
                                $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id_tiket . ')" class="btn btn-outline-warning">Kuesioner</button>';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                } else if ($mjl->status == 3) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id_tiket)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>
                                        <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')">Detail</a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-outline-success"> Pesan</a>
                                        ';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                } else if ($mjl->status == 4) {
                    $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id_tiket)->where('dari', 'internal')->where('readed', null)->get();
                    foreach ($pesan as $value) {
                        if ($value->count > 0) {
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id_tiket . '" class="btn btn-outline-success notification">
                                        <span>Pesan</span>
                                        <span class="badge">' . $value->count . '</span> 
                                        </a>
                                        <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')">Detail</a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        } else {
                            $html = '';
                            $html .= '<center>
                                        <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                        
                                        <a href="#" title="Detail" class="btn btn-outline-primary" onclick="LihatDetail(\'' . $mjl->id_tiket . '\')">Detail</a>';
                            if ($mjl->kuesioner != true) {
                                $html .= '';
                            }
                            $html .= '</center>';
                            return $html;
                        }
                    }
                }
            })

            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    public function GetDataStasiun($id)
    {
        $curl = curl_init(Helper::API() . 'produk-digital/sub-produk/' . $id);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("APP-KEY:" . Helper::APPKEY(), "cache-control: no-cache"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, 6);
        $result = curl_exec($curl);
        if (curl_error($curl)) {
            return view('pengguna.produk.error-service');
        }
        curl_close($curl);
        $resStasiun = json_decode($result, true);
        $data_stasiun = $resStasiun['data'];
        //end stasiun
        $s = '<option selected value="" disabled>-- Pilih --</option>';
        foreach ($data_stasiun as $k) {
            $s .= '<option value="' . $k['id_sub'] . '">' . $k['nama_subproduk'] . '</option>';
        }
        return $s;
    }

    public function GethargaStasiun($id)
    {
        $curl = curl_init(Helper::API() . 'produk-digital');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("APP-KEY:" . Helper::APPKEY(), "cache-control: no-cache"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, 6);
        $result = curl_exec($curl);
        if (curl_error($curl)) {
            return view('pengguna.produk.error-service');
        }
        curl_close($curl);
        $resTipe = json_decode($result, true);
        $data_tipe = $resTipe['data'];
    }
    public function GetdetailPasut($id)
    {
        $data =  DB::table('detail_tiket_pasut')
            ->join('master_kategori_pasut', 'detail_tiket_pasut.id_kategori', '=', 'master_kategori_pasut.id')
            ->where('id_tiket', $id)->get();
        // dd($data);
        return json_decode($data);
    }
    public function SimpanPasangSurut(Request $request)
    {

        $field = $request->all();
        // dd($field['jenis_kategori']);
        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';

        $id = Tiket::insertGetId([
            'no_tiket' => $request->no_tiket,
            'tanggal' => $request->tanggal,
            'status' => 3,
            'stasiun' => $request->stasiun,
            'kategori' => 'pasut',
            'id_pengguna' => $request->id_pengguna,
            'created_at' => $datenow,
            'updated_at' => null,
        ]);
        foreach ($field['jenis_kategori'] as $key => $val) {
            $detail = DB::table('detail_tiket_pasut')->insert([
                'id_tiket' => $id,
                'id_kategori' => $val,
                'tahun' => $field['tahun'][$key],
                'bulan' => $field['bulan'][$key],
                'harga_satuan' => $field['harga_satuan'][$key],
                'jumlah' => $field['jumlah'][$key],
                'total' => $field['total_satu'][$key]
            ]);
        }

        if (!empty($id)) {
            Session::flash('success', 'Berhasil Buat Tiket Layanan Pasang Surut');
            return redirect('/tiket');
        }
    }
    public function simpantiketlayananproduk(Request $request)
    {
        // dd($request->all());
        //get kode transaksi
        if (date('m') == 1) {
            $rm = "I";
        } else if (date('m') == 2) {
            $rm = "II";
        } else if (date('m') == 3) {
            $rm = "III";
        } else if (date('m') == 4) {
            $rm = "IV";
        } else if (date('m') == 5) {
            $rm = "V";
        } else if (date('m') == 6) {
            $rm = "VI";
        } else if (date('m') == 7) {
            $rm = "VII";
        } else if (date('m') == 8) {
            $rm = "VIII";
        } else if (date('m') == 9) {
            $rm = "IX";
        } else if (date('m') == 10) {
            $rm = "X";
        } else if (date('m') == 11) {
            $rm = "XI";
        } else if (date('m') == 12) {
            $rm = "XII";
        }

        $searchlike = $rm . "/" . date('Y');
        $liz2 = DB::select("SELECT max(kode_transaksi) as kode from trx_beli where kode_transaksi like '%" . $searchlike . "%'");
        foreach ($liz2 as $list2) {
            $maxkode = $list2->kode;
        }
        if (!empty($maxkode)) {
            $strep = explode("/", $maxkode);
            $nexturut = $strep[0] + 1;
            if ($nexturut >= 1 && $nexturut <= 9) {
                $urutnya = "00" . $nexturut;
            } else if ($nexturut >= 10 && $nexturut <= 99) {
                $urutnya = "0" . $nexturut;
            } else if ($nexturut >= 100 && $nexturut <= 999) {
                $urutnya = $nexturut;
            }
        } else {
            $urutnya = "001";
        }
        $kodetransaksi = $urutnya . "/" . $rm . "/" . date('Y');
        // end kode transaksi
        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';

        $id = Tiket::create([
            'no_tiket' => $request->no_tiket,
            'tanggal' => $request->tanggal,
            'status' => 3,
            'kategori' => 'produk',
            'id_pengguna' => $request->id_pengguna,
            'status_kepuasan' => null,
            'created_at' => $datenow,
            'updated_at' => null,
        ]);
        $trxbeli = TrxBeli::create([
            'kode_transaksi' => $kodetransaksi,
            'nama_instansi' => $request->nama_pengguna,
            'alamat' => null,
            'provinsi' => null,
            'kabupaten' => null,
            'telp' => null,
            'timecreate' => date('Y-m-d'),
            'tanggal_proses' => date('Y-m-d'),
            'no_antrian' => $request->no_tiket,
            'id_tiket'   => $id->id
        ]);

        if (count((array) $request->id_sub) > 0) {
            for ($i = 0; $i < count((array) $request->id_sub); $i++) {
                DB::select("insert into trx_beli_detail (id_beli,id_sub,banyaknya,persatuan,total) values ('" . $trxbeli->id_beli . "','" . $request->id_sub[$i] . "','" . intval($request->jumlah[$i]) . "','" . floatval($request->satuan[$i]) . "','" . intval($request->satuan[$i]) * floatval($request->jumlah[$i]) . "')");
            }
        }

        $data = array(
            'id_sub' => $request->id_sub,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'no_tiket' => $request->no_tiket,
            'tanggal' => $request->tanggal,
            'id_pengguna' => $request->id_pengguna,
            'email' => Auth::guard('pengguna')->user()->email,
            'nama' => Auth::guard('pengguna')->user()->nama,
        );

        $curl = curl_init(Helper::API() . 'v2/transakasiBeli');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("APP-KEY:" . Helper::APPKEY()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, 6);
        $result = curl_exec($curl);

        if (curl_error($curl)) {
            Tiket::where('id', $id)->delete();
            Session::flash('error', 'Service Error');
            return redirect('/tiket');
        }

        curl_close($curl);

        if (!empty($id)) {
            Session::flash('success', 'Berhasil Buat Tiket Layanan Produk');
            return redirect('/tiket');
        }
    }


    public function indextiketlayanandiklat()
    {
        //no_antrian per hari
        $layanandiklat = 'C';
        $datenow = date('Y-m-d');
        $last = TiketLayananDiklat::latest('no_tiket')->where('tanggal', $datenow)->first();
        if (empty($last)) {
            $new = 1;
        } else {
            $new = (int) str_replace("C", "", $last->no_tiket) + 1;
        }
        if (strlen($new) < 2) {
            $no_tiket = $layanandiklat . "00" . $new;
        } else {
            $no_tiket = $layanandiklat . "0" . $new;
        }

        $masterlayanandiklat = MasterlayananDiklat::orderby('id')->get();

        return view('pengguna.indextiketlayanandiklat', compact('no_tiket', 'masterlayanandiklat'));
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

        $id2 = Tiket::insertGetId([
            'no_tiket' => $request->no_tiket,
            'tanggal' => $request->tanggal,
            'status' => 1,
            'kategori' => 'umum',
            'id_terkait' => $id,
            'id_pengguna' => $request->id_pengguna,
            'status_kepuasan' => null,
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

        if (!empty($id)) {
            Session::flash('success', 'Berhasil Buat Tiket Layanan Diklat');
            return redirect('/tiket');
        }
    }



    public function indextiketlayanankunjunganumum()
    {
        //no_antrian per hari
        $layananjasa = 'C';
        $datenow = date('Y-m-d');
        $last = TiketLayananKunjunganUmum::latest('no_tiket')->where('tanggal', $datenow)->first();
        if (empty($last)) {
            $new = 1;
        } else {
            $new = (int) str_replace("D", "", $last->no_tiket) + 1;
        }
        if (strlen($new) < 2) {
            $no_tiket = $layananjasa . "00" . $new;
        } else {
            $no_tiket = $layananjasa . "0" . $new;
        }

        $masterpusat = MasterPusat::orderby('id')->get();

        return view('pengguna.indextiketlayanankunjunganumum', compact('no_tiket', 'masterpusat'));
    }
    public function simpantiketlayanankunjunganumum(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');
        $datenull = '0000-00-00 00:00:00';

        $id = Tiket::insertGetId([
            'no_tiket' => $request->no_tiket,
            'tanggal' => $request->tanggal,
            'status' => 1,
            'kategori' => 'umum',
            'id_pengguna' => $request->id_pengguna,
            'status_kepuasan' => null,
            'created_at' => $datenow,
            'updated_at' => null,
        ]);

        $jumlahkunjungan = $request->panjangarray;

        if ($jumlahkunjungan > 0) {
            for ($i = 0; $i < $jumlahkunjungan; $i++) {

                $id2 = TiketLayananKunjunganUmumDetail::insert([
                    'personil' => $request->personil[$i],
                    'keperluan' => $request->keperluan[$i],
                    'id_pusat' => $request->id_pusat[$i],
                    'id_tiket_kunjunganumum' => $id,
                    'id_master_layananumum'  => $request->id_kategori[$i],
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

        if (!empty($id)) {
            Session::flash('success', 'Berhasil Buat Tiket Layanan Kunjungan Umum');
            return redirect('/tiket');
        }
    }
    public function detailtiketlayanankunjunganumum($id)
    {
        $tiketlayanankunjunganumum = TiketLayananKunjunganUmum::where('id', $id)->get();
        $tiketlayanankunjunganumumdetail = TiketLayananKunjunganUmumDetail::leftjoin('master_pusat', 'tiket_layanan_kunjungan_umum_detail.id_pusat', '=', 'master_pusat.id')->select('tiket_layanan_kunjungan_umum_detail.*', 'master_pusat.nama_pusat')->where('id_tiket_kunjunganumum', $id)->get();
        $datenow = date('Y-m-d');

        return view('pengguna.detailtiketlayanankunjunganumum', compact('tiketlayanankunjunganumum', 'datenow', 'tiketlayanankunjunganumumdetail'));
    }
    public function getmastertiketlayanankunjunganumum()
    {
        $id_master_pusat = $_GET['id_master_pusat'];
        if (!empty($id_master_pusat)) {
            $masterlayanandiklat = MasterLayananDiklat::where('id_pusat', $id_master_pusat)->orderby('id')->get();
        } else {
            $masterlayanandiklat = '';
        }

        return $masterlayanandiklat;
    }

    public function updatestatuskuesioner(Request $request)
    {
        $layanan = $request->input('layanan');
        $id_tiket = $request->input('id');

        $update = DB::table('tiket')->where('kategori', $layanan)->where('id', $id_tiket)->update(['kuesioner' => true]);

        if ($update) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    function fetch_data_katalog(Request $request)
    {
        $id_jenisproduk = $request->jenis;
        $page = $request->get('page') ? $request->get('page') : 1;
        $pencarian = strtolower($request->get('pencarian'));

        $resProduk = $this->query_data_produk($pencarian);
        $convert = json_encode($resProduk);
        $data['resProduk'] = json_decode($convert, true);

        return view('pengguna.produk.buku', $data);
    }

    function fetch_data_buku(Request $request)
    {
        $page = $request->get('page');
        $pencarian = strtolower($request->get('pencarian'));
        $url = url('/images');

        $resProduk = $this->query_data_produk($pencarian);
        $convert = json_encode($resProduk);
        $data['resProduk'] = json_decode($convert, true);
        $data['page'] = $page;

        return view('pengguna.produk.paging_buku', $data);
    }

    function query_data_produk($pencarian)
    {
        $resProduk = DB::table('m_subproduk')->selectRaw('
                    id_sub,
                    id_produk,
                    kode_produk,
                    nama_subproduk,
                    tarif,
                    stok_baik,
                    edisi,
                    skala,
                    nama_lembar
                    ')
            ->when($pencarian, function ($q, $pencarian) {
                return $q->where(DB::raw('LOWER(nama_lembar)'), 'like', '%' . $pencarian . '%');
            })
            ->where('stok_baik', '>', '5')
            ->where('status_subproduk', 2)
            ->orderBy('nama_subproduk', 'ASC')->paginate(12);
        return response()->json(
            array(
                'status' => 'sukses',
                'error' => false,
                'data' => $resProduk,
            ),
            200
        );
    }

    function getKeranjangKatalog($no_tiket, $tanggal, $nama)
    {
        $data = array(
            'no_tiket' => $no_tiket,
            'tanggal' => $tanggal,
            'nama' => $nama,
        );

        $curl = curl_init(Helper::API() . 'v2/keranjang');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("APP-KEY:" . Helper::APPKEY()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, 6);
        $result = curl_exec($curl);

        if (curl_error($curl)) {
            return null;
        }

        curl_close($curl);

        $resProduk = json_decode($result, true);

        return $resProduk;
    }
    public function getDatatiketall(Request $req)
    {
        $kategori = $req->filter_kat;
        if ($kategori == "Layanan Jasa") {
            $tiketlayananproduk = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                ->where('id_pengguna', Auth::guard('pengguna')->user()->id)
                ->where('tiket.kategori', 'jasa')
                ->where('master_layanan_jasa.id_pusat', '!=', 14)
                ->orderBy('tiket.tanggal', 'DESC')->get();
        } elseif ($kategori == "Berbayar") {
            $tiketlayananproduk = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                ->where('id_pengguna', Auth::guard('pengguna')->user()->id)
                ->whereIn('tiket.kategori', array('pasut', 'produk', 'kontrak'))
                ->orderBy('tiket.tanggal', 'DESC')->get();
        } elseif ($kategori == "IG Nol Rupiah") {
            $tiketlayananproduk = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                ->where('id_pengguna', Auth::guard('pengguna')->user()->id)
                ->where('tiket.kategori', 'jasa')
                ->whereIn('master_layanan_jasa.id', array(13, 14))
                ->orderBy('tiket.tanggal', 'DESC')->get();
        } else {
            $tiketlayananproduk = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                ->where('id_pengguna', Auth::guard('pengguna')->user()->id)
                ->orderBy('tiket.tanggal', 'DESC')->get();
        }


        return Datatables::of($tiketlayananproduk)
            ->addColumn('nominal', function ($mjl) {
                return "Rp " . number_format($mjl->nominal, 0, ",", ".");
            })
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                            <p> Open</p>';
                } else if ($mjl->status == 2) {
                    return '<center>
                            <p> Closed</p>';
                } else if ($mjl->status == 3) {
                    return '<center>
                            <p> Menunggu Verifikasi</p>';
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
                        if ($mjl->jumlah_setoran != null) {
                            return '<center>
                            <p> Berbayar</p>';
                        } else {
                            return '<center>
                            <p> Layanan Jasa</p>';
                        }

                        return '<center>
                            <p> Layanan Jasa</p>';
                    }
                } else if ($mjl->kategori == 'produk' || $mjl->kategori == 'pasut' || $mjl->kategori == 'kontrak') {
                    return '<center>
                            <p> Berbayar</p>';
                }
            })
            ->addColumn('subkategori', function ($mjl) {
                if ($mjl->kategori == 'jasa') {
                    if ($mjl->id_master_layananjasa == 13 || $mjl->id_master_layananjasa == 14) {
                        return "<center>
                        <p> $mjl->nama_layanan_jasa </p>";
                    } else {
                        return "<center>
                            <p> $mjl->nama_layanan_jasa </p>";
                    }
                } else if ($mjl->kategori == 'produk') {
                    return '<center>
                            <p> Peta</p>';
                } else if ($mjl->kategori == 'pasut') {
                    return '<center>
                            <p> Pasang Surut</p>';
                } else if ($mjl->kategori == 'kontrak') {
                    return '<center>
                            <p> Jasa Kontrak</p>';
                }
            })
            ->addColumn('action', function ($mjl) {
                $html = '';
                if ($mjl->kategori == 'jasa') {
                    if ($mjl->status == 1) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>
                                            </center>';
                            } else {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            </center>';
                            }
                        }
                    } else if ($mjl->status == 2) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                if ($mjl->kuesioner != true) {
                                    // $html .= '<center>
                                    //         <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification">
                                    //         <span>Pesan</span>
                                    //         <span class="badge">' . $value->count . '</span> 
                                    //         </a>';
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'jasa\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                } else {
                                    // $html .= '<center><button class="btn btn-outline-dark">Closed</button>';
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                if ($mjl->kuesioner != true) {
                                    // $html .= '<center>
                                    //         <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                    //         ';
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'jasa\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                } else {
                                    // $html .= '<center><button class="btn btn-outline-dark">Closed</button>';

                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 3) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 4) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    }
                } else if ($mjl->kategori == 'produk') {
                    if ($mjl->status == 1) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>
                                            </center>';
                            } else {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            </center>';
                            }
                        }
                    } else if ($mjl->status == 2) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                if ($mjl->kuesioner != true) {
                                    // $html .= '<center>
                                    //         <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                    //         <span>Pesan</span>
                                    //         <span class="badge">' . $value->count . '</span> 
                                    //         </a>';
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                } else {
                                    // $html .= '<center><button class="btn btn-outline-dark">Closed</button>';
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                if ($mjl->kuesioner != true) {
                                    // $html .= '<center>
                                    //         <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                    //         ';
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                } else {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 3) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 4) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    }
                } else if ($mjl->kategori == 'pasut') {
                    if ($mjl->status == 1) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>
                                            </center>';
                            } else {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            </center>';
                            }
                        }
                    } else if ($mjl->status == 2) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                if ($mjl->kuesioner != true) {
                                    // $html .= '<center>
                                    //         <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                    //         <span>Pesan</span>
                                    //         <span class="badge">' . $value->count . '</span> 
                                    //         </a>';
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                } else {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                if ($mjl->kuesioner != true) {
                                    $html = '';
                                    // $html .= '<center>
                                    //         <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                    //         ';
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                } else {
                                    $html = '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 3) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 4) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    }
                } else if ($mjl->kategori == 'kontrak') {
                    if ($mjl->status == 1) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>
                                            </center>';
                            } else {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            </center>';
                            }
                        }
                    } else if ($mjl->status == 2) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                if ($mjl->kuesioner != true) {
                                    // $html .= '<center>
                                    //         <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                    //         <span>Pesan</span>
                                    //         <span class="badge">' . $value->count . '</span> 
                                    //         </a>';
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                } else {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                if ($mjl->kuesioner != true) {
                                    $html = '';
                                    // $html .= '<center>
                                    //         <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                    //         ';
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                } else {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 3) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 4) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    }
                }
            })
            ->rawColumns(['subkategori', 'kategori-awal', 'status', 'action'])
            ->make(true);
    }
    public function getDatatiketkategori($kat)
    {
        // dd($kat);
        if ($kat == "Layanan Jasa") {
            $tiketlayananproduk = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                ->where('master_layanan_jasa.id', '!=', 13)
                ->orderby('tiket.id', 'desc')->get();
        } elseif ($kat == "Berbayar") {
            $tiketlayananproduk = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                ->where('id_pengguna', Auth::guard('pengguna')->user()->id)
                ->whereIn('tiket.kategori', array('pasut', 'produk'))
                ->orderby('tiket.id', 'desc')->get();
        } elseif ($kat == "IG Nol Rupiah") {
            $tiketlayananproduk = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
                ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
                ->where('id_pengguna', Auth::guard('pengguna')->user()->id)
                ->whereIn('tiket.kategori', array(13, 14))
                ->orderby('tiket.id', 'desc')->get();
        }
        $tiketlayananproduk = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
            ->select('tiket.*', 'master_layanan_jasa.nama_layanan_jasa as nama_layanan_jasa')
            ->where('id_pengguna', Auth::guard('pengguna')->user()->id)
            ->orderby('tiket.id', 'desc')->get();

        return Datatables::of($tiketlayananproduk)
            ->addColumn('status', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                            <p> Open</p>';
                } else if ($mjl->status == 2) {
                    return '<center>
                            <p> Closed</p>';
                } else if ($mjl->status == 3) {
                    return '<center>
                            <p> Menunggu Verifikasi</p>';
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
                } else if ($mjl->kategori == 'produk' || $mjl->kategori == 'pasut') {
                    return '<center>
                            <p> Berbayar</p>';
                }
            })
            ->addColumn('subkategori', function ($mjl) {
                if ($mjl->kategori == 'jasa') {
                    return "<center>
                            <p> $mjl->nama_layanan_jasa </p>";
                } else if ($mjl->kategori == 'produk') {
                    return '<center>
                            <p> Peta</p>';
                } else if ($mjl->kategori = 'pasut') {
                    return '<center>
                            <p> Pasang Surut</p>';
                }
            })
            ->addColumn('action', function ($mjl) {
                $html = '';
                if ($mjl->kategori == 'jasa') {
                    if ($mjl->status == 1) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>
                                            </center>';
                            } else {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananjasa') . '/' . $mjl->id . '" class="btn btn-outline-primary"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            </center>';
                            }
                        }
                    } else if ($mjl->status == 2) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'jasa\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'jasa\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 3) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 4) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/jasa/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    }
                } else if ($mjl->kategori == 'produk') {
                    if ($mjl->status == 1) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>
                                            </center>';
                            } else {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            </center>';
                            }
                        }
                    } else if ($mjl->status == 2) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 3) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 4) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    }
                } else if ($mjl->kategori == 'pasut') {
                    if ($mjl->status == 1) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification"> 
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>
                                            </center>';
                            } else {
                                return '<center>
                                            <a target="_blank" href=" ' . url('detailtiketlayananproduk') . '/' . $mjl->id . '" class="btn btn-outline-primary" style="display:none;"> Cetak Tiket</a>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            </center>';
                            }
                        }
                    } else if ($mjl->status == 2) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '<button type="button" onclick="KuesionerKategori(\'produk\',' . $mjl->id . ')" class="btn btn-outline-warning">Kuesioner</button>';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 3) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/produk/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    } else if ($mjl->status == 4) {
                        $pesan = DB::table('pesan')->select(DB::raw('count(id_terkait)'))->where('id_terkait', $mjl->id)->where('dari', 'internal')->where('readed', null)->get();
                        foreach ($pesan as $value) {
                            if ($value->count > 0) {
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success notification">
                                            <span>Pesan</span>
                                            <span class="badge">' . $value->count . '</span> 
                                            </a>';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            } else {
                                $html = '';
                                $html .= '<center>
                                            <a target="_blank" href=" ' . url('/tiket/pesan') . '/pasut/' . $mjl->id . '" class="btn btn-outline-success"> Pesan</a>
                                            ';
                                if ($mjl->kuesioner != true) {
                                    $html .= '';
                                }
                                $html .= '</center>';
                                return $html;
                            }
                        }
                    }
                }
            })
            ->rawColumns(['subkategori', 'kategori-awal', 'status', 'action'])
            ->make(true);
    }

    public function IndexKerjaSama()
    {
        $masterpusat = DB::table('master_pusat')->orderby('id', 'asc')->get();
        $masterlayanan = DB::table('master_layanan_jasa')->orderby('id', 'asc')->get();
        $id_user =  Auth::guard('pengguna')->user()->id;
        $get_jumlah_laporan = DB::table('tiket')->where('id_pengguna', $id_user)->where('kategori', 'kontrak')->count();
        $jumlah_id_user = str_pad($id_user, 5, '0', STR_PAD_LEFT);
        $layanan = 'A';
        $nomer_urut = str_pad($get_jumlah_laporan, 3, '0', STR_PAD_LEFT);
        $end = $layanan . "" . $jumlah_id_user . "" . $nomer_urut;
        // dd($end);

        return view('pengguna.indexkerjasama', compact('end', 'masterpusat', 'masterlayanan'));
    }
    public function SimpanKerjaSama(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $field = $request->all();
        $datenow = date('Y-m-d');
        $hNow = date('H:i');
        // dd($datenow,$hNow,$request->all());
        $id = Tiket::insertGetId([
            'no_tiket' => $request->no_tiket,
            'tanggal' => $datenow,
            'mulai' => $hNow,
            'nama_kontrak' => $request->nama_kontrak,
            'jumlah_setoran' => $request->jumlah_setoran,
            'kategori' => 'kontrak',
            'id_pengguna' => $request->id_pengguna,
            'status' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);


        if (!empty($id)) {
            Session::flash('success', 'Berhasil Buat Tiket Layanan Kontrak');
            return redirect('/tiket');
        }
    }
}
