<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuoLessonParticipant extends Model
{
    protected $fillable = [
        'lesson_id',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'is_registered_user',
    ];

    /**
     * Get the lesson for this participant.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Get the user if this is a registered user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
