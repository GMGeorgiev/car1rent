<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makers extends Model
{
    protected $table = 'makers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'MakerName', 'isActive'
    ];
    public function models(){

        return $this->hasMany(CarModels::class);

    }
}
