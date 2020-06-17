<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTypes extends Model
{
    protected $table = 'PaymentTypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'isActive'
    ];

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(PaymentTypeTranslations::class)->where('locale', '=', $language);
    }
}
