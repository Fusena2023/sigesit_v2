<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Session;
use File;

class BannerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:internal');
    }

    public function indexbanner()
    {
        $master_banner = DB::table('master_banner')->orderby('id', 'asc')->get();

        return view('admin.indexbanner', compact('master_banner'));
    }

    public function simpanbanner(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $this->validate($req, [
            'gambar' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if ($req->hasFile('gambar')) {
            $file = $req->file('gambar');
            $image = $file->getClientOriginalName();
            $destination = base_path() . '/public/upload/';
            $req->file('gambar')->move($destination, $image);
        }

        $data = [
            'judul'     => $req->judul,
            'deskripsi' => $req->deskripsi,
            'gambar'    => $image,
            'show'      => $req->status,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        try{
            $simpan = DB::table('master_banner')->insert($data);
            if($simpan > 0){
                return redirect()->back()->with(['success'=>'Simpan banner']);
            }else{
                return redirect()->back()->with(['error'=>'Simpan banner']);
            }
        }catch(Exception $e){
            return redirect()->back()->with(['error'=>'Simpan banner']);
        }

    }

    public function editbanner(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $this->validate($req, [
            'gambar_edit' => 'image|mimes:jpeg,png,jpg',
        ]);
        
        if ($req->hasFile('gambar_edit')) {
            $file = $req->file('gambar_edit');
            $image = $file->getClientOriginalName();
            $destination = base_path() . '/public/upload/';
            $req->file('gambar_edit')->move($destination, $image);
        }else{
            $image = $req->gambar_get;
        }
        // dd($req);
        $data = [
            'judul'     => $req->judul_edit,
            'deskripsi' => $req->deskripsi_edit,
            'gambar'    => $image,
            'show'      => $req->status_edit,
            'updated_at'=> date('Y-m-d H:i:s'),
        ];

        try{
            $simpan = DB::table('master_banner')->where('id',$req->id_edit)->update($data);
            if($simpan > 0){
                return redirect()->back()->with(['success'=>'Edit banner']);
            }else{
                return redirect()->back()->with(['error'=>'Edit banner']);
            }
        }catch(Exception $e){
            return redirect()->back()->with(['error'=>'Edit banner']);
        }

    }

    public function deletebanner(Request $req)
    {
        try{
            $id = DB::table('master_banner')->where('id', $req->id)->delete();
            if($id > 0){
                $image_path = public_path()."/upload/".$req->gambar_edit;
                \File::delete($image_path);
                return redirect()->back()->with(['success'=>'Delete banner']);
            }else{
                return redirect()->back()->with(['error'=>'Delete banner']);
            }
        }catch(Exception $e){
            return redirect()->back()->with(['error'=>'Delete banner']);
        }
    }

}
