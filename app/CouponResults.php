<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponResults extends Model
{
    protected $table = 'CouponResults';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'couponID',
        'bookingID',
        'customerID',
        'isActive',
    ];
    //

    public function coupon()
    {
        return $this->belongsTo(Coupons::class);
    }
}
