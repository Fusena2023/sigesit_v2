<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Session;

class UserPenggunaController extends Controller
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
    public function indexuserpengguna()
    {
        return view('admin.indexuserpengguna');
    }

    public function getdatauserspengguna(Request $req)
    {
        $tanggal = date('Y-m-d');
        $tanggal_time = date('Y-m-d H:i:s', strtotime($tanggal));
        $jep = '';
        $tanggal = explode('to', $req->tanggal_range);
        // dd($tanggal);
        $jenis_instansi = $req->jenisinstansi;
        if ($tanggal[0] != "") {
            $tanggal_start = date('Y-m-d H:i:s', strtotime($tanggal[0]));
            $tanggal_end = date('Y-m-d H:i:s', strtotime($tanggal[1]));
        } else {
            $tanggal_start = "";
            $tanggal_end = "";
        }

        if ($tanggal_start != "" || $tanggal_end != "") {
            if ($jenis_instansi == 'Kementerian') {
                $user_pengguna = DB::table('users_pengguna')
                    ->whereBetween('created_at', [$tanggal_start, $tanggal_end])
                    ->where('jenis_instansi', 'Kementerian')
                    ->orderby('id')->get();
            } elseif ($jenis_instansi == 'Pendidikan') {
                $user_pengguna = DB::table('users_pengguna')
                    ->whereBetween('created_at', [$tanggal_start, $tanggal_end])
                    ->where('jenis_instansi', 'Pendidikan')
                    ->orderby('id')->get();
            } elseif ($jenis_instansi == 'Pemda') {
                $user_pengguna = DB::table('users_pengguna')
                    ->whereBetween('created_at', [$tanggal_start, $tanggal_end])
                    ->where('jenis_instansi', 'Pemda')
                    ->orderby('id')
                    ->get();
            } elseif ($jenis_instansi == 'Lainnya') {
                $user_pengguna = DB::table('users_pengguna')
                    ->whereBetween('created_at', [$tanggal_start, $tanggal_end])
                    ->where('jenis_instansi', 'Lainnya')
                    ->orderby('id')
                    ->get();
            } else {
                $user_pengguna = DB::table('users_pengguna')
                    ->Where('created_at', '<=', $tanggal_start)
                    ->Where('created_at', '>=', $tanggal_end)
                    ->orderby('id')
                    ->get();
            }
        } elseif ($tanggal_start == "" || $tanggal_end == "") {
            if ($jenis_instansi == 'Kementerian') {
                $user_pengguna = DB::table('users_pengguna')
                    ->where('jenis_instansi', 'Kementerian')
                    ->orderby('id')->get();
            } elseif ($jenis_instansi == 'Pendidikan') {
                $user_pengguna = DB::table('users_pengguna')
                    ->where('jenis_instansi', 'Pendidikan')
                    ->orderby('id')->get();
            } elseif ($jenis_instansi == 'Pemda') {
                $user_pengguna = DB::table('users_pengguna')
                    ->where('jenis_instansi', 'Pemda')
                    ->orderby('id')
                    ->get();
            } elseif ($jenis_instansi == 'Lainnya') {
                $user_pengguna = DB::table('users_pengguna')
                    ->where('jenis_instansi', 'Lainnya')
                    ->orderby('id')
                    ->get();
            }
        }

        $user_pengguna = DB::table('users_pengguna')->orderby('id')->get();

        return Datatables::of($user_pengguna)
            ->addColumn('instansi', function ($mjl) {
                $instansi = '';
                ($mjl->instansi == null) ? $instansi = '-' : $instansi = $mjl->instansi;
                return $instansi;
            })
            ->addcolumn('jenis_pengguna_fix', function ($mjl) {
                $jenis_pengguna = '';
                ($mjl->jenis_pengguna == 1) ? $jenis_pengguna = 'Perorangan' : $jenis_pengguna = $mjl->jenis_instansi;
                return $jenis_pengguna;
            })
            ->addColumn('action', function ($mjl) {
                return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\'' . $mjl->id . '\',\'' . $mjl->nama . '\',\'' . $mjl->email . '\',\'' . $mjl->alamat . '\',\'' . $mjl->no_telp . '\',\'' . $mjl->jenis_pengguna . '\',\'' . $mjl->alamat_instansi . '\',\'' . $mjl->jenis_instansi . '\',\'' . $mjl->instansi . '\',\'' . $mjl->direktorat . '\',\'' . $mjl->npwp . '\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="View" class="btn btn-sm btn-success" onclick="view(\'' . $mjl->id . '\',\'' . $mjl->nama . '\',\'' . $mjl->email . '\',\'' . $mjl->alamat . '\',\'' . $mjl->no_telp . '\',\'' . $mjl->jenis_pengguna . '\',\'' . $mjl->alamat_instansi . '\',\'' . $mjl->jenis_instansi . '\',\'' . $mjl->instansi . '\',\'' . $mjl->direktorat . '\',\'' . $mjl->npwp . '\',\'' . $mjl->login_last . '\')"><i class="fa fa-eye"></i></a>
                                <a href="#" title="Delete" class="btn btn-sm btn-danger" onclick="del(\'' . $mjl->id . '\')"><i class="fa fa-times "></i></a>
                                </center>';
            })
            ->make(true);
    }

    public function simpanuserspengguna(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = [
            'nama'              => $req->nama,
            'email'             => $req->email,
            'alamat'            => $req->alamat,
            'no_telp'           => $req->telepon,
            'alamat_instansi'   => $req->alamatinstansi,
            'jenis_instansi'    => $req->jenisinstansi,
            'instansi'          => $req->instansi,
            'direktorat'        => $req->direktorat,
            'npwp'              => $req->npwp,
            'jenis_pengguna'    => $req->jp,
            'aktifasi'          => 1,
            'created_at'         => date('Y-m-d H:i:s'),
        ];

        try {
            $simpan = DB::table('users_pengguna')->insert($data);
            if ($simpan > 0) {
                return redirect()->back()->with(['success' => 'Simpan Data']);
            } else {
                return redirect()->back()->with(['error' => 'Simpan Data']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Simpan Data']);
        }
    }

    public function edituserspengguna(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = [
            'nama'              => $request->nama,
            'email'             => $request->email,
            'alamat'            => $request->alamat,
            'no_telp'           => $request->telpon,
            'alamat_instansi'   => $request->ai,
            'jenis_instansi'    => $request->ji,
            'instansi'          => $request->instansi,
            'direktorat'        => $request->direktorat,
            'npwp'              => $request->npwp,
            'jenis_pengguna'    => $request->jenis_pengguna,
            'updated_at'        => date('Y-m-d H:i:s'),
        ];
        try {
            $edit = DB::table('users_pengguna')->where('id', $request->id)->update($data);
            if ($edit > 0) {
                return redirect()->back()->with(['success' => 'Edit Data']);
            } else {
                return redirect()->back()->with(['error' => 'Edit Data']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Edit Data']);
        }
    }

    public function deleteuserspengguna(Request $req)
    {
        DB::table('users_pengguna')->where('id', $req->id_edit)->delete();

        return redirect()->back()->with(['success' => 'Data Didelete']);
    }

    public function exportexcel(Request $req)
    {
        $tanggal = explode('to', $req->tanggal_range);
        // dd($tanggal, $req->jenis_instansi);
        if ($tanggal == '' || $req->jenis_instansi == null || $tanggal[0] == "") {
            $rekap_tiket = DB::table('users_pengguna')->get();
        } else if ($tanggal != '' || $req->jenis_instansi == 'Kementerian') {
            $rekap_tiket = DB::table('users_pengguna')
                ->whereBetween('created_at', [$tanggal[0], $tanggal[1]])
                ->where('jenis_instansi', 'Kementerian')
                ->get();
        } else if ($tanggal != '' || $req->jenis_instansi == 'Pendidikan') {
            $rekap_tiket = DB::table('users_pengguna')
                ->whereBetween('created_at', [$tanggal[0], $tanggal[1]])
                ->where('jenis_instansi', 'Pendidikan')
                ->get();
        } else if ($tanggal != '' || $req->jenis_instansi == 'Pemda') {
            $rekap_tiket = DB::table('users_pengguna')
                ->whereBetween('created_at', [$tanggal[0], $tanggal[1]])
                ->where('jenis_instansi', 'Pemda')
                ->get();
        } else if ($tanggal != '' || $req->jenis_instansi == 'Lainnya') {
            $rekap_tiket = DB::table('users_pengguna')
                ->whereBetween('created_at', [$tanggal[0], $tanggal[1]])
                ->where('jenis_instansi', 'Lainnya')
                ->get();
        } else if ($tanggal == '' || $req->jenis_instansi == 'Kementerian') {
            $rekap_tiket = DB::table('users_pengguna')
                ->where('jenis_instansi', 'Kementerian')
                ->get();
        } else if ($tanggal == '' || $req->jenis_instansi == 'Pendidikan') {
            $rekap_tiket = DB::table('users_pengguna')
                ->where('jenis_instansi', 'Pendidikan')
                ->get();
        } else if ($tanggal == '' || $req->jenis_instansi == 'Pemda') {
            $rekap_tiket = DB::table('users_pengguna')
                ->where('jenis_instansi', 'Pemda')
                ->get();
        } else if ($tanggal == '' || $req->jenis_instansi == 'Lainnya') {
            $rekap_tiket = DB::table('users_pengguna')
                ->where('jenis_instansi', 'Lainnya')
                ->get();
        } else if ($tanggal[0] != ''|| $tanggal[1] != '' || $req->jenis_instansi == '') {
            $rekap_tiket = DB::table('users_pengguna')
                ->whereBetween('created_at', [$tanggal[0], $tanggal[1]])
                ->get();
        }
        
        return view('admin.exportexcel', compact('rekap_tiket'));
    }

    public function validasi_email($email)
    {

        $email = DB::table('users_pengguna')->where('email', $email)->count();

        return $email;
    }
}
