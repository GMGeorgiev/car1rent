<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarExtrasTranslation extends Model
{
    protected $table = 'CarExtrasTranslation';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'extra_id',
        'DefaultName',
        'locale',
        'isActive',
    ];
    //
    public function ExtraType()
    {
        return $this->belongsTo(CarsExtras::class);
    }


}
