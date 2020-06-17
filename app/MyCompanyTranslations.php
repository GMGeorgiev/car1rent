<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyCompanyTranslations extends Model
{
    protected $table = 'MyCompanyTranslations';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'companyID',
        'companyName',
        'companyAddress',
        'locale',
        'isActive',
    ];
    public function company()
    {
        return $this->belongsTo(MyCompany::class);
    }
    //
}
