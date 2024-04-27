<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/error-session', 'Controller@error_session')->name('error_session');

Route::get('/cetak', 'HomeController@cetak_pdf');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home/faq', 'HomeController@indexfaq')->name('homefaq');
Route::post('/home/faq-filter', 'HomeController@FilterFaq')->name('homefaqfilter');
Route::get('/home/getSurvey', 'HomeController@getSurvey')->name('getSurvey');
Route::get('/home/getSurvey/pusat', 'HomeController@getSurveyPerpusat')->name('getSurveyPerpusat');
Route::get('/home/getSurvey/komppnen', 'HomeController@getSurveyKomponen')->name('getSurveyKomponen');
Route::get('/home/getResponden/{param}', 'HomeController@getResponden')->name('getResponden');
Route::post('send-email-forgot-password', 'HomeController@sendEmailforgotPassword')->name('pengguna.sendEmailforgotPassword');
Route::get('/lupa-password/{id_user}', 'HomeController@LupaPasswordApi')->name('pengguna.LupaPasswordApi');
Route::post('update-password', 'HomeController@updatePassword')->name('pengguna.updatePassword');

//Standart pelayanan

Route::get('/standart-pelayanan', 'HomeController@indexstandartpelayanan')->name('standartpelayanan');


Route::get('/home/profile', 'HomeController@index_profile')->name('index_profile');

//pengaduan
Route::get('/home/pengaduan', 'HomeController@indexpengaduan')->name('home_pengaduan');
Route::post('/home/save-pengaduan', 'HomeController@save_pengaduan')->name('save_pengaduan');

Auth::routes();

Route::get('login-internal', 'AuthInternal\InternalLoginController@login')->name('internal.auth.login');
Route::post('login-internal', 'AuthInternal\InternalLoginController@logininternal')->name('internal.auth.logininternal');
Route::post('logout-internal', 'AuthInternal\InternalLoginController@logout')->name('internal.auth.logout');

Route::get('login', 'AuthPengguna\PenggunaLoginController@login')->name('login');
Route::post('loginpengguna', 'AuthPengguna\PenggunaLoginController@loginpengguna')->name('pengguna.auth.loginpengguna');
Route::post('logout', 'AuthPengguna\PenggunaLoginController@logout')->name('pengguna.auth.logout');

//Register
Route::post('/register', 'Auth\RegisterController@store')->name('register.pengguna');
Route::post('/registerinstansi', 'Auth\RegisterController@storeinstansi')->name('register.penggunainstansi');

//Admin
Route::get('/admin/home', 'Admin\HomeController@index')->name('admin.home');
Route::get('/admin/home/getdata1', 'Admin\HomeController@getdata1')->name('admin.getdata1');
Route::get('/admin/home/getdata2', 'Admin\HomeController@getdata2')->name('admin.getdata2');
Route::get('/admin/home/getdata3', 'Admin\HomeController@getdata3')->name('admin.getdata3');
Route::get('/admin/home/getdata4', 'Admin\HomeController@getdata4')->name('admin.getdata4');
Route::get('/admin/home/getdatagrafik', 'Admin\HomeController@getdatagrafik')->name('admin.getdatagrafik');
Route::get('/admin/home/getdatabaru', 'Admin\HomeController@getdatabaru')->name('admin.getdatabaru');

Route::get('/admin/masterjenislayanan', 'Admin\MasterController@indexjenislayanan')->name('admin.jenislayanan');
Route::get('/getdatajenislayanan', 'Admin\MasterController@getdatajenislayanan')->name('admin.datatables.getdatajenislayanan');
Route::post('admin/simpanjenislayanan', 'Admin\MasterController@simpanjenislayanan')->name('admin.simpanjenislayanan');
Route::post('admin/editjenislayanan', 'Admin\MasterController@editjenislayanan')->name('admin.editjenislayanan');
Route::post('admin/showjenislayanan', 'Admin\MasterController@showjenislayanan')->name('admin.showjenislayanan');

Route::get('/admin/masterfaq', 'Admin\MasterController@indexfaq')->name('admin.faq');
Route::get('/getdatafaq', 'Admin\MasterController@getdatafaq')->name('admin.datatables.getdatafaq');
Route::post('admin/simpanfaq', 'Admin\MasterController@simpanfaq')->name('admin.simpanfaq');
Route::post('admin/editfaq', 'Admin\MasterController@editfaq')->name('admin.editfaq');
Route::post('admin/showfaq', 'Admin\MasterController@showfaq')->name('admin.showfaq');

Route::get('/admin/mastertentang', 'Admin\MasterController@indextentang')->name('admin.tentang');
Route::get('/getdatatentang', 'Admin\MasterController@getdatatentang')->name('admin.datatables.getdatatentang');
Route::post('admin/edittentang', 'Admin\MasterController@edittentang')->name('admin.edittentang');
Route::post('admin/showtentang', 'Admin\MasterController@showtentang')->name('admin.showtentang');

Route::get('/admin/masterlokasi', 'Admin\MasterController@indexlokasi')->name('admin.lokasi');
Route::get('/getdatalokasi', 'Admin\MasterController@getdatalokasi')->name('admin.datatables.getdatalokasi');
Route::post('admin/editlokasi', 'Admin\MasterController@editlokasi')->name('admin.editlokasi');
Route::post('admin/showlokasi', 'Admin\MasterController@showlokasi')->name('admin.showlokasi');

Route::get('/admin/masterberita', 'Admin\MasterController@indexberita')->name('admin.berita');
Route::get('/getdataberita', 'Admin\MasterController@getdataberita')->name('admin.datatables.getdataberita');
Route::post('admin/simpanberita', 'Admin\MasterController@simpanberita')->name('admin.simpanberita');
Route::post('admin/editberita', 'Admin\MasterController@editberita')->name('admin.editberita');
Route::post('admin/showberita', 'Admin\MasterController@showberita')->name('admin.showberita');
Route::post('admin/hapusberita', 'Admin\MasterController@hapusberita')->name('admin.hapusberita');

Route::get('/admin/masterlayanandigital', 'Admin\MasterController@indexlayanandigital')->name('admin.layanandigital');
Route::get('/getdatalayanandigital', 'Admin\MasterController@getdatalayanandigital')->name('admin.datatables.getdatalayanandigital');
Route::post('admin/simpanlayanandigital', 'Admin\MasterController@simpanlayanandigital')->name('admin.simpanlayanandigital');
Route::post('admin/editlayanandigital', 'Admin\MasterController@editlayanandigital')->name('admin.editlayanandigital');
Route::post('admin/showlayanandigital', 'Admin\MasterController@showlayanandigital')->name('admin.showlayanandigital');

Route::get('/admin/masterpusat', 'Admin\MasterController@indexpusat')->name('admin.pusat');
Route::get('/getdatapusat', 'Admin\MasterController@getdatapusat')->name('admin.datatables.getdatapusat');
Route::post('admin/simpanpusat', 'Admin\MasterController@simpanpusat')->name('admin.simpanpusat');
Route::post('admin/editpusat', 'Admin\MasterController@editpusat')->name('admin.editpusat');
Route::post('admin/showpusat', 'Admin\MasterController@showpusat')->name('admin.showpusat');

//master informasi popup

Route::get('/admin/informasi', 'Admin\MasterController@indexinformasi')->name('admin.informasi');
Route::get('/getdatainformasi', 'Admin\MasterController@getdatainformasi')->name('admin.datatables.informasi');
Route::post('admin/simpaninformasi', 'Admin\MasterController@simpaninformasi')->name('admin.simpaninformasi');
Route::post('admin/editinformasi', 'Admin\MasterController@editinformasi')->name('admin.editinformasi');
Route::post('admin/showinformasi', 'Admin\MasterController@showinformasi')->name('admin.showinformasi');

//master pertanyaan
Route::get('/admin/master-pertanyaan', 'Admin\MasterController@indexpertanyaan')->name('admin.pertanyaan');
Route::get('/admin/master-pertanyaan/get-data', 'Admin\MasterController@getPertanyaan')->name('admin.datatables.getPertanyaan');
Route::post('/admin/master-pertanyaan/simpan', 'Admin\MasterController@simpanpertanyaan')->name('admin.simpanpertanyaan');
Route::post('/admin/master-pertanyaan/edit', 'Admin\MasterController@editpertanyaan')->name('admin.editpertanyaan');
Route::post('/admin/master-pertanyaan/delete', 'Admin\MasterController@deletedpertanyaan')->name('admin.deletedpertanyaan');

Route::get('/admin/katlayananjasa', 'Admin\KategoriLayananController@indexkatlayananjasa')->name('admin.katlayananjasa');
Route::get('/getdatakatlayananjasa', 'Admin\KategoriLayananController@getdatakatlayananjasa')->name('admin.datatables.getdatakatlayananjasa');
Route::post('admin/simpankatlayananjasa', 'Admin\KategoriLayananController@simpankatlayananjasa')->name('admin.simpankatlayananjasa');
Route::post('admin/editkatlayananjasa', 'Admin\KategoriLayananController@editkatlayananjasa')->name('admin.editkatlayananjasa');
Route::post('admin/showkatlayananjasa', 'Admin\KategoriLayananController@showkatlayananjasa')->name('admin.showkatlayananjasa');

//master layanan nol rupiah

Route::get('/admin/nolrupiah', 'Admin\KategoriLayananController@indexnolrupiah')->name('admin.nolrupiah');
Route::get('/getdatanolrupiah', 'Admin\KategoriLayananController@getdatanolrupiah')->name('admin.datatables.getdatanolrupiah');
Route::post('admin/simpannolrupiah', 'Admin\KategoriLayananController@simpannolrupiah')->name('admin.simpannolrupiah');
Route::post('admin/editnolrupiah', 'Admin\KategoriLayananController@editnolrupiah')->name('admin.editnolrupiah');
Route::post('admin/shownolrupiah', 'Admin\KategoriLayananController@shownolrupiah')->name('admin.shownolrupiah');

Route::get('/admin/katlayanandiklat', 'Admin\KategoriLayananController@indexkatlayanandiklat')->name('admin.katlayanandiklat');
Route::get('/getdatakatlayanandiklat', 'Admin\KategoriLayananController@getdatakatlayanandiklat')->name('admin.datatables.getdatakatlayanandiklat');
Route::post('admin/simpankatlayanandiklat', 'Admin\KategoriLayananController@simpankatlayanandiklat')->name('admin.simpankatlayanandiklat');
Route::post('admin/editkatlayanandiklat', 'Admin\KategoriLayananController@editkatlayanandiklat')->name('admin.editkatlayanandiklat');

Route::get('/admin/tiket-layanan', 'Admin\AdminTiketController@indextiketlayananjasa')->name('admin.tiketlayananjasa');
Route::get('/admin/get-data-all-tiket', 'Admin\AdminTiketController@getdataalltiket')->name('admin.getdataalltiket');
Route::get('/admin/get-data-tiket-layanan-jasa', 'Admin\AdminTiketController@getdatatiketlayananjasa')->name('admin.datatables.getdatatiketlayananjasa');
Route::post('admin/tutup-tiket-layanan', 'Admin\AdminTiketController@tutuptiketlayananjasa')->name('admin.tutuptiketlayananjasa');
Route::post('admin/update-status/jasa-layanan-nol', 'Admin\AdminTiketController@UpdatePenolakanJasaNol')->name('admin.update_status.layanan_jasa_nol');

Route::get('/admin/tiketlayananjasa/all', 'Admin\AdminTiketController@getdataalltiket')->name('admin.getdataalltiket');

Route::post('/tiket-admin-export/xls/cetak', 'Admin\AdminTiketController@cetak_export')->name('admin.export.tiket');

Route::get('/admin/pengaduan', 'Admin\AdminTiketController@index_pengaduan')->name('admin.pengaduan');
Route::get('/admingetdatapengaduan', 'Admin\AdminTiketController@getdatatiketlayananjasa')->name('admin.datatables.getdatapengaduan');
Route::post('admin/tanggapipengaduan', 'Admin\AdminTiketController@tanggapi_pengaduan')->name('admin.update_pengaduan');

Route::get('/admin/tiketlayananproduk', 'Admin\AdminTiketController@indextiketlayananproduk')->name('admin.tiketlayananproduk');
Route::get('/admingetdatatiketlayananproduk', 'Admin\AdminTiketController@getdatatiketlayananproduk')->name('admin.datatables.getdatatiketlayananproduk');
Route::post('admin/update-status/produk', 'Admin\AdminTiketController@UpdatePenolakan')->name('admin.update_status.layanan_produk');


Route::get('/admin/tiketlayananpasut', 'Admin\AdminTiketController@indextiketlayananpasut')->name('admin.tiketlayananpasut');
Route::get('/admingetdatatiketlayananpasut', 'Admin\AdminTiketController@getdatatiketlayananpasut')->name('admin.datatables.getdatatiketlayananpasut');
Route::post('admin/update-status/pasut', 'Admin\AdminTiketController@UpdatePenolakanPasut')->name('admin.update_status.layanan_pasut');
Route::get('/admin/tiket-pasang-surut/get-detail-pasut/{id}', 'Admin\AdminTiketController@GetdetailPasut')->name('pengguna.getdata.detail_pasut');

//kas negara

Route::get('/admin/tiket-layanan-kas-negara', 'Admin\AdminTiketController@indexkasnegara')->name('admin.tiketlayanankasnegara');
Route::get('/admingetdatatiketlayanankasnegara', 'Admin\AdminTiketController@getdatatiketlayanankasnegara')->name('admin.datatables.getdatatiketlayanankasnegara');
Route::get('/admin/getdata/kode-akun/{id}', 'Admin\AdminTiketController@GetKodeAkun')->name('admin.kas_negara.get_kode_akun');
Route::post('/admin-simpan-layanan-kas', 'Admin\AdminTiketController@SimpanTiketKas')->name('admin.simpan.layanan_kas');
Route::post('/admin-edit-layanan-kas', 'Admin\AdminTiketController@edit_kasnegara')->name('admin.edit.layanan_kas');
Route::post('admin/showkasnegara', 'Admin\MasterController@showkasnegara')->name('admin.showkasnegara');

Route::get('/admin/tiketlayanandiklat', 'Admin\AdminTiketController@indextiketlayanandiklat')->name('admin.tiketlayanandiklat');
Route::get('/admingetdatatiketlayanandiklat', 'Admin\AdminTiketController@getdatatiketlayanandiklat')->name('admin.datatables.getdatatiketlayanandiklat');
Route::get('/admin/get-detail-diklat/{id}', 'Admin\AdminTiketController@GetDetailDiklat')->name('admin.get.detail.diklat');
Route::post('admin/tutuptiketlayanandiklat', 'Admin\AdminTiketController@tutuptiketlayanandiklat')->name('admin.tutuptiketlayanandiklat');
Route::post('admin/simpan-layanan-diklat', 'Admin\AdminTiketController@SimpanLayananDiklat')->name('admin.simpan.layanan_diklat');

//diklat admin

Route::get('/admin/tiketlayanandiklat/admin', 'Admin\AdminTiketController@indextiketlayanandiklatAdmin')->name('admin.tiketlayanandiklat.admin');
Route::get('/admingetdatatiketlayanandiklat/admin', 'Admin\AdminTiketController@getdatatiketlayanandiklatAdmin')->name('admin.datatables.getdatatiketlayanandiklat.admin');

Route::get('/admin/tiketlayananmes', 'Admin\AdminTiketController@indextiketlayananmes')->name('admin.tiketlayananmes');
Route::get('/admin/getdatatiketlayananmes', 'Admin\AdminTiketController@getdatatiketlayananmes')->name('admin.datatables.getdatatiketlayananmes');
Route::get('/admin/get-detail-mes/{id}', 'Admin\AdminTiketController@GetDetailMes')->name('admin.get.detail.mes');
Route::post('admin/simpan-layanan-mes', 'Admin\AdminTiketController@SimpanLayananMes')->name('admin.simpan.mes');

Route::get('/admin/tiketlayanankunjunganumum', 'Admin\AdminTiketController@indextiketlayanankunjunganumum')->name('admin.tiketlayanankunjunganumum');
Route::get('/admingetdatatiketlayanankunjunganumum', 'Admin\AdminTiketController@getdatatiketlayanankunjunganumum')->name('admin.datatables.getdatatiketlayanankunjunganumum');
Route::get('/admindetailkunjunganumumget/{id}', 'Admin\AdminTiketController@detailkunjunganumumget')->name('admin.detailkunjunganumumget');
Route::post('admin/tutuptiketlayanankunjunganumum', 'Admin\AdminTiketController@tutuptiketlayanankunjunganumum')->name('admin.tutuptiketlayanankunjunganumum');

//pesan
Route::get('admin/tiket/pesan/{tiket}/{id}', 'Admin\AdminTiketController@indexpesan')->name('admin.tiket.pesan');
Route::get('admin/tiket/kirim/{param}', 'Admin\AdminTiketController@kirimpesandefault')->name('admin.tiket.kirim.pesan');
Route::get('admin/tiket/kirimbaru/{param}', 'Admin\AdminTiketController@kirimpesanbaru')->name('admin.tiket.kirim.pesanbaru');


Route::get('/admin/pesanxtiket', 'Admin\AdminTiketController@indexpesanxtiket')->name('admin.pesanxtiket');
Route::get('/admingetdatapesanxtiket', 'Admin\AdminTiketController@getdatapesanxtiket')->name('admin.datatables.getdatapesanxtiket');
Route::post('admin/tutuppesanxtiket', 'Admin\AdminTiketController@tutuppesanxtiket')->name('admin.tutuppesanxtiket');

//user pengguna
Route::get('/admin/user-pengguna', 'Admin\UserPenggunaController@indexuserpengguna')->name('admin.userpengguna');
Route::get('/getdatausers', 'Admin\UserPenggunaController@getdatauserspengguna')->name('admin.datatables.getdatauserspengguna');
Route::post('admin/edit-user', 'Admin\UserPenggunaController@edituserspengguna')->name('admin.edituserspengguna');
Route::post('admin/delete-user', 'Admin\UserPenggunaController@deleteuserspengguna')->name('admin.deleteuserspengguna');
Route::post('admin/simpan-user', 'Admin\UserPenggunaController@simpanuserspengguna')->name('admin.simpanuserspengguna');
Route::post('admin/exportexcel', 'Admin\UserPenggunaController@exportexcel')->name('admin.exportexcel');
Route::get('admin/validasi-email/{email}', 'Admin\UserPenggunaController@validasi_email')->name('admin.validasi.email');

//banner
Route::get('/admin/banner', 'Admin\BannerController@indexbanner')->name('admin.banner');
Route::post('admin/simpan-banner', 'Admin\BannerController@simpanbanner')->name('admin.simpanbanner');
Route::post('admin/edit-banner', 'Admin\BannerController@editbanner')->name('admin.editbanner');
Route::post('admin/delete-banner', 'Admin\BannerController@deletebanner')->name('admin.deletebanner');

//kepuasan
Route::post('/pengguna/kepuasan', 'KepuasanController@getTiket')->name('pengguna.kepuasan');
Route::post('/insert/kepuasan', 'KepuasanController@storekepuasan');
Route::post('/kepuasan/count', 'HomeController@getNilaiKepuasan');

//kuesioner pengguna
// Route::get('/kuesioner/{layanan}/{id_tiket}','KuesionerPenggunaController@index')->name('pengguna.kuesioner.index');
Route::post('/kuesioner', 'KuesionerPenggunaController@index')->name('pengguna.kuesioner.index');
Route::post('/kuesioner/submit', 'KuesionerPenggunaController@submit')->name('pengguna.kuesioner.submit');
Route::post('/kuesioner/update', 'TiketController@updatestatuskuesioner')->name('pengguna.updatestatuskuesioner');

//kuesioner
Route::get('/admin/kuesioner-admin', 'Admin\KuesionerController@index')->name('admin.kuesioner');
Route::get('/kuesioner-admin-tiket', 'Admin\KuesionerController@indexpertiket')->name('admin.kuesionerTiket');
Route::get('/kuesioner-admin-tiket/get-data/{user_tiket}', 'Admin\KuesionerController@getDataViewKuesioner')->name('admin.getDataViewKuesioner');
Route::get('/kuesioner-admin-export/xls', 'Admin\KuesionerController@index_export')->name('admin.exportKuesioner');
Route::post('/kuesioner-admin-export/xls/cetak', 'Admin\KuesionerController@cetak_export')->name('admin.exportexcel.kuesioner');

//rekap belum kuisioner
Route::get('/admin/rekap-belum-kusioner', 'Admin\AdminTiketController@IndexBelumKuisioner')->name('admin.index.belum.kuisoner');
Route::get('/admin/get-rekap-belum-kusioner', 'Admin\AdminTiketController@GetBelomKuisioner')->name('admin.datatables.get.belom.kuisioner');
Route::post('/admin/kirim-email-kuesioner', 'Admin\AdminTiketController@KirimEmail')->name('admin.kirim.email.blm.kuisioner');

//index survey
Route::get('/admin/survey-admin', 'Admin\SurveyController@index')->name('admin.admin.survey');
Route::post('/survey-admin/simpan', 'Admin\SurveyController@simpanSurvey')->name('admin.simpansurvey');
Route::get('/survey-admin/get-data', 'Admin\SurveyController@getdatasurvey')->name('admin.datatables.getdatasurvey');
Route::post('/survey-admin/edit', 'Admin\SurveyController@editSurvey')->name('admin.editsurvey');

//Tiket
Route::get('/tiket', 'TiketController@indextiket')->name('pengguna.tiket');
Route::get('/getdatatiketlayananjasa', 'TiketController@getdatatiketlayananjasa')->name('pengguna.datatables.getdatatiketlayananjasa');
Route::get('/getdatatiketlayananproduk', 'TiketController@getdatatiketlayananproduk')->name('pengguna.datatables.getdatatiketlayananproduk');
Route::get('/getdatatiketlayananpasut', 'TiketController@getdatatiketlayananpasut')->name('pengguna.datatables.getdatatiketlayananpasut');
Route::get('/getdatatiketlayanandiklat', 'TiketController@getdatatiketlayanandiklat')->name('pengguna.datatables.getdatatiketlayanandiklat');
Route::get('/getdatatiketlayanankunjunganumum', 'TiketController@getdatatiketlayanankunjunganumum')->name('pengguna.datatables.getdatatiketlayanankunjunganumum');
Route::get('/getdatatiket', 'TiketController@getdatatiket')->name('pengguna.datatables.getdatatiket');
Route::get('/getDatatiketall', 'TiketController@getDatatiketall')->name('pengguna.datatables.getDatatiketall');
Route::get('/getDatatiketkategori/filter/{kat}', 'TiketController@getDatatiketkategori')->name('pengguna.datatables.getDatatiketkategori');

Route::get('/getmastertiketlayanan/jasa/', 'TiketController@getmastertiketlayananjasa')->name('pengguna.getmastertiketlayananjasa');
Route::get('/getmastertiketlayanan/kunjungan-umum/', 'TiketController@getmastertiketlayanankunjunganumum')->name('pengguna.getmastertiketlayanankunjunganumum');

Route::get('/tiket/pesan/{tiket}/{id}', 'TiketController@indexpesan')->name('pengguna.tiket.pesan');
Route::get('/tiket/kirim/{param}', 'TiketController@kirimpesandefault')->name('pengguna.tiket.kirim.pesan');
Route::get('/tiket/kirimbaru/{param}', 'TiketController@kirimpesanbaru')->name('pengguna.tiket.kirim.pesanbaru');

//Buat Tiket Layanan Jasa
Route::get('/tiketlayananjasa/{id}', 'TiketController@indextiketlayananjasa')->name('pengguna.tiketlayananjasa');
Route::post('/simpantiketlayananjasa', 'TiketController@simpantiketlayananjasa')->name('pengguna.simpantiketlayananjasa');
Route::get('/detailtiketlayananjasa/{id}', 'TiketController@detailtiketlayananjasa')->name('pengguna.detailtiketlayananjasa');

//Buat Tiket Layanan Produk
Route::get('/tiketlayananproduk/{id}', 'TiketController@indextiketlayananproduk')->name('pengguna.tiketlayananproduk');
Route::post('/simpantiketlayananproduk', 'TiketController@simpantiketlayananproduk')->name('pengguna.simpantiketlayananproduk');
Route::post('/tiketlayananproduk/fetch-data-katalog', 'TiketController@fetch_data_katalog')->name('pengguna.tiketlayananproduk.fetch_data_katalog');
Route::get('/tiketlayananproduk/fetch-data-katalog/filter', 'TiketController@fetch_data_buku')->name('pengguna.tiketlayananproduk.fetch_data_katalog.get');
Route::get('/tiketlayananproduk/fetch-data/{no}/{tgl}/{nama}', 'TiketController@getKeranjangKatalog');

//tiket pasang surut
Route::get('/tiket-pasang-surut', 'TiketController@IndexPasangSurut')->name('pengguna.index.pasang_surut');
Route::get('/get-data-pasut', 'TiketController@GetDataPasangSurut')->name('datatables.get.pasut');
Route::get('/tiket-pasang-surut/get-data-stasiun/{id}', 'TiketController@GetDataStasiun')->name('pengguna.getdata.stasiun');
Route::get('/tiket-pasang-surut/get-harga/{id}', 'TiketController@GethargaStasiun')->name('pengguna.getdata.harga');
Route::post('/simpan-pasang-surut', 'TiketController@SimpanPasangSurut')->name('pengguna.simpan.pasang_surut');
Route::get('/tiket-pasang-surut/get-detail-pasut/{id}', 'TiketController@GetdetailPasut')->name('pengguna.getdata.detail_pasut');

//kerja sama

Route::get('/tiket-kerja-sama', 'TiketController@IndexKerjaSama')->name('pengguna.index.kerja_sama');
// Route::get('/get-data-pasut', 'TiketController@GetDataKerjaSama')->name('datatables.get.kerja_sama');
Route::post('/simpan-kerja-sama', 'TiketController@SimpanKerjaSama')->name('pengguna.simpan.kerja_sama');

//Buat Tiket Layanan Diklat
Route::get('/tiketlayanandiklat', 'TiketController@indextiketlayanandiklat')->name('pengguna.tiketlayanandiklat');
Route::post('/simpantiketlayanandiklat', 'TiketController@simpantiketlayanandiklat')->name('pengguna.simpantiketlayanandiklat');

//Buat Tiket Layanan Diklat
Route::get('/tiketlayanankunjunganumum', 'TiketController@indextiketlayanankunjunganumum')->name('pengguna.tiketlayanankunjunganumum');
Route::post('/simpantiketlayanankunjunganumum', 'TiketController@simpantiketlayanankunjunganumum')->name('pengguna.simpantiketlayanankunjunganumum');
Route::get('/detailtiketlayanankunjunganumum/{id}', 'TiketController@detailtiketlayanankunjunganumum')->name('pengguna.detailtiketlayanankunjunganumum');

//Pesan Tanpa Tiket
Route::get('/pesan-baru', 'PesanxTiketController@index')->name('pengguna.pesan.baru');
Route::get('/getdatapesanxtiket', 'PesanxTiketController@getdatapesanxtiket')->name('pengguna.datatables.getdatapesanxtiket');
Route::get('/pesanxtiketadd', 'PesanxTiketController@indexpesanxtiketadd')->name('pengguna.pesanxtiket.add');
Route::post('/simpanpesanxtiket', 'PesanxTiketController@simpanpesanxtiket')->name('pengguna.simpanpesanxtiket');

//master Layanan ke kas negara
Route::get('/admin/master-layanan', 'Admin\MasterController@index_kasnegara')->name('admin.master.index_kasnegara');
Route::post('/master-layanan/simpan', 'Admin\MasterController@simpan_kasnegara')->name('admin.master.simpan_kasnegara');
Route::get('/master-layanan/get-data', 'Admin\MasterController@get_kasnegara')->name('admin.master.get_kasnegara');
Route::post('/master-layanan/edit', 'Admin\MasterController@edit_kasnegara')->name('admin.master.edit_kasnegara');
Route::get('/master-layanan/delete', 'Admin\MasterController@delete_kasnegara')->name('admin.master.delete_kasnegara');

//master stasiun

Route::get('/admin/master-stasiun', 'Admin\MasterController@indexStasiun')->name('admin.stasiun');
Route::get('/get-data-stasiun', 'Admin\MasterController@getdataStasiun')->name('admin.datatables.getdata.stasiun');
Route::post('admin/simpan-stasiun', 'Admin\MasterController@simpanStasiun')->name('admin.simpan.stasiun');
Route::post('admin/edit-stasiun', 'Admin\MasterController@editStasiun')->name('admin.edit.stasiun');
Route::post('admin/hapus-stasiun', 'Admin\MasterController@hapusStasiun')->name('admin.hapus.stasiun');
Route::post('admin/show-hide-statusiun', 'Admin\MasterController@updateStatus')->name('admin.update_status.stasiun');
//master produk

Route::get('/admin/master-produk', 'Admin\MasterController@indexproduk')->name('admin.produk');
Route::get('/get-data-produk', 'Admin\MasterController@getdataproduk')->name('admin.datatables.getdata.produk');
Route::post('admin/simpan-produk', 'Admin\MasterController@simpanproduk')->name('admin.simpan.produk');
Route::post('admin/edit-produk', 'Admin\MasterController@editproduk')->name('admin.edit.produk');
Route::post('admin/hapus-produk', 'Admin\MasterController@hapusproduk')->name('admin.hapus.produk');
Route::get('admin/export-excel-produk', 'Admin\MasterController@ExportExcelProduk')->name('admin.export_produk');
Route::post('admin/show-hide-produk', 'Admin\MasterController@updateStatusProduk')->name('admin.update_status.produk');
//master subproduk

Route::get('/admin/master-subproduk', 'Admin\MasterController@indexsubproduk')->name('admin.subproduk');
Route::get('/get-data-subproduk', 'Admin\MasterController@getdatasubproduk')->name('admin.datatables.getdata.subproduk');
Route::post('admin/simpan-subproduk', 'Admin\MasterController@simpansubproduk')->name('admin.simpan.subproduk');
Route::post('admin/edit-subproduk', 'Admin\MasterController@editsubproduk')->name('admin.edit.subproduk');
Route::post('admin/hapus-subproduk', 'Admin\MasterController@hapussubproduk')->name('admin.hapus.subproduk');
Route::post('admin/show-hide-subproduk', 'Admin\MasterController@updateStatussubproduk')->name('admin.update_status.subproduk');

//master hasil survey

Route::get('/admin/master-hasilsurvey', 'Admin\MasterController@indexhasilsurvey')->name('admin.hasilsurvey');
Route::get('/get-data-hasilsurvey', 'Admin\MasterController@getdatahasilsurvey')->name('admin.datatables.getdata.hasilsurvey');
Route::post('admin/simpan-hasilsurvey', 'Admin\MasterController@simpanhasilsurvey')->name('admin.simpan.hasilsurvey');
Route::post('admin/edit-hasilsurvey', 'Admin\MasterController@edithasilsurvey')->name('admin.edit.hasilsurvey');
Route::post('admin/hapus-hasilsurvey', 'Admin\MasterController@hapushasilsurvey')->name('admin.hapus.hasilsurvey');
Route::post('admin/get-triwulan-survey', 'Admin\MasterController@CekTriwulanSurvey')->name('admin.Get_triwulan.hasilsurvey');


//master hasil survey komponen
Route::get('/admin/master-hasilsurveykomponen', 'Admin\MasterController@indexhasilsurveykomponen')->name('admin.hasilsurveykomponen');
Route::get('/get-data-hasilsurveykomponen', 'Admin\MasterController@getdatahasilsurveykomponen')->name('admin.datatables.getdata.hasilsurveykomponen');
Route::post('admin/simpan-hasilsurveykomponen', 'Admin\MasterController@simpanhasilsurveykomponen')->name('admin.simpan.hasilsurveykomponen');
Route::post('admin/edit-hasilsurveykomponen', 'Admin\MasterController@edithasilsurveykomponen')->name('admin.edit.hasilsurveykomponen');
Route::post('admin/hapus-hasilsurveykomponen', 'Admin\MasterController@hapushasilsurveykomponen')->name('admin.hapus.hasilsurveykomponen');
Route::post('admin/get-triwulan-perkomponen', 'Admin\MasterController@CekTriwulankomponen')->name('admin.Get_triwulan.hasilPerkomponen');

//master unsur

Route::get('/admin/master-unsur', 'Admin\MasterController@indexunsur')->name('admin.unsur');
Route::get('/get-data-unsur', 'Admin\MasterController@getdataunsur')->name('admin.datatables.getdata.unsur');
Route::post('admin/simpan-unsur', 'Admin\MasterController@simpanunsur')->name('admin.simpan.unsur');
Route::post('admin/edit-unsur', 'Admin\MasterController@editunsur')->name('admin.edit.unsur');
Route::post('admin/hapus-unsur', 'Admin\MasterController@hapusunsur')->name('admin.hapus.unsur');
Route::post('admin/show-hide-unsur', 'Admin\MasterController@updateStatusunsur')->name('admin.update_status.unsur');

//master standart

Route::get('/admin/master-standart', 'Admin\MasterController@indexstandart')->name('admin.standart');
Route::get('/get-data-standart', 'Admin\MasterController@getdatastandart')->name('admin.datatables.getdata.standart');
Route::post('admin/simpan-standart', 'Admin\MasterController@simpanstandart')->name('admin.simpan.standart');
Route::post('admin/edit-standart', 'Admin\MasterController@editstandart')->name('admin.edit.standart');
Route::post('admin/hapus-standart', 'Admin\MasterController@showstandart')->name('admin.show.standart');
