<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class TiketLayananDiklat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'tiket_layanan_diklat';
    public $primaryKey = 'id';

    protected $fillable = [
        'id','no_tiket', 'tanggal','mulai','selesai','status','id_master_layanandiklat','id_pengguna','created_at','updated_at'
    ];
}