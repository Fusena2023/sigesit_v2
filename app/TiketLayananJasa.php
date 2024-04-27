<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class TiketLayananJasa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'tiket_layanan_jasa';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','no_tiket', 'tanggal','mulai','selesai','status','id_master_layananjasa','id_pengguna','created_at','updated_at','kuesioner'
    ];


    public function namas()
    {
        return $this->belongsTo(User::class, 'id_pengguna')->withDefault();
    }


}
