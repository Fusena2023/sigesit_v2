<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Tiket;
use DB;
use Illuminate\Http\Request;
use App\TiketLayananJasa;
use App\TiketLayananProduk;
use App\TiketLayananDiklat;
use App\TiketLayananKunjunganUmum;

class HomeController extends Controller
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
	public function index()
	{
		return view('admin.index');
	}

	public function getdata1()
	{
		$count = Tiket::where('status', 2)->where('kategori', 'jasa')->count();

		$jenislayanan = 'Layanan Jasa';

		$color = 'blue';

		return view('admin.homeindexgetdata1', compact('count', 'jenislayanan', 'color'));
	}
	public function getdata2()
	{
		$count = Tiket::where('status', 2)
			->whereIn('tiket.kategori', array('pasut', 'produk'))->count();

		$jenislayanan = 'Layanan Berbayar';

		$color = 'orange';

		return view('admin.homeindexgetdata1', compact('count', 'jenislayanan', 'color'));
	}
	public function getdata3()
	{
		$count = Tiket::leftjoin('master_layanan_jasa', 'master_layanan_jasa.id', '=', 'tiket.id_master_layananjasa')
			->where('tiket.status', 2)
			->where('tiket.kategori', 'jasa')
			->whereIn('master_layanan_jasa.id', array(13, 14))->count();

		$jenislayanan = 'Layanan IG Nol Rupiah';

		$color = 'teal';

		return view('admin.homeindexgetdata1', compact('count', 'jenislayanan', 'color'));
	}
	// public function getdata4()
	// {
	// 	$count = TiketLayananKunjunganUmum::where('status', 2)->count();

	// 	$jenislayanan = 'Layanan Lain-Lain';

	// 	$color = 'red';

	//     return view('admin.homeindexgetdata1',compact('count','jenislayanan','color'));
	// }
	public function getdatagrafik()
	{
		$tahunini = date('Y');

		//jasa
		$jasajan = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '1' AND  kategori = 'jasa' "));
		foreach ($jasajan as $value) {
			$jumlahjasajan = $value->count;
		}
		$jasafeb = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '2' AND  kategori = 'jasa' "));
		foreach ($jasafeb as $value) {
			$jumlahjasafeb = $value->count;
		}
		$jasamar = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '3' AND  kategori = 'jasa' "));
		foreach ($jasamar as $value) {
			$jumlahjasamar = $value->count;
		}
		$jasaapr = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '4' AND  kategori = 'jasa' "));
		foreach ($jasaapr as $value) {
			$jumlahjasaapr = $value->count;
		}
		$jasamei = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '5' AND  kategori = 'jasa' "));
		foreach ($jasamei as $value) {
			$jumlahjasamei = $value->count;
		}
		$jasajun = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '6' AND  kategori = 'jasa' "));
		foreach ($jasajun as $value) {
			$jumlahjasajun = $value->count;
		}
		$jasajul = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '7' AND  kategori = 'jasa' "));
		foreach ($jasajul as $value) {
			$jumlahjasajul = $value->count;
		}
		$jasaags = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '8' AND  kategori = 'jasa' "));
		foreach ($jasaags as $value) {
			$jumlahjasaags = $value->count;
		}
		$jasasep = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '9' AND  kategori = 'jasa' "));
		foreach ($jasasep as $value) {
			$jumlahjasasep = $value->count;
		}
		$jasaokt = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '10' AND  kategori = 'jasa' "));
		foreach ($jasaokt as $value) {
			$jumlahjasaokt = $value->count;
		}
		$jasanov = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '11' AND  kategori = 'jasa' "));
		foreach ($jasanov as $value) {
			$jumlahjasanov = $value->count;
		}
		$jasades = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('m', created_at) = '12' AND  kategori = 'jasa' "));
		foreach ($jasades as $value) {
			$jumlahjasades = $value->count;
		}

		//berbayar
		$prodjan = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '1'  AND  kategori IN ('pasut', 'produk')"));
		foreach ($prodjan as $value) {
			$jumlahprodjan = $value->count;
		}
		$prodfeb = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '2'  AND  kategori IN ('pasut', 'produk')"));
		foreach ($prodfeb as $value) {
			$jumlahprodfeb = $value->count;
		}
		$prodmar = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '3'  AND  kategori IN ('pasut', 'produk')"));
		foreach ($prodmar as $value) {
			$jumlahprodmar = $value->count;
		}
		$prodapr = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '4'  AND  kategori IN ('pasut', 'produk')"));
		foreach ($prodapr as $value) {
			$jumlahprodapr = $value->count;
		}
		$prodmei = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '5'  AND  kategori IN ('pasut', 'produk')"));
		foreach ($prodmei as $value) {
			$jumlahprodmei = $value->count;
		}
		$prodjun = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '6'  AND  kategori IN ('pasut', 'produk')"));
		foreach ($prodjun as $value) {
			$jumlahprodjun = $value->count;
		}
		$prodjul = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '7'  AND  kategori IN ('pasut', 'produk')"));
		foreach ($prodjul as $value) {
			$jumlahprodjul = $value->count;
		}
		$prodags = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '8'  AND  kategori IN ('pasut', 'produk')"));
		foreach ($prodags as $value) {
			$jumlahprodags = $value->count;
		}
		$prodsep = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '9'  AND  kategori IN ('pasut', 'produk')"));
		foreach ($prodsep as $value) {
			$jumlahprodsep = $value->count;
		}
		$prodokt = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '10' AND  kategori IN ('pasut', 'produk') "));
		foreach ($prodokt as $value) {
			$jumlahprodokt = $value->count;
		}
		$prodnov = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '11' AND  kategori IN ('pasut', 'produk') "));
		foreach ($prodnov as $value) {
			$jumlahprodnov = $value->count;
		}
		$proddes = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '12' AND  kategori IN ('pasut', 'produk') "));
		foreach ($proddes as $value) {
			$jumlahproddes = $value->count;
		}


		//diklat
		$dikjan = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '1' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($dikjan as $value) {
			$jumlahdikjan = $value->count;
		}
		$dikfeb = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '2' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($dikfeb as $value) {
			$jumlahdikfeb = $value->count;
		}
		$dikmar = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '3' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($dikmar as $value) {
			$jumlahdikmar = $value->count;
		}
		$dikapr = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '4' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($dikapr as $value) {
			$jumlahdikapr = $value->count;
		}
		$dikmei = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '5' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($dikmei as $value) {
			$jumlahdikmei = $value->count;
		}
		$dikjun = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '6' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($dikjun as $value) {
			$jumlahdikjun = $value->count;
		}
		$dikjul = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '7' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($dikjul as $value) {
			$jumlahdikjul = $value->count;
		}
		$dikags = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '8' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($dikags as $value) {
			$jumlahdikags = $value->count;
		}
		$diksep = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '9' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($diksep as $value) {
			$jumlahdiksep = $value->count;
		}
		$dikokt = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '10' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($dikokt as $value) {
			$jumlahdikokt = $value->count;
		}
		$diknov = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '11' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($diknov as $value) {
			$jumlahdiknov = $value->count;
		}
		$dikdes = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = '12' AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14)"));
		foreach ($dikdes as $value) {
			$jumlahdikdes = $value->count;
		}

		return view('admin.homeindexgetdatagrafik', compact('jumlahjasades', 'jumlahjasanov', 'jumlahjasaokt', 'jumlahjasasep', 'jumlahjasaags', 'jumlahjasajul', 'jumlahjasajun', 'jumlahjasamei', 'jumlahjasaapr', 'jumlahjasamar', 'jumlahjasafeb', 'jumlahjasajan', 'jumlahproddes', 'jumlahprodnov', 'jumlahprodokt', 'jumlahprodsep', 'jumlahprodags', 'jumlahprodjul', 'jumlahprodjun', 'jumlahprodmei', 'jumlahprodapr', 'jumlahprodmar', 'jumlahprodfeb', 'jumlahprodjan', 'jumlahdikdes', 'jumlahdiknov', 'jumlahdikokt', 'jumlahdiksep', 'jumlahdikags', 'jumlahdikjul', 'jumlahdikjun', 'jumlahdikmei', 'jumlahdikapr', 'jumlahdikmar', 'jumlahdikfeb', 'jumlahdikjan'));
	}


	public function getdatabaru()
	{
		$tahunini = date('Y');

		$bulanini = date('m');


		//jasa
		$jasabulan = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = " . $bulanini . "  AND  kategori = 'jasa'"));
		foreach ($jasabulan as $value) {
			$jumlahjasabulan = $value->count;
		}
		//produk
		$prodbulan = DB::select(DB::raw("SELECT COUNT(*) FROM tiket WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = " . $bulanini . " AND  kategori IN ('pasut', 'produk')"));
		foreach ($prodbulan as $value) {
			$jumlahprodbulan = $value->count;
		}
		//diklat
		$dikbulan = DB::select(DB::raw("SELECT COUNT(*) FROM tiket LEFT JOIN master_layanan_jasa	ON tiket.id_master_layananjasa = master_layanan_jasa.id WHERE date_part('year', created_at) = " . $tahunini . " AND date_part('month', created_at) = " . $bulanini . " AND  tiket.kategori = 'jasa' AND master_layanan_jasa.id IN (13, 14) "));
		foreach ($dikbulan as $value) {
			$jumlahdikbulan = $value->count;
		}
		//kunjungan umum
		// $kunjbulan = DB::select(DB::raw("SELECT COUNT(*) FROM tiket_layanan_kunjungan_umum WHERE date_part('year', created_at) = ". $tahunini ." AND date_part('month', created_at) = ". $bulanini ." "));
		// foreach ($kunjbulan as $value) {
		// 	$jumlahkunjbulan = $value->count;
		// }

		return view('admin.homeindexgetdatabaru', compact('jumlahjasabulan', 'jumlahprodbulan', 'jumlahdikbulan'));
	}
}
