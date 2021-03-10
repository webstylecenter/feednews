<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValueIsEmpty implements Rule
{
    public function passes($attribute, $value): bool
    {
        return strlen($value) === 0;
    }

    public function message(): string
    {
        return 'Address field must be empty';
    }
}
