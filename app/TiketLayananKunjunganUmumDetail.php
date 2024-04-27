<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class TiketLayananKunjunganUmumDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'tiket_layanan_kunjungan_umum_detail';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','personil', 'keperluan','id_pusat','id_tiket_kunjunganumum'
    ];
}