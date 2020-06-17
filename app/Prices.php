<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    protected $table = 'Prices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'isActive', 'isUsed'
    ];

    public function PriceRules(){

        return $this->hasMany(PriceRules::class);

    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(PricesTranslation::class)->where('locale', '=', $language);
    }
}
