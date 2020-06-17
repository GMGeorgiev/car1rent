<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppLanguage extends Model
{
    protected $table = 'AppLanguage';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
        'iso',
        'is_primary',
        'isActive',
    ];
}
