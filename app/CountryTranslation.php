<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    protected $table = 'CountriesTranslation';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'countryName',
        'locale',
        'isActive',
    ];
    //

    public function country()
    {
        return $this->belongsTo(Countries::class);
    }
}
