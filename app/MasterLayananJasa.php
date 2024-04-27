<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class MasterLayananJasa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'master_layanan_jasa';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','nama_layanan_jasa', 'deskripsi','gambar','icon','status','id_pusat'
    ];
}