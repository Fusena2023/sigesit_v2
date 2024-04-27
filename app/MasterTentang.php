<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class MasterTentang extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'master_tentang';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','deskripsi','lokasi_big','lokasi_tatapmuka','status','status_lokasi','email','telpon','website'
    ];
}