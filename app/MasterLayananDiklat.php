<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class MasterLayananDiklat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'master_layanan_diklat';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','nama_layanan_diklat', 'deskripsi','gambar','icon','status','id_pusat'
    ];
}