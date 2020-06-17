<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'Countries';
    //
    protected $fillable = [
        'Code',

    ];

    public function cities(){

        return $this->hasMany(Cities::class);

    }

    public function offices(){

        return $this->hasMany(Offices::class);

    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(CountryTranslation::class)->where('locale', '=', $language);
    }
}
