<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Kepuasan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'kepuasan_pengguna';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','id_pengguna','kategori','id_terkait','nilai'
    ];
}
