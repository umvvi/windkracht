<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'type',
        'duration_hours',
        'price_per_person',
        'num_sessions',
        'description',
    ];

    /**
     * Get the reservations for this package.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Get display format for duration
     */
    public function getFormattedDurationAttribute()
    {
        $hours = intval($this->duration_hours);
        $minutes = ($this->duration_hours - $hours) * 60;
        
        if ($minutes === 0) {
            return "{$hours}h";
        }
        return "{$hours}h {$minutes}m";
    }

    /**
     * Get total package price
     */
    public function getTotalPriceAttribute()
    {
        return $this->price_per_person * ($this->type === 'duo' ? 2 : 1);
    }
}
