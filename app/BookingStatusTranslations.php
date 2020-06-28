<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingStatusTranslations extends Model
{
    protected $table = 'BookingStatusTranslations';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'BookingStatusID',
        'BookingStatusName',
        'locale',
        'isActive',
    ];
    //
    public function payment()
    {
        return $this->belongsTo(BookingStatuses::class);
    }
}
