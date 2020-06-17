<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuelTypes extends Model
{
    protected $table = 'fueltypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'DefaultFuelName',
        'isActive'
    ];

    public function cars(){

        return $this->hasMany(Cars::class);

    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(FuelTypesTranslation::class)->where('locale', '=', $language);
    }
}
