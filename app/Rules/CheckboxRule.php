<?php

namespace RServices\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckboxRule implements Rule
{

    public function passes($attribute, $value)
    {
        if (is_null($value)) return false;

        return boolval($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Chechbox field is invalid.';
    }
}
