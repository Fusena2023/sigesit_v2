<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class MasterFAQ extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'master_faq';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','pertanyaan','jawaban','status'
    ];
}