<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RegNumber',
        'MakerID',
        'ModelID',
        'OfficeID',
        'FuelID',
        'CupeTypeID',
        'ModelYear',
        'image',
        'CarBasePrice',
        'Doors',
        'Seats',
        'AC',
        'TankCapacity',
        'TrunkVolume',
        'Engine',
        'GearType',
        'HP',
        'SIPP',
        'sipp1_id',
        'sipp2_id',
        'sipp3_id',
        'sipp4_id',
        'isActive',
    ];


    public function priceRules()
    {
        return $this->hasMany(CarsToPriceRules::class);
    }




    public function Maker()
    {
        return $this->belongsTo(Makers::class, 'MakerID');
    }

    public function Model()
    {
        return $this->belongsTo(CarModels::class, 'ModelID');
    }

    public function Office()
    {
        return $this->belongsTo(Offices::class, 'OfficeID');
    }

    public function Fuel()
    {
        return $this->belongsTo(FuelTypes::class, 'FuelID');
    }

    public function CupeType()
    {
        return $this->belongsTo(CupeTypes::class, 'CupeTypeID');
    }

    public function SIPP1()
    {
        return $this->belongsTo(SIPPcodes::class, 'sipp1_id');
    }

    public function SIPP2()
    {
        return $this->belongsTo(SIPPcodes::class, 'sipp2_id');
    }

    public function SIPP3()
    {
        return $this->belongsTo(SIPPcodes::class, 'sipp3_id');
    }

    public function SIPP4()
    {
        return $this->belongsTo(SIPPcodes::class, 'sipp4_id');
    }

    public static function getAllModels(){
        $allModels = array();
        $allCars = self::all();
        $allCars = $allCars->all();
        $allModels = array_map(function($car){
            $model = CarModels::where('id', $car->ModelID)->first();
            $modelTitle = $model->ModelName . ' ' . $car->RegNumber;
            return $modelTitle;
        }, $allCars);
        return $allModels;
    }

}
