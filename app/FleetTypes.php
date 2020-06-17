<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FleetTypes extends Model
{
    protected $table = 'fleettypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'DefaultFleetName',
        'isActive',
    ];

    public function models(){

        return $this->hasMany(CarModels::class);

    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(FleetTypesTranslation::class)->where('locale', '=', $language);
    }
}
