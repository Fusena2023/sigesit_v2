<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class MasterLayananDigital extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'master_layanan_digital';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id','nama_layanan', 'deskripsi','icon','show','url'
    ];
}