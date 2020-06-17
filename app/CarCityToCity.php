<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarCityToCity extends Model
{
    protected $table = 'CarCityToCity';

    protected $fillable = [
        'cityFromID',
        'cityToID',
        'TransferPrice',
        'isActive',
    ];

    public function cityFrom()
    {
        return $this->belongsTo(Cities::class, 'cityFromID');
    }

    public function cityTo()
    {
        return $this->belongsTo(Cities::class, 'cityToID');
    }
}
