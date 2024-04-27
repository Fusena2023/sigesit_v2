<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class MasterBerita extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'master_berita';
    public $primaryKey = 'id';

    protected $fillable = [
        'id','judul', 'deskripsi','gambar','show','created_at','updated_at'
    ];
}