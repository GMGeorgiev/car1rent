<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyCompany extends Model
{
    protected $table = 'MyCompany';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'countryID',
        'companyPhone',
        'companyEmail',
        'beginWork',
        'endWork',
        'isActive',
    ];

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(MyCompanyTranslations::class)->where('locale', '=', $language);
    }
}
