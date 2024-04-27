<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Session;

class SurveyController extends Controller
{
    public function index()
    {
        return view('admin.master.indexsurvey');
    }

    public function getdatasurvey()
    {
        $master_survey = DB::table('master_survey')->select('master_survey.*')->orderBy('tahun','DESC')->get();

        return Datatables::of($master_survey)
                ->addColumn('nilai', function ($mjl) {
                    return str_replace('.',',',$mjl->nilai);
                })
                ->addColumn('action', function ($mjl) {
                        return '<center>
                                <a href="#" title="Edit" class="btn btn-sm btn-primary" onclick="edit(\''.$mjl->id.'\',\''.$mjl->tahun.'\',\''.$mjl->triwulan.'\',\''.$mjl->nilai.'\')"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" title="Lihat" class="btn btn-sm btn-success" onclick="lihat(\''.$mjl->tahun.'\',\''.$mjl->triwulan.'\',\''.$mjl->nilai.'\')"><i class="fa fa-eye "></i></a>';
                    
                })
                ->addIndexColumn()
                ->make(true);
    }

    public function simpanSurvey(Request $request){
        $nilai = str_replace('.','',$request->nilai);
        $data = [
            'tahun'     => $request->tahun,
            'triwulan'  => $request->triwulan,
            'nilai'     => str_replace(',','.',$nilai),
        ];

        $simpan = DB::table('master_survey')->insert($data);

        return redirect()->back()->with(['success'=>'Data Simpan']);
    }

    public function editSurvey(Request $request){
        $nilai = str_replace('.','',$request->nilai);
        $data = [
            'tahun'     => $request->tahun,
            'triwulan'  => $request->triwulan,
            'nilai'     => str_replace(',','.',$nilai),
        ];

        $simpan = DB::table('master_survey')->where('id', $request->id)->update($data);

        return redirect()->back()->with(['success'=>'Data Update']);
    }
}
