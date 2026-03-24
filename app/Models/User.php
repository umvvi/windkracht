<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email',
        'password',
        'role',
        'is_active',
        'activation_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the personal information associated with the user.
     */
    public function personalInformation()
    {
        return $this->hasOne(PersonalInformation::class);
    }

    /**
     * Get reservations for customers.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'customer_id');
    }

    /**
     * Get lessons for instructors.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'instructor_id');
    }

    /**
     * Get login logs for user.
     */
    public function loginLogs()
    {
        return $this->hasMany(LoginLog::class);
    }

    /**
     * Check if user is customer
     */
    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    /**
     * Check if user is instructor
     */
    public function isInstructor()
    {
        return $this->role === 'instructor';
    }

    /**
     * Check if user is owner
     */
    public function isOwner()
    {
        return $this->role === 'owner';
    }
}
