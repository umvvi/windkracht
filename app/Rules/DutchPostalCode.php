<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DutchPostalCode implements Rule
{
    public function passes($attribute, $value)
    {
        // Allow empty values (nullable)
        if (empty($value)) {
            return true;
        }

        // Check format: 1234AB (4 digits + 2 letters, case-insensitive)
        return preg_match('/^\d{4}[a-zA-Z]{2}$/', $value) === 1;
    }

    public function message()
    {
        return 'Postcode moet het formaat XXXXAB hebben (4 cijfers en 2 letters), bijvoorbeeld 1234AB.';
    }
}
