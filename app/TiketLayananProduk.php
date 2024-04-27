<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class TiketLayananProduk extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'tiket_layanan_produk';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','no_tiket', 'tanggal','status','id_pengguna','created_at','updated_at','kuesioner'
    ];
}
