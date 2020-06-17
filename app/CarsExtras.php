<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarsExtras extends Model
{
    protected $table = 'carextras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ExtraName',
        'image',
        'isActive'
    ];

    public function carsResults(){

        return $this->hasMany(CarExtraResults::class);

    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(CarExtrasTranslation::class)->where('locale', '=', $language);
    }
}
