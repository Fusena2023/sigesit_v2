<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class MasterPusat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'master_pusat';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','nama_pusat','status'
    ];
}