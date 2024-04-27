<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxBeli extends Model
{
    protected $table = 'trx_beli';

    protected $primaryKey = 'id_beli';

    /* protected $fillable = ['kode_transaksi', 'nama_instansi', 'alamat', 'provinsi', 'kabupaten', 'telp', 'sudahbayar',
		'type_input', 'id_instansi', 'id_sentra', 'jenis_tarif', 'bukti_bayar', 'gudang', 'timecreate', 'jam',
		'status_berjalan', 'tanggal_proses', 'id_user', 'cetakan', 'nomor_kwitansi', 'nomor_faktur', 'id_cp']; */
    protected $guarded = [];

    public $timestamps = false;
}
