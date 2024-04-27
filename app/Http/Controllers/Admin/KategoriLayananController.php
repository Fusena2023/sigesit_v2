<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Session;
use App\MasterLayananJasa;
use App\MasterLayananDiklat;
use App\MasterPusat;

class KategoriLayananController extends Controller
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
    public function indexkatlayananjasa()
    {
        $masterpusat = MasterPusat::where('status', true)
            ->where('id', '!=', 14)
            ->orderby('id', 'asc')
            ->get();
        return view('admin.katlayanan.indexkatlayananjasa', compact('masterpusat'));
    }
    public function getdatakatlayananjasa()
    {
        $masterlayananjasa = MasterLayananJasa::leftjoin('master_pusat', 'master_layanan_jasa.id_pusat', '=', 'master_pusat.id')->select('master_layanan_jasa.*', 'master_pusat.nama_pusat as nama_pusat')->where('id_pusat', '!=', 14)->orderby('master_layanan_jasa.id')->get();

        return Datatables::of($masterlayananjasa)
            ->addColumn('action', function ($mjl) {
                if ($mjl->status == 1) {
                    return '<center>
                    <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->gambar . '\',\'' . $mjl->nama_pusat . '\',\'' . $mjl->id_pusat . '\',\'' . $mjl->kode_layanan . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->gambar . '\',\'' . $mjl->nama_pusat . '\',\'' . $mjl->kode_layanan . '\')"><i class="fa fa-search "></i></a>
                    <a href="#" title="Sembunyikan" class="btn btn-sm btn-warning" onclick="show(\'' . $mjl->id . '\',\'Sembunyikan\')"><i class="fa fa-check "></i></a></center>';
                } else {
                    return '<center>
                    <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->gambar . '\',\'' . $mjl->nama_pusat . '\',\'' . $mjl->id_pusat . '\',\'' . $mjl->kode_layanan . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->gambar . '\',\'' . $mjl->nama_pusat . '\',\'' . $mjl->kode_layanan . '\')"><i class="fa fa-search "></i></a> 
                    <a href="#" title="Tampilkan" class="btn btn-sm btn-info" onclick="show(\'' . $mjl->id . '\',\'Tampilkan\')"><i class="fa fa-times "></i></a></center>';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function simpankatlayananjasa(Request $request)
    {
        if (!empty($request->hasFile('icon'))) {
            $file = $request->file('icon');
            $original_file_name = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/upload/jasa', $original_file_name);
        } else {
            $original_file_name = null;
        }
        $id = MasterLayananJasa::insert([
            'nama_layanan_jasa' => $request->nama_layanan_jasa,
            'deskripsi' => $request->deskripsi,
            'id_pusat' => $request->id_pusat,
            'gambar' => $original_file_name,
            'kode_layanan' => $request->kode,
            'status' => 1,
        ]);


        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/katlayananjasa');
    }

    public function showkatlayananjasa(Request $request)
    {
        $master_kas_negara = DB::table('master_layanan_jasa')->where('id', $request->id)->get();
        foreach ($master_kas_negara as $value) {
            $status = $value->status;
        }

        if ($status == 1) {
            $id = DB::table('master_layanan_jasa')->where('id', $request->id)->update([
                'status' => 2,
            ]);
        } else {
            $id = DB::table('master_layanan_jasa')->where('id', $request->id)->update([
                'status' => 1,
            ]);
        }

        Session::flash('success', 'Data Berhasi di ubah');

        return redirect('/admin/katlayananjasa');
    }
    public function editkatlayananjasa(Request $request)
    {
        if (empty($request->hasFile('icon'))) {
            $id = MasterLayananJasa::where('id', $request->id)->update([
                'nama_layanan_jasa' => $request->nama_layanan_jasa,
                'deskripsi' => $request->deskripsi,
                'id_pusat' => $request->id_pusat,
                'kode_layanan' => $request->kode,
            ]);
        } else {
            $file = $request->file('icon');
            $original_file_name = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/upload/jasa', $original_file_name);

            $data_sebelumnya = MasterLayananJasa::where('id', $request->id)->first();
            unlink(public_path() . '/upload/jasa/' . $data_sebelumnya->gambar);

            $id = MasterLayananJasa::where('id', $request->id)->update([
                'nama_layanan_jasa' => $request->nama_layanan_jasa,
                'deskripsi' => $request->deskripsi,
                'id_pusat' => $request->id_pusat,
                'gambar' => $original_file_name,
                'kode_layanan' => $request->kode,
            ]);
        }

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/katlayananjasa');
    }

    //nol rupiah


    public function indexnolrupiah()
    {
        $masterpusat = MasterPusat::where('status', true)
            ->where('id', 14)
            ->orderby('id', 'asc')
            ->get();
        return view('admin.katnolrp.index', compact('masterpusat'));
    }
    public function getdatanolrupiah()
    {
        $masterlayananjasa = MasterLayananJasa::leftjoin('master_pusat', 'master_layanan_jasa.id_pusat', '=', 'master_pusat.id')
            ->select('master_layanan_jasa.*', 'master_pusat.nama_pusat as nama_pusat')
            ->where('id_pusat', 14)
            ->orderby('master_layanan_jasa.id')
            ->get();

        return Datatables::of($masterlayananjasa)
            ->addColumn('action', function ($mjl) {
                return '<center>
                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_layanan_jasa . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->gambar . '\',\'' . $mjl->nama_pusat . '\',\'' . $mjl->id_pusat . '\',\'' . $mjl->kode_layanan . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                </center>';
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function simpannolrupiah(Request $request)
    {
        if (!empty($request->hasFile('icon'))) {
            $file = $request->file('icon');
            $original_file_name = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/upload/jasa', $original_file_name);
        } else {
            $original_file_name = null;
        }
        $id = MasterLayananJasa::insert([
            'nama_layanan_jasa' => $request->nama_layanan_jasa,
            'deskripsi' => $request->deskripsi,
            'id_pusat' => $request->id_pusat,
            'gambar' => $original_file_name,
            'kode_layanan' => $request->kode,
            'status' => 1,
        ]);


        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/nolrupiah');
    }

    public function editnolrupiah(Request $request)
    {
        $master_kas_negara = DB::table('master_layanan_jasa')->where('id', $request->id)->get();
        foreach ($master_kas_negara as $value) {
            $status = $value->status;
        }

        if ($status == 1) {
            $id = DB::table('master_layanan_jasa')->where('id', $request->id)->update([
                'status' => 2,
            ]);
        } else {
            $id = DB::table('master_layanan_jasa')->where('id', $request->id)->update([
                'status' => 1,
            ]);
        }

        Session::flash('success', 'Data Berhasi di ubah');

        return redirect('/admin/nolrupiah');
    }
    public function shownolrupiah(Request $request)
    {
        if (empty($request->hasFile('icon'))) {
            $id = MasterLayananJasa::where('id', $request->id)->update([
                'nama_layanan_jasa' => $request->nama_layanan_jasa,
                'deskripsi' => $request->deskripsi,
                'id_pusat' => $request->id_pusat,
                'kode_layanan' => $request->kode,
            ]);
        } else {
            $file = $request->file('icon');
            $original_file_name = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/upload/jasa', $original_file_name);

            $data_sebelumnya = MasterLayananJasa::where('id', $request->id)->first();
            unlink(public_path() . '/upload/jasa/' . $data_sebelumnya->gambar);

            $id = MasterLayananJasa::where('id', $request->id)->update([
                'nama_layanan_jasa' => $request->nama_layanan_jasa,
                'deskripsi' => $request->deskripsi,
                'id_pusat' => $request->id_pusat,
                'gambar' => $original_file_name,
                'kode_layanan' => $request->kode,
            ]);
        }

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/nolrupiah');
    }

    public function indexkatlayanandiklat()
    {
        $masterpusat = MasterPusat::where('status', true)->orderby('id', 'asc')->get();
        return view('admin.katlayanan.indexkatlayanandiklat', compact('masterpusat'));
    }
    public function getdatakatlayanandiklat()
    {
        $masterlayanandiklat = MasterLayananDiklat::leftjoin('master_pusat', 'master_layanan_diklat.id_pusat', '=', 'master_pusat.id')->select('master_layanan_diklat.*', 'master_pusat.nama_pusat as nama_pusat')->orderby('master_layanan_diklat.id')->get();

        return Datatables::of($masterlayanandiklat)
            ->addColumn('action', function ($mjl) {
                return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama_layanan_diklat . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->gambar . '\',\'' . $mjl->nama_pusat . '\',\'' . $mjl->id_pusat . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\'' . $mjl->nama_layanan_diklat . '\',\'' . $mjl->deskripsi . '\',\'' . $mjl->gambar . '\',\'' . $mjl->nama_pusat . '\')"><i class="fa fa-search "></i></a>';
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function simpankatlayanandiklat(Request $request)
    {
        $des = str_replace("\r\n", "<br>", $request->deskripsi);
        if (empty($request->file('icon'))) {

            $id = MasterLayananDiklat::insertGetId([
                'nama_layanan_diklat' => $request->nama_layanan_diklat,
                'deskripsi' => $des,
                'id_pusat' => $request->id_pusat,
                'gambar' => null,
            ]);
        } else {
            $uploadedFile = $request->file('icon');
            $path = $uploadedFile->store('images');

            $id = MasterLayananDiklat::insert([
                'nama_layanan_diklat' => $request->nama_layanan_diklat,
                'deskripsi' => $des,
                'id_pusat' => $request->id_pusat,
                'gambar' => $path,
            ]);
        }


        Session::flash('success', 'Data Tersimpan');
        return redirect('/admin/katlayanandiklat');
    }
    public function editkatlayanandiklat(Request $request)
    {
        $des = str_replace(".trim()", "", $request->deskripsi);
        if (!empty($request->icon)) {
            $uploadedFile = $request->file('icon');
            $path = $uploadedFile->store('images');

            $id = MasterLayananDiklat::where('id', $request->id)->update([
                'nama_layanan_diklat' => $request->nama_layanan_diklat,
                'deskripsi' => $des,
                'gambar' => $path,
                'id_pusat' => $request->id_pusat,
            ]);
        } else {
            $id = MasterLayananDiklat::where('id', $request->id)->update([
                'nama_layanan_diklat' => $request->nama_layanan_diklat,
                'deskripsi' => $des,
                'id_pusat' => $request->id_pusat,
            ]);
        }

        Session::flash('success', 'Data Diperbaharui');

        return redirect('/admin/katlayanandiklat');
    }
}
