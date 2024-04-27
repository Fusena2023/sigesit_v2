<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class TiketLayananKunjunganUmum extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'tiket_layanan_kunjungan_umum';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','no_tiket', 'tanggal','status','id_pengguna','created_at','updated_at','kuesioner'
    ];

    public function namas()
    {
        return $this->belongsTo(User::class, 'id_pengguna')->withDefault();
    }

    
}
