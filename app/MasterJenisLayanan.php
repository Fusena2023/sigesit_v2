<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class MasterJenisLayanan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'master_jenis_layanan';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','jenis_layanan', 'deskripsi','icon','show','batasan'
    ];
}