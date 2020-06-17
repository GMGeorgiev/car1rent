<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SIPPcodes extends Model
{
    protected $table = 'SIPPcodes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Code', 'Position', 'Description', 'isActive'
    ];

    public function sippResults(){

        return $this->hasMany(SIPPResults::class);

    }

    public function cars(){

        return $this->hasMany(Cars::class);

    }
}
