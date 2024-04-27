<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Tiket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'tiket';
    public $primaryKey = 'id';
    public $timestamps = false;

    // protected $fillable = [
    //     'id','kategori', 'tanggal','id_terkait','no_tiket','status'
    // ];
    protected $guarded = [];
    
    public function namas()
    {
        return $this->belongsTo(User::class, 'id_pengguna')->withDefault();
    }
}