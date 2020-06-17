<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingAdditions extends Model
{
    protected $table = 'BookingAdditions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bookingID',
        'firstName',
        'lastName',
        'email',
        'phone',
        'email_verified_at',
        'countryID',
        'address',
        'birth_date',
        'TakeAddress',
        'RetAddress',
        'message',
        'paymentType',
        'payment_status'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'BookingID');
    }
}
