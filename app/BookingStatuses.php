<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingStatuses extends Model
{
    protected $table = 'BookingStatuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'isActive'
    ];

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(BookingStatusTranslations::class)->where('locale', '=', $language);
    }
}
