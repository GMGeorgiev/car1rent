<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTypeTranslations extends Model
{
    protected $table = 'PaymentTypeTranslations';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'PaymentTypeID',
        'PaymentTypeName',
        'PaymentTypeDescription',
        'locale',
        'isActive',
    ];
    //
    public function payment()
    {
        return $this->belongsTo(PaymentTypes::class);
    }
}
