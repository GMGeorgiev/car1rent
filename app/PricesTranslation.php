<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricesTranslation extends Model
{
    protected $table = 'PricesTranslation';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price_id',
        'Name',
        'locale',
        'isActive',
    ];
    //
    public function price()
    {
        return $this->belongsTo(Prices::class);
    }
}
