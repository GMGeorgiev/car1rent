<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatuses extends Model
{
    protected $table = 'PaymentStatuses';

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
        return $this->hasMany(PaymentStatusTranslations::class)->where('locale', '=', $language);
    }
}
