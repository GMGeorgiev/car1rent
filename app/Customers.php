<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'Customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phone',
        'countryID',
        'address',
        'birth_date',
        'user_id',
        'isActive'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
