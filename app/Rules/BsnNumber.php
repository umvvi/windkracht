<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BsnNumber implements Rule
{
    public function passes($attribute, $value)
    {
        // Allow empty values (nullable)
        if (empty($value)) {
            return true;
        }

        // Check format: exactly 9 digits
        return preg_match('/^\d{9}$/', $value) === 1;
    }

    public function message()
    {
        return 'BSN moet uit 9 cijfers bestaan.';
    }
}
