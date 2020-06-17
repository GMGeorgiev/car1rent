<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SIPPResults extends Model
{
    protected $table = 'SIPPcodeResults';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CarID',
        'SippID',
    ];
    //

    public function cars()
    {
        return $this->belongsTo(Cars::class, 'CarID');
    }

    public function sipp()
    {
        return $this->belongsTo(SIPPcodes::class, 'SippID');
    }
}
