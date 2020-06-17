<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuelTypesTranslation extends Model
{
    protected $table = 'FuelTypesTranslation';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fuel_id',
        'FuelName',
        'locale',
        'isActive',
    ];
    //

    public function FuelType()
    {
        return $this->belongsTo(FuelTypes::class);
    }

}
