<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficiesTranslations extends Model
{
    //
    protected $table = 'OfficiesTranslations';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'officeID',
        'officeName',
        'officeAddress',
        'locale',

    ];

    public function company()
    {
        return $this->belongsTo(Offices::class);
    }
}
