<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CupeTypesTranslation extends Model
{
    protected $table = 'CupeTypesTranslation';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cupeType_id',
        'DefaultName',
        'locale',
        'isActive',
    ];
    //

    public function CoupeType()
    {
        return $this->belongsTo(CupeTypes::class);
    }

}
