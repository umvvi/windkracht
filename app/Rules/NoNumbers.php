<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoNumbers implements Rule
{
    private $fieldName;

    public function __construct($fieldName = 'Dit veld')
    {
        $this->fieldName = $fieldName;
    }

    public function passes($attribute, $value)
    {
        // Allow empty values (nullable)
        if (empty($value)) {
            return true;
        }

        // Check that string does NOT contain any digits
        return !preg_match('/\d/', $value);
    }

    public function message()
    {
        return $this->fieldName . ' mag geen nummers bevatten.';
    }
}
