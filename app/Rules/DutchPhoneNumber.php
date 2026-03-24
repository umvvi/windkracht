<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DutchPhoneNumber implements Rule
{
    public function passes($attribute, $value)
    {
        // Allow empty values (nullable)
        if (empty($value)) {
            return true;
        }

        // Check format: 06XXXXXXXX or +31612345678
        return preg_match('/^((\+31|0)[1-9]\d{1,9})$/', str_replace([' ', '-'], '', $value)) === 1;
    }

    public function message()
    {
        return 'Telefoonnummer moet een geldig Nederlands nummer zijn (06... of +31...).';
    }
}
