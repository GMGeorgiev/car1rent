<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offices extends Model
{
    //
    protected $table = 'offices';

    protected $fillable = [
        'CountryID',
        'CityID',
        'lat',
        'lon',
        'Phone',
        'MobilePhone',
        'Fax',
        'email',
        'office_image_url',
        'isActive',

    ];
    public function countries(){

        return $this->belongsTo(Countries::class);

    }
    public function cities(){

        return $this->belongsTo(Cities::class);

    }
    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(OfficiesTranslations::class)->where('locale', '=', $language);
    }
}
