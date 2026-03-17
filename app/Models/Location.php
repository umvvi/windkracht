<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'city',
        'description',
    ];

    /**
     * Get the lessons at this location.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Get the reservations at this location.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
