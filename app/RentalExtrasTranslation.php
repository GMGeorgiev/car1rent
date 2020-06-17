<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalExtrasTranslation extends Model
{
    protected $table = 'RentalExtrasTranslation';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'extra_id',
        'RentExtraName',
        'locale',
        'isActive',
    ];
    //
    public function price()
    {
        return $this->belongsTo(RentalExtras::class);
    }
}
