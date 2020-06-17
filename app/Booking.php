<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'Booking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'company_id',
        'user_id',
        'from_date',
        'to_date',
        'car_id',
        'status',
        'amount',
        'pickup_loc',
        'drop_loc',
        'ins_code',
        'description',
        'booking_file'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }

}
