<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingExtraResults extends Model
{
    protected $table = 'BookingExtraResults';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'BookingID',
        'RentalExtraID',
        'count',
        'price'
    ];
    //

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'BookingID');
    }

    public function rentalExtra()
    {
        return $this->belongsTo(RentalExtras::class, 'RentalExtraID');
    }
}
