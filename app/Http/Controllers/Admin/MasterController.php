<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\MasterJenisLayanan;
use App\MasterFAQ;
use App\MasterTentang;
use App\MasterBerita;
use App\MasterLayananDigital;
use App\MasterPusat;
use Session;
use Symfony\Component\Console\Helper\Table;

class MasterController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexjenislayanan()
    {
        return view('admin.master.indexjenislayanan');
    }

    public function getdatajenislayanan()
    {
        $masterjenislayanan = MasterJenisLayanan::orderby('id')->get();

        return Datatables::of($masterjenislayanan)
            ->addColumn('action', function ($mjl) {
                if ($mjl->show == true) {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->jenis_layanan . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->icon . '\',\'' . $mjl->batasan . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->jenis_layanan . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->icon . '\')"><i class="fa fa-search "></i></a>
                                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\',\'' . $mjl->jenis_layanan . '\')"><i class="fa fa-times "></i></a></center>';
                } else {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->jenis_layanan . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->icon . '\',\'' . $mjl->batasan . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->jenis_layanan . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->icon . '\')"><i class="fa fa-search "></i></a>
                                <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\',\'' . $mjl->jenis_layanan . '\')"><i class="fa fa-check "></i></a></center>';
                }
            })
            ->make(true);
    }

    public function simpanjenislayanan(Request $request)
    {
        $uploadedFile = $request->file('icon');
        $filename2in = $uploadedFile->getClientOriginalName();
        $filenamein = uniqid() . str_replace(' ', '', $filename2in);

        $path = public_path() . '/storage/app/public/';
        $uploadedFile->move($path, $filenamein);

        $id = MasterJenisLayanan::insertGetId([
            'jenis_layanan' => $request->jenis_layanan,
            'deskripsi' => $request->deskripsi,
            'show' => false,
            'batasan' => $request->batasan,
            'icon' => $filenamein,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/masterjenislayanan');
    }
    public function editjenislayanan(Request $request)
    {
        if (!empty($request->icon)) {

            $uploadedFile = $request->file('icon');
            $filename2in = $uploadedFile->getClientOriginalName();
            $filenamein = uniqid() . str_replace(' ', '', $filename2in);

            $path = public_path() . '/storage/app/public/';
            $uploadedFile->move($path, $filenamein);

            $id = MasterJenisLayanan::where('id', $request->id)->update([
                'jenis_layanan' => $request->jenis_layanan,
                'deskripsi' => $request->deskripsi,
                'icon' => $filenamein,
                'batasan' => $request->batasan,
            ]);
        } else {
            $id = MasterJenisLayanan::where('id', $request->id)->update([
                'jenis_layanan' => $request->jenis_layanan,
                'deskripsi' => $request->deskripsi,
                'batasan' => $request->batasan,
            ]);
        }

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/masterjenislayanan');
    }

    public function showjenislayanan(Request $request)
    {
        $masterjenislayanan = MasterJenisLayanan::where('id', $request->id)->get();
        foreach ($masterjenislayanan as $value) {
            $show = $value->show;
        }

        if ($show == true) {
            $id = MasterJenisLayanan::where('id', $request->id)->update([
                'show' => false,
            ]);
        } else {
            $id = MasterJenisLayanan::where('id', $request->id)->update([
                'show' => true,
            ]);
        }

        Session::flash('success', 'Data Ditampilkan');

        return redirect('/admin/masterjenislayanan');
    }

    public function indexfaq()
    {
        return view('admin.master.indexfaq');
    }

    public function getdatafaq()
    {
        $masterfaq = MasterFAQ::orderby('id')->get();

        return Datatables::of($masterfaq)
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == true) {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->pertanyaan . '\',\'' . $mjl->jawaban . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\',\'' . $mjl->pertanyaan . '\',\'' . $mjl->jawaban . '\')"><i class="fa fa-check "></i></a></center>';
                } else {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->pertanyaan . '\',\'' . $mjl->jawaban . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\',\'' . $mjl->pertanyaan . '\',\'' . $mjl->jawaban . '\')"><i class="fa fa-times "></i></a></center>';
                }
            })
            ->make(true);
    }

    public function simpanfaq(Request $request)
    {
        $des = str_replace("\r\n", "<br>", $request->jawaban);

        $id = MasterFAQ::insertGetId([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => strip_tags($des),
            'status' => false,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/masterfaq');
    }

    public function showfaq(Request $request)
    {
        $masterfaq = MasterFAQ::where('id', $request->id)->get();
        foreach ($masterfaq as $value) {
            $show = $value->status;
        }

        if ($show == true) {
            $id = MasterFAQ::where('id', $request->id)->update([
                'status' => false,
            ]);
            Session::flash('success', 'Data Disembunyikan');
        } else {
            $id = MasterFAQ::where('id', $request->id)->update([
                'status' => true,
            ]);
            Session::flash('success', 'Data Ditampilkan');
        }


        return redirect('/admin/masterfaq');
    }

    public function editfaq(Request $request)
    {
        $des = str_replace(".trim()", "", $request->jawaban);
        $id = MasterFAQ::where('id', $request->id)->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $des,
        ]);

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/masterfaq');
    }

    public function indexinformasi()
    {
        return view('admin.master.indexinformasi');
    }

    public function getdatainformasi()
    {
        $masterjenislayanan = DB::table('master_informasi')->get();

        return Datatables::of($masterjenislayanan)
            ->addColumn('action', function ($mjl) {
                $cek_status = DB::table('master_informasi')->where('status', 1)->count();
                // dd($cek_status);
                if ($mjl->status == 1) {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->text_informasi . '\',)"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\',\'' . $mjl->text_informasi . '\')"><i class="fa fa-check "></i></a></center>';
                } elseif ($mjl->status == 2) {
                    if ($cek_status == 1) {
                        return '<center>
                                    <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->text_informasi . '\',)"><i class="glyphicon glyphicon-edit"></i></a>
                                    </center>';
                    } else {
                        return '<center>
                                    <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->text_informasi . '\',)"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\',\'' . $mjl->text_informasi . '\')"><i class="fa fa-times "></i></a></center>';
                    }
                }
            })

            ->addIndexColumn()
            ->make(true);
    }

    public function simpaninformasi(Request $request)
    {
        $cek_status = DB::table('master_informasi')->where('status', 1)->count();
        $uploadedFile = $request->file('icon');
        if ($uploadedFile != null) {
            $filename2in = $uploadedFile->getClientOriginalName();
            $filenamein = uniqid() . str_replace(' ', '', $filename2in);

            $path = public_path() . '/storage/app/public/';
            $uploadedFile->move($path, $filenamein);
        } else {
            $filenamein = '';
        }


        $id = DB::table('master_informasi')->insert([
            'text_informasi' => $request->text_informasi,
            'status' => 2,
            'dokumen' => $filenamein,
        ]);


        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/informasi');
    }
    public function editinformasi(Request $request)
    {
        if (!empty($request->dokumen)) {

            $uploadedFile = $request->file('dokumen');
            $filename2in = $uploadedFile->getClientOriginalName();
            $filenamein = uniqid() . str_replace(' ', '', $filename2in);

            $path = public_path() . '/storage/app/public/';
            $uploadedFile->move($path, $filenamein);

            $id = DB::table('master_informasi')->where('id', $request->id)->update([
                'text_informasi' => $request->informasi,
                'dokumen' => $filenamein,
            ]);
        } else {
            $id = DB::table('master_informasi')->where('id', $request->id)->update([
                'text_informasi' => $request->informasi,
            ]);
        }

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/informasi');
    }

    public function showinformasi(Request $request)
    {
        $masterjenislayanan = DB::table('master_informasi')->where('id', $request->id)->get();
        foreach ($masterjenislayanan as $value) {
            $status = $value->status;
        }

        if ($status == 1) {
            $id = DB::table('master_informasi')->where('id', $request->id)->update([
                'status' => 2,
            ]);
        } else {
            $id = DB::table('master_informasi')->where('id', $request->id)->update([
                'status' => 1,
            ]);
        }

        Session::flash('success', 'Data Ditampilkan');

        return redirect('/admin/informasi');
    }

    public function indextentang()
    {
        return view('admin.master.indextentang');
    }

    public function getdatatentang()
    {
        $mastertentang = MasterTentang::orderby('id')->get();

        return Datatables::of($mastertentang)
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == true) {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . base64_encode($mjl->deskripsi) . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\',\'' . base64_encode($mjl->deskripsi) . '\')"><i class="fa fa-times "></i></a></center>';
                } else {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . base64_encode($mjl->deskripsi) . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\',\'' . base64_encode($mjl->deskripsi) . '\')"><i class="fa fa-check "></i></a></center>';
                }
            })
            ->make(true);
    }

    public function edittentang(Request $request)
    {
        $id = MasterTentang::where('id', $request->id)->update([
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/mastertentang');
    }

    public function showtentang(Request $request)
    {
        $mastertentang = MasterTentang::where('id', $request->id)->get();
        foreach ($mastertentang as $value) {
            $show = $value->status;
        }

        if ($show == true) {
            $id = MasterTentang::where('id', $request->id)->update([
                'status' => false,
            ]);
            Session::flash('success', 'Data Disembunyikan');
        } else {
            $id = MasterTentang::where('id', $request->id)->update([
                'status' => true,
            ]);
            Session::flash('success', 'Data Ditampilkan');
        }


        return redirect('/admin/mastertentang');
    }

    public function indexlokasi()
    {
        return view('admin.master.indexlokasi');
    }

    public function getdatalokasi()
    {
        $mastertentang = MasterTentang::orderby('id')->get();

        return Datatables::of($mastertentang)
            ->addColumn('action', function ($mjl) {
                if ($mjl->status_lokasi == true) {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->lokasi_big . '\',\'' . $mjl->lokasi_tatapmuka . '\',\'' . $mjl->email . '\',\'' . $mjl->telpon . '\',\'' . $mjl->website . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\',\'' . $mjl->lokasi_big . '\',\'' . $mjl->lokasi_tatapmuka . '\',\'' . $mjl->email . '\',\'' . $mjl->telpon . '\',\'' . $mjl->website . '\')"><i class="fa fa-times "></i></a></center>';
                } else {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->lokasi_big . '\',\'' . $mjl->lokasi_tatapmuka . '\',\'' . $mjl->email . '\',\'' . $mjl->telpon . '\',\'' . $mjl->website . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\',\'' . $mjl->lokasi_big . '\',\'' . $mjl->lokasi_tatapmuka . '\',\'' . $mjl->email . '\',\'' . $mjl->telpon . '\',\'' . $mjl->website . '\')"><i class="fa fa-check "></i></a></center>';
                }
            })
            ->make(true);
    }

    public function editlokasi(Request $request)
    {
        $id = MasterTentang::where('id', $request->id)->update([
            'lokasi_big' => $request->lokasi_big,
            'lokasi_tatapmuka' => $request->lokasi_tatapmuka,
            'email' => $request->email,
            'telpon' => $request->telpon,
            'website' => $request->website,
        ]);

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/masterlokasi');
    }

    public function showlokasi(Request $request)
    {
        $mastertentang = MasterTentang::where('id', $request->id)->get();
        foreach ($mastertentang as $value) {
            $show = $value->status_lokasi;
        }

        if ($show == true) {
            $id = MasterTentang::where('id', $request->id)->update([
                'status_lokasi' => false,
            ]);
            Session::flash('success', 'Data Disembunyikan');
        } else {
            $id = MasterTentang::where('id', $request->id)->update([
                'status_lokasi' => true,
            ]);
            Session::flash('success', 'Data Ditampilkan');
        }

        return redirect('/admin/masterlokasi');
    }

    public function indexberita()
    {
        return view('admin.master.indexberita');
    }

    public function getdataberita()
    {
        $masterberita = MasterBerita::orderby('created_at', 'desc')->get();

        return Datatables::of($masterberita)
            ->addColumn('action', function ($mjl) {
                if ($mjl->show == true) {
                    return '<center>
                                <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->judul . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->gambar . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                <a href="#" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->id . '\',\'' . $mjl->judul . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->gambar . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i> Lihat</a>
                                <a href="#" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\',\'' . $mjl->judul . '\')"><i class="fa fa-times "></i> Sembunyikan</a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="hapus(\'' . $mjl->id . '\',\'Hapus Permanen\',\'' . $mjl->judul . '\')"><i class="fa fa-trash "></i> Hapus</a></center>';
                } else {
                    return '<center>
                                <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->judul . '\',\'' . $mjl->deskripsi . '.trim()\',\'' . $mjl->gambar . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                <a href="#" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->id . '\',\'' . $mjl->judul . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->gambar . '\',\'' . $mjl->created_at . '\',\'' . $mjl->updated_at . '\')"><i class="fa fa-search "></i> Lihat</a>
                                <a href="#" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\',\'' . $mjl->judul . '\')"><i class="fa fa-check "></i> Tampilkan</a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="hapus(\'' . $mjl->id . '\',\'Hapus Permanen\',\'' . $mjl->judul . '\')"><i class="fa fa-trash "></i> Hapus</a></center>';
                }
            })
            ->make(true);
    }

    public function simpanberita(Request $request)
    {
        $uploadedFile = $request->file('gambar');
        $path = $uploadedFile->store('images/berita');
        $datenow = date('Y-m-d H:i:s');

        $des = str_replace("\r\n", "<br>", $request->deskripsi);

        $id = MasterBerita::insertGetId([
            'judul' => $request->judul,
            'deskripsi' => $des,
            'show' => false,
            'created_at' => $datenow,
            'updated_at' => null,
            'gambar' => $path,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/masterberita');
    }

    public function editberita(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');
        $des = str_replace(".trim()", "", $request->deskripsi);
        if (!empty($request->gambar)) {
            $uploadedFile = $request->file('gambar');
            $path = $uploadedFile->store('images');

            $id = MasterBerita::where('id', $request->id)->update([
                'judul' => $request->judul,
                'deskripsi' => $des,
                'gambar' => $path,
                'updated_at' => $datenow,
            ]);
        } else {
            $id = MasterBerita::where('id', $request->id)->update([
                'judul' => $request->judul,
                'deskripsi' => $des,
                'updated_at' => $datenow,
            ]);
        }

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/masterberita');
    }

    public function showberita(Request $request)
    {
        $masterberita = MasterBerita::where('id', $request->id)->get();
        foreach ($masterberita as $value) {
            $show = $value->show;
        }

        if ($show == true) {
            $id = MasterBerita::where('id', $request->id)->update([
                'show' => false,
            ]);
        } else {
            $id = MasterBerita::where('id', $request->id)->update([
                'show' => true,
            ]);
        }

        Session::flash('success', 'Data Ditampilkan');

        return redirect('/admin/masterberita');
    }
    public function hapusberita(Request $request)
    {

        $id = MasterBerita::where('id', $request->id)->delete();

        Session::flash('success', 'Data Dihapus Permanen');

        return redirect('/admin/masterberita');
    }

    public function indexlayanandigital()
    {
        return view('admin.master.indexlayanandigital');
    }

    public function getdatalayanandigital()
    {
        $masterlayanandigital = MasterLayananDigital::orderby('id')->get();

        return Datatables::of($masterlayanandigital)
            ->addColumn('action', function ($mjl) {
                if ($mjl->show == true) {
                    return '<center>
                                <div class="row">
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_layanan . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->icon . '\',\'' . $mjl->url . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->nama_layanan . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->icon . '\')"><i class="fa fa-search "></i></a>
                                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\',\'' . $mjl->nama_layanan . '\')"><i class="fa fa-check "></i></a></center>
                                </div>
                                ';
                } else {
                    return '<center>
                                <div class="row">
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_layanan . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->icon . '\',\'' . $mjl->url . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->nama_layanan . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->icon . '\')"><i class="fa fa-search "></i></a>
                                <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\',\'' . $mjl->nama_layanan . '\')"><i class="fa fa-times "></i></a></center>
                                </div>
                                ';
                }
            })
            ->make(true);
    }

    public function simpanlayanandigital(Request $request)
    {
        $uploadedFile = $request->file('icon');
        $filename2in = $uploadedFile->getClientOriginalName();
        $filenamein = uniqid() . str_replace(' ', '', $filename2in);

        $path = public_path() . '/upload/daring';
        $uploadedFile->move($path, $filenamein);

        $id = MasterLayananDigital::insertGetId([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'show' => false,
            'url' => $request->url,
            'icon' => $filenamein,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/masterlayanandigital');
    }

    public function editlayanandigital(Request $request)
    {
        if (!empty($request->icon)) {
            $uploadedFile = $request->file('icon');
            $filename2in = $uploadedFile->getClientOriginalName();
            $filenamein = uniqid() . str_replace(' ', '', $filename2in);

            $path = public_path() . '/upload/daring';
            $uploadedFile->move($path, $filenamein);

            $id = MasterLayananDigital::where('id', $request->id)->update([
                'nama_layanan' => $request->nama_layanan,
                'deskripsi' => $request->deskripsi,
                'icon' => $filenamein,
                'url' => $request->url,
            ]);
        } else {
            $id = MasterLayananDigital::where('id', $request->id)->update([
                'nama_layanan' => $request->nama_layanan,
                'deskripsi' => $request->deskripsi,
                'url' => $request->url,
            ]);
        }

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/masterlayanandigital');
    }

    public function showlayanandigital(Request $request)
    {
        $masterlayanandigital = MasterLayananDigital::where('id', $request->id)->get();
        foreach ($masterlayanandigital as $value) {
            $show = $value->show;
        }

        if ($show == true) {
            $id = MasterLayananDigital::where('id', $request->id)->update([
                'show' => false,
            ]);
            Session::flash('success', 'Data Disembunyikan');
        } else {
            $id = MasterLayananDigital::where('id', $request->id)->update([
                'show' => true,
            ]);
            Session::flash('success', 'Data Ditampilkan');
        }

        return redirect('/admin/masterlayanandigital');
    }

    public function indexpusat()
    {
        return view('admin.master.indexpusat');
    }

    public function getdatapusat()
    {
        $masterpusat = MasterPusat::orderby('id')->get();

        return Datatables::of($masterpusat)
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == true) {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_pusat . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\',\'' . $mjl->nama_pusat . '\')"><i class="fa fa-check "></i></a></center>';
                } else {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_pusat . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\',\'' . $mjl->nama_pusat . '\')"><i class="fa fa-times "></i></a></center>';
                }
            })
            ->make(true);
    }

    public function simpanpusat(Request $request)
    {
        $id = MasterPusat::insertGetId([
            'nama_pusat' => $request->nama_pusat,
            'status' => true,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/masterpusat');
    }

    public function editpusat(Request $request)
    {
        $id = MasterPusat::where('id', $request->id)->update([
            'nama_pusat' => $request->nama_pusat,
        ]);

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/masterpusat');
    }

    public function showpusat(Request $request)
    {
        $masterpusat = MasterPusat::where('id', $request->id)->get();
        foreach ($masterpusat as $value) {
            $status = $value->status;
        }

        if ($status == true) {
            $id = MasterPusat::where('id', $request->id)->update([
                'status' => false,
            ]);
            Session::flash('success', 'Data Disembunyikan');
        } else {
            $id = MasterPusat::where('id', $request->id)->update([
                'status' => true,
            ]);
            Session::flash('success', 'Data Ditampilkan');
        }

        return redirect('/admin/masterpusat');
    }

    public function indexpertanyaan()
    {

        $urutan_last = DB::table('master_pertanyaan')->orderBy('urutan', 'DESC')->first();

        return view('admin.master.indexpertanyaan', compact('urutan_last'));
    }

    public function getPertanyaan()
    {
        $master_pertanyaan = DB::table('master_pertanyaan')->select('master_pertanyaan.*')->orderBy('urutan', 'ASC')->get();

        return Datatables::of($master_pertanyaan)
            ->addColumn('required', function ($mjl) {
                if (!empty($mjl->required)) {
                    return '<center><span class="label label-danger">WAJIB</span></center>';
                } else {
                    return '<center><span class="label label-warning">TIDAK WAJIB</span></center>';
                }
            })
            ->addColumn('khusus', function ($mjl) {
                if (!empty($mjl->khusus)) {
                    return '<center><span class="label label-danger">KHUSUS</span></center>';
                } else {
                    return '';
                }
            })
            ->addColumn('action', function ($mjl) {
                if (empty($mjl->deleted_at)) {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->pertanyaan . '\',\'' . $mjl->required . '\',\'' . $mjl->khusus . '\',\'' . $mjl->kategori . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'hide\')"><i class="fa fa-check"></i></a>';
                } else {
                    return '<center>
                            <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->pertanyaan . '\',\'' . $mjl->required . '\',\'' . $mjl->khusus . '\',\'' . $mjl->kategori . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'show\')"><i class="fa fa-times"></i></a>';
                }
            })
            ->rawColumns(['khusus', 'required', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function simpanpertanyaan(Request $request)
    {
        $last_urutan = $request->urutan_last + 1;

        $data = [
            'pertanyaan'    => $request->pertanyaan,
            'urutan'        => $last_urutan,
            'required'      => $request->required,
            'type'          => 'radio',
            'khusus'        => $request->khusus,
            'kategori'      => $request->kategori,
        ];

        $simpan = DB::table('master_pertanyaan')->insert($data);

        return redirect()->back()->with(['success' => 'Data Simpan']);
    }

    public function editpertanyaan(Request $request)
    {

        $data = [
            'pertanyaan'    => $request->pertanyaan,
            'required'      => $request->required,
            'khusus'        => $request->khusus,
            'kategori'      => $request->kategori,
        ];

        $edit = DB::table('master_pertanyaan')->where('id', $request->id)->update($data);

        return redirect()->back()->with(['success' => 'Data Update']);
    }

    public function deletedpertanyaan(Request $request)
    {
        if ($request->hideShow == 'hide') {
            $hideShow = date('Y-m-d H:i:s');
        } else {
            $hideShow = null;
        }
        $deleted = DB::table('master_pertanyaan')
            ->where('id', $request->id)
            ->update([
                'deleted_at' => $hideShow,
            ]);

        return redirect()->back()->with(['success' => 'Data Hide']);
    }

    public function index_kasnegara()
    {
        $data['master_kas'] = DB::table('master_layanan_kas_negara')->get();
        $data['no'] = 1;
        $data['kode_akun'] = DB::table('master_kode_akun')->get();

        return view('admin.master.indexlayanankasnegara', $data);
    }

    public function get_kasnegara()
    {
        $master_kas = DB::table('master_layanan_kas_negara')->select('master_layanan_kas_negara.*', 'master_kode_akun.kode_akun')
            ->leftjoin('master_kode_akun', 'master_kode_akun.id', 'master_layanan_kas_negara.id_kode_akun')
            ->orderBy('master_layanan_kas_negara.id', 'ASC')->get();

        return Datatables::of($master_kas)
            ->addColumn('nama_layanan', function ($mjl) {
                return $mjl->nama_layanan;
            })
            ->addColumn('kode', function ($mjl) {
                return $mjl->kode_akun;
            })
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_layanan . '\',\'' . $mjl->id_kode_akun . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\')"><i class="fa fa-check "></i></a>
                <a href="#" title="Delete" class="btn btn-sm btn-danger" onclick="destroy(\'' . $mjl->id . '\',\'Delete\')"><i class="fa fa-trash "></i></a></center>';
                } elseif ($mjl->status == 2) {
                    return  '<center>
                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_layanan . '\',\'' . $mjl->id_kode_akun . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\')"><i class="fa fa-times "></i></a>
                <a href="#" title="Delete" class="btn btn-sm btn-danger" onclick="destroy(\'' . $mjl->id . '\',\'Delete\')"><i class="fa fa-trash "></i></a></center>';
                } elseif ($mjl->status == null) {
                    return  '<center>
                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_layanan . '\',\'' . $mjl->id_kode_akun . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\')"><i class="fa fa-times "></i></a>
                <a href="#" title="Delete" class="btn btn-sm btn-danger" onclick="destroy(\'' . $mjl->id . '\',\'Delete\')"><i class="fa fa-trash "></i></a></center>';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function edit_kasnegara(Request $request)
    {

        $update = DB::table('master_layanan_kas_negara')->where('id', $request->id)->update([
            'nama_layanan'  => $request->layanan,
            'id_kode_akun'  => $request->kode_akun
        ]);

        return redirect()->back()->with(['success' => 'Berhasil Edit']);
    }
    public function showkasnegara(Request $request)
    {
        $master_kas_negara = DB::table('master_layanan_kas_negara')->where('id', $request->id)->get();
        foreach ($master_kas_negara as $value) {
            $status = $value->status;
        }

        if ($status == 1) {
            $id = DB::table('master_layanan_kas_negara')->where('id', $request->id)->update([
                'status' => 2,
            ]);
        } else {
            $id = DB::table('master_layanan_kas_negara')->where('id', $request->id)->update([
                'status' => 1,
            ]);
        }

        Session::flash('success', 'Data Berhasi di ubah');

        return redirect('/admin/master-layanan');
    }

    public function simpan_kasnegara(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');

        $id = DB::table('master_layanan_kas_negara')->insert([
            'nama_layanan' => $request->layanan,
            'id_kode_akun' => $request->kode_akun,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/master-layanan');
    }

    public function delete_kasnegara(Request $req)
    {
        $delete = DB::table('master_layanan_kas_negara')->where("id", $req->id)->delete();
        Session::flash('success', 'Data Berhasil Dihapus');
    }


    public function indexStasiun()
    {
        return view('admin.master.indexstasiun');
    }

    public function getdataStasiun()
    {
        $data = DB::table('master_stasiun')->get();

        return Datatables::of($data)
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                                <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->kode_stasiun . '\',\'' . $mjl->nama_stasiun . '\')"><i class="glyphicon glyphicon-edit"></i> </a>
                                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\')"><i class="fa fa-check "></i></a>
                                </center>';
                } else {
                    return '<center>
                    <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->kode_stasiun . '\',\'' . $mjl->nama_stasiun . '\')"><i class="glyphicon glyphicon-edit"></i> </a>
                    <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\')"><i class="fa fa-times "></i></a>

                    </center>';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function simpanStasiun(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');

        $id = DB::table('master_stasiun')->insert([
            'kode_stasiun' => $request->kode_stasiun,
            'nama_stasiun' => $request->nama_stasiun,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/master-stasiun');
    }

    public function editStasiun(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');
        $id = DB::table('master_stasiun')->where('id', $request->id)->update([
            'kode_stasiun' => $request->kode_stasiun,
            'nama_stasiun' => $request->nama_stasiun,
        ]);


        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/master-stasiun');
    }

    public function hapusStasiun(Request $request)
    {

        $id = DB::table('master_stasiun')->where('id', $request->id)->delete();

        Session::flash('success', 'Data Dihapus Permanen');

        return redirect('/admin/master-stasiun');
    }

    public function updateStatus(Request $request)
    {
        $masterjenislayanan = DB::table('master_stasiun')->where('id', $request->id)->get();
        foreach ($masterjenislayanan as $value) {
            $status = $value->status;
        }

        if ($status == 1) {
            $id = DB::table('master_stasiun')->where('id', $request->id)->update([
                'status' => 2,
            ]);
        } else {
            $id = DB::table('master_stasiun')->where('id', $request->id)->update([
                'status' => 1,
            ]);
        }

        Session::flash('success', 'Data Ditampilkan');

        return redirect('/admin/master-stasiun');
    }
    public function indexproduk()
    {
        $master_satuan = DB::table('m_satuan')->get();
        return view('admin.master.indexproduk', compact('master_satuan'));
    }

    public function getdataproduk()
    {
        $data = DB::table('m_produk')
            ->join('m_satuan', 'm_produk.satuan', '=', 'm_satuan.id')
            ->get();

        return Datatables::of($data)
            ->addColumn('tarif', function ($mjl) {
                return "Rp " . number_format($mjl->tarif, 0, ",", ".");
            })
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                    <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id_produk . '\',\'' . $mjl->nama_produk . '\',\'' . $mjl->id_produk . '\',\'' . $mjl->tarif . '\',\'' . $mjl->stok_awal . '\',\'' . $mjl->stok_baik . '\',\'' . $mjl->stok_rusak . '\')"><i class="glyphicon glyphicon-edit"></i> </a>
                    <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id_produk . '\',\'Sembunyikan\')"><i class="fa fa-check "></i></a>
                    </center>';
                } else {
                    return '<center>
                    <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id_produk . '\',\'' . $mjl->nama_produk . '\',\'' . $mjl->id_produk . '\',\'' . $mjl->tarif . '\',\'' . $mjl->stok_awal . '\',\'' . $mjl->stok_baik . '\',\'' . $mjl->stok_rusak . '\')"><i class="glyphicon glyphicon-edit"></i> </a>
                    <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id_produk . '\',\'Tampilkan\')"><i class="fa fa-times "></i></a>
                    </center>';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function updateStatusProduk(Request $request)
    {
        $masterjenislayanan = DB::table('m_produk')->where('id_produk', $request->id)->get();
        foreach ($masterjenislayanan as $value) {
            $status = $value->status;
        }

        if ($status == 1) {
            $id = DB::table('m_produk')->where('id_produk', $request->id)->update([
                'status' => 2,
            ]);
        } else {
            $id = DB::table('m_produk')->where('id_produk', $request->id)->update([
                'status' => 1,
            ]);
        }

        Session::flash('success', 'Data Ditampilkan');

        return redirect('/admin/master-produk');
    }

    public function simpanproduk(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');

        $id = DB::table('m_produk')->insert([
            'nama_produk' => $request->nama_produk,
            'satuan' => $request->satuan,
            'tarif' => str_replace(".", "", $request->tarif),
            'stok_awal' => $request->stok_awal,
            'stok_baik' => $request->stok_baik,
            'stok_rusak' => $request->stok_rusak,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/master-produk');
    }

    public function editproduk(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');
        $id = DB::table('m_produk')->where('id_produk', $request->id)->update([
            'nama_produk' => $request->nama_produk,
            'satuan' => $request->satuan,
            'tarif' => str_replace(".", "", $request->tarif),
            'stok_awal' => $request->stok_awal,
            'stok_baik' => $request->stok_baik,
            'stok_rusak' => $request->stok_rusak,
        ]);


        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/master-produk');
    }

    public function hapusproduk(Request $request)
    {

        $id = DB::table('m_produk')->where('id_produk', $request->id)->delete();

        Session::flash('success', 'Data Dihapus Permanen');

        return redirect('/admin/master-produk');
    }

    public function ExportExcelProduk()
    {
        $data = DB::table('m_produk')
            ->join('m_satuan', 'm_produk.satuan', '=', 'm_satuan.id')
            ->get();

        return view('admin.master.export-produk', compact('data'));
    }
    public function indexsubproduk()
    {
        $master_satuan = DB::table('m_satuan')->get();
        $produk = DB::table('m_produk')->get();
        return view('admin.master.indexsubproduk', compact('master_satuan', 'produk'));
    }

    public function getdatasubproduk()
    {
        $data = DB::table('m_subproduk')
            ->leftjoin('m_produk', 'm_subproduk.id_produk', '=', 'm_produk.id_produk')
            ->leftjoin('m_satuan', 'm_subproduk.satuan', '=', 'm_satuan.id')
            ->get();

        return Datatables::of($data)
            ->addColumn('tarif', function ($mjl) {
                return "Rp " . number_format($mjl->tarif, 0, ",", ".");
            })
            ->addColumn('action', function ($mjl) {
                if ($mjl->status_subproduk == 1) {
                    return '<center>
                    <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id_sub . '\',\'' . $mjl->id_produk . '\',\'' . $mjl->nama_subproduk . '\',\'' . $mjl->satuan . '\',\'' . $mjl->kode_produk . '\',\'' . $mjl->edisi . '\',\'' . $mjl->skala . '\',\'' . $mjl->nama_lembar . '\',\'' . $mjl->tanggal_stok . '\',\'' . $mjl->tarif . '\',\'' . $mjl->stok_awal . '\',\'' . $mjl->stok_baik . '\',\'' . $mjl->stok_rusak . '\')"><i class="glyphicon glyphicon-edit"></i> </a>
                    <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id_sub . '\',\'Sembunyikan\')"><i class="fa fa-check "></i></a>
                    </center>';
                } else {
                    return '<center>
                    <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id_sub . '\',\'' . $mjl->id_produk . '\',\'' . $mjl->nama_subproduk . '\',\'' . $mjl->satuan . '\',\'' . $mjl->kode_produk . '\',\'' . $mjl->edisi . '\',\'' . $mjl->skala . '\',\'' . $mjl->nama_lembar . '\',\'' . $mjl->tanggal_stok . '\',\'' . $mjl->tarif . '\',\'' . $mjl->stok_awal . '\',\'' . $mjl->stok_baik . '\',\'' . $mjl->stok_rusak . '\')"><i class="glyphicon glyphicon-edit"></i> </a>
                    <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id_sub . '\',\'Tampilkan\')"><i class="fa fa-times "></i></a>
                    </center>';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function updateStatussubproduk(Request $request)
    {
        $masterjenislayanan = DB::table('m_subproduk')->where('id_sub', $request->id)->get();
        foreach ($masterjenislayanan as $value) {
            $status_subproduk = $value->status_subproduk;
        }

        if ($status_subproduk == 1) {
            $id = DB::table('m_subproduk')->where('id_sub', $request->id)->update([
                'status_subproduk' => 2,
            ]);
        } else {
            $id = DB::table('m_subproduk')->where('id_sub', $request->id)->update([
                'status_subproduk' => 1,
            ]);
        }

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/master-subproduk');
    }

    public function simpansubproduk(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');

        $id = DB::table('m_subproduk')->insert([
            'id_produk' => $request->nama_produk,
            'nama_subproduk' => $request->nama_subproduk,
            'satuan' => $request->satuan,
            'kode_produk' => $request->kode_produk,
            'edisi' => $request->edisi,
            'skala' => $request->skala,
            'nama_lembar' => $request->nama_lembar,
            'tanggal_stok' => $request->tanggal_stok,
            'tarif' => str_replace(".", "", $request->tarif),
            'stok_awal' => $request->stok_awal,
            'stok_baik' => $request->stok_baik,
            'stok_rusak' => $request->stok_rusak,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/master-subproduk');
    }

    public function editsubproduk(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');
        $id = DB::table('m_subproduk')->where('id_sub', $request->id)->update([
            'id_produk' => $request->nama_produk,
            'nama_subproduk' => $request->nama_subproduk,
            'satuan' => $request->satuan,
            'kode_produk' => $request->kode_produk,
            'edisi' => $request->edisi,
            'skala' => $request->skala,
            'nama_lembar' => $request->nama_lembar,
            'tanggal_stok' => $request->tanggal_stok,
            'tarif' => str_replace(".", "", $request->tarif),
            'stok_awal' => $request->stok_awal,
            'stok_baik' => $request->stok_baik,
            'stok_rusak' => $request->stok_rusak,
        ]);


        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/master-subproduk');
    }

    public function hapussubproduk(Request $request)
    {

        $id = DB::table('m_subproduk')->where('id_sub', $request->id)->delete();

        Session::flash('success', 'Data Dihapus Permanen');

        return redirect('/admin/master-subproduk');
    }

    public function indexhasilsurvey()
    {
        $master_pusat = DB::table('master_pusat')->where('id', '!=', 14)->get();
        return view('admin.master.indexhasilsurvey', compact('master_pusat'));
    }

    public function getdatahasilsurvey()
    {
        $data = DB::table('master_hasil_survey')
            ->select('master_hasil_survey.*', 'master_hasil_survey.id as id_hasil', 'master_pusat.*')
            ->leftjoin('master_pusat', 'master_hasil_survey.id_pusat', '=', 'master_pusat.id')
            ->get();

        return Datatables::of($data)
            ->addColumn('action', function ($mjl) {
                return '<center>
                                <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id_hasil . '\',\'' . $mjl->nama_pusat . '\',\'' . $mjl->id . '\',\'' . $mjl->jumlah_pengunjung . '\',\'' . $mjl->ikm . '\',\'' . $mjl->tw . '\',\'' . $mjl->tahun . '\')"><i class="glyphicon glyphicon-edit"></i> </a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="hapus(\'' . $mjl->id_hasil . '\',\'' . $mjl->nama_pusat . '\')"><i class="fa fa-trash "></i></a></center>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function simpanhasilsurvey(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');

        $id = DB::table('master_hasil_survey')->insert([
            'id_pusat' => $request->pusat,
            'jumlah_pengunjung' => $request->jumlah_pengunjung,
            'ikm' => $request->ikm,
            'tahun' => $request->tahun,
            'tw' => $request->tw,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/master-hasilsurvey');
    }

    public function CekTriwulanSurvey(Request $request)
    {
        $data = DB::table('master_hasil_survey')->where('tw', $request->tw)->where('tahun', $request->tahun)->select('tw')->count();
        // dd($data);
        return $data;
    }

    public function edithasilsurvey(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');
        $id = DB::table('master_hasil_survey')->where('id', $request->id)->update([
            'id_pusat' => $request->pusat,
            'jumlah_pengunjung' => $request->jumlah_pengunjung,
            'ikm' => $request->ikm,
            'tahun' => $request->tahun,
            'tw' => $request->tw,
        ]);


        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/master-hasilsurvey');
    }

    public function hapushasilsurvey(Request $request)
    {

        $id = DB::table('master_hasil_survey')->where('id', $request->id)->delete();

        Session::flash('success', 'Data Dihapus Permanen');

        return redirect('/admin/master-hasilsurvey');
    }


    public function indexhasilsurveykomponen()
    {
        $master_unsur = DB::table('master_unsur')->where('status', 1)->get();
        return view('admin.master.indexsurveykomponen', compact('master_unsur'));
    }

    public function getdatahasilsurveykomponen()
    {
        $data = DB::table('master_hasil_survey_komponen')
            ->select('master_hasil_survey_komponen.*', 'master_hasil_survey_komponen.id as id_hasil', 'master_unsur.*')
            ->join('master_unsur', 'master_hasil_survey_komponen.id_unsur', '=', 'master_unsur.id')
            ->get();

        return Datatables::of($data)
            ->addColumn('action', function ($mjl) {
                return '<center>
                                <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id_hasil . '\',\'' . $mjl->nama_unsur . '\',\'' . $mjl->id . '\',\'' . $mjl->kepuasan . '\',\'' . $mjl->kepentingan . '\',\'' . $mjl->ikm . '\',\'' . $mjl->konversi . '\',\'' . $mjl->nilai . '\')"><i class="glyphicon glyphicon-edit"></i> </a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="hapus(\'' . $mjl->id_hasil . '\',\'' . $mjl->nama_unsur . '\')"><i class="fa fa-trash "></i></a></center>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function simpanhasilsurveykomponen(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');

        $id = DB::table('master_hasil_survey_komponen')->insert([
            'tahun' => $request->tahun,
            'tw' => $request->tw,
            'id_unsur' => $request->unsur,
            'kepuasan' => $request->kepuasan,
            'kepentingan' => $request->kepentingan,
            'ikm' => $request->ikm,
            'konversi' => $request->konversi,
            'nilai' => $request->nilai,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/master-hasilsurveykomponen');
    }

    public function edithasilsurveykomponen(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');
        $id = DB::table('master_hasil_survey_komponen')->where('id', $request->id)->update([
            'tahun' => $request->tahun,
            'tw' => $request->tw,
            'id_unsur' => $request->unsur,
            'kepuasan' => $request->kepuasan,
            'kepentingan' => $request->kepentingan,
            'ikm' => $request->ikm,
            'konversi' => $request->konversi,
            'nilai' => $request->nilai,
        ]);


        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/master-hasilsurveykomponen');
    }

    public function hapushasilsurveykomponen(Request $request)
    {

        $id = DB::table('master_hasil_survey_komponen')->where('id', $request->id)->delete();

        Session::flash('success', 'Data Dihapus Permanen');

        return redirect('/admin/master-hasilsurveykomponen');
    }

    public function CekTriwulankomponen(Request $request)
    {
        $data = DB::table('master_hasil_survey_komponen')->where('tw', $request->tw)->where('tahun', $request->tahun)->select('tw')->count();
        // dd($data);
        return $data;
    }

    public function indexunsur()
    {
        return view('admin.master.indexunsur');
    }

    public function updateStatusunsur(Request $request)
    {
        $masterjenislayanan = DB::table('master_unsur')->where('id', $request->id)->get();
        foreach ($masterjenislayanan as $value) {
            $status_subproduk = $value->status;
        }

        if ($status_subproduk == 1) {
            $id = DB::table('master_unsur')->where('id', $request->id)->update([
                'status' => 2,
            ]);
        } else {
            $id = DB::table('master_unsur')->where('id', $request->id)->update([
                'status' => 1,
            ]);
        }

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/master-unsur');
    }

    public function getdataunsur()
    {
        $data = DB::table('master_unsur')->get();

        return Datatables::of($data)
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                                <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_unsur . '\')"><i class="glyphicon glyphicon-edit"></i> </a>
                                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\')"><i class="fa fa-check "></i></a>
                                </center>';
                } else {
                    return '<center>
                                <a href="#" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_unsur . '\')"><i class="glyphicon glyphicon-edit"></i> </a>
                                <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\')"><i class="fa fa-times "></i></a>
                                </center>';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function simpanunsur(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');

        $id = DB::table('master_unsur')->insert([
            'nama_unsur' => $request->nama_unsur,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/master-unsur');
    }

    public function editunsur(Request $request)
    {
        // dd($request->all());
        $datenow = date('Y-m-d H:i:s');
        $id = DB::table('master_unsur')->where('id', $request->id)->update([
            'nama_unsur' => $request->nama_unsur,
        ]);


        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/master-unsur');
    }

    public function hapusunsur(Request $request)
    {

        $id = DB::table('master_unsur')->where('id', $request->id)->delete();

        Session::flash('success', 'Data Dihapus Permanen');

        return redirect('/admin/master-unsur');
    }

    public function indexstandart()
    {
        return view('admin.master.indexstandart');
    }

    public function getdatastandart()
    {
        $masterjenislayanan = DB::table('master_standart')->get();

        return Datatables::of($masterjenislayanan)
            ->addColumn('action', function ($mjl) {
                $cek_status = DB::table('master_standart')->where('status', 1)->count();
                if ($mjl->status == 1) {
                    return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->text . '\',)"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\',\'' . $mjl->text . '\')"><i class="fa fa-check "></i></a></center>';
                } else if ($mjl->status == 2) {
                    if ($cek_status == 1) {
                        return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->text . '\',)"><i class="glyphicon glyphicon-edit"></i></a></center>';
                    } else {
                        return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->text . '\',)"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\',\'' . $mjl->text . '\')"><i class="fa fa-times "></i></a></center>';
                    }
                }
            })

            ->addIndexColumn()
            ->make(true);
    }

    public function simpanstandart(Request $request)
    {
        $uploadedFile = $request->file('icon');
        $filename2in = $uploadedFile->getClientOriginalName();
        $filenamein = uniqid() . str_replace(' ', '', $filename2in);

        $path = public_path() . '/assets/digilab/images/';
        $uploadedFile->move($path, $filenamein);

        $id = DB::table('master_standart')->insert([
            'text' => $request->text,
            'status' => 2,
            'gambar' => $filenamein,
        ]);

        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/master-standart');
    }
    public function editstandart(Request $request)
    {
        if (!empty($request->gambar)) {

            $uploadedFile = $request->file('gambar');
            $filename2in = $uploadedFile->getClientOriginalName();
            $filenamein = uniqid() . str_replace(' ', '', $filename2in);

            $path = public_path() . '/assets/digilab/images/';
            $uploadedFile->move($path, $filenamein);

            $id = DB::table('master_standart')->where('id', $request->id)->update([
                'text' => $request->text,
                'gambar' => $filenamein,
            ]);
        } else {
            $id = DB::table('master_standart')->where('id', $request->id)->update([
                'text' => $request->text,
            ]);
        }

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/master-standart');
    }

    public function showstandart(Request $request)
    {
        $masterjenislayanan = DB::table('master_standart')->where('id', $request->id)->get();
        foreach ($masterjenislayanan as $value) {
            $status = $value->status;
        }

        if ($status == 1) {
            $id = DB::table('master_standart')->where('id', $request->id)->update([
                'status' => 2,
            ]);
        } else {
            $id = DB::table('master_standart')->where('id', $request->id)->update([
                'status' => 1,
            ]);
        }

        Session::flash('success', 'Data Ditampilkan');

        return redirect('/admin/master-standart');
    }
}
