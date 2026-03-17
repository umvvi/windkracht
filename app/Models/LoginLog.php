<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'logged_at',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    /**
     * Get the user for this login log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
