<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $table = 'Coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'couponPrice',
        'start_date',
        'end_date',
        'once',
        'percent',
        'description',
        'isActive',
    ];


    public function results(){

        return $this->hasMany(CouponResults::class);

    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(CouponResults::class)->where('locale', '=', $language);
    }
    //
}
