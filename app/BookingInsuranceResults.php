<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingInsuranceResults extends Model
{
    protected $table = 'BookingInsuranceResults';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'BookingID',
        'InsuranceID',
    ];
    //

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'BookingID');
    }

    public function rentalExtra()
    {
        return $this->belongsTo(BookingInsuranceResults::class, 'InsuranceID');
    }
}
