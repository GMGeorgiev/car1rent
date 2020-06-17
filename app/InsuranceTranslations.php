<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceTranslations extends Model
{
    protected $table = 'InsuranceTranslations';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'insurance_id',
        'insuranceName',
        'insuranceDescription',
        'locale',
        'isActive',
    ];
    //

    public function Insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
}
