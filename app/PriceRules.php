<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceRules extends Model
{
    protected $table = 'PriceRules';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price_id',
        'start_date',
        'end_date',
        'RulePrice',
        'price_day',
        'price_2_4_days',
        'price_5_7_days',
        'price_8_15_days',
        'price_16_30_days',
        'price_31_days',
        'price_weekend',
        'Description',
        'car_id',
        'model_id',
        'gear_type',
        'ac',
        'fuel_id',
        'sipp_id',
        'fleet_id',
        'maker_id',
        'coupe_id',
        'discount_id',
        'weight',
        'isUsed',
        'isActive',
        'CarExtraID',
        'discount_percent',
    ];

    // helpers



    //foreign keys

    public function cars()
    {
        return $this->hasMany(CarsToPriceRules::class);
    }

    public function carsToPrices()
    {
        return $this->hasMany(CarsToPriceRules::class);
    }

    public function models()
    {
        return $this->belongsTo(CarModels::class, 'model_id');
    }
}
