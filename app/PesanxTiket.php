<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class PesanxTiket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'pesanxtiket';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','kode', 'tanggal','status','id_pengguna','created_at','updated_at','perihal'
    ];
}