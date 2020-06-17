<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatusTranslations extends Model
{
    protected $table = 'PaymentStatusTranslations';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'PaymentStatusID',
        'PaymentStatusName',
        'locale',
    ];
    //
    public function payment()
    {
        return $this->belongsTo(PaymentStatuses::class);
    }
}
