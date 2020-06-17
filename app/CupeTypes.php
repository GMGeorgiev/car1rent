<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CupeTypes extends Model
{
    protected $table = 'cupetypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CupeTypeName',
        'isActive',
    ];



    public function cars(){

        return $this->hasMany(Cars::class);

    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(CupeTypesTranslation::class)->where('locale', '=', $language);
    }
}
