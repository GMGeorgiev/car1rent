<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{

    public function offices(){

        return $this->hasMany(Offices::class);

    }

    public function countries(){

        return $this->belongsTo(Countries::class);

    }



    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(PricesTranslation::class)->where('locale', '=', $language);
    }

}
