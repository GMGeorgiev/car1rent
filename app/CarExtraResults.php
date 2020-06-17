<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarExtraResults extends Model
{
    protected $table = 'carextraresults';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CarID',
        'CarExtraID',
    ];
    //

    public function cars()
    {
        return $this->belongsTo(Cars::class);
    }

    public function extra()
    {
        return $this->belongsTo(CarsExtras::class);
    }
}
