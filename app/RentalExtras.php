<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalExtras extends Model
{
    protected $table = 'RentalExtras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RentExtraPrice',
        'MaxPrice',
        'Description',
        'rental_extra_image',
        'allow_choice',
        'choice_number',
        'isActive'
    ];



    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(RentalExtrasTranslation::class)->where('locale', '=', $language);
    }
}
