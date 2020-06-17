<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModels extends Model
{
    protected $table = 'carmodels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ModelName',
        'MakerID',
        'FleetTypeID',
        'ModelYear',
        'image',
        'ModelBasePrice',
        'isActive',
    ];

    public function maker()
    {
        return $this->belongsTo(Makers::class);
    }


    public function fleetType()
    {
        return $this->belongsTo(FleetTypes::class);
    }

    public function priceRules()
    {
        return $this->hasMany(PriceRules::class);
    }


}
