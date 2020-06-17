<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    protected $table = 'Discounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CupeTypeName',
        'isActive',
    ];

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(DiscountTranslations::class)->where('locale', '=', $language);
    }
}
