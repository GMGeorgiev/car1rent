<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarsToPriceRules extends Model
{
    protected $table = 'CarsToPriceRules';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CarID',
        'RuleID',
        'isActive'
    ];


    public function Car()
    {
        return $this->belongsTo(Cars::class,'CarID');
    }
    public function Rule()
    {
        return $this->belongsTo(PriceRules::class, 'RuleID');
    }
}
