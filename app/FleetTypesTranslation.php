<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FleetTypesTranslation extends Model
{
    protected $table = 'FleetTypesTranslation';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fleetType_id',
        'FleetName',
        'locale',
        'isActive',
    ];
    //

    public function FleetType()
    {
        return $this->belongsTo(FleetTypes::class);
    }
}
