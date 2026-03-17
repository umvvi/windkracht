<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    protected $table = 'personal_information';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'street_address',
        'city',
        'postal_code',
        'date_of_birth',
        'phone_mobile',
        'bsn',
    ];

    /**
     * Get the user associated with this personal information.
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
